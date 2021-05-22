<?php
  /**
     * Default controller
     */
  class Home extends Controller {
    public function __construct(){
      $this->studentModel = $this->model('Student');
      $this->courseModel = $this->model('Course');
    }

    /**
     * Default method
     * This will get the registered user and courses to display in the home page
     * View file - home/index
     */
    public function index(){
      $students = $this->studentModel->getStudentInfo();
      $courses  = $this->courseModel->getCourses();
      if(isset($courses['status']) && ($courses['status'] == 'error')) {
        $data =[
          'message' => $courses['message']
        ];
        $this->view('results/error', $data);
      } else if(isset($students['status']) && $students['status'] == 'error') {
        $data =[
          'message' => $students['message']
        ];
        $this->view('results/error', $data);
      } else {
        $data = [
          "students_info" => $students,
          "courses" => $courses
        ];
        $this->view('home/index', $data);
      }
    }
  }