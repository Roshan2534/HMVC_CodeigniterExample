<?php
defined('BASEPATH') OR exit('No direct scipt access allowed');

class Dashboard extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        if($this->session->userdata('is_logged_in')==FALSE)
        {
            redirect('login');
        }
        
    }
    public function index()
    {
        $data['title']='Dashboard';
        $data['module']='users';
        $data['view_file']='dashboard';
        echo Modules::run('templates/user_layout',$data);
    }
}