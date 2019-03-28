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
    public function update_profile_pic()
        {
            $config['upload_path']='./assets/images/users/';
            $config['allowed_types']='jpg|jpeg|png';
            $config['max_size']=500;
            $config['overwrite']=TRUE;
            $config['remove_spaces']=TRUE;
            $config['encrypt_name']=TRUE;

            $this->load->library('upload',$config);
            $field_name='profilefile';

            if(! $this->upload->do_upload($field_name))
            {
                $data['error']=$this->upload->display_errors();
                $this->session->set_flashdata('UpdateProfilePicError',$data['error']);
            }
            else
            {
                $id = $this->session->userdata('user_id');
                //get default image
                $data['profile_pic'] = $this->user->find($id);
                $profile_pic = $data['profile_pic']['profile_pic'];
                $image_path = $this->upload->data();
                $data = array(
                'profile_pic' => $image_path[file_name],
                );

                $data['update'] = $this->user->save($data, $id);

                if($data['update'] == $id)
                {
                if($profile_pic !== 'male.png' && $profile_pic !== 'female.png')
                {
                unlink(FCPATH . 'assets/images/users/'. $profile_pic);
                }
                $this->session->set_flashdata('ProfileImageUpdated','Image Updated Successfully');
                    redirect('edit_profile_pic');
                }
                else {
                        echo 'can not update image';
                    }
                }

        }

    public function edit_profile()
    {
        $this->form_validation->set_rules('firstname','Firstname','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('lastname','Lastname','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('email','Email address','trim|required|valid_email');
        $this->form_validation->set_rules('about','About','trim|required|max_length[300]');
        if($this->form_validation->run()===FALSE)
        {
        $data['title']='Edit Profile';
        $data['module']='users';
        $data['view_file']='edit_profile';
        //Running a querry to find user details
        $id = $this->session->userdata('user_id');
        $data['user_profile']=$this->user->find($id);
        echo Modules::run('templates/user_layout',$data);
        }
        else{
            $id=$this->session->userdata('user_id');
            $firstname=$this->input->post('firstname');
            $lastname=$this->input->post('lastname');
            $about=$this->input->post('about');
            $userData = array(
                'firstname'=> $firstname,
                'lastname'=>$lastname,
                'about'=>$about
            );
            $data['update']=$this->user->save($userData,$id);
            if($data['update']==$id)
            {
                $this->session->set_flashdata('ProfileUpdated','Profile Updated Successfully');
                redirect('profile');
            }
            else{
                echo 'Profile Cannot be Updated';
            }
        }
    }

    
}