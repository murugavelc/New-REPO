<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set("display_error",0);
error_reporting(0);
class Web extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Web_model');

    }

	public function index()	{
		echo '<h1>Salvage Web API. Access denied for this URL</h1>';
	}
	public function login()	{
		if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
			$result = $this->Web_model->check_login($_REQUEST['username'],$_REQUEST['password'],4);
			if($result){
				$details = array(
					"user_id"			=> $result->user_id,
					"first_name"		=> $result->first_name,
					"last_name"			=> $result->last_name,
					"middle_name"		=> $result->middle_name,
					"email"				=> $result->email,
					"phone"				=> $result->phone,
					"country"			=> $result->country,
					"state"				=> $result->state,
					"city"				=> $result->city,
					"postal_code"		=> $result->zip_code,
					"dob"				=> $result->dob,
					"building_number"	=> $result->building_number,
					"unit_number"	    => $result->unit_number,
					"additional_number"	=> $result->additional_number,
					"street"			=> $result->address_line,
					"nationality"		=> $result->nationality,
					);
				echo json_encode(array("status" => "success", "user_details" => $details));
			} else{
				echo json_encode(array("status" => "username or password is incorrect"));
			}
		}
	}
	public function register(){
		if(isset($_REQUEST['email']) && isset($_REQUEST['first_name'])){
			if($this->Web_model->hasEmail($_REQUEST['email']) && empty($_REQUEST['user_id'])) {
				echo json_encode(array("status" => "Email already exist"));die;
			}
			$data = array(
				"first_name"		=> $_REQUEST['first_name'],
				"last_name"			=> $_REQUEST['last_name'],
				"middle_name"		=> $_REQUEST['middle_name'],
				"email"				=> $_REQUEST['email'],
				"phone"				=> $_REQUEST['phone'],
				"country"			=> $_REQUEST['country'],
				"state"				=> $_REQUEST['state'],
				"city"				=> $_REQUEST['city'],
				"zip_code"		    => $_REQUEST['postal_code'],
				"dob"				=> $_REQUEST['dob'],
				"building_number"	=> $_REQUEST['building_number'],
				"unit_number"	    => $_REQUEST['unit_number'],
				"additional_number"	=> $_REQUEST['additional_number'],
				"address_line"		=> $_REQUEST['street'],
				"nationality"		=> $_REQUEST['nationality'],
				"register_via"		=> 'App',
				"user_type"			=> '4',
				'created_on'		=> date('Y-m-d H:i:s', strtotime('now')),
                'updated_on'		=> date('Y-m-d H:i:s', strtotime('now')),
				);
			if(!empty($_REQUEST['user_id'])){
				$this->db->where('user_id', $_REQUEST['user_id']);
				$status = $this->db->update(TABLE_PRE.'users', $data);
				if($status){
					echo json_encode(array("status" => "Updated your profile"));die;
				} else{
					echo json_encode(array("status" => "Error for Update your profile"));die;
				}				
			} else {
				$success = $this->db->insert(TABLE_PRE . 'users', $data);
				$uid = $this->db->insert_id();
			}
			
			//Send email to user
			
			$to = $_REQUEST['email'];
			$sub = 'New Registration for Salvage';
			$msg = 'Thank you for your registration. We will send your login details after the document verification.<br/><br/>Thanks.';
			$this->Sendmail($to, $sub, $msg);

			// Upload	
			$error = 'success';	
			if (!empty($_FILES['doc_file']['tmp_name'])) {

				$config['upload_path'] = './uploads/documents/' . $uid . '/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['overwrite'] = TRUE;

				$this->load->library('upload', $config);
				
				if (!is_dir($config['upload_path'])) {
					mkdir($config['upload_path'], 0777, TRUE);
				}
				if (!$this->upload->do_upload("doc_file")) {		
					$error = $this->upload->display_errors();
				} else{
					$docs['doc_file'] = $_FILES['doc_file']['name'];
					$this->db->where('user_id', $uid);
					$this->db->update(TABLE_PRE . 'users', $docs);
				}				
			}				
			echo json_encode(array("status" => $error));
		} else {
			echo json_encode(array("status" => "missing required information"));
		}
	}

	public function StateCityRequest(){
		if(!empty($_REQUEST['id']) && !empty($_REQUEST['request'])) {
			if($_REQUEST['request'] == "state") {
				$table = "sv_states";
				$field = "country_id";
			} else if($_REQUEST['request'] == "city"){
				$table = "sv_cities";
				$field = "state_id";
			}else{
				echo json_encode(array("status" => "Invalid Request"));die;
			}
			$result = $this->Web_model->getStateCity($table, $field, $_REQUEST['id']);
			echo json_encode(array("status" => "success",$_REQUEST['request'].'s' => $result));
		} else  if($_REQUEST['request'] == "country"){
			$result = $this->Web_model->getStateCity('sv_countries');
			echo json_encode(array("status" => "success",$_REQUEST['request'].'s' => $result));
		} else{
			echo json_encode(array("status" => "Invalid Request"));
		}
	}
	public function productList(){
		$products = $this->Web_model->getProductDetails($_REQUEST);
		$product_list = $location = $brand = array();
		foreach($products as $key => $array){
			$imges = $this->Web_model->getProductimg($array['product_id']);
			$img_list = array();
			foreach($imges as $key => $value) {
				$img_list[] = $value['product_img']; 
			}
			$product_list[] = array(
					"product_id"		  => $array['product_id'],
					"title"				  => $array['title'],
					"base_price"		  => $array['base_price'],
					"description"		  => $array['description'],
					"start_datetime"	  => $array['start_datetime'],
					"end_datetime"		  => $array['end_datetime'],
					"vehicle_type"		  => $array['vehicle_type'],
					"brand"				  => $array['brand'],
					"model"				  => $array['model'],
					"year"				  => $array['year'],
					"km_driven"			  => $array['km_driven'],
					"fuel"				  => $array['fuel'],
					"seating_capacity"	  => $array['seating_capacity'],
					"transmission_type"	  => $array['transmission_type'],
					"registration_number" => $array['registration_number'],
					"registration_expiry" => $array['registration_expiry'],
					"chasis_number"		  => $array['chasis_number'],
					"engine_number"		  => $array['engine_number'],
					"loss_type"		      => $array['loss_type'],
					"in_stock_yard"		  => $array['in_stock_yard'],
					"salvage_location"	  => $array['salvage_location'],
					"insurance_company"	  => $array['insurance_company'],
					"policy_number"		  => $array['policy_number'],
					"claim_number"		  => $array['claim_number'],
					"owner_name"		  => $array['owner_name'],
					"owner_change_date"	  => $array['owner_change_date'],
					"images"			  => $img_list,
					"img_url"			  => BASE."uploads/products/".$array['product_id'].'/'
				);
				if($array['brand'] != ''){
					$brand[]   = $array['brand'];
				}
				if($array['salvage_location'] != ''){
					$location[] = $array['salvage_location'];
				}
				
		}
		$locations = array_unique($location);
		$brands    = array_unique($brand);
		sort($locations);
		sort($brands);
		if(count($product_list)>0 && is_array($product_list)){
			echo json_encode(array("status" => "success","products" => $product_list,"brand_list" => $brands, "locations" => $locations));
		} else{
			echo json_encode(array("status" => "No products available"));
		}
	}
	public function getModelList(){
		if(!empty($_REQUEST['brand'])){
			$result = $this->Web_model->getModels($_REQUEST['brand']);
			$models_list = array();
			if(!empty($result[0]['model'])){
				foreach($result as $key => $value) {
					$models_list[] = $value['model']; 
				}
				echo json_encode(array("status" => "success" , "model_list" => $models_list));
			} else{
				echo json_encode(array("status" => "No data found"));
			}
		} else{
			echo json_encode(array("status" => "Invalid Request"));
		}
	}
	public function startBidding(){
		if(!empty($_REQUEST['product_id']) && !empty($_REQUEST['user_id'])){
			$result = $this->Web_model->getProduct($_REQUEST['product_id']);
			$result = $result[0];
			if(!empty($result['product_id'])){
				$last_update = $this->Web_model->getbiddingDetails($_REQUEST['product_id']);
				$highest_price = $result['base_price'];
				$updated_date  = $result['created_on'];
				$total_bidding = 0;
				if($last_update[0]['bid_price']>0){
					$highest_price = $last_update[0]['bid_price'];
					$updated_date  = $last_update[0]['created_on'];
					$total_bidding = count($last_update);
				}
				$imges       = $this->Web_model->getProductimg($_REQUEST['product_id']);
				$watch_list  = $this->Web_model->isAddedWatchList($_REQUEST);
				$img_list    = array();
				foreach($imges as $key => $value) {
					$img_list[] = $value['product_img']; 
				}
				$details = array(
					"product_id"		  => $result['product_id'],
					"heighest_price"	  => $highest_price,
					"total_bidding"		  => $total_bidding,
					"last_update_date"	  => $updated_date,
					"title"				  => $result['title'],
					"base_price"		  => $result['base_price'],
					"description"		  => $result['description'],
					"start_datetime"	  => $result['start_datetime'],
					"end_datetime"		  => $result['end_datetime'],
					"vehicle_type"		  => $result['vehicle_type'],
					"brand"				  => $result['brand'],
					"model"				  => $result['model'],
					"year"				  => $result['year'],
					"km_driven"			  => $result['km_driven'],
					"fuel"				  => $result['fuel'],
					"seating_capacity"	  => $result['seating_capacity'],
					"transmission_type"	  => $result['transmission_type'],
					"registration_number" => $result['registration_number'],
					"registration_expiry" => $result['registration_expiry'],
					"chasis_number"		  => $result['chasis_number'],
					"engine_number"		  => $result['engine_number'],
					"loss_type"		      => $result['loss_type'],
					"in_stock_yard"		  => $result['in_stock_yard'],
					"salvage_location"	  => $result['salvage_location'],
					"insurance_company"	  => $result['insurance_company'],
					"policy_number"		  => $result['policy_number'],
					"claim_number"		  => $result['claim_number'],
					"owner_name"		  => $result['owner_name'],
					"owner_change_date"	  => $result['owner_change_date'],
					"added_watch_list"	  => $watch_list,
					"images"			  => $img_list,					
					"img_url"			  => BASE."uploads/products/".$result['product_id'].'/'
				);
				echo json_encode(array("status" => "success","bidding_details" => $details));
			} else {
				echo json_encode(array("status" => "Product ID is incorrect"));
			}
		} else {
			echo json_encode(array("status" => "Invalid Request"));
		}
	}
	public function bidding(){
		if(!empty($_REQUEST['product_id']) && !empty($_REQUEST['user_id']) && !empty($_REQUEST['amount'])){
			$result = $this->Web_model->getbiddingDetails($_REQUEST['product_id']);
			$result = $result[0];
			$create = date("Y-m-d h:i:s");
			$total = 0;
			if(!empty($result['product_id'])){
				$total = count($result);
				if($_REQUEST['amount'] > $result['bid_price']){
					$data = array(
							"user_id"	 => $_REQUEST['user_id'],
							"product_id" => $_REQUEST['product_id'],
							"bid_price"  => $_REQUEST['amount'],
							"bid_from"   => "App",
							"created_on" => $create
						);
				} else {
					echo json_encode(array("status" => "Try higher bid price"));die;
				}
			} else {
				$data = array(
						"user_id"	 => $_REQUEST['user_id'],
						"product_id" => $_REQUEST['product_id'],
						"bid_price"  => $_REQUEST['amount'],
						"bid_from"   => "App",
						"created_on" => $create 
					);
			}
			$success = $this->db->insert(TABLE_PRE . 'biddings', $data);
            $uid = $this->db->insert_id();
			echo json_encode(array("status" => "success", "bid_price" => $_REQUEST['amount'], "updated_date" => $create, "total_bidding" => $total));
		} else{
			echo json_encode(array("status" => "Invalid Request"));
		}
	}
	public function myBiddings(){
		if(!empty($_REQUEST['user_id'])){
			$products = $this->Web_model->getMyBiddings($_REQUEST['user_id']);
			if(count($products) >0 && is_array($products)){
				foreach($products as $key => $array){
					$high_bid = $this->Web_model->getbiddingDetails($array['product_id']);
					$imges = $this->Web_model->getProductimg($array['product_id']);
					$img_list = array();
					foreach($imges as $key => $value) {
						$img_list[] = $value['product_img']; 
					}
					$winner = "No";
					if($array['bid_winner'] == $_REQUEST['user_id']){
						$winner = "Yes";
					}
					$product_list[] = array(
							"product_id"		  => $array['product_id'],
							"title"				  => $array['title'],
							"base_price"		  => $array['base_price'],
							"highest_bid_price"	  => $high_bid[0]['bid_price'],
							"total_bidding"		  => count($high_bid),
							"description"		  => $array['description'],
							"start_datetime"	  => $array['start_datetime'],
							"end_datetime"		  => $array['end_datetime'],
							"vehicle_type"		  => $array['vehicle_type'],
							"brand"				  => $array['brand'],
							"model"				  => $array['model'],
							"year"				  => $array['year'],
							"transmission_type"	  => $array['transmission_type'],
							"registration_number" => $array['registration_number'],
							"registration_expiry" => $array['registration_expiry'],
							"salvage_location"	  => $array['salvage_location'],
							"insurance_company"	  => $array['insurance_company'],
							"policy_number"		  => $array['policy_number'],
							"claim_number"		  => $array['claim_number'],
							"owner_name"		  => $array['owner_name'],
							"you_are_winner"	  => $winner,
							"images"			  => $img_list,
							"img_url"			  => BASE."uploads/products/".$array['product_id'].'/'
						);
					
			}
			echo json_encode(array("status" => "success", "my_bidding" => $product_list));
		 } 
		}else{
			echo json_encode(array("status" => "Invalid Request"));
		}
	}
	public function addWatchList(){
		if(!empty($_REQUEST['user_id']) && !empty($_REQUEST['product_id'])){
			$result = $this->Web_model->addWatchList($_REQUEST);
			echo json_encode(array("status" => "Success"));
			
		} else{
			echo json_encode(array("status" => "Invalid Request"));
		}
	}
	public function getWatchList(){
		$products = $this->Web_model->getWatchList($_REQUEST['user_id']);
		if(count($products)>0 && is_array($products)){
			foreach($products as $key => $array){
				$imges = $this->Web_model->getProductimg($array['product_id']);
				$img_list = array();
				foreach($imges as $key => $value) {
					$img_list[] = $value['product_img']; 
				}
				$product_list[] = array(
						"product_id"		  => $array['product_id'],
						"title"				  => $array['title'],
						"base_price"		  => $array['base_price'],
						"description"		  => $array['description'],
						"start_datetime"	  => $array['start_datetime'],
						"end_datetime"		  => $array['end_datetime'],
						"vehicle_type"		  => $array['vehicle_type'],
						"brand"				  => $array['brand'],
						"model"				  => $array['model'],
						"year"				  => $array['year'],
						"km_driven"			  => $array['km_driven'],
						"fuel"				  => $array['fuel'],
						"seating_capacity"	  => $array['seating_capacity'],
						"transmission_type"	  => $array['transmission_type'],
						"registration_number" => $array['registration_number'],
						"registration_expiry" => $array['registration_expiry'],
						"chasis_number"		  => $array['chasis_number'],
						"engine_number"		  => $array['engine_number'],
						"loss_type"		      => $array['loss_type'],
						"in_stock_yard"		  => $array['in_stock_yard'],
						"salvage_location"	  => $array['salvage_location'],
						"insurance_company"	  => $array['insurance_company'],
						"policy_number"		  => $array['policy_number'],
						"claim_number"		  => $array['claim_number'],
						"owner_name"		  => $array['owner_name'],
						"owner_change_date"	  => $array['owner_change_date'],
						"images"			  => $img_list,
						"img_url"			  => BASE."uploads/products/".$array['product_id'].'/'
					);
					
			}
			echo json_encode(array("status" => "success","products" => $product_list));
		} else{
			echo json_encode(array("status" => "No products available"));
		}		
	}
	public function changePassword(){
		if(!empty($_REQUEST['user_id']) && !empty($_REQUEST['old_password']) && !empty($_REQUEST['new_password'])){
			$result = $this->Web_model->changePassword($_REQUEST);
			if($result){
				echo json_encode(array("status" => "You password has been updated"));
			} else{
				echo json_encode(array("status" => "Incorrect user ID or password"));
			}
		} else {
			echo json_encode(array("status" => "Invalid Request"));
		}
	}
	public function forgotPassword(){
		if($this->Web_model->hasEmail($_REQUEST['email'])){
			echo json_encode(array("status" => "Password change link sent to your email id"));
		} else{
			echo json_encode(array("status" => "Email ID is not exist"));
		}
	}
	public function testmail(){
		$this->Sendmail('raja.p@vividinfotech.com',"test","testemail");
	}
	public function Sendmail($to,$subject,$msg,$error = 0){
		$this->load->library('email'); 
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['protocol'] = 'sendmail';
		$config['smtp_host']  = 'ssl://smtp.googlemail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = 'benjamin.joel@vividinfotech.com';
		$config['smtp_pass'] = 'joel1234.';
		$config['smtp_timeout'] = '4';
		$config['crlf'] = '\n';
		$config['newline'] = '\r\n';

		$this->email->initialize($config);

		$this->email->from('info@salvage.com', 'Salvage',1);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($msg);
		if($this->email->send()){
			echo "send";
		} else if($error == 1){
				echo $this->email->print_debugger();
		}
	}
	
}
