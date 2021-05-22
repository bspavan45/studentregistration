<?php
class Report {
    private $dbh;
    private $response;

    public function __construct() {
        //get db instance
        $this->dbh = new Database;
        $this->response = [];
    }


    /**
     * Get all students registered for courses
     */
    public function getStudentCourseInfo() {
        try {
            $this->dbh->query('SELECT * FROM subscription INNER JOIN student_info ON subscription.student_id = student_info.student_id INNER JOIN courses ON subscription.course_id = courses.course_id');
            $results = $this->dbh->resultSet();
            // echo "<pre/>";
            // print_r($results);die;
            return $results;
        } catch(PDOException $e) {
            $this->response = [
                "status"=> "error",
                "message" => "Unable to fetch the details."
            ];
            return $this->response;
        }

    }
}
?>