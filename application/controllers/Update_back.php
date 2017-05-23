<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class update extends CI_Controller {

	function __construct(){

		parent::__construct();

		$this->load->model('model_update');
	}

	function update_slider() {
		$slider_id = $this->input->post('slider_id');
		$slider_title = $this->input->post('slider_title');
		$slider_link = $this->input->post('slider_link');
		$slider_image_old = $this->input->post('silder_image_old');
		$slider_image_new = $_FILES['silder_image_new']['name'];
		$config = array(

			'upload_path' => "./assets/image/slider",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'remove_spaces' => FALSE,
			'overwrite' => TRUE,
			'max_size' => "2048000", 
			'max_height' => "2200",
			'max_width' => "2200"

		);
		if ($slider_image_new == '') {

			$data = array(
			'slider_title' => $slider_title,
			'silder_image' => $slider_image_old,
			'slider_link' => $slider_link
			);
			$this->model_update->update_slider($slider_id,$data);
		}
		else {

			$data = array(
			'slider_title' => $slider_title,
			'silder_image' => $slider_image_new,
			'slider_link' => $slider_link
			);

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('silder_image_new');
			$this->model_update->update_slider($slider_id,$data);
		}
		

		

		redirect('admin/slider');	
	}

	function update_manufacturer() {
		$manu_id = $this->input->post('manu_id');
		$manu_title = $this->input->post('manu_title');
		$manu_link = $this->input->post('manu_link');
		$manu_desc = $this->input->post('manu_desc');
		$manu_image_old = $this->input->post('manu_image_old');
		$manu_image_new = $_FILES['manu_image_new']['name'];
		$config = array(

			'upload_path' => "./assets/image/manufacturer",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'remove_spaces' => FALSE,
			'overwrite' => TRUE,
			'max_size' => "2048000", 
			'max_height' => "2200",
			'max_width' => "2200"

		);
		if ($manu_image_new == '') {

			$data = array(
			'manu_title' => $manu_title,
			'manu_image' => $manu_image_old,
			'manu_link' => $manu_link,
			'manu_desc' => $manu_desc
			);
			$this->model_update->update_manufacturer($manu_id,$data);
		}
		else {

			$data = array(
			'manu_title' => $manu_title,
			'manu_image' => $manu_image_new,
			'manu_link' => $manu_link,
			'manu_desc' => $manu_desc
			);

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('manu_image_new');
			$this->model_update->update_manufacturer($manu_id,$data);
		}
		

		

		redirect('admin/manufacturer');	
	}

	function update_event() {
		$event_id = $this->input->post('event_id');
		$event_title = $this->input->post('event_name');
		$event_desc = $this->input->post('event_desc');


		if ($_FILES['event_image']['name']== '') {
			
			$image_1 = $this->input->post('event_image_old');
		}
		else {
			$image_1 = $_FILES['event_image']['name'];
		}
		$config = array(

			'upload_path' => "./assets/image/events",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'remove_spaces' => FALSE,
			'overwrite' => TRUE,
			'max_size' => "2048000", 
			'max_height' => "2200",
			'max_width' => "2200"

		);

			$data = array(
			'news_title' => $event_title,
			'news_image' => $image_1,
			'news_desc' => $event_desc
			);

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('event_image');
			$this->model_update->update_event($event_id,$data);
		

		

		redirect('admin/event');	
	}

	function update_news() {
		$news_id = $this->input->post('news_id');
		$news_title = $this->input->post('news_name');
		$news_desc = $this->input->post('news_desc');


		if ($_FILES['news_image']['name']== '') {
			
			$image_1 = $this->input->post('news_image_old');
		}
		else {
			$image_1 = $_FILES['news_image']['name'];
		}

		if ($_FILES['news_thumb']['name']== '') {
			
			$image_2 = $this->input->post('news_thumb_old');
		}
		else {
			$image_2 = $_FILES['news_thumb']['name'];
		}


		$config = array(

			'upload_path' => "./assets/image/news",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'remove_spaces' => FALSE,
			'overwrite' => TRUE,
			'max_size' => "2048000", 
			'max_height' => "2200",
			'max_width' => "2200"

		);

			$data = array(
			'news_title' => $news_title,
			'news_image' => $image_1,
			'news_desc' => $news_desc,
			'news_thumbnail' => $image_2
			);

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('news_image');
			$this->upload->do_upload('news_thumb_image');
			$this->model_update->update_news($news_id,$data);
		

		

		redirect('admin/news');	
	}

	function update_discount() {

		$discount_id = $this->input->post('discount_id');
		$discount_code = $this->input->post('discount_code');
		$discount_price = $this->input->post('discount_price');
		$discount_name= $this->input->post('discount_name');
		$discount_desc = $this->input->post('discount_desc');
		$start_date = $this->input->post('start_date');
		$expired_date = $this->input->post('expired_date');


		$data = array(
			'discount_code' => $discount_code,
			'discount_price' => $discount_price,
			'discount_name' => $discount_name,
			'discount_desc' => $discount_desc,
			'start_date' => $start_date,
			'expired_date' => $expired_date
		);
		
		$this->model_update->update_discount($discount_id,$data);
		
		redirect('admin/discount');	
	}

	function update_admin() {

		$admin_id = $this->input->post('admin_id');
		$username = $this->input->post('username');
		$surename = $this->input->post('surename');
		$role_name= $this->input->post('role_name');
		$email= $this->input->post('email');


		$data = array(
			'username' => $username,
			'surename' => $surename,
			'role_id' => $role_name,
			'email' => $email
		);
		
		$this->model_update->update_admin($admin_id,$data);
		
		redirect('admin/users_admin');	
	}

	function update_product() {

		$product_id = $this->input->post('product_id');
		$product_title = $this->input->post('product_title');
		$product_brand = $this->input->post('manu_id');
		$product_category = $this->input->post('product_category');
		$product_code = $this->input->post('product_code');
		$product_availability = $this->input->post('product_availability');
		$featured_product = $this->input->post('featured');
		$product_spec = $this->input->post('product_specification');
		$product_text = $this->input->post('product_text');
		$product_description = $this->input->post('product_desc');
		$product_category_url = url_title($product_category);
		$product_slug = url_title($product_title);
		
		/*$product_image_old_1 = $this->input->post('product_image_old_1');
		$product_image_new_1 = $_FILES['product_image_new_1']['name'];

		$product_image_old_2 = $this->input->post('product_image_old_2');
		$product_image_new_2 = $_FILES['product_image_new_2']['name'];
		
		$product_image_old_3 = $this->input->post('product_image_old_3');
		$product_image_new_3 = $_FILES['product_image_new_3']['name'];
		
		$product_image_old_4 = $this->input->post('product_image_old_4');
		$product_image_new_4 = $_FILES['product_image_new_4']['name'];*/

		if ($_FILES['product_image_new_1']['name']== '') {
			
			$image_1 = $this->input->post('product_image_old_1');
		}
		else {
			$image_1 = $_FILES['product_image_new_1']['name'];
		}


		if ($_FILES['product_image_new_2']['name'] == '') {
			
			$image_2 = $this->input->post('product_image_old_2');
		}
		else {
			$image_2 = $_FILES['product_image_new_2']['name'];
		}



		if ($_FILES['product_image_new_3']['name'] == '') {
			
			$image_3 = $this->input->post('product_image_old_3');
		}
		else {
			$image_3 = $_FILES['product_image_new_3']['name'];
		}



		if ($_FILES['product_image_new_4']['name'] == '') {
			
			$image_4 = $this->input->post('product_image_old_4');
		}
		else {
			$image_4 = $_FILES['product_image_new_4']['name'];
		}
		
		
		$config = array(

			'upload_path' => "./assets/image/product",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'remove_spaces' => FALSE,
			'overwrite' => TRUE,
			'max_size' => "2048000", 
			'max_height' => "2200",
			'max_width' => "2200"

		);
		
			$data = array(
			'product_id' => $product_id,	
			'product_title' => $product_title,
			'manu_id' => $product_brand,
			'product_category' => $product_category,

			'product_code' => $product_code,
			'product_availability' => $product_availability,
			'featured' => $featured_product,

			'product_specification' => 	$product_spec,
			'product_text_preview' => $product_text,
			'product_descrption' => $product_description,

			'category_url' => $product_category_url,
			'product_slug' => $product_slug,

			'product_image_1' => $image_1,
			'product_image_2' => $image_2,
			'product_image_3' => $image_3,
			'product_image_4' => $image_4
			
			);

			


			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('product_image_new_1');
			$this->upload->do_upload('product_image_new_2');
			$this->upload->do_upload('product_image_new_3');
			$this->upload->do_upload('product_image_new_4');
			$this->model_update->update_product($product_id,$data);
		

		redirect('admin/product-list');	
	}

	function update_sparepart() {

		$sparepart_id = $this->input->post('sparepart_id');
		$sparepart_name = $this->input->post('sparepart_name');
		$manu_id = $this->input->post('manu_id');
		$sparepart_category = $this->input->post('sparepart_category');
		$catalog_code = $this->input->post('catalog_code');
		$sparepart_price = $this->input->post('sparepart_price');
		$sparepart_stock = $this->input->post('stock');
		$sparepart_desc = $this->input->post('sparepart_desc');
		$sparepart_text_preview = $this->input->post('sparepart_text_preview');
		$sparepart_slug = url_title($sparepart_name);
		

		if ($_FILES['sparepart_image_new_1']['name'] == '') {
			
			$product_image_1 = $this->input->post('sparepart_image_old_1');
		}
		else {
			$product_image_1 = $_FILES['sparepart_image_new_1']['name'];
		}


		if ($_FILES['sparepart_image_new_2']['name'] == '') {
			
			$product_image_2 = $this->input->post('sparepart_image_old_2');
		}
		else {
			$product_image_2 = $_FILES['sparepart_image_new_2']['name'];
		}



		if ($_FILES['sparepart_image_new_3']['name'] == '') {
			
			$product_image_3 = $this->input->post('sparepart_image_old_3');
		}
		else {
			$product_image_3 = $_FILES['sparepart_image_new_3']['name'];
		}



		if ($_FILES['sparepart_image_new_4']['name'] == '') {
			
			$product_image_4 = $this->input->post('sparepart_image_old_4');
		}
		else {
			$product_image_4 = $_FILES['sparepart_image_new_4']['name'];
		}
		
	
		$config = array(

			'upload_path' => "./assets/sp/images/products",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'remove_spaces' => FALSE,
			'overwrite' => TRUE,
			'max_size' => "2048000", 
			'max_height' => "2200",
			'max_width' => "2200"

		);
		
			$data = array(
			'sparepart_name' => $sparepart_name,
			'manu_id' => $manu_id,
			'sparepart_category' => $sparepart_category,

			'sparepart_code' => $catalog_code,
			'sparepart_price' => $sparepart_price,

			'stock' => 	$sparepart_stock,
			'sparepart_text_preview' => $sparepart_text_preview,
			'sparepart_desc' => $sparepart_desc,

			'sparepart_slug' => $sparepart_slug,

			'sparepart_image' => $product_image_1,
			'sparepart_image_2' => $product_image_2,
			'sparepart_image_3' => $product_image_3,
			'sparepart_image_4' => $product_image_4

		);

	
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('sparepart_image_new_1');
			$this->upload->do_upload('sparepart_image_new_2');
			$this->upload->do_upload('sparepart_image_new_3');
			$this->upload->do_upload('sparepart_image_new_4');
			$this->model_update->update_sparepart($sparepart_id,$data);

		redirect('admin/list_sparepart');	
	}

}