<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/////Helper Function For Login Views//////
if(!function_exists('AdminView'))
{
    function AdminView($page, $data=array(),$title=array())
    {
        
       
        $thiz=&get_instance(); 
        $thiz->load->view('templates/ad_header',$title);
        $thiz->load->view($page,$data);
        $thiz->load->view('templates/ad_footer'); 
       // $thiz->load->view('templates/ad_footer',array('ad_scriptfile'=>basename($page))); 
    }
}