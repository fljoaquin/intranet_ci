<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Description: Home controller class
 * This is only viewable to those members that are logged in
 */
class CompanyCalendar extends CI_Controller{
    function __construct(){
        parent::__construct();
       $prefs = array(
			'show_next_prev'  => TRUE,
			'next_prev_url'   => base_url() . 'CompanyCalendar/show/'
		);
       		$this->load->library('calendar', $prefs);

       $this->load->view("templates/header");
       $this->load->view("templates/user-bar");
    }

	public function index(){
		$this->show();
	}
    public function show(){
        // If the user is validated, then this function will run
		$this->load->view('calendar');
		

    }
	

    private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect(base_url() . 'login');
        }
    }
}
?>