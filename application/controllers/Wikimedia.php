<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Wikimedia extends CI_Controller
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
        $title['title'] = 'Wikimedia';
        $page = 'wiki/index';
        AdminView($page, $data, $title);
    }


    ///New Articles
    public function AddNewArticles()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);



            ///check form validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('description', 'description', 'required');

            if (empty($_FILES['img']['name'])) {
                $this->form_validation->set_rules('photo', 'Document', 'required');
            }


            if ($this->form_validation->run() == TRUE) {
                $postData = array();

                // $postData['user_id'] = $this->session->userdata('user_id');
                $postData['name'] = $name;
                $postData['description'] = $description;


                ////findData
                // $findData = getByWhere('article', '*', array('article_id' => 0));
                if (!empty($postData)) {
                    $last_id = addNew('articles', $postData);

                    if ($last_id) {
                        ///image 
                        if (isset($_FILES['img']) && $_FILES['img']['name'] != "") {
                            $path = 'assets/articles/' . $last_id . '/';
                            if (!is_dir($path)) {
                                mkdir($path, 0777, true);
                            }
                            $config['upload_path'] = FCPATH . $path;
                            $config['allowed_types'] = 'gif|jpg|png|jpeg';
                            $this->load->library('upload', $config);
                            if (!$this->upload->do_upload('img')) {
                                $error = array('error' => $this->upload->display_errors());
                                echo $error;
                                die;
                            } else {
                                $data1 = $this->upload->data();
                                $postData['files'] = $path . $data1['file_name'];
                                updateByWhere('articles', array('files' => $postData['files']), array('article_id' => $last_id));
                            }
                        }
                    }
                    ///Success
                    $data = array('code' => 'success', 'message' => 'Added New Account Successfully!');
                    echo json_encode($data);
                    die;
                } else {
                    ///credential not correct
                    $data = array('code' => 'warning', 'message' => 'Account Already Exists!');
                    echo json_encode($data);
                    die;
                }
            } else {
                ///validation errors
                $error_array = array();
                foreach (array_merge($_POST, $_FILES) as $key => $value) {
                    if (form_error($key)) {
                        $error_array[] = array($key, form_error($key, null, null));
                    }
                }
                $data = array('code' => 'error', 'message' => $error_array);
                echo json_encode($data);
                die;
            }
        }
    }


    ///ArticlesList
    public function ArticlesList()
    {
        $data = array();
        $title['title'] = 'Wikimedia';
        $page = 'wiki/articles_list';
        AdminView($page, $data, $title);
    }

    ///get_articles_list_table Table
    public function get_articles_list_table()
    {
        if (isset($_POST)) {
            extract($_POST);
            $data = getByWhere('articles', '*', array(), array(), $length, $start);
            $totalRecords = record_count('articles');
            $RowsData = array();
            if ($data) {
                foreach ($data as $key => $rec) {
                    $rec = (array) $rec;
                    // echo '<pre>';
                    // print_r($rec);
                    // echo '</pre>';
                    // die;


                    foreach ($columns as $colKey => $colRec) {
                        if ($colRec['data'] == 'files') {
                            $html = '';
                            $html = '<img src="' . base_url($rec[$colRec['data']]) . '">';
                            $rec[$colRec['data']] = $html;
                            $RowsData[$key][$colRec['data']] =   $rec[$colRec['data']];
                        } else {
                            $RowsData[$key][$colRec['data']] = ($rec[$colRec['data']]) ? $rec[$colRec['data']] : '';
                        }
                    }
                }
            }
            $return['draw'] = $draw;
            $return['recordsTotal'] = $totalRecords;
            $return['recordsFiltered'] = $totalRecords;
            $return['data'] = $RowsData;
            echo json_encode($return);
        }
    }
}
