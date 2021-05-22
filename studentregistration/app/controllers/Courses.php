<?php
/**
 * Courses controller
 */
class Courses extends Controller{
    public function __construct() {
        $this->courseModel = $this->model('Course');
    }

    /**
     * This method will register the user
     */
    public function register() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize the incoming post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //if Post then process the form and add to DB
            $data = [
                "title"=>'Course Registration Details',
                'cname'=> $_POST['cname'],
                'cdes'=> $_POST['cdesc'],
                'cname_err' => '',
                'cdes_err' => '',
                'return_status' => '',
                'return_message' => '',
                'type'=>'register'
            ];

            // Validate course name
            if(empty($data['cname'])){
                $data['cname_err'] = 'Please enter course name';
            }

            // Validate course description
            if(empty($data['cdes'])){
                $data['cdes_err'] = 'Please enter course description';
            }

            // Make sure errors are empty
        if(empty($data['cdes_err']) && empty($data['cname_err'])){
            // successfully Validated
            $response = $this->courseModel->registerCourse($data);

            if($response['status'] == 'success') {
                $data = [
                    'title'=>'Course Registration Details',
                    'cname'=>'',
                    'cdes'=> '',
                    'cname_err' => '',
                    'cdes_err' => '',
                    'type'=>'register',
                    'return_status' => $response['status'],
                    'return_message' => $response['message'],
                    'course_id'=>''
                ];
            } else {
                $data['return_status'] = $response['status'];
                $data['return_message'] = $response['message'];
            }
            $this->view('register/course-registration', $data);
          } else {
            // Load view registration page with errors
            $this->view('register/course-registration', $data);
          }

        } else {
            $data = [
                "title"=>'Course Registration Details',
                'cname'=> '',
                'cdes'=> '',
                'cname_err' => '',
                'cdes_err' => '',
                'return_status' => '',
                'return_message' => '',
                'type'=>'register'
            ];
            $this->view('register/course-registration', $data);

        }
    }

    /**
     * This method will update the registered user
     */
    public function update($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize the incoming post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //if Post then process the form and add to DB
            $data = [
                "title"=>'Update Course details',
                'cname'=> $_POST['cname'],
                'cdes'=> $_POST['cdesc'],
                'cname_err' => '',
                'cdes_err' => '',
                'type'=>'update',
                'return_status' => '',
                'return_message' => '',
                'course_id'=>$id
            ];

            // Validate course name
            if(empty($data['cname'])){
                $data['cname_err'] = 'Please enter course name';
            }

            // Validate course description
            if(empty($data['cdes'])){
                $data['cdes_err'] = 'Please enter course description';
            }

            // Make sure errors are empty
        if(empty($data['cdes_err']) && empty($data['cname_err'])){
            // successfully Validated
            //Update course and display the message (on success or on failure)
            $response = $this->courseModel->updateCourse($data);
            $data['return_status'] = $response['status'];
            $data['return_message'] = $response['message'];
            $this->view('register/course-registration', $data);
          } else {
            // Load view registration page with errors
            $this->view('register/course-registration', $data);
          }        
        } else {
            $course = $this->courseModel->getSingleCourseInfo($id);
                if($course['status'] == 'success') {
                    $data = [
                        'title'=>'Update Course details',
                        'cname'=> $course['data']->course_name,
                        'cdes'=> $course['data']->course_description,
                        'cname_err' => '',
                        'cdes_err' => '',
                        'type'=>'update',
                        'return_status' => $course['status'],
                        'return_message' => $course['message'],
                        'course_id'=>$course['data']->course_id
                    ];
                    $this->view('register/course-registration', $data);
                } else {
                    $data = [
                        'message' => $course['message']
                    ];
                    $this->view('results/error', $data);
                }
        }
    }

    /**
     * This method will delete the registered user
     */
    public function delete($id) {
        $deleted = $this->courseModel->deleteCourse($id);
        if($deleted['status'] == 'success') {
            $this->view('results/success', $deleted);
        } else {
            $this->view('results/error', $deleted);
        }   
    }
}
?>