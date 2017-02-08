<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    // ADMIN PRODUCT LIST
    public function allProductsList(){
        $this->db->select('*')->from(TABLE_PRE.'products')->where('bid_winner = 0');
        $this->db->where('is_deleted != 1');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function allProducts($limit,$start,$search=array()){
	    $this->db->where("( start_datetime <= '".date('Y-m-d H:i:s',strtotime('now'))."' AND end_datetime >=  '".date('Y-m-d H:i:s',strtotime('now'))."')");
		$this->db->where('is_deleted != 1');
        $this->db->select('*')->from(TABLE_PRE.'products')->where('bid_winner = 0');
		$this->db->limit($limit, $start);
		$where = "bid_winner = 0";
		if(!empty($search['model'])){
			$where .= " and model like '".$search['model']."%'";
		}
		if(!empty($search['brand'])){
			$where .= " and brand like '".$search['brand']."%'";
		}
		if(!empty($search['price_from'])){
			$where .= " and updated_bid_amount >=".$search['price_from'];
		}
		if(!empty($search['price_to'])){
			$where .= " and updated_bid_amount <=".$search['price_to'];
		}
		if(!empty($search['location'])){
			$where .= " and salvage_location like '".$search['location']."%'";
		}
		if(!empty($search['year'])){
			$year = explode(",",$search['year']);
			$where .= " and year >='".$year[0]."' and year <= '".$year[1]."'";
		}
		if(!empty($search['fuel-petrol']) || !empty($search['fuel-diesel']) || !empty($search['fuel-gas'])){
			$where .=" and (";
			if(!empty($search['fuel-petrol'])) {
				$where .= " fuel = '".$search['fuel-petrol']."' or";
			}
			if(!empty($search['fuel-diesel'])){
				$where .= " fuel = '".$search['fuel-diesel']."' or";
			}
			if(!empty($search['fuel-gas'])){
				$where .= " fuel = '".$search['fuel-gas']."' or";
			}
			$where = substr($where, 0, -2);
			$where .=" )";
		}
		if(!empty($search['product_id'])){
			$where .= " and product_id =".$search['product_id'];
		}
		$this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }
	 public function allProductstotal($search = array()){
	    $this->db->where("( start_datetime <= '".date('Y-m-d H:i:s',strtotime('now'))."' AND end_datetime >=  '".date('Y-m-d H:i:s',strtotime('now'))."')");
		$this->db->where('is_deleted != 1');
        $this->db->select('*')->from(TABLE_PRE.'products');
		$where = "bid_winner = 0";
		if(!empty($search['model'])){
			$where .= " and model like '".$search['model']."%'";
		}
		if(!empty($search['brand'])){
			$where .= " and brand like '".$search['brand']."%'";
		}
		if(!empty($search['price_from'])){
			$where .= " and updated_bid_amount >=".$search['price_from'];
		}
		if(!empty($search['price_to'])){
			$where .= " and updated_bid_amount <=".$search['price_to'];
		}
		if(!empty($search['location'])){
			$where .= " and salvage_location like '".$search['location']."%'";
		}
		if(!empty($search['year'])){
			$year = explode(",",$search['year']);
			$where .= " and year >='".$year[0]."' and year <= '".$year[1]."'";
		}
		if(!empty($search['fuel-petrol']) || !empty($search['fuel-diesel']) || !empty($search['fuel-gas'])){
			$where .=" and (";
			if(!empty($search['fuel-petrol'])) {
				$where .= " fuel = '".$search['fuel-petrol']."' or";
			}
			if(!empty($search['fuel-diesel'])){
				$where .= " fuel = '".$search['fuel-diesel']."' or";
			}
			if(!empty($search['fuel-gas'])){
				$where .= " fuel = '".$search['fuel-gas']."' or";
			}
			$where = substr($where, 0, -2);
			$where .=" )";
		}
		if(!empty($search['product_id'])){
			$where .= " and product_id =".$search['product_id'];
		}
		$this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function allClosedProducts(){
        $this->db->where('(approval_init = 1 AND approver_1 = 1 AND approver_2 = 1 AND approver_3 = 1 )');
        $this->db->select('*')->from(TABLE_PRE.'products')->where('bid_winner != 0');
        $this->db->where('is_deleted != 1');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function allCompletedProducts(){
        $this->db->where("( end_datetime <=  '".date('Y-m-d H:i:s',strtotime('now'))."')");
        $this->db->where('is_deleted != 1');
        $this->db->where('approval_init != 1');
        $this->db->select('*')->from(TABLE_PRE.'products')->where('bid_winner = 0');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function allActiveProducts(){
        $this->db->where("( start_datetime <= '".date('Y-m-d H:i:s',strtotime('now'))."' AND end_datetime >=  '".date('Y-m-d H:i:s',strtotime('now'))."')");
        $this->db->where('bid_winner = 0');
        $this->db->where('is_deleted != 1');
        $this->db->select('*')->from(TABLE_PRE.'products');
        $query = $this->db->get();
//        echo $this->db->last_query(); die;
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function allInactiveProducts(){
        $this->db->where("( start_datetime >= '".date('Y-m-d H:i:s',strtotime('now'))."' || end_datetime <=  '".date('Y-m-d H:i:s',strtotime('now'))."')");
        $this->db->where('bid_winner = 0');
        $this->db->where('is_deleted != 1');
        $this->db->select('*')->from(TABLE_PRE.'products');
        $query = $this->db->get();
//        echo $this->db->last_query(); die;
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function allUpcomingProducts(){
        $this->db->where("( start_datetime >= '".date('Y-m-d H:i:s',strtotime('now'))."' )");
        $this->db->where('bid_winner = 0');
        $this->db->where('is_deleted != 1');
        $this->db->select('*')->from(TABLE_PRE.'products');
        $query = $this->db->get();
//        echo $this->db->last_query(); die;
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function allApprovalProducts(){
        $this->db->where("( approval_init = 1 && (approver_1 != 1 || approver_2 != 1 || approver_3 != 1))");
        $this->db->where('bid_winner = 0');
        $this->db->where('is_deleted != 1');
        $this->db->select('*')->from(TABLE_PRE.'products');
        $query = $this->db->get();
//        echo $this->db->last_query(); die;
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function allBiddingProducts(){
        $this->db->where("( start_datetime <= '".date('Y-m-d H:i:s',strtotime('now'))."' AND end_datetime >=  '".date('Y-m-d H:i:s',strtotime('now'))."')");
        $this->db->where('bid_winner = 0');
        $this->db->select('*')->from(TABLE_PRE.'products');
        $query = $this->db->get();
//        echo $this->db->last_query(); die;
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function allProductsByUser($uid){
        $this->db->where('created_by',$uid);
        $this->db->where('is_deleted != 1');
        $this->db->select('*')->from(TABLE_PRE.'products');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function getProductById($id){
        $this->db->where('product_id',$id);
        $this->db->select('*')->from(TABLE_PRE.'products');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }
        return false;
    }

    public function getProductImagesById($id){
        $this->db->where('product_id',$id);
        $this->db->select('*')->from(TABLE_PRE.'product_images');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function getProductPriceById($id){
        
        $this->db->where('product_id',$id);
        $this->db->select('*')->from(TABLE_PRE.'biddings');
        $this->db->order_by('bid_price','DESC')->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    public function getHighestBidByProduct($id){
        $out = array();
        $product_base = $this->getProductById($id);
        $base = $product_base->base_price;

        $recent = $this->getProductPriceById($id);

//        print_r($recent);

        $out['current_price'] = '';
        $out['updated_datetime'] = '';

        if($recent > $base){
            $out['current_price'] = $recent->bid_price;
            $out['updated_datetime'] = $recent->created_on;
        }else{
            $out['current_price'] = $base;
            $out['updated_datetime'] = $product_base->updated_on;
        }

        return $out;
    }

    public function getTotalBidsByProduct($id){
        $this->db->where('product_id',$id);
        return $this->db->count_all_results(TABLE_PRE.'biddings');

    }

    public function getAllBidsByProduct($id){
        $this->db->where('product_id',$id);
        $this->db->select('a.*,b.first_name,b.last_name')->from(TABLE_PRE.'biddings a');
        $this->db->join(TABLE_PRE.'users b','a.user_id = b.user_id');
        $this->db->order_by('bid_price','DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function getWinner($id,$end_datetime){
        if(date('Y-m-d H:i:s',strtotime($end_datetime)) < date('Y-m-d H:i:s',strtotime('now')) ) {
            $this->db->where('product_id',$id);
            $this->db->select('a.*,b.first_name,b.last_name')->from(TABLE_PRE.'biddings a');
            $this->db->join(TABLE_PRE.'users b','a.user_id = b.user_id');
            $this->db->order_by('bid_price','DESC')->limit(1);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return $query->row();
            }else{
                return false;
            }
        }
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

    public function hasTitle($title,$id = ''){
        if($id != ''){
            $this->db->where('product_id !=',$id);
        }
        $this->db->where('title',$title);
        $query = $this->db->select('*')->from(TABLE_PRE.'products')->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }
	public function getProductSearchList($keyword){
		$this->db->select('*')->from(TABLE_PRE.'products');
		$where = "bid_winner = 0 and brand like '".$keyword."%' or model like '".$keyword."%' or title like '".$keyword."%'";		
		$this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
	}
	
	public function mybiddings($limit,$start){
        $this->db->select('a.*,b.user_id')->from(TABLE_PRE.'products a');
        $this->db->join(TABLE_PRE.'biddings b','a.product_id = b.product_id');
		$this->db->where('b.user_id',$_SESSION['user_id']);
		$this->db->group_by('b.product_id'); 
        $this->db->order_by('bid_price','DESC');
		$this->db->limit($limit, $start);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }
	public function totalmybiddings(){
        $this->db->select('a.*,b.user_id')->from(TABLE_PRE.'products a');
        $this->db->join(TABLE_PRE.'biddings b','a.product_id = b.product_id');
		$this->db->where('b.user_id',$_SESSION['user_id']);
		$this->db->group_by('b.product_id'); 
        $this->db->order_by('bid_price','DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }
	
	public function biddingcount($productid)
	{
	         $this->db->where('product_id',$productid);
			 $this->db->select('product_id');
			 $query = $this->db->get(TABLE_PRE.'biddings');
			 return $query->num_rows();
			 //if($query->num_rows() > 0){
               //return $query->result();
            // }
	}
	public function mywatchlist($limit,$start){
        $this->db->select('a.*,b.user_id')->from(TABLE_PRE.'products a');
        $this->db->join(TABLE_PRE.'watch_list b','a.product_id = b.product_id');
		$this->db->where('b.user_id',$_SESSION['user_id']);
		$this->db->group_by('b.product_id'); 
		$this->db->limit($limit, $start);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }
	public function totalmywatchlist(){
        $this->db->select('a.*,b.user_id')->from(TABLE_PRE.'products a');
        $this->db->join(TABLE_PRE.'watch_list b','a.product_id = b.product_id');
		$this->db->where('b.user_id',$_SESSION['user_id']);
		$this->db->group_by('b.product_id'); 
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }
	public function checkwatchlist($userid,$productid)
	{
	    $this->db->where('user_id',$userid);
		$this->db->where('product_id',$productid);
	    $this->db->select('watch_id');
		$query = $this->db->get(TABLE_PRE.'watch_list');
        return $query->num_rows();
	}

    public function getAllUsersInBidWatch($productid){
		$bidding_user = $watchlist_user = '';
		$this->db->select("sv_users.*");
		$this->db->from("sv_biddings");
		$this->db->join('sv_users', 'sv_users.user_id = sv_biddings.user_id');
		$this->db->where("sv_biddings.product_id",$productid);
		$this->db->group_by("sv_users.user_id");
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$bidding_user = $query->result_array();
		}

		$this->db->select("sv_users.*");
		$this->db->from("sv_watch_list");
		$this->db->join('sv_users', 'sv_users.user_id = sv_watch_list.user_id');
		$this->db->where("sv_watch_list.product_id",$productid);
		$this->db->group_by("sv_users.user_id");
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$watchlist_user = $query->result_array();
		}

        if(!empty($bidding_user) && empty($watchlist_user)){
            return $bidding_user;
        }elseif(empty($bidding_user) && !empty($watchlist_user)){
            return $watchlist_user;
        }elseif(!empty($bidding_user) && !empty($watchlist_user)){
            return array_merge($bidding_user,$watchlist_user);
        }

    }
	
	public function allmotorsProducts($limit,$start,$search=array()){
	    $this->db->where("( start_datetime <= '".date('Y-m-d H:i:s',strtotime('now'))."' AND end_datetime >=  '".date('Y-m-d H:i:s',strtotime('now'))."')");
        $this->db->select('*')->from(TABLE_PRE.'products')->where('bid_winner = 0');
		$this->db->limit($limit, $start);
		$where = "bid_winner = 0";
		if(!empty($search['model'])){
			$where .= " and model like '".$search['model']."%'";
		}
		if(!empty($search['brand'])){
			$where .= " and brand like '".$search['brand']."%'";
		}
		if(!empty($search['price_from'])){
			$where .= " and updated_bid_amount >=".$search['price_from'];
		}
		if(!empty($search['price_to'])){
			$where .= " and updated_bid_amount <=".$search['price_to'];
		}
		if(!empty($search['location'])){
			$where .= " and salvage_location like '".$search['location']."%'";
		}
		if(!empty($search['year'])){
			$year = explode(",",$search['year']);
			$where .= " and year >='".$year[0]."' and year <= '".$year[1]."'";
		}
		if(!empty($search['fuel-petrol']) || !empty($search['fuel-diesel']) || !empty($search['fuel-gas'])){
			$where .=" and (";
			if(!empty($search['fuel-petrol'])) {
				$where .= " fuel = '".$search['fuel-petrol']."' or";
			}
			if(!empty($search['fuel-diesel'])){
				$where .= " fuel = '".$search['fuel-diesel']."' or";
			}
			if(!empty($search['fuel-gas'])){
				$where .= " fuel = '".$search['fuel-gas']."' or";
			}
			$where = substr($where, 0, -2);
			$where .=" )";
		}
		if(!empty($search['product_id'])){
			$where .= " and product_id =".$search['product_id'];
		}
		$this->db->where("is_motor = 1");
		$this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }
	 public function allmotorProductstotal($search = array()){
	    $this->db->where("( start_datetime <= '".date('Y-m-d H:i:s',strtotime('now'))."' AND end_datetime >=  '".date('Y-m-d H:i:s',strtotime('now'))."')");
        $this->db->select('*')->from(TABLE_PRE.'products');
		$where = "bid_winner = 0";
		if(!empty($search['model'])){
			$where .= " and model like '".$search['model']."%'";
		}
		if(!empty($search['brand'])){
			$where .= " and brand like '".$search['brand']."%'";
		}
		if(!empty($search['price_from'])){
			$where .= " and updated_bid_amount >=".$search['price_from'];
		}
		if(!empty($search['price_to'])){
			$where .= " and updated_bid_amount <=".$search['price_to'];
		}
		if(!empty($search['location'])){
			$where .= " and salvage_location like '".$search['location']."%'";
		}
		if(!empty($search['year'])){
			$year = explode(",",$search['year']);
			$where .= " and year >='".$year[0]."' and year <= '".$year[1]."'";
		}
		if(!empty($search['fuel-petrol']) || !empty($search['fuel-diesel']) || !empty($search['fuel-gas'])){
			$where .=" and (";
			if(!empty($search['fuel-petrol'])) {
				$where .= " fuel = '".$search['fuel-petrol']."' or";
			}
			if(!empty($search['fuel-diesel'])){
				$where .= " fuel = '".$search['fuel-diesel']."' or";
			}
			if(!empty($search['fuel-gas'])){
				$where .= " fuel = '".$search['fuel-gas']."' or";
			}
			$where = substr($where, 0, -2);
			$where .=" )";
		}
		if(!empty($search['product_id'])){
			$where .= " and product_id =".$search['product_id'];
		}
		$this->db->where("is_motor = 1");
		$this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }
	public function allnonmotorsProducts($limit,$start,$search=array()){
	    $this->db->where("( start_datetime <= '".date('Y-m-d H:i:s',strtotime('now'))."' AND end_datetime >=  '".date('Y-m-d H:i:s',strtotime('now'))."')");
        $this->db->select('*')->from(TABLE_PRE.'products')->where('bid_winner = 0');
		$this->db->limit($limit, $start);
		$where = "bid_winner = 0";
		if(!empty($search['model'])){
			$where .= " and model like '".$search['model']."%'";
		}
		if(!empty($search['brand'])){
			$where .= " and brand like '".$search['brand']."%'";
		}
		if(!empty($search['price_from'])){
			$where .= " and updated_bid_amount >=".$search['price_from'];
		}
		if(!empty($search['price_to'])){
			$where .= " and updated_bid_amount <=".$search['price_to'];
		}
		if(!empty($search['location'])){
			$where .= " and salvage_location like '".$search['location']."%'";
		}
		if(!empty($search['year'])){
			$year = explode(",",$search['year']);
			$where .= " and year >='".$year[0]."' and year <= '".$year[1]."'";
		}
		if(!empty($search['fuel-petrol']) || !empty($search['fuel-diesel']) || !empty($search['fuel-gas'])){
			$where .=" and (";
			if(!empty($search['fuel-petrol'])) {
				$where .= " fuel = '".$search['fuel-petrol']."' or";
			}
			if(!empty($search['fuel-diesel'])){
				$where .= " fuel = '".$search['fuel-diesel']."' or";
			}
			if(!empty($search['fuel-gas'])){
				$where .= " fuel = '".$search['fuel-gas']."' or";
			}
			$where = substr($where, 0, -2);
			$where .=" )";
		}
		if(!empty($search['product_id'])){
			$where .= " and product_id =".$search['product_id'];
		}
		$this->db->where("is_motor = 0");
		$this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }
	 public function allnonmotorProductstotal($search = array()){
	    $this->db->where("( start_datetime <= '".date('Y-m-d H:i:s',strtotime('now'))."' AND end_datetime >=  '".date('Y-m-d H:i:s',strtotime('now'))."')");
        $this->db->select('*')->from(TABLE_PRE.'products');
		$where = "bid_winner = 0";
		if(!empty($search['model'])){
			$where .= " and model like '".$search['model']."%'";
		}
		if(!empty($search['brand'])){
			$where .= " and brand like '".$search['brand']."%'";
		}
		if(!empty($search['price_from'])){
			$where .= " and updated_bid_amount >=".$search['price_from'];
		}
		if(!empty($search['price_to'])){
			$where .= " and updated_bid_amount <=".$search['price_to'];
		}
		if(!empty($search['location'])){
			$where .= " and salvage_location like '".$search['location']."%'";
		}
		if(!empty($search['year'])){
			$year = explode(",",$search['year']);
			$where .= " and year >='".$year[0]."' and year <= '".$year[1]."'";
		}
		if(!empty($search['fuel-petrol']) || !empty($search['fuel-diesel']) || !empty($search['fuel-gas'])){
			$where .=" and (";
			if(!empty($search['fuel-petrol'])) {
				$where .= " fuel = '".$search['fuel-petrol']."' or";
			}
			if(!empty($search['fuel-diesel'])){
				$where .= " fuel = '".$search['fuel-diesel']."' or";
			}
			if(!empty($search['fuel-gas'])){
				$where .= " fuel = '".$search['fuel-gas']."' or";
			}
			$where = substr($where, 0, -2);
			$where .=" )";
		}
		if(!empty($search['product_id'])){
			$where .= " and product_id =".$search['product_id'];
		}
		$this->db->where("is_motor = 0");
		$this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }
	public function highestbidamt($productid)
	{
	         $this->db->where('product_id',$productid);
			 $this->db->select('bid_price');
			 $this->db->order_by('bid_id','desc');
			 $this->db->limit('1');
			 $query = $this->db->get(TABLE_PRE.'biddings');
			 $data = $query->result_array();
			 return $data[0]['bid_price'];
			 //echo $this->db->last_query();
			 //return $query->num_rows();
			 //if($query->num_rows() > 0){
               //return $query->result();
            // }
	}

}