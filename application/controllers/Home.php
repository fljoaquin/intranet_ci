<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Description: Home controller class
 * This is only viewable to those members that are logged in
 */
class Home extends CI_Controller{
    function __construct(){
        parent::__construct();
       
        $this->load->view("templates/header");
        $this->load->view("templates/user-bar");
    }

    public function index($data = null){
        // If the user is validated, then this function will run
        $this->load->view("index");

    }

    private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect(base_url() . 'login');
        }
    }
}
?>