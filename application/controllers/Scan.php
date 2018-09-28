<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: ipcadmin
 * Date: 6/1/2018
 * Time: 9:16 AM
 */

class Scan extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->check_isvalidated();
        $mid = $this->security->xss_clean($this->input->post('mid'));
        $member_info['mid'] = $mid;
        $this->load->view('scan/scan-rewards', $member_info);

    }

    public function scanRewardsAndHistory(){
        $mid = $this->security->xss_clean($this->input->post('mid'));
        $this->load->model("Members_model");
        $RewardsReportData = $this->Members_model->rewardsHistory($mid);
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

    public function scanning(){
        $this->load->model("Scan_model");
        $reward_serialN = $this->security->xss_clean($this->input->post('rewardScan'));
        $mid = $this->security->xss_clean($this->input->post('mid'));
        $member_status_level = $this->Scan_model->getMemberRewardLevel($mid);// Check if member qualifies for reward level

        foreach($member_status_level as $member_status_level_value){
            $member_level = $member_status_level_value['level'];
        }
        $reward_status_level = $this->Scan_model->checkRewardLevelUsingSerialNumber($reward_serialN, $member_level); // Retrieve reward level using serial number
        $table_suffix = "reward";

        foreach($reward_status_level as $reward_status_level_value){
            $reward_level = $reward_status_level_value['level'];
        }

        if(is_null($reward_status_level) || $reward_status_level === false) {
            redirect(base_url() . "scan/scanRewardsAndHistory");
        }

        $member_level = strtolower($member_level );
        $reward_level = strtolower($reward_level);
        $table_name = $reward_level . $table_suffix;

        $level_num['silver'] = 1;
        $level_num['gold'] = 2;
        $level_num['diamond'] = 3;

        if($level_num[$member_level] >= $level_num[$reward_level]){
            // if member status level is greater or equal than reward level qualifies for reward other wise will not qualify
            $member_qualifies = true;
        }else{
            $member_qualifies = false;
        }



        $rewardAlreadyGiven = $this->Scan_model->checkRewardGiven($reward_serialN, $mid, $table_name, $reward_level); // See if this reward has been assigned already to this member and avoid to double assign it to same member
        $isGiftCard = $this->Scan_model->checkIsGiftCard($reward_serialN, $reward_level); // TRUE if it is gift card

        $this->load->model("Members_model");
        $RewardsReportData = $this->Members_model->rewardsHistory($mid);
        if($RewardsReportData !== false){
            $data = array(
                "rewards_history" => $RewardsReportData
            );

            $this->load->view("history/rewards", $data);
        }else{
            $this->load->view("history/messages/no-rewards-found");
        }
    }



    private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect(base_url() . 'login');
        }
    }
}

?>