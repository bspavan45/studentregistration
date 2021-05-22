<?php
    /**
     * Subscriiption controller: used to subscribe students to courses 
     * View file - /register/enroll
     */
class Subscription extends Controller {
    public function __construct() {
        $this->enrollModel = $this->model('Enroll');
        $this->studentModel = $this->model('Student');
        $this->courseModel = $this->model('Course');
    }

    /**
     * Get the students and course details to fill the drop downs
     */
    public function index(){
        $students = $this->studentModel->getStudentInfo();
        $courses  = $this->courseModel->getCourses();
        $data = [
          "students_info" => $students,
          "courses" => $courses
        ];
        $this->view('/register/enroll', $data);
      }

      public function enroll(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = [
                'student_id' => $_POST['students'],
                'course_id' => $_POST['courses']
            ];
            $enrollment = $this->enrollModel->registerStudentCourse($data);
            if($enrollment['status'] == 'success') {
                $this->view('results/success', $enrollment);
            } else {
                $this->view('results/error', $enrollment);
            }   
        }
      }

}

?>