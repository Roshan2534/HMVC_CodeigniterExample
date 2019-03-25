<?php
defined('BASEPATH') OR exit('No direct scipt access allowed');

class Dashboard extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
    /*Additional code which you want to run automatically in every function call */
    $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
    $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
    $this->output->set_header('Pragma: no-cache');

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
    public function profile()
    {
        $data['title']='Profile';
        $data['module']='users';
        $data['view_file']='profile';
        //Running a querry to find user details
        $id = $this->session->userdata('user_id');
        $data['user_profile']=$this->user->find($id);
        echo Modules::run('templates/user_layout',$data);
    }
    public function edit_profile_pic()
    {
        $data['title']='Edit Profile Pic';
        $data['module']='users';
        $data['view_file']='edit_profile_pic';
        //Running a querry to find user details
        $id = $this->session->userdata('user_id');
        $data['user_profile']=$this->user->find($id);
        echo Modules::run('templates/user_layout',$data);
    }
}