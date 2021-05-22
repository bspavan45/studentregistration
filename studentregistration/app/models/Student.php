<?php

class Student {
    private $dbh;
    private $response;

    public function __construct() {
        //get db instance
        $this->dbh = new Database;
        $this->response = [];
    }

    /**
     * Registers a student
     * returns success or failure array with custom message
     */
    public function registerStudent($data) {
        try{
            $this->dbh->query('INSERT INTO student_info (first_name, last_name, dob, contact_number) VALUES (:fname, :lname, :dob, :cnum)');
            //bind the params with values
            $this->dbh->bind(":fname", $data['fname']);
            $this->dbh->bind(":lname", $data['lname']);
            $this->dbh->bind(":dob", $data['dob']);
            $this->dbh->bind(":cnum", $data['phone']);
            //execute the query
            if($this->dbh->execute()) {
                $this->response = [
                    "status"=> "success",
                    "message" => "The student has been registered."
                ];
            }
            return $this->response;

        } catch(PDOException $e) {
            $this->response = [
                "status"=> "error",
                "message" => "The student could not be registered. Please try again later"
            ];
            return $this->response;
        }
    }

    /**
     * Updates student information
     * returns success or failure array with custom message
     */
    public function updateStudent($data) {
        try{
            $this->dbh->query('UPDATE student_info SET first_name = :fname , last_name = :lname, dob = :dob, contact_number = :cnum WHERE student_id = :id');
            //bind the params with values
            $this->dbh->bind(":fname", $data['fname']);
            $this->dbh->bind(":lname", $data['lname']);
            $this->dbh->bind(":dob", $data['dob']);
            $this->dbh->bind(":cnum", $data['phone']);
            $this->dbh->bind(":id", $data['student_id']);
            //execute the query
            if($this->dbh->execute()) {
                $this->response = [
                    "status"=> "success",
                    "message" => "Student details updated successfully."
                ];
            }
            return $this->response;

        } catch(PDOException $e) {
            $this->response = [
                "status"=> "error",
                "message" => "Student details could not be updated. Please try again later"
            ];
            return $this->response;
        }
    }

    /**
     * Get all registered student details
     */
    public function getStudentInfo() {
        try {
            $this->dbh->query('SELECT * FROM student_info');
            $students = $this->dbh->resultSet();
            return $students;
        } catch(PDOException $e) {
            $this->response = [
                "status"=> "error",
                "message" => "Unable to fetch all student details. Please contact the admin"
            ];
            return $this->response;
        }

    }

    /**
     * Get registered student details based on the id
     */
    public function getSingleStudentInfo($id) {
        try {
            $this->dbh->query('SELECT * FROM student_info where student_id = :id');
            $this->dbh->bind(":id", $id);
            $student = $this->dbh->single();
            $this->response = [
                "status"=> "success",
                "message" => "Student details fetched successfully.",
                "data" => $student
            ];
            return $this->response;
        } catch(PDOException $e) {
            $this->response = [
                "status"=> "error",
                "message" => "Unable to fetch a single student details."
            ];
            return $this->response;
        }

    }

    /**
     * Delete the registered student details
     * make sure the foreign key references are deleted first and then delete the entry from the student table
     * ON DELETE CASCADE is defined for the table 'subscription', if a student is deleted from primary table then
     * the entry from the subscription will also be deleted
     */
    public function deleteStudent($id) {
        try {
                $this->dbh->query('DELETE FROM student_info where student_id = :id');
                $this->dbh->bind(":id", $id);
                if($this->dbh->execute()){
                    $rowCount= $this->dbh->rowCount();
                    $this->response = [
                        "status"=> "success",
                        "message" => "Student has been deleted.",
                        "rows_affected"=>$rowCount
                    ];
                }
            return $this->response;
        } catch(PDOException $e) {
            $this->response = [
                "status"=> "error",
                "message" => "Unable to delete Student. Please try again later."
            ];
            return $this->response;
        }
    }

}

?>