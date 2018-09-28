<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Lazaro J Fajardo
 * Description: Login model class
 */
class Login_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function validate(){
        // grab user input
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));

        // Prep the query
        $this->db->select("*");
        $this->db->from("users");
        $this->db->join("user_role", "user_role.user_role_id = users.user_role");
        $this->db->where('username', $username);
        $this->db->where('password', $password);

        // Run the query
        $select = $this->db->get();

        // Let's check if there are any results
        if($select->num_rows() == 1) {
            // If there is a user, then create session data
            $row = $select->row();
            $data = array(
                'userid' => $row->id,
                'fname' => $row->fname,
                'lname' => $row->lname,
                'username' => $row->username,
                'user_role_id' => $row->user_role_id,
                'user_role_name' => $row->user_role_name,
                'validated' => true
            );
            $this->session->set_userdata($data);
            return $data;
        }else{
            // If the previous process did not validate
            // then return false.
            return false;
        }

    }
}
?>