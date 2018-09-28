
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: ipcadmin
 * Date: 5/17/2018
 * Time: 4:38 PM
 */

class ModalHistory extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->check_isvalidated();
    }

    public function rewardsreportYearly(){

        $this->load->model("Members_model");
        $RewardsReportData = $this->Members_model->rewardsHistory();
        if($RewardsReportData !== false){
            $data = array(
                "rewards_history" => $RewardsReportData
            );
            $this->load->view("history/rewards", $data);
        }else{
            //echo "not found";

            $this->load->view("history/messages/no-rewards-found"); //
        }


    }

    public function pointsreportYearly(){

        $this->load->model("Members_model");
        $PointsReportData = $this->Members_model->pointsHistory();
        if($PointsReportData !== false){
            $data = array(
                "points_history" => $PointsReportData
            );
            $this->load->view("history/points", $data);
        }else{
            $this->load->view("history/messages/no-points-found");
        }


    }

    private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect(base_url() . 'login');
        }
    }

}
