<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bidding_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function allBiddings(){
        $this->db->where('user_type',$type);
        $this->db->select('*')->from(TABLE_PRE.'users');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function allBiddingsByUser($uid){
        $this->db->where('created_by',$uid);
        $this->db->select('*')->from(TABLE_PRE.'biddings');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function getUserById($id,$type){
        $this->db->where('user_id',$id);
        $this->db->where('user_type',$type);
        $this->db->select('*')->from(TABLE_PRE.'users');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }
        return false;
    }

    public function getUserDetById($id){
        $this->db->where('user_id',$id);
        $this->db->select('*')->from(TABLE_PRE.'users as a');
//        $this->db->join(TABLE_PRE.'user_types as b','a.user_type = b.type_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }
        return false;
    }

    public function UsersByType($type){
        $this->db->where('user_type',$type);
        $this->db->select('*')->from(TABLE_PRE.'users');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function StaffUsers(){
        $this->db->where('user_type !=',2);
        $this->db->where('user_type !=',1);
        $this->db->select('a.*,b.name')->from(TABLE_PRE.'users as a');
        $this->db->join(TABLE_PRE.'user_types as b','a.user_type = b.type_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function hasEmail($email,$id = ''){
        if($id != ''){
            $this->db->where('user_id !=',$id);
        }
        $this->db->where('email',$email);
        $query = $this->db->select('*')->from(TABLE_PRE.'users')->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }
	public function mailsend_to_all_bid_user($userid,$productid,$amt)
	{
	    $users = $this->Products_model->getAllUsersInBidWatch($productid);
			$unique_user = array_map('unserialize', array_unique(array_map('serialize', $users)));

			foreach ($unique_user as $user) {
				if($user['user_id'] != $userid){

					$data['product'] = $this->Products_model->getProductById($productid);
					$data['subj'] = 'Salvage :: Bidded product notification - '.$data['product']->title.' (#' . $_POST['product_id'] . ')';
					$data['user'] = $user;
					$data['bid'] = $amt;
					$email_msg = $this->load->view('email/bidding_user_mail', $data, true);

					email_sender($user['email'], $data['subj'], $email_msg);

				}
			}	
		
	}

}