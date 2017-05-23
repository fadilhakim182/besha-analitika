<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class sparepart extends CI_Controller {


	public function __construct(){

      parent::__construct();
      $this->load->helper("url");
      $this->load->library(array('session', 'form_validation', 'email'));
      $this->load->model('model_sparepart');
      $this->load->model('model_manufacturer');
      $this->load->library('pagination');
      $this->agent->referrer();
  	}


	public function index()

	{

		 if(!$this->session->userdata('contact_person')){ redirect(base_url("login/login_costumer")); };
		$data['manufacturer'] = $this->get_manufacturer();
		$this->load->view('templates/meta_sparepart');
		$this->load->view('templates/header_sparepart');
		$this->load->view('home_sparepart',$data);
		$this->load->view('templates/footer_sparepart');

	}


	public function list_view_manufacturer($id) {

		 if(!$this->session->userdata('contact_person')){ redirect(base_url("login/login_costumer")); };
		  if(!$this->session->userdata('contact_person')){ redirect(base_url("login/login_costumer")); };
		$id=$this->uri->segment(3);
		$config = array();

        $config["base_url"] = base_url() . "/spareparts/manufacturer/".$id;
        $config["total_rows"] = $this->model_sparepart->count_product_by_id($id);
        $this->model_sparepart->count_product_by_id($id) ;

		// Use pagination number for anchor URL.

		$config['use_page_numbers'] = TRUE;
		//Set that how many number of pages you want to view.

		$config['num_links'] =  $this->model_sparepart->count_product_by_id($id);

		// Open tag for CURRENT link.
		$config['cur_tag_open'] = '<li class="active"><span>';

		// Close tag for CURRENT link.
		$config['cur_tag_close'] = '</span></li>';

		/*$config['next_tag_open'] = '<li><span>';
		$config['next_tag_close'] = '</span></li>';*/

		// By clicking on performing NEXT pagination.
		$config['next_link'] = '<li><span>Next';
		// By clicking on performing PREVIOUS pagination.
		$config['prev_link'] = '<li><span>Prev';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

       $limit = $config["per_page"] = 50;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["spareparts"] = $this->model_sparepart->fetch_product_by_id($id ,$limit, $page);
        $data["links"] = $this->pagination->create_links();
		$data['manufacturer'] = $this->get_manufacturer();
		/*$data['spareparts'] = $this->model_sparepart->list_sparepart();*/


		$this->load->view('templates/meta_sparepart');
		$this->load->view('templates/header_sparepart');
		$this->load->view('sparepart/sparepart_list_view_by_manufacturer',$data);
		$this->load->view('templates/footer_sparepart');
	}



	public function list_grid_manufacturer($id) {

		if(!$this->session->userdata('contact_person')){ redirect(base_url("login/login_costumer")); };
		$id=$this->uri->segment(3);
		$config = array();
        $config["base_url"] = base_url() . "/sparepart/manufacturer/".$id;
        $config["total_rows"] = $this->model_sparepart->count_product_by_id($id);
        $this->model_sparepart->count_product_by_id($id) ;
		// Use pagination number for anchor URL.
		$config['use_page_numbers'] = TRUE;
		//Set that how many number of pages you want to view.
		$config['num_links'] =  $this->model_sparepart->count_product_by_id($id);
		// Open tag for CURRENT link.
		$config['cur_tag_open'] = '<li class="active"><span>';
		// Close tag for CURRENT link.
		$config['cur_tag_close'] = '</span></li>';
		/*$config['next_tag_open'] = '<li><span>';
		$config['next_tag_close'] = '</span></li>';*/
		// By clicking on performing NEXT pagination.
		$config['next_link'] = '<li><span>Next';
		// By clicking on performing PREVIOUS pagination.
		$config['prev_link'] = '<li><span>Prev';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
       $limit = $config["per_page"] = 50;
        $config["uri_segment"] = 4;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["spareparts"] = $this->model_sparepart->fetch_product_by_id($id ,$limit, $page);
        $data["links"] = $this->pagination->create_links();
		$data['manufacturer'] = $this->get_manufacturer();
		/*$data['spareparts'] = $this->model_sparepart->list_sparepart();*/

		$this->load->view('templates/meta_sparepart');
		$this->load->view('templates/header_sparepart');
		$this->load->view('sparepart/sparepart_list_grid_by_manufacturer',$data);
		$this->load->view('templates/footer_sparepart');

	}


	public function list_view() {


		if(!$this->session->userdata('contact_person')){ redirect(base_url("login/login_costumer")); };
		$config = array();
		if($this->uri->segment(2) == 'category') {
			$manu_id = $this->uri->segment(3);
			$slug = $this->uri->segment(4);
			$data["spareparts"] = $this->model_sparepart->count_product_category_id($slug,$manu_id);
		}else {
			$config["base_url"] = base_url() . "/spareparts/all";
			$config["total_rows"] = $this->model_sparepart->count_product();
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] =  $this->model_sparepart->count_product();
			$config["uri_segment"] = 3;
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$config['cur_tag_open'] = '<li class="active"><span>';
			// Close tag for CURRENT link.
			$config['cur_tag_close'] = '</span></li>';

			/*$config['next_tag_open'] = '<li><span>';
			$config['next_tag_close'] = '</span></li>';*/
			// By clicking on performing NEXT pagination.
			$config['next_link'] = '<li><span>Next';
			// By clicking on performing PREVIOUS pagination.
			$config['prev_link'] = '<li><span>Prev';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
	        $limit = $config["per_page"] = 50;

	        $this->pagination->initialize($config);
	        $data["spareparts"] = $this->model_sparepart->fetch_product($limit, $page);
	        $data["links"] = $this->pagination->create_links();	
		}

		$data['manufacturer'] = $this->get_manufacturer(); 
		$this->load->view('templates/meta_sparepart');
		$this->load->view('templates/header_sparepart');
		$this->load->view('sparepart/sparepart_list_view',$data);
		$this->load->view('templates/footer_sparepart');

	}

	public function grid_view() {
		if(!$this->session->userdata('contact_person')){ redirect(base_url("login/login_costumer")); };
		$config = array();

		if($this->uri->segment(2) == 'category') {
			$manu_id = $this->uri->segment(3);
			$slug = $this->uri->segment(4);
			$data["spareparts"] = $this->model_sparepart->count_product_category_id($slug,$manu_id);
		} else {


        $config["base_url"] = base_url() . "/sparepart/all";        
        $config["total_rows"] = $this->model_sparepart->count_product();
		// Use pagination number for anchor URL.
		$config['use_page_numbers'] = TRUE;
		//Set that how many number of pages you want to view.
		$config['num_links'] =  $this->model_sparepart->count_product();
		// Open tag for CURRENT link.
		$config['cur_tag_open'] = '<li class="active"><span>';

		// Close tag for CURRENT link.
		$config['cur_tag_close'] = '</span></li>';
		/*$config['next_tag_open'] = '<li><span>';
		$config['next_tag_close'] = '</span></li>';*/
		// By clicking on performing NEXT pagination.
		$config['next_link'] = '<li><span>Next';

		// By clicking on performing PREVIOUS pagination.
		$config['prev_link'] = '<li><span>Prev';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
        $limit = $config["per_page"] = 50;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["spareparts"] = $this->model_sparepart->fetch_product($limit, $page);
        $data["links"] = $this->pagination->create_links();

    	}







		$data['manufacturer'] = $this->get_manufacturer();



		$this->load->view('templates/meta_sparepart');



		$this->load->view('templates/header_sparepart');



		$this->load->view('sparepart/sparepart_grid_view',$data);



		$this->load->view('templates/footer_sparepart');



	}

	public function detail($id,$slug) {

		 if(!$this->session->userdata('contact_person')){ redirect(base_url("login/login_costumer")); };

		$this->load->helper("check_data_helper");
     	$section = $this->uri->segment(2);
	    $data =  array('page_section' => $section);
		$slug=$this->uri->segment(3);
		$id=$this->uri->segment(4);
		$data['sparepart'] = $this->model_sparepart->getproductfromIdandSlug($id,$slug);
		$data['manufacturer'] = $this->get_manufacturer();
		$this->load->view('templates/meta_sparepart');
		$this->load->view('templates/header_sparepart');
		$this->load->view('sparepart/v_detail_product.php',$data);
		$this->load->view('templates/footer_sparepart');

	}

	public function signup(){

		$section = $this->uri->segment(2);
		$data =  array('page_section' => $section);
		$this->load->view('templates/meta_sparepart');
		$this->load->view('templates/header_sparepart');
		$this->load->view('sparepart/v_signup', $data);
		$this->load->view('templates/footer_sparepart');

	}

	public function signup_post()
	{

		//print_r($_POST); exit;
		//set validation rules for login data
		$this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email|is_unique[user_tbl.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]|md5');

		//validate form input
		if ($this->form_validation->run() == FALSE)
        {
			// fails
			$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Signup Error Please Try Again</div>');
			$this->load->view('templates/meta_sparepart');
			$this->load->view('templates/header_sparepart');
			$this->load->view('sparepart/v_signup');
			$this->load->view('templates/footer_sparepart');

        }
		else

		{

			/*

				Array

				(

					[contact_person] => Aries Dimas Yudhistira

					[email] => alhusna901@gmail.com

					[password] => 999999

					[cpassword] => 999999

					[company_name] => 

					[no_tlp] => 32423432323

					[no_fax] => 

					[no_hp] => 3324234

					[npwp_no] => 34234234

					[npwp_address] => 32dfsdfdsfsdfsdfsdf

					[billing_address] => dsfdsfsdfsdfsdf

					[shipping_address] => sdfsdfdsfsdf

				)

			*/

			$contact_person = $this->input->post("contact_person");
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$company_name = $this->input->post('company_name');
			$no_tlp = $this->input->post('no_tlp');	
			$no_fax = $this->input->post('no_fax');
			$no_hp = $this->input->post('no_hp');
			$npwp_no = $this->input->post('npwp_no');
			$npwp_address = $this->input->post('npwp_address');
			$shipping_address = $this->input->post('shipping_address');
			$billing_address = $this->input->post('billing_address');

			//insert the user registration details into database

			$data = array( 
				'contact_person' => $contact_person,
				'email' => $email,
				'password' => $password,
				'company_name' => $company_name,
				'no_tlp' => $no_tlp,
				'no_fax' => $no_fax,
				'no_hp' => $no_hp,
				'npwp_no' => $npwp_no,
				'npwp_address' => $npwp_address,
				'shipping_address' => $shipping_address,
				'billing_address' => $billing_address,
				'act_status' => 0
			);

			// insert form data into database
			if ($this->model_sparepart->insertUser($data))
			{

				// send email

				if ($this->model_sparepart->sendEmail($email,$contact_person,$company_name,$no_tlp,$no_hp))
				{

					// successfully sent mail
					$this->session->set_flashdata('msg','You are Successfully Registered!');
					redirect('registration/success');

				}
				else
				{
					// error

					$this->session->set_flashdata('msg','Oops! Error.  Please try again!');
					redirect('sparepart/signup');


				}
			}
			else
			{
				// error
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
				redirect('login/register');

			}

		}

	}


	function verify() {

		$key = $this->uri->segment(2); 
		if ($this->model_sparepart->verifyEmailID($key))

		{

			$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center">Your Email Address is successfully verified! Please login to access your account!</div>');

			redirect('sparepart');

		}
		else

		{

			$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center">Sorry! There is error verifying your Email Address!</div>');

			redirect('home');
		}
	}



	function verify_login() {
		$this->load->view('templates/meta_sparepart');
		$this->load->view('sparepart/v_verify_login');

	}

	function login_action_verify(){



		$email = $this->input->post('email');

		$password = md5($this->input->post('password'));

		$current_url = $this->input->post("redirect_success");

		

		if(empty($current_url))

		{

			$current_url = $this->agent->referrer();

		}

		$this->load->model('login_model_sparepart');
		$cek = $this->login_model_sparepart->cek_login($email, $password);
		if($cek->num_rows()==1){

			foreach ($cek->result() as $data) { }
				if($data->act_status == '0') {
					$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						Cannot login, your account not yet confirmed by administrator.
					</div>');
					redirect(base_url("verify/failed"));
				}

				else {



					$sess_data['user_id'] = $data->user_id;

					$sess_data["name"]	  = $data->contact_person;

					$sess_data['email']   = $data->email;



					$sess_data['discount_price'] = $data->discount_price;



					$this->session->set_userdata($sess_data);



					redirect('sparepart');



				}



		}else{

			$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissable">



                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>



                                                Maaf username/password yang anda masukan salah.



                                            </div>');



			redirect(base_url("verify/failed"));



		}



	}



	function login_action(){



		$email = $this->input->post('email');

		$password = md5($this->input->post('password'));

		$current_url = $this->input->post("redirect_success");

		

		if(empty($current_url))

		{

			$current_url = $this->agent->referrer();

		}



		$this->load->model('login_model_sparepart');



		$cek = $this->login_model_sparepart->cek_login($email, $password);



		if($cek->num_rows()==1){



			foreach ($cek->result() as $data) { }



				if($data->act_status == '0') {



					$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissable">



						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

  

						Silahkan Konfirmas email anda terlebih Dahulu.

  

					</div>');



					redirect(base_url("login"));



				}



				else {



					$sess_data['user_id'] = $data->user_id;

					$sess_data["name"]	  = $data->contact_person;

					$sess_data['email']   = $data->email;

					$sess_data['discount_price'] = $data->discount_price;

					$this->session->set_userdata($sess_data);



					redirect($this->agent->referrer());



				}



		}else{


			$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissable">



                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>



                                                Maaf username/password yang anda masukan salah.



                                            </div>');



			redirect(base_url("login"));

		}



	}



	function login_action_2(){

		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		$this->load->model('login_model_sparepart');
		$cek = $this->login_model_sparepart->cek_login($email, $password);
		if($cek->num_rows()==1){
			foreach ($cek->result() as $data) { }

				if($data->act_status == '0') {

					$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissable">



                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>



                                                Silahkan Konfirmas email anda terlebih Dahulu.



                                            </div>');



					redirect(base_url("login"));



				}
				else {

					$sess_data['user_id'] = $data->user_id;

					$sess_data['email'] = $data->email;

					$sess_data['discount_price'] = $data->discount_price;
					$this->session->set_userdata($sess_data);
					redirect(base_url('sparepart'));

				}

		}else{



			$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissable">



                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>



                                                Maaf username/password yang anda masukan salah.



                                            </div>');



			redirect(base_url("login"));
		}
	}

	function logout(){

		//$arr_sess = $this->session->all_userdata();

		//print_r($arr_sess); exit;

		// $this->session->sess_destroy();

		$array_items = array(

			"user_id",

			"email"

		);
		$this->session->unset_userdata($array_items);
		redirect(base_url('sparepart'));

	}

	public function contact(){

		 if(!$this->session->userdata('contact_person')){ redirect(base_url("login/login_costumer")); };
		$this->load->view('templates/meta_sparepart');
		$this->load->view('templates/header_sparepart');
		$this->load->view('contact_sparepart');
		$this->load->view('templates/footer_sparepart');

	}

	public function jasa()
	{

		 if(!$this->session->userdata('contact_person')){ redirect(base_url("login/login_costumer")); };

		$data['manufacturer'] = $this->get_manufacturer();
		// $data['kota'] = $this->model_sparepart->list_kota();
		$this->load->view('templates/meta_sparepart');
		$this->load->view('templates/header_sparepart');
		$this->load->view('sparepart/v_jasa',$data);
		$this->load->view('templates/footer_sparepart');
	}


	public function contact_post()
	{
		$this->load->library("form_validation");

		$email 		= $this->input->post('email',true);
		$nama 		= $this->input->post('name',true);
		$hp		 = $this->input->post('hp',true);
		$subject 	= $this->input->post('subject',true);	
		$message 	= $this->input->post('message',true);


		$this->form_validation->set_rules("email","Email","valid_email|required");
		$this->form_validation->set_rules("name","Name","required");
		$this->form_validation->set_rules("subject","Subject","required");
		$this->form_validation->set_rules("message","Message","required");
		$this->load->model('model_user');
		if ($this->form_validation->run() == TRUE)
		{

			// successfully sent mail
			$this->load->library('email');
			
			$config['protocol']  = 'smtp';
			$config['mailtype']  = 'html';
			$config['priority']  = '1';
			$config['wordwrap']  = FALSE;
			$config['smtp_host'] = 'ssl://besha-analitika.co.id';
			$config['smtp_port'] = 465;
			$config['smtp_user'] = 'service@besha-analitika.co.id';
			$config['smtp_pass'] = 'r482722xuwm8';
			
			$this->email->initialize($config);
	
			$this->email->from($email,$nama);
			$this->email->to($config['smtp_user']);
			$this->email->subject($subject);
			$this->email->message($message);
			$a = $this->email->send();
			
			var_dump($a);
			
			$this->session->set_flashdata('msg','<p style="color:green;"> We will contact you soon, Thank you</p>');

			//echo $this->email->print_debugger();
		
			redirect('sparepart/contact');

		}
		else
		{
			// error
			$err = validation_errors();
			$this->session->set_flashdata('msg',"<p style='color:red;'> $err </p>");
			redirect('sparepart/contact');
		}

	}

	public function get_manufacturer() {

		 if(!$this->session->userdata('contact_person')){ redirect(base_url("login/login_costumer")); };
		 $query = $this->db->get('manufacturer_tbl');
		    $return = array();

		    foreach ($query->result() as $manufacturer)
		    {
		        $return[$manufacturer->manu_id] = $manufacturer;
		        $return[$manufacturer->manu_id]->subs = $this->get_sparepart_categories($manufacturer->manu_id); // Get the categories sub categories
		    }

		    return $return;
	}

	public function get_sparepart_categories($manufacturer_id)
	{
		 if(!$this->session->userdata('contact_person')){ redirect(base_url("login/login_costumer")); };

	    $this->db->where('category_id', $manufacturer_id);
	    $query = $this->db->get('detail_sparepart_category_tbl');
	    return $query->result();
	}

	public function search(){

		 if(!$this->session->userdata('contact_person')){ redirect(base_url("login/login_costumer")); };

		$this->load->view('templates/meta_sparepart');
		$this->load->view('templates/header_sparepart');
		$data['manufacturer'] = $this->get_manufacturer();
		$keyword = $this->uri->segment(3); 

		if(empty($keyword)) {

            $keyword    =   $this->input->post('keyword');
        }

        else {

            $keyword=$this->uri->segment(3);

        }

        $data['results']    =   $this->model_sparepart->searchProduct($keyword);
        $this->load->view('sparepart/v_list_sparepart_search_result',$data);
        $this->load->view('templates/footer_sparepart');

	}


	public function search_grid(){

		 if(!$this->session->userdata('contact_person')){ redirect(base_url("login/login_costumer")); };
		$this->load->view('templates/meta_sparepart');
		$this->load->view('templates/header_sparepart');

		$data['manufacturer'] = $this->get_manufacturer();
		$keyword = $this->uri->segment(3);
        if(empty($keyword)) {
            $keyword    =   $this->input->post('keyword');
        }
        else {
            $keyword=$this->uri->segment(3);
        }

        $data['results']    =   $this->model_sparepart->searchProduct($keyword);
        $this->load->view('sparepart/v_grid_sparepart_search_result',$data);
        $this->load->view('templates/footer_sparepart');

	}



	function user_registration_sucess(){

		$this->load->view('templates/meta_sparepart');
		$this->load->view('templates/header_sparepart');
        $this->load->view('sparepart/v_success');
        $this->load->view('templates/footer_sparepart');

	}

	function thankyou_for_confirm(){

		$this->load->view('templates/meta_sparepart');
		$this->load->view('templates/header_sparepart');
        $this->load->view('sparepart/v_success_confirm');
        $this->load->view('templates/footer_sparepart');

	}



	function user_registration_after_confirm(){

		$this->load->view('templates/meta_sparepart');
		$this->load->view('templates/header_sparepart');
        $this->load->view('sparepart/v_login_user');
        $this->load->view('templates/footer_sparepart');

	}
	
	function invoice_success_page()
	{
		$this->load->view("sparepart/success_invoice_mail");	
		
	}
	




}