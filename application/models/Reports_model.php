<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    // WINNING REPORT
    public function getAllWinnings($start,$end){
        $this->db->where('a.bid_winner != 0');
        $this->db->where('( a.bid_close_date >= "'.date('Y-m-d H:i:s',strtotime($start)).'" AND a.bid_close_date <= "'.date('Y-m-d H:i:s',strtotime($end)).'" )');
        $this->db->select('*')->from(TABLE_PRE.'products as a');
        $this->db->join(TABLE_PRE.'users as b','a.bid_winner = b.user_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    // IN YARD REPORT
    public function getAllInYard($inyard = 1){
        $this->db->where('in_stock_yard',$inyard);
        $this->db->where('is_deleted != 1');
        $this->db->select('*')->from(TABLE_PRE.'products');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function allProductsDropdown(){
        $this->db->select('*')->from(TABLE_PRE.'products');
        $this->db->where('is_deleted != 1');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

	 public function allProductstotal($search = array()){
        $this->db->select('*')->from(TABLE_PRE.'products');
		$where = "bid_winner = 0";
		if(!empty($search['model'])){
			$where .= " and model like '".$search['model']."%'";
		}
		if(!empty($search['brand'])){
			$where .= " and brand like '".$search['brand']."%'";
		}
		if(!empty($search['price_from'])){
			$where .= " and base_price >=".$search['price_from'];
		}
		if(!empty($search['price_to'])){
			$where .= " and base_price <=".$search['price_to'];
		}
		if(!empty($search['location'])){
			$where .= " and salvage_location like '".$search['location']."%'";
		}
		if(!empty($search['year'])){
			$year = explode(",",$search['year']);
			$where .= " and year >='".$year[0]."' and year <= '".$year[1]."'";
		}
		if(!empty($search['fuel-diesel'])){
			$where .= " and fuel =".$search['fuel-diesel'];
		}
		if(!empty($search['fuel-petrol'])){
			$where .= " and fuel =".$search['fuel-petrol'];
		}
		if(!empty($search['fuel-gas'])){
			$where .= " and fuel =".$search['fuel-gas'];
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
        $this->db->where('user_id',$_SESSION['user_id']);
	    $this->db->select('watch_list');
		$query = $this->db->get(TABLE_PRE.'users');
        if($query->num_rows() > 0){
            $watchlistdata = $query->result_array();
			if($watchlistdata[0]['watch_list'] != ''){
			   $product_id = explode(",",$watchlistdata[0]['watch_list']);
			   $this->db->select("*");
			   $this->db->from("sv_products");
			   $this->db->where_in('product_id',$product_id);
			   $this->db->where("is_deleted","0");  
			   $query = $this->db->get();
			   if($query->num_rows() > 0){
				return $query->result();
			   }
			   return false;
			  } else{
				return false;
			  }
			
        }
        return false;
    }
	public function totalmywatchlist(){
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
	public function checkwatchlist($userid,$productid)
	{
	    $this->db->where('user_id',$userid);
		$this->db->where('product_id',$productid);
	    $this->db->select('watch_id');
		$query = $this->db->get(TABLE_PRE.'watch_list');
        return $query->num_rows();
	}

}