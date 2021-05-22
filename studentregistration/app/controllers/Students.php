<?php
    /**
     * Student controller: used to get the register students 
     * View file - register/student-registration
     */

class Students extends Controller {
    public function __construct() {
        $this->studentModel = $this->model('Student');
    }

    public function register() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize the incoming post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //if Post then process the form and add to DB
            $data = [
                'title' => 'Student Registration',
                'fname'=> $_POST['fName'],
                'lname'=> $_POST['lName'],
                'dob'=> $_POST['dob'],
                'phone'=> $_POST['cNUm'],
                'lname_err' => '',
                'fname_err' => '',
                'dob_err' => '',
                'phone_err' => '',
                'return_status' => '',
                'return_message' => '',
                'type'=>'register'
            ];

            // Validate First name
            if(empty($data['fname'])){
                $data['fname_err'] = 'Please enter first name';
            }

            // Validate Last name
            if(empty($data['lname'])){
                $data['lname_err'] = 'Please enter last name';
            }

            // Validate DOB
            if(empty($data['dob'])){
                $data['dob_err'] = 'Please enter DOB';
            } else {
                $dob = $data['dob'];  
                $formattedDate = date("Y-m-d", strtotime($dob));
                $data['dob'] = $formattedDate;
            }

            // Validate phone number
            if(empty($data['phone'])){
                $data['phone_err'] = 'Please enter phone number';
            }else if(strlen($data['phone']) > 10) {
                $data['phone_err'] = 'Phone number should be of maximum 10 digits';
            }

            // Make sure errors are empty
            if(empty($data['fname_err']) && empty($data['lname_err']) && empty($data['dob_err']) && empty($data['phone_err'])){
                // successfully Validated
                $response = $this->studentModel->registerStudent($data);
                if($response['status'] == 'success') {
                    $data = [
                        'title' => 'Student Registration',
                        'fname'=> '',
                        'lname'=> '',
                        'dob'=> '',
                        'phone'=> '',
                        'lname_err' => '',
                        'fname_err' => '',
                        'dob_err' => '',
                        'phone_err' => '',
                        'return_status' => $response['status'],
                        'return_message' => $response['message'],
                        'type'=>'register'
                    ];
                } else {
                    $data['return_status'] = $response['status'];
                    $data['return_message'] = $response['message'];
                }
                $this->view('register/student-registration', $data);
            } else {
                // Load view registration page with errors
                $this->view('register/student-registration', $data);
            }

        } else {
            $data = [
                'title' => 'Student Registration',
                'fname'=> '',
                'lname'=> '',
                'dob'=> '',
                'phone'=> '',
                'lname_err' => '',
                'fname_err' => '',
                'dob_err' => '',
                'phone_err' => '',
                'return_status' => '',
                'return_message' => '',
                'type'=>'register'
            ];
            $this->view('register/student-registration', $data);

        }
    }

    public function update($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize the incoming post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //if Post then process the form and add to DB
            $data = [
                'title' => 'Update student details',
                'fname'=> $_POST['fName'],
                'lname'=> $_POST['lName'],
                'dob'=> $_POST['dob'],
                'phone'=> $_POST['cNUm'],
                'lname_err' => '',
                'fname_err' => '',
                'dob_err' => '',
                'phone_err' => '',
                'type'=>'update',
                'return_status' => '',
                'return_message' => '',
                'student_id'=>$id
            ];

            // Validate First name
            if(empty($data['fname'])){
                $data['fname_err'] = 'Please enter first name';
            }

            // Validate Last name
            if(empty($data['lname'])){
                $data['lname_err'] = 'Please enter last name';
            }

            // Validate DOB
            if(empty($data['dob'])){
                $data['dob_err'] = 'Please enter DOB';
            } else {
                $dob = $data['dob'];  
                $formattedDate = date("Y-m-d", strtotime($dob));
                $data['dob'] = $formattedDate;
            }

            // Validate phone number
            if(empty($data['phone'])){
                $data['phone_err'] = 'Please enter phone number';
            } else if(strlen($data['phone']) > 10) {
                $data['phone_err'] = 'Phone number should be of maximum 10 digits';
            }

            // Make sure errors are empty
            if(empty($data['fname_err']) && empty($data['lname_err']) && empty($data['dob_err']) && empty($data['phone_err'])){
                // successfully Validated
                //Update student and display message (on success or on failure)
                $response = $this->studentModel->updateStudent($data);
                $data['return_status'] = $response['status'];
                $data['return_message'] = $response['message'];
                $this->view('register/student-registration', $data);
            } else {
                // Load view registration page with errors
                $this->view('register/student-registration', $data);
            }
        
        } else {
            $student = $this->studentModel->getSingleStudentInfo($id);
            if($student['status'] == 'success') {
                $data = [
                    'title' => 'Update student details',
                    'fname'=> $student['data']->first_name,
                    'lname'=> $student['data']->last_name,
                    'dob'=> $student['data']->dob,
                    'phone'=> $student['data']->contact_number,
                    'lname_err' => '',
                    'fname_err' => '',
                    'dob_err' => '',
                    'phone_err' => '',
                    'type'=>'update',
                    'return_status' => $student['status'],
                    'return_message' => $student['message'],
                    'student_id'=>$student['data']->student_id
                ];
                $this->view('register/student-registration', $data);
            } else {
                $data = [
                    'message' => $student['message']
                ];
                $this->view('results/error', $data);
            }   
        }
    }

    public function delete($id) {
        $deleted = $this->studentModel->deleteStudent($id);
        if($deleted['status'] == 'success') {
            $this->view('results/success', $deleted);
        } else {
            $this->view('results/error', $deleted);
        }       
    }
}
?>