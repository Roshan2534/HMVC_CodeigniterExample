<?php
defined('BASEPATH') OR exit('No direct scipt access allowed');

class Templates extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function default_layout($data)
    {
        $this->load->view('default_layout',$data);
    }
    public function user_layout($data)
    {
        $this->load->view('user_layout',$data);
    }
}