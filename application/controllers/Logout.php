<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

    function __construct(){
        parent::__construct();
    }

    public function index(){
        // Load our view to be displayed
        // to the user
        $this->session->unset_userdata('userid');
        $this->session->sess_destroy();
        redirect(base_url() . 'login');
    }

}
