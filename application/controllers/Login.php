<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
    }

    public function index($msg = NULL){
        // Load our view to be displayed
        // to the user
        $rand[1] = 'callcenter';
        $rand[2] = 'nurse';
        $r_number = rand(1, 2);
        $data['msg'] = $msg;
        $data['rand_picture'] = $rand[$r_number];
        $this->load->helper('form');
        $this->load->view('login/login_view', $data);
    }

    public function process(){
        // Load the model
        $this->load->model('login_model');
        // Validate the user can login
        $result = $this->login_model->validate();
        // Now we verify the result
        if(! $result){
            // If user did not validate, then show them login page again
            $msg = 'Username or Password are not valid';
            $this->index($msg);
        }else{
            // If user did validate,
            // Send them to members area
            redirect(base_url(). "home");
        }
    }

}
