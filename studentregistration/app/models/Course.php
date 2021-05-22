<?php

class Course {
    private $dbh;
    private $response;

    public function __construct() {
        //get the db instance
        $this->dbh = new Database;
        $this->response = [];
    }

    /**
     * Registers a course
     * returns success or failure array with custom message
     */
    public function registerCourse($data) {
        try{
            $this->dbh->query('INSERT INTO courses (course_name, course_description) VALUES (:cname, :cdes)');
            //bind the params with values
            $this->dbh->bind(":cname", $data['cname']);
            $this->dbh->bind(":cdes", $data['cdes']);
            //execute the query
            if($this->dbh->execute()) {
                $this->response = [
                    "status"=> "success",
                    "message" => "The Course has been registered."
                ];
            }
            return $this->response;

        } catch(PDOException $e) {
            $this->response = [
                "status"=> "error",
                "message" => "The course could not be registered. Please try again later"
            ];
            return $this->response;
        }
    }

    /**
     * Updates course information
     * returns success or failure array with custom message
     */
    public function updateCourse($data) {
        try{
            $this->dbh->query('UPDATE courses SET course_name = :cname , course_description = :cdes WHERE course_id = :id');
            //bind the params with values
            $this->dbh->bind(":cname", $data['cname']);
            $this->dbh->bind(":cdes", $data['cdes']);
            $this->dbh->bind(":id", $data['course_id']);
            //execute the query
            if($this->dbh->execute()) {
                $this->response = [
                    "status"=> "success",
                    "message" => "Course details updated successfully."
                ];
            }
            return $this->response;

        } catch(PDOException $e) {
            $this->response = [
                "status"=> "error",
                "message" => "Course details could not be updated. Please try again later"
            ];
            return $this->response;
        }
    }

    /**
     * Get all registered course details.
     */
    public function getCourses() {
        try {
            $this->dbh->query('SELECT * FROM courses');
            $courses = $this->dbh->resultSet();
            return $courses;
        } catch(PDOException $e) {
            $this->response = [
                "status"=> "error",
                "message" => "Unable to fetch all Course details. Please contact the admin"
            ];
            return $this->response;
        }

    }

    /**
     * Get registered course details based on the id
     */
    public function getSingleCourseInfo($id) {
        try {
            $this->dbh->query('SELECT * FROM courses where course_id = :id');
            $this->dbh->bind(":id", $id);
            $course = $this->dbh->single();
            $this->response = [
                "status"=> "success",
                "message" => "Course details fetched successfully.",
                "data" => $course
            ];
            return $this->response;
        } catch(PDOException $e) {
            $this->response = [
                "status"=> "error",
                "message" => "Unable to fetch Course details."
            ];
            return $this->response;
        }

    }

    /**
     * Delete the registered course details
     * make sure the foreign key references are deleted first and then delete the entry from the courses table
     * ON DELETE CASCADE is defined for the table 'subscription', if a course is deleted in primary table then
     * the entry from the subscription will also be deleted
     */
    public function deleteCourse($id) {
        try {
                $this->dbh->query('DELETE FROM courses where course_id = :id');
                $this->dbh->bind(":id", $id);
                if($this->dbh->execute()){
                    $rowCount= $this->dbh->rowCount();
                    $this->response = [
                        "status"=> "success",
                        "message" => "Course has been deleted.",
                        "rows_affected"=>$rowCount
                    ];
                }
            return $this->response;
        } catch(PDOException $e) {
            $this->response = [
                "status"=> "error",
                "message" => "Unable to delete the Course. Please try again later."
            ];
            return $this->response;
        }
    }

}

?>