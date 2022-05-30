<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{

    ///Load Helper
    function __construct()
    {
        parent::__construct();
        ///load Helper
        $this->load->helper('functions_helper');
        $this->load->helper('queries_helper');
    }

    ///Login Page View
    public function index()
    {
        if ($this->input->is_ajax_request()) {
            ///check validation 
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            //run validation 
            if ($this->form_validation->run()) {
                extract($_POST);
                $data['username'] = $username;
                $data['password'] = $password;
                $findData = getByWhere('login', '*', array('username' => $username));
                // updateByWhere('login', array('password' => password_hash($password, PASSWORD_DEFAULT)), array('user_id' => '1'));
                // echo '<pre>';
                // print_r($findData);
                // echo '</pre>';
                // die;
                if ($findData) {
                    $hash = $findData[0]->password;
                    if (password_verify($password, $hash)) {
                        ///set session
                        $newdata = array(
                            'user_id'  => $findData[0]->user_id,
                            'username'     => $findData[0]->username,
                            'logged_in' => TRUE
                        );
                        $this->session->set_userdata($newdata);
                        ///Success
                        $data = array('code' => 'success', 'message' => 'Logged in');
                        echo json_encode($data);
                        die;
                    } else {
                        ///credential not correct
                        $data = array('code' => 'warning', 'message' => 'Sorry Password Not Match');
                        echo json_encode($data);
                        die;
                    }
                } else {
                    ///credential not correct
                    $data = array('code' => 'warning', 'message' => 'Record Not Found!');
                    echo json_encode($data);
                    die;
                }
            } else {

                ///credential not correct
                $data = array('code' => 'warning', 'message' => 'Sorry some inputs are missing');
                echo json_encode($data);
                die;
                // ///validation errors
                // $error_array = array();
                // foreach ($_POST as $key => $value) {
                //     if (form_error($key)) {
                //         $error_array[] = array($key, form_error($key, null, null));
                //     }
                // }
                // $data = array('code' => 'error', 'message' => $error_array);
                // echo json_encode($data);
                // die;
            }
        } else {

            $data = array();
            $data['title'] = 'Login Page';
            $page = 'login';
            $this->load->view($page, $data);
        }
    }
}
