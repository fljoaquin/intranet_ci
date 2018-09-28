<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Lazaro J Fajardo
 * Description: Member Search model class
 */
class Members_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    public function pagination($search_input = null){
        $this->db->select("id");
        $this->db->from("ptgeneralinfo");
        $this->db->where("enrollmentstatus", "active");
        $this->db->like("name", $search_input, "after");
        $this->db->or_where("unique_id", $search_input);
        $this->db->or_like("lastname", $search_input, "after");
        $result = $this->db->get();

        if($result->num_rows() > 0) {
            return $result->num_rows();
        }else{
            return false;
        }
    }

    public function search($search_input = null, $limit = 25, $row_index){
        // Grab user Input
        //$search_input = $this->security->xss_clean($this->input->get('search'));

        // Prepare Query
        $this->db->select("*");
        $this->db->from("ptgeneralinfo");
        $this->db->where("enrollmentstatus", "active");
        $this->db->like("name", $search_input, "after");
        $this->db->or_where("unique_id", $search_input);
        $this->db->or_like("lastname", $search_input, "after");
        $this->db->order_by("id", "ASC");
        $this->db->limit($limit, $row_index);

        // Run the query
        $result = $this->db->get()->result_array();
        if(!is_null($result)){

            return $result;
        }else{
           return false;
        }
    }

    public function getCashValueYearlyTotal($UID = null){
        if($UID == null){
            return false;
        }
        $selectTotalSilverY = "SELECT  sum(static.cashvalue) as totalcashvalue FROM staticrewards static INNER JOIN silverreward silver ON static.serial_number = silver.rewardid WHERE (silver.date BETWEEN DATE_FORMAT(NOW(), '%Y-01-01') AND NOW()) AND silver.unique_id = '" . $UID . "'";
        $selectTotalGoldY = "SELECT  sum(static.cashvalue) as totalcashvalue FROM staticrewards static INNER JOIN goldreward gold ON static.serial_number = gold.rewardid WHERE (gold.date BETWEEN DATE_FORMAT(NOW(), '%Y-01-01') AND NOW()) AND gold.unique_id = '" . $UID . "'";
        $selectTotalDiamondY = "SELECT  sum(static.cashvalue) as totalcashvalue FROM staticrewards static INNER JOIN diamondreward diamond ON static.serial_number = diamond.rewardid WHERE (diamond.date BETWEEN DATE_FORMAT(NOW(), '%Y-01-01') AND NOW()) AND diamond.unique_id = '" . $UID. "'";

        $resultSilver = $this->db->query($selectTotalSilverY)->result_array();
        $resultGold = $this->db->query($selectTotalGoldY)->result_array();
        $resultDiamond = $this->db->query($selectTotalDiamondY )->result_array();


        //$silverTotal1 = $resultSilver->result_array();
        //$silverTotal = $silverTotal1['totalcashvalue'];
        $silverTotal = 0;
        $goldTotal = 0;
        $diamondTotal = 0;
        $total = 0;

        foreach($resultSilver as $yearCashV){
            $silverTotal += $yearCashV['totalcashvalue'];
        }

        foreach($resultGold as $yearCashV){
            $goldTotal += $yearCashV['totalcashvalue'];
        }

        foreach($resultDiamond as $yearCashV){
            $diamondTotal += $yearCashV['totalcashvalue'];
        }

        $total += $silverTotal + $goldTotal + $diamondTotal;

        return $total;
    }

    public function selectCashValueDailyTotal($UID = NULL){
        if($UID == NULL){
            return false;
        }

        $selectTotalSilver = "SELECT  sum(static.cashvalue) as totalcashvalue FROM staticrewards static INNER JOIN silverreward silver ON static.serial_number = silver.rewardid WHERE DATE(silver.date) = DATE(NOW()) AND silver.unique_id = '" . $UID . "'";
        $selectTotalGold = "SELECT  sum(static.cashvalue) as totalcashvalue FROM staticrewards static INNER JOIN goldreward gold ON static.serial_number = gold.rewardid WHERE DATE(gold.date) = DATE(NOW()) AND gold.unique_id = '" . $UID . "'";
        $selectTotalDiamond = "SELECT  sum(static.cashvalue) as totalcashvalue FROM staticrewards static INNER JOIN diamondreward diamond ON static.serial_number = diamond.rewardid WHERE DATE(diamond.date) = DATE(NOW()) AND diamond.unique_id = '" . $UID. "'";

        $resultTotalSilver = $this->db->query($selectTotalSilver)->result_array();
        $resultTotalGold = $this->db-> query($selectTotalGold)->result_array();
        $resultTotalDiamond = $this->db->query($selectTotalDiamond)->result_array();

        $totalCashValueSilver = 0;
        $totalCashValueGold = 0;
        $totalCashValueDiamond = 0;
        $totalCashValue = 0;

        foreach($resultTotalSilver as $yearCashV){
            $totalCashValueSilver += $yearCashV['totalcashvalue'];
        }

        foreach($resultTotalGold as $yearCashV){
            $totalCashValueGold += $yearCashV['totalcashvalue'];
        }

        foreach($resultTotalDiamond as $yearCashV){
            $totalCashValueDiamond += $yearCashV['totalcashvalue'];
        }

        $totalCashValue += $totalCashValueSilver + $totalCashValueGold + $totalCashValueDiamond;

        return $totalCashValue;
    }

    public function rewardsHistory($mid){
        //$mid = $this->security->xss_clean($this->input->post('mid'));

        $selectRewardsReportQuery = "SELECT silver.id, silver.rewardid, silver.date, static.reward FROM silverreward silver INNER JOIN staticrewards static ON static.serial_number = silver.rewardid WHERE (date BETWEEN DATE_FORMAT(NOW(), '%Y-01-01') AND NOW()) AND unique_id = '" . $mid . "' UNION SELECT gold.id, gold.rewardid, gold.date, static.reward FROM goldreward gold INNER JOIN staticrewards static ON static.serial_number = gold.rewardid  WHERE (date BETWEEN DATE_FORMAT(NOW(), '%Y-01-01') AND NOW()) AND unique_id = '" . $mid . "' UNION SELECT diamond.id, diamond.rewardid, diamond.date, static.reward FROM diamondreward diamond INNER JOIN staticrewards static ON static.serial_number = diamond.rewardid  WHERE (date BETWEEN DATE_FORMAT(NOW(), '%Y-01-01') AND NOW()) AND unique_id = '". $mid ."' GROUP BY id";
        if($resultRewardsReport = $this->db->query($selectRewardsReportQuery)->result_array()){
            return $resultRewardsReport;
        }else{
            return false;
        }

    }

    public function pointsHistory(){
        $mid = $this->security->xss_clean($this->input->post('mid'));

        $selectPointsReportQuery = "SELECT m.memberid, m.cptcode AS mcptcode, m.visitdate, pv.cptcode, pv.pvalue, pv.description FROM members m INNER JOIN pointvalue pv ON m.cptcode = pv.cptcode WHERE m.unique_id = '" . $mid . "'";
        if($resultPointsReport = $this->db->query($selectPointsReportQuery)->result_array()){
            return $resultPointsReport;
        }else{
            return false;
        }
    }
}

?>