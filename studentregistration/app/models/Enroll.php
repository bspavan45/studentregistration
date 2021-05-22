<?php

class Enroll {
    private $dbh;
    private $response;

    public function __construct() {
        //get the db instance
        $this->dbh = new Database;
        $this->response = [];
    }

    /**
     * Subscribe students to courses
     */
    public function registerStudentCourse($data) {
        foreach($data['course_id'] as $cid) {
            $qrystr[] = "({$data['student_id']},{$cid})";  
        }
        $qry = implode(',', $qrystr);
        try{
            $this->dbh->query('INSERT INTO subscription (student_id, course_id) VALUES '. $qry);
            //execute the query
            if($this->dbh->execute()) {
                $this->response = [
                    "status"=> "success",
                    "message" => "successfully registered student to the course."
                ];
            }
            return $this->response;

        } catch(PDOException $e) {
            $this->response = [
                "status"=> "error",
                "message" => "The student might be registered already. Please check and try again"
            ];
            return $this->response;
        }

    }
    
}

?>