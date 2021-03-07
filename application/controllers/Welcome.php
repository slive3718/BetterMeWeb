<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
  
        // $this->load->model('admin_model');
             
        // $this->load->library('form_validation');
        // $this->load->helper('date');
        // $this->load->library('upload');
       
    }
	public function index()
	{
		$this->load->view('login/index');
    }
    
    public function createAccount(){
        // $this->load->view('login/createAccount');
        echo "HI";
    }
}
