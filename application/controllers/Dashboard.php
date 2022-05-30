<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    ///check login
    function __construct()
    {
        parent::__construct();
        ///load Helper
        $this->load->helper('functions_helper');
        $this->load->helper('queries_helper');
        if (isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] == false)) {
            redirect('login');
        }
    }

    ///dashboard
    public function index()
    {

        $data = array();
        $title['title'] = 'Dashboard';
        $page = 'admin/dashboard';
        AdminView($page, $data, $title);
    }



    ////Logout
    public function Logout()
    {
        session_destroy();
        redirect('login');
    }
}
