<?php
    /**
     * Reports controller: used to get the students subscribed for the courses list to display in 
     * "Generate Reports" view
     * View file - reports/report
     */

class Reports extends Controller {
    public function __construct() {
        $this->reportModel = $this->model('Report');
    }

    public function index() {
        $courseDetails = $this->reportModel->getStudentCourseInfo();
        $this->view('reports/report', $courseDetails);
        
    }
}

?>