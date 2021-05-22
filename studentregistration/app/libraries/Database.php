<?php
/**
 * PDO Database Class
 * Connect to database
 * Return rows and results
 */

class Database {
    protected static $instance;

	public function __construct() {
        return self::getInstance();
    }

    /**
     * Static db instance
     * returns db instance 
     * if already present then returns the instance
     * if not present then create the new PDO instance and return
     * 
     */
	public static function getInstance() {

		if(empty(self::$instance)) {

			$db_info = array(
				"db_host" => DB_HOST,
				"db_user" => DB_USER,
				"db_pass" => DB_PASS,
				"db_name" => DB_NAME,
                "db_port" => DB_PORT,
				"db_charset" => "UTF-8");

			try {
				self::$instance = new PDO("mysql:host=".$db_info['db_host'].';port='.$db_info['db_port'].';dbname='.$db_info['db_name'], $db_info['db_user'], $db_info['db_pass']);
				self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
				self::$instance->query('SET NAMES utf8');
				self::$instance->query('SET CHARACTER SET utf8');

			} catch(PDOException $error) {
				echo $error->getMessage();
			}

		}

		return self::$instance;
	}

    /**
     * Prepares the query 
     */
    public function query($sql){
        $this->stmt = self::$instance->prepare($sql);
      }
  
    /**
     * Bind values
     * 
     */
      public function bind($param, $value, $type = null){
        if(is_null($type)){
          switch(true){
            case is_int($value):
              $type = PDO::PARAM_INT;
              break;
            case is_bool($value):
              $type = PDO::PARAM_BOOL;
              break;
            case is_null($value):
              $type = PDO::PARAM_NULL;
              break;
            default:
              $type = PDO::PARAM_STR;
          }
        }
  
        $this->stmt->bindValue($param, $value, $type);
      }
  
      // Execute the prepared statement
      public function execute(){
        return $this->stmt->execute();
      }
  
      // Get result set as array of objects
      public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
      }
  
      // Get single record as object
      public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
      }
  
      // Get row count
      public function rowCount(){
        return $this->stmt->rowCount();
      }
}

?>