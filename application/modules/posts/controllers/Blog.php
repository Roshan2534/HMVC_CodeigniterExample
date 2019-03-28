<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MX_Controller
{
  public function __construct()
  {
    parent::__construct();
    /*Additional code which you want to run automatically in every function call */
    $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
    $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
    $this->output->set_header('Pragma: no-cache');

    $this->load->model('post');
    $this->load->helper('text');

  }

  public function add_posts()
  {
    if($this->session->userdata('is_logged_in') == FALSE)
    {
      redirect('login');
    }

    else
    {

      $this->form_validation->set_rules('title', 'Title',
                                    'trim|required|min_length[20]|max_length[150]');

      $this->form_validation->set_rules('body', 'Body',
                                    'trim|required|min_length[20]|max_length[500]');

      $this->form_validation->set_rules('category', 'Category',
                                    'trim|required');


if($this->form_validation->run() === FALSE)
{
  $data['title'] = 'Add Post | '. $this->session->userdata('firstname');
  $data['module'] = 'posts';
  $data['view_file'] = 'add_posts';
  echo Modules::run('templates/user_layout', $data);

}

else
{

  $category_id = $this->input->post('category');
  $poster_id = $this->session->userdata('user_id');
  $title   =  $this->input->post('title');
  $body   =  $this->input->post('body');

  $post_data = array(
    'category_id' => $category_id,
    'poster_id' => $poster_id,
    'title' => $title,
    'body' => $body
  );

  $data['post_data'] = $this->post->save($post_data);
  if(!empty($data['post_data']))
  {
    $this->session->set_flashdata('PostAdded', 'You have added a post successfully');
    redirect('my_posts');
  }
  else
  {
    echo 'cannot make a post';
  }
}


    }
  }
  public function my_posts()
  { 
    if($this->session->userdata('is_logged_in') == FALSE)
    {
      redirect('login');
    }
    else{
      $poster_id=$this->session->userdata('user_id');

      $data['posts']=$this->post->get_my_post($poster_id);
      $data['title'] = 'My Post | '. $this->session->userdata('firstname');
      $data['module'] = 'posts';
      $data['view_file'] = 'my_posts';
      echo Modules::run('templates/user_layout', $data);
    }
  }

  public function view_post($post_id)
  {
    $post_id=$this->uri->segment(2);
    if(empty($post_id))
    {
      show_404;
    }
    else{
      $data['view_post']=$this->post->get_single_post($post_id);
      $data['title']='View Post';
      $data['module']='posts';
      $data['view_file']='view_post';
      echo Modules::run('templates/user_layout',$data);
    }
  }
  public function save_comment()
  {
    $this->form_validation->set_rules('comment_body', 'Comment Body',
                    'trim|required|min_length[20]|max_length[300]');

    if($this->form_validation->run()=== FALSE)
    {
      $post_id = $this->input->post('post_id');
      $this->session->set_flashdata('CommentValidation', validation_errors());
      redirect('view_post/'.$post_id);
    }

    else
    {
     $post_id = $this->input->post('post_id');
      $comment_data = array(
        'post_id' => $this->input->post('post_id'),
        'commenter_id' => $this->session->userdata('user_id'),
        'comment_body' => $this->input->post('comment_body')
      );

      $message = Modules::run('comments/postcomments/save_comment', $comment_data);

      if(!empty($message))
      {
        $this->session->set_flashdata('CommentAdded', 'Comment Added successfully');
        redirect('view_post/'.$post_id);
      }

    }


  }
  


  




}
