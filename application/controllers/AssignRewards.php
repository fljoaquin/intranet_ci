<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Description: Home controller class
 * This is only viewable to those members that are logged in
 */
class AssignRewards extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->check_isvalidated();
        $this->load->view("templates/header");
        $this->load->view("templates/user-bar");
        $this->load->view("templates/navigation-bar");
    }

    public function index($data = null){
        // If the user is validated, then this function will run
        $this->load->view("assignrewards");
    }

    public function search(){

        $search = $this->security->xss_clean($this->input->get('search'));
        $page = $this->security->xss_clean($this->input->get('page'));
        $limit = 25;

        if(empty($page)){
            $page = 0;
            $row_index = 0;
        }else{
            $row_index = $limit * $page;
        }

        if(empty($search)){
            redirect(base_url() . 'assignRewards');
        }

        $this->load->model("Members_model");
        $rows = $this->Members_model->pagination($search);
        $results = $this->Members_model->search($search, $limit, $row_index);

        if($results === false || $rows === false){
            redirect(base_url() . 'assignRewards/not_found');
        }

        foreach($results as $result){
            $result_d['yearCashValue'][$result['unique_id']] = $this->Members_model->getCashValueYearlyTotal($result['unique_id']);
            $result_d['todayCashValue'][$result['unique_id']] = $this->Members_model->selectCashValueDailyTotal($result['unique_id']);
        }


        $data = array(
            "selected_data" => $results,
            "YTD" => $result_d['yearCashValue'],
            "TDV" => $result_d['todayCashValue'],
            "total_rows_r" => $rows,
            "limit" => $limit,
            "search" => $search,
            "page" => $page
        );
        $this->load->view("assignrewards", $data);
    }

    public function not_found(){
        $data = array("patient_not_found" => "No members Found");
        $this->load->view("assignRewards", $data);
    }

    public function scanRewards(){
        $this->load->view('scan/scan-rewards');
    }

    private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect(base_url() . 'login');
        }
    }
}