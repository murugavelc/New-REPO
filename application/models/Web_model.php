<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

	public function check_login($email,$pass,$user_type){
		$this->db->select('*')->from(TABLE_PRE.'users');
        $this->db->where('email',$email);
        $this->db->where('password',md5($pass));
        $this->db->where('user_type',$user_type);
		$this->db->where('is_deleted','0');        
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }
        return false;
    }
	public function hasEmail($email,$id = ''){
        if($id != ''){
            $this->db->where('user_id !=',$id);
        }
        $this->db->where('email',$email);
		$this->db->where('is_deleted','0');  
        $query = $this->db->select('*')->from(TABLE_PRE.'users')->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }
    public function getProductDetails($search = array())	{
		$this->db->select("*");
		$this->db->from("sv_products");
		$where = "is_deleted = 0 and end_datetime >='".date("Y-m-d h:s:i")."'";
		if(!empty($search['brand'])){
			$where .= " and brand = '".$search['brand']."'";
		}
		if(!empty($search['model'])){
			$where .= " and model = '".$search['model']."'";
		}
		if(!empty($search['start_year']) && !empty($search['end_year'])) {
			$this->db->where("year BETWEEN ".$search['start_year']." AND ".$search['end_year']);
		}
		if(!empty($search['start_price']) && !empty($search['end_price'])){	
			$this->db->where("base_price BETWEEN ".$search['start_price']." AND ".$search['end_price']);
		}		
		if(!empty($search['location'])){
			$where .= " and salvage_location = '".$search['location']."'";
		}
		if(!empty($search['petrol']) || !empty($search['diesel']) || !empty($search['gasoline'])){
			$where .=" and (";
			if(!empty($search['petrol'])) {
				$where .= " fuel = 1 or";
			}
			if(!empty($search['diesel'])){
				$where .= " fuel = 2 or";
			}
			if(!empty($search['gasoline'])){
				$where .= " fuel = 3 or";
			}
			$where = substr($where, 0, -2);
			$where .=" )";
		}
		if(!empty($search['product_id'])){
			$where .= " and product_id = ".$product_id;
		}	
		$this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
    }
	public function getProductimg($id)	{
		$this->db->select("product_img");
		$this->db->from("sv_product_images");
		$this->db->where("product_id",$id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
    }	
	public function getStateCity($table, $filed='', $id=''){
		$this->db->select("*");
		$this->db->from($table);
		if($filed != ''){
			$this->db->where($filed,$id);
		}
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
	}
	public function getProduct($product_id){
		$this->db->select("*");
		$this->db->from("sv_products");
		$this->db->where("product_id",$product_id);
		$this->db->where("is_deleted","0");		
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
	}
	public function getbiddingDetails($product_id){
		$this->db->select("*");
		$this->db->from("sv_biddings");
		$this->db->where("product_id",$product_id);
		//$this->db->order_by("created_on", "desc")->limit(1);
		$this->db->order_by("bid_id", "desc");
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
	}
	public function getModels($brand){
		$this->db->select("model");
		$this->db->from("sv_products");
		$this->db->where("brand",$brand);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
	}
	public function getMyBiddings($user_id){
		$this->db->select("sv_biddings.*,sv_products.*");
		$this->db->from("sv_biddings");
		$this->db->join('sv_products', 'sv_products.product_id = sv_biddings.product_id');
		$this->db->where("sv_biddings.user_id",$user_id);
		$this->db->where("sv_products.is_deleted","0");	
		$this->db->group_by('sv_biddings.product_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
	}
	public function addWatchList($post){
		$this->db->select("*")->from(TABLE_PRE.'watch_list');
		$this->db->where("user_id",$post['user_id']);
		$this->db->where("product_id",$post['product_id']);
		$query = $this->db->get();
		$result = $query->result_array();
		if(count($result) == 0){
			$data = array(
				"user_id"	 => $post['user_id'],
				"product_id" => $post['product_id'],
				"created_on" => date("Y-m-d h:i:s")
				);
			$this->db->insert(TABLE_PRE . 'watch_list', $data);
		}
	}
	public function getWatchList($user_id){
		$this->db->select("sv_watch_list.*,sv_products.*");
		$this->db->from("sv_watch_list");
		$this->db->join('sv_products', 'sv_products.product_id = sv_watch_list.product_id');
		$this->db->where("sv_watch_list.user_id",$user_id);
		$this->db->where("sv_products.is_deleted","0");	
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
	}
	public function isAddedWatchList($post){
		$this->db->select("*")->from(TABLE_PRE.'watch_list');
		$this->db->where("user_id",$post['user_id']);
		$this->db->where("product_id",$post['product_id']);
		$query = $this->db->get();
        if($query->num_rows() > 0){
            return "Yes";
        }else {
			return "No";
		}
	}
	public function changePassword($post){
		$this->db->select("*")->from(TABLE_PRE.'users');
		$where = "user_id = '".$post['user_id']."' and password = '".md5($post['old_password'])."'";
		$this->db->where($where);
		$query = $this->db->get();
		$result = $query->result_array();
		if(count($result)>0 && is_array($result)){
			$this->db->where('user_id', $post['user_id']);
			return $this->db->update(TABLE_PRE.'users', array("password" => md5($post['new_password'])));	
		} else {
			 return false;
		}

	}

}