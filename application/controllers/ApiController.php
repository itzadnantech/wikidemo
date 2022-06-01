<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ApiController extends CI_Controller
{
    ///check login
    function __construct()
    {
        parent::__construct();
        ///load Helper
        $this->load->helper('functions_helper');
        $this->load->helper('queries_helper');
    }

    ///upload file by api
    public function api_file()
    {

        ///image 
        if (isset($_FILES['img']) && $_FILES['img']['name'] != "") {
            echo '<pre>';
            print_r($_FILES['img']);
            echo '</pre>';
            die;
            $path = 'assets/APIfiles/';

            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            $config['upload_path'] = FCPATH . $path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('img')) {
                $error = array('error' => $this->upload->display_errors());
                echo json_encode('file not uploaded');
                die;
            } else {
                $data1 = $this->upload->data();
                $postData['files'] = $path . $data1['file_name'];
                echo json_encode('file uploaded!');
                die;
            }
        }
    }
}
