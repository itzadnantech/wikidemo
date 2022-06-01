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
        $this->load->helper('wikimedia_helper');
    }

    ////loginRequest
    public function loginRequest()
    {
        $login_Token = getLoginToken();
        echo '<pre>';
        print_r($login_Token);
        echo '</pre>';
        die;
        $params2 = [
            "action" => "login",
            "lgname" => "itzmichael",
            "lgpassword" => "8q6vcd6rb0thm1mk3dohi5q1ui4inb2t",
            "lgtoken" => $login_Token,
            "format" => "json"
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => END_POINT,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $params2,

        ));

        $response = curl_exec($curl);
        $response = json_decode($response);
        curl_close($curl);
        echo '<pre>';
        print_r($response);
        echo '</pre>';
        die;
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
