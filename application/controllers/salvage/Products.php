<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('User_model');
		$this->load->model('Products_model');
		$this->load->library('encrypt');

	}

	public function index()
	{
		$data['products'] = $this->Products_model->allProductsByUser($_SESSION['user_id']);
		$this->load->view('salvage/products',$data);
	}

	public function add(){
		$data = array();
		$this->load->view('salvage/add_product',$data);
	}


	public function insert(){
		$res = array();
		if(isset($_POST)){
			$res['input'] = $_POST;
			$res['files'] = $_FILES;
			if($this->Products_model->hasTitle($_POST['title'])){
				$res['error']['title'] = "Product name already used";
			}else {
				$sed = explode('-',$_POST['startend_datetime']);
				$in_arr = array(
					'title'    			=> $_POST['title'],
					'title_arabic'		=> $_POST['title_arabic'],
					'base_price'     	=> $_POST['base_price'],
					'start_datetime'	=> date('Y-m-d H:i:s',strtotime($sed[0])),
					'end_datetime'		=> date('Y-m-d H:i:s',strtotime($sed[1])),
					'is_motor'			=> (isset($_POST['motor_non'])?$_POST['motor_non']:''),
					'vehicle_type'		=> $_POST['vehicle_type'],
					'brand'				=> $_POST['brand'],
					'model'				=> $_POST['model'],
					'year'				=> $_POST['year'],
					'km_driven'			=> $_POST['km_driven'],
					'fuel'				=> $_POST['fuel'],
					'seating_capacity'	=> $_POST['seat_capacity'],
					'transmission_type'	=> $_POST['transmission'],
					'registration_number'	=> $_POST['registration_number'],
					'registration_expiry'	=> date('Y-m-d',strtotime($_POST['registration_date'])),
					'chasis_number'			=> $_POST['chasis_number'],
					'engine_number'			=> $_POST['engine_number'],
					'loss_type'				=> $_POST['loss_type'],
					'in_stock_yard'			=> (isset($_POST['in_stock_yard'])?$_POST['in_stock_yard']:''),
					'salvage_location'		=> $_POST['salvage_location'],
					'insurance_company'		=> $_POST['company_name'],
					'policy_number'			=> $_POST['policy_number'],
					'claim_number'			=> $_POST['claim_number'],
					'owner_name'			=> $_POST['owner_name'],
					'owner_change_date'	=> date('Y-m-d',strtotime($_POST['owner_change_date'])),
					'description'     	=> $_POST['description'],
					'description_arabic'     	=> $_POST['description_arabic'],
					'created_by'		=> $_SESSION['user_id'],
					'created_on'    	=> date('Y-m-d H:i:s', strtotime('now')),
					'updated_on'    	=> date('Y-m-d H:i:s', strtotime('now')),
				);

				if (!empty($_FILES['profile_img']['tmp_name']) && $_FILES['profile_img']['tmp_name'][0] != '') {
					$success = $this->db->insert(TABLE_PRE . 'products', $in_arr);
					$uid = $this->db->insert_id();
					$name_array = array();
					$this->load->library('upload');
					$this->load->library('image_lib');
					if (!empty($_FILES['profile_img']['tmp_name'])) {

						$config['upload_path'] = './uploads/products/' . $uid . '/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['overwrite'] = TRUE;
						$config['max_size'] = '0';
						$config['max_width'] = '0';
						$config['max_height'] = '0';

						if (!is_dir($config['upload_path'])) {
							mkdir($config['upload_path'], 0755, TRUE);
						}
						if (!is_dir($config['upload_path'] . 'thumb/')) {
							mkdir($config['upload_path'] . 'thumb/', 0755, TRUE);
						}

						$files = $_FILES;
						$count = count($_FILES['profile_img']['name']);
						for ($i = 0; $i < $count; $i++) {
							$_FILES['profile_img']['name'] = $files['profile_img']['name'][$i];
							$_FILES['profile_img']['type'] = $files['profile_img']['type'][$i];
							$_FILES['profile_img']['tmp_name'] = $files['profile_img']['tmp_name'][$i];
							$_FILES['profile_img']['error'] = $files['profile_img']['error'][$i];
							$_FILES['profile_img']['size'] = $files['profile_img']['size'][$i];
							$this->upload->initialize($config);
							if ($this->upload->do_upload('profile_img') == False) {
								// echo 'error';
								$res['error']['img'] = $this->upload->display_errors();
							} else {
								$name_array[] = $_FILES['profile_img']['name'];
								$upload_data = $this->upload->data();
								// echo 'success';
								$config["source_image"] = './uploads/products/' . $uid . '/' . $upload_data['file_name'];
								$config['new_image'] = './uploads/products/' . $uid . '/thumb/' . $upload_data['file_name'];
								$config["width"] = 200;
								$config["height"] = 200;

								$this->image_lib->initialize($config);
								$img_success = $this->image_lib->fit();

								if ($img_success) {
									$img_update = array('product_id' => $uid, 'product_img' => $upload_data['file_name']);
//								$this->db->where('product_id', $uid);
									$this->db->insert(TABLE_PRE . 'product_images', $img_update);
								} else {
									$res['error']['img'] = 'failed on cropping';
								}
							}
						}
						$res['files_all'] = $name_array;
					}

					$res['success'] = "Successfully updated.";
				}else{
					$res['error']['img'] = 'Product Image is required';
				}

			}
		}
		echo json_encode($res);
	}



	public function edit(){
		$id = $this->uri->segment(4);
		if($id == ''){ redirect('salvage/products'); }
		$data['product'] = $this->Products_model->getProductById($id);
		$data['product_imgs'] = $this->Products_model->getProductImagesById($id);
		if(!$data['product']){ redirect('salvage/products'); }
		$this->load->view('salvage/edit_product',$data);
	}

	public function update(){
		$res = array();
		if(isset($_POST)){
			$res['input'] = $_POST;
			if($this->Products_model->hasTitle($_POST['title'],$_POST['product_id'])){
				$res['error']['title'] = "Title already used";
			}else {
				$sed = explode('-',$_POST['startend_datetime']);
				$in_arr = array(
					'title'    			=> $_POST['title'],
					'title_arabic'		=> $_POST['title_arabic'],
					'base_price'     	=> $_POST['base_price'],
					'start_datetime'	=> date('Y-m-d H:i:s',strtotime($sed[0])),
					'end_datetime'		=> date('Y-m-d H:i:s',strtotime($sed[1])),
					'is_motor'			=> (isset($_POST['motor_non'])?$_POST['motor_non']:''),
					'vehicle_type'		=> $_POST['vehicle_type'],
					'brand'				=> $_POST['brand'],
					'model'				=> $_POST['model'],
					'year'				=> $_POST['year'],
					'km_driven'			=> $_POST['km_driven'],
					'fuel'				=> $_POST['fuel'],
					'seating_capacity'	=> $_POST['seat_capacity'],
					'transmission_type'	=> $_POST['transmission'],
					'registration_number'	=> $_POST['registration_number'],
					'registration_expiry'	=> date('Y-m-d',strtotime($_POST['registration_date'])),
					'chasis_number'			=> $_POST['chasis_number'],
					'engine_number'			=> $_POST['engine_number'],
					'loss_type'				=> $_POST['loss_type'],
					'in_stock_yard'			=> (isset($_POST['in_stock_yard'])?$_POST['in_stock_yard']:''),
					'salvage_location'		=> $_POST['salvage_location'],
					'insurance_company'		=> $_POST['company_name'],
					'policy_number'			=> $_POST['policy_number'],
					'claim_number'			=> $_POST['claim_number'],
					'owner_name'			=> $_POST['owner_name'],
					'owner_change_date'	=> date('Y-m-d',strtotime($_POST['owner_change_date'])),
					'description'     	=> $_POST['description'],
					'description_arabic'     	=> $_POST['description_arabic'],
					'updated_on'    	=> date('Y-m-d H:i:s', strtotime('now')),
				);
				$this->db->where('product_id',$_POST['product_id']);
				$success = $this->db->update(TABLE_PRE . 'products', $in_arr);
				$uid = $_POST['product_id'];

				$name_array = array();
				$this->load->library('upload');
				$this->load->library('image_lib');
				if (!empty($_FILES['profile_img']['tmp_name'])) {

					$config['upload_path'] = './uploads/products/' . $uid . '/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['overwrite'] = TRUE;
					$config['max_size'] = '0';
					$config['max_width'] = '0';
					$config['max_height'] = '0';

					if (!is_dir($config['upload_path'])) {
						mkdir($config['upload_path'], 0755, TRUE);
					}
					if (!is_dir($config['upload_path'].'thumb/')) {
						mkdir($config['upload_path'].'thumb/', 0755, TRUE);
					}

					$files = $_FILES;
					$count = count($_FILES['profile_img']['name']);
					for($i=0; $i<$count; $i++) {
						$_FILES['profile_img']['name']= $files['profile_img']['name'][$i];
						$_FILES['profile_img']['type']= $files['profile_img']['type'][$i];
						$_FILES['profile_img']['tmp_name']= $files['profile_img']['tmp_name'][$i];
						$_FILES['profile_img']['error']= $files['profile_img']['error'][$i];
						$_FILES['profile_img']['size']= $files['profile_img']['size'][$i];
						$this->upload->initialize($config);
						if($this->upload->do_upload('profile_img') == False) {
							// echo 'error';
							$res['error']['img'] = $this->upload->display_errors();
						}
						else {
							$name_array[] = $_FILES['profile_img']['name'];
							$upload_data = $this->upload->data();
							// echo 'success';
							$config["source_image"] = './uploads/products/' . $uid . '/' . $upload_data['file_name'];
							$config['new_image'] = './uploads/products/' . $uid . '/thumb/' . $upload_data['file_name'];
							$config["width"] = 200;
							$config["height"] = 200;

							$this->image_lib->initialize($config);
							$img_success = $this->image_lib->fit();

							if ($img_success) {
								$img_update = array('product_id' => $uid,'product_img' => $upload_data['file_name']);
//								$this->db->where('product_id', $uid);
								$this->db->insert(TABLE_PRE . 'product_images', $img_update);
							} else {
								$res['error']['img'] = 'failed on cropping';
							}
						}
					}
					$res['files_all'] = $name_array;
				}
				if (empty($res['error'])) {
					$res['success'] = "Successfully updated.";
				}
			}
		}
		echo json_encode($res);
	}

	public function remove_img(){
		$res = array();
		if(isset($_POST['id'])){
			$this->db->where('image_id',$_POST['id']);
			$res['sucess'] =  $this->db->delete(TABLE_PRE.'product_images');
		}
		echo json_encode($res);
	}

	public function view(){
		$id = $this->uri->segment(4);
		if($id == ''){ redirect('salvage/products'); }
		$data['product'] = $this->Products_model->getProductById($id);
		$data['product_imgs'] = $this->Products_model->getProductImagesById($id);
		$data['current_bid'] = $this->Products_model->getHighestBidByProduct($id);
		$data['total_bids']	= $this->Products_model->getTotalBidsByProduct($id);
		if(!$data['product']){ redirect('salvage/products'); }
		$this->load->view('salvage/view_product',$data);
	}

	public function view_biddings(){
		$id = $this->uri->segment(4);
		if($id == ''){ redirect('salvage/products'); }
		$data['product'] = $this->Products_model->getProductById($id);
		$data['product_imgs'] = $this->Products_model->getProductImagesById($id);
		$data['current_bid'] = $this->Products_model->getHighestBidByProduct($id);
		$data['all_bids']	= $this->Products_model->getAllBidsByProduct($id);
		$data['total_bids']	= $this->Products_model->getTotalBidsByProduct($id);
		$data['winner']	= $this->Products_model->getWinner($id,$data['product']->end_datetime);
		if(!$data['product']){ redirect('salvage/products'); }
		$this->load->view('salvage/view_product_biddings',$data);
	}

	public function close_bid(){
		$res = array();
		if(isset($_POST['winner_id'])){
			$in_arr = array(
				'bid_winner'		=> $_POST['winner_id'],
				'bid_close_price'	=> $_POST['bid_price'],
			);
			$this->db->where('product_id',$_POST['product_id']);
			$res['success'] = $this->db->update(TABLE_PRE.'products',$in_arr);
		}
		echo json_encode($res);
	}

}
