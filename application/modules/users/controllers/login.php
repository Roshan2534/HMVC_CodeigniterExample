<?php
defined('BASEPATH') OR exit('No direct scipt access allowed');

class Login extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        $this->load->library('MY_Form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('login_email','Email ID','trim|valid_email|callback_login_check');
        $this->form_validation->set_rules('login_password','Password','trim|required');
        if($this->form_validation->run($this) === FALSE)
        {
        $data['title']='Login';
        $data['module']='users';
        $data['view_file']='login';
        echo Modules::run('templates/default_layout',$data);
        }
        else{
            redirect('dashboard');
        }}
        public function login_check()
        {
            $email=$this->input->post('login_email');
            $password = $this->input->post('login_password');
            if(empty($email))
            {
                $this->form_validation->set_message('login_check','Email is Required');
                return false;
            }
            //using MY Model find_by methods
            $data['userData']=$this->user->find_by('email',$email,NULL,TRUE);
            if(empty($data['userData']))
            {
                $this->form_validation->set_message('login_check','Invalid Email or Password');
                return false;
            }
            else{
                $storedpassword=$data['userData']['password'];
                //checking the hash password by using bcrypt library
                $this->load->library('bcrypt');
                if($this->bcrypt->check_password($password,$storedpassword))
                {
                    //If the password matches stored password
                    $newdata=array(
                        'user_id'=>$data['userData']['id'],
                        'firstname'=>$data['userData']['firstname'],
                        'lastname'=>$data['userData']['lastname'],
                        'is_logged_in'=>TRUE

                    );
                    $this->session->set_userdata($newdata);
                    return TRUE;
                }
                else{
                    //Password does not match
                    $this->form_validation->set_message('login_check','Invalid Email or Password');
                    return false;
                }

                }
        }
        public function logout()
        {
            $this->session->sess_destroy();
            redirect('login','refresh');
        }

}

