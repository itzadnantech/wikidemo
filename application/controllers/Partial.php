<?php defined('BASEPATH') or exit('No direct script access allowed');

class Partial extends CI_Controller
{
    ///load assential things
    function __construct()
    {
        parent::__construct();
        ///load Helper
        $this->load->helper('functions_helper');
        $this->load->helper('queries_helper');
    } 

    ///ForgotPassword
    public function ForgotPassword()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);

            ///check validation 
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('cpassword', 'Password', 'required');

            //run validation 
            if ($this->form_validation->run()) {
                if ($password == $cpassword) {
                    $findData = getByWhere('login', '*', array('username' => $username));
                    if ($findData) {
                        $password_hash = password_hash($password, PASSWORD_DEFAULT);
                        updateByWhere('login', array('password' => $password_hash), array('username' => $username));
                        ///Success
                        $data = array('code' => 'success', 'page' => 'login', 'message' => 'Password Has Been Changed!');
                        echo json_encode($data);
                        die;
                    } else {
                        ///credential not correct
                        $data = array('code' => 'warning', 'message' => 'Username Not Found!');
                        echo json_encode($data);
                        die;
                    }
                } else {
                    ///credential not correct
                    $data = array('code' => 'warning', 'message' => 'Passwords Not Match');
                    echo json_encode($data);
                    die;
                }
            } else {
                ///credential not correct
                $data = array('code' => 'warning', 'message' => 'Sorry some inputs are missing');
                echo json_encode($data);
                die;
            }
        }
    }

    ///DeleteRecord
    public function DeleteRecord()
    {
        $table = $this->uri->segment(2);
        $field = $this->uri->segment(3);
        $value = $this->uri->segment(4);

        $check = deleteRecordWhere($table, array($field => $value));
        if ($check) {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    ///DeleteByAjax
    public function DeleteByAjax()
    {
        extract($_POST);
        $check = deleteRecordWhere($table, array($field => $value));
        if ($check == 1) {
            ///Success
            $data = array('code' => 'success');
            echo json_encode($data);
            die;
        } else {
            ///credential not correct
            $data = array('code' => 'warning');
            echo json_encode($data);
            die;
        }
    }

    ///SearchTableFieldsFilters
    public function SearchTableFieldsFiltersUsers()
    {
        extract($_POST); 
        if ($condition == 'All') {
            unset($_SESSION['search_users']); 
            $_SESSION['search_users'] = 'All';
        } else if ($condition == 'Some') {
            unset($_SESSION['search_users']);
            unset($_SESSION['users_fields']);
            $_SESSION['search_users'] = 'Some';
            $_SESSION['users_fields'] = $fields;
        } 
        ///Success
        $data=array('code'=>'success','message'=>'Record Searched!');
        echo json_encode($data);
        die;
    } 

    ///SearchTableFieldsArticles
    public function SearchTableFieldsFiltersArticles()
    {
        extract($_POST); 
        if ($condition == 'All') {
            unset($_SESSION['search_articles']);
            $_SESSION['search_articles'] = 'All';
        } else if ($condition == 'Some') {
            unset($_SESSION['search_articles']);
            unset($_SESSION['articles_fields']);
            $_SESSION['search_articles'] = 'Some';
            $_SESSION['articles_fields'] = $fields;
        } 
        ///Success
        $data=array('code'=>'success','message'=>'Record Searched!');
        echo json_encode($data);
        die;
    } 

    ///SearchTableFieldsArticles
    public function SearchTableFieldsFiltersProviders()
    {
        extract($_POST); 
        if ($condition == 'All') {
            unset($_SESSION['search_providers']);
            $_SESSION['search_providers'] = 'All';
        } else if ($condition == 'Some') {
            unset($_SESSION['search_providers']);
            unset($_SESSION['providers_fields']);
            $_SESSION['search_providers'] = 'Some';
            $_SESSION['providers_fields'] = $fields;
        } 
        ///Success
        $data=array('code'=>'success','message'=>'Record Searched!');
        echo json_encode($data);
        die;
    }
}
