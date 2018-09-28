<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Lazaro J Fajardo
 * Date: 6/1/2018
 * Time: 3:59 PM
 */

class Scan_model extends CI_Model{
    function __construct(){
        parent::__construct();

    }

    public function checkRewardGiven($rewardid, $mID, $table, $level){

        //$reward_level = checkRewardLevelUsingSerialNumber($rewardid);

        $selectRewardsQuery = "SELECT id FROM staticrewards static WHERE EXISTS ( SELECT unique_id, memberid, reward FROM " . $table . " nonstatic WHERE static.serial_number = nonstatic.rewardid AND nonstatic.unique_id = '" . $mID . "' ) AND static.level = '".$level."' AND static.serial_number = '".$rewardid."'";

        if($resultSelectRewards = $this->db->query($selectRewardsQuery)->result_array()){
            return true;
        }else{
            return false;
        }
    }

    public function checkRewardLevelUsingSerialNumber($rewardid = null, $level){

        if(!is_null($rewardid)) {
            $this->db->select("level");
            $this->db->from("staticrewards");
            $this->db->where("serial_number", $rewardid);
            $this->db->where("qty_avail >", 0);
            $this->db->where("level", $level);
            $this->db->limit("1");

            // Get the results and return it
            $result = $this->db->get()->result_array();

            if(!is_null($result)){
                return $result;
            }else{
                return null; // No results, no reward found matching rewardid
            }
        }else{
            // rewardid is null
            return false;
        }
    }

    public function checkIsGiftCard($rewardid, $level){
        $this->db->select("id");
        $this->db->from("staticrewards");
        $this->db->where("serial_number", $rewardid);
        $this->db->where("level", $level);
        $this->db->where("LOWER(reward)", "gift card");
        $this->db->limit("1");

        $result = $this->db-get()->result_array();

        if(!is_null($result)){
            return true; // It is a gift card
        }

        return false; // it is not a gift card

    }

    public function getMemberRewardLevel($mid = null){

       if(!is_null($mid)){
            $this->db->select("level");
            $this->db->from("ptgeneralinfo");
            $this->db->where("unique_id", $mid);
            $this->db->limit("1");
            $result = $this->db->get()->result_array();

            if(!is_null($result)){
                return $result;
            }

            return null;
       }

       return false;
    }


}