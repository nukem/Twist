<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * Twist Lifestyle
 * 
 * @author     Michael Cortes
 */
class Products extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		session_start(); 
		$this->load->model('base_model');
		$this->load->model('Model_model');
		$this->load->model('Shop_order_model');
		$this->load->helper('html');
	}
	
	public function payment_summary()
	{
		if($_POST)
		{
			$data = $this->input->post('data');
			$this->Shop_order_model->save($data);
			//send post request to paypal?
		}	
		$data['shoppingcart_all'] =  $this->base_model->shoppingcart_items();
		
		$data['main_content'] = 'products/payment_summary';
		$this->load->view('template', $data);		
	}
  
  
	public function billing_shipping_info()
	{
		if($_POST) /// && $this->form_validation->run('billing_shipping_edit'))
		{
			$data = $this->input->post('data');
			
			$this->Shop_order_model->save($data);
			
			redirect('products/order_review');
		}
		$data['shoppingcart_all'] =  $this->base_model->shoppingcart_items();
		$data['main_content'] = 'products/billing_shipping_info';
		$this->load->view('template', $data);
	}
	
	public function order_review()
	{
		if($_POST)
		{
			$data = $this->input->post('data');
			$this->Shop_order_model->save($data);
			//send post request to paypal?
		}	
		$data['shoppingcart_all'] =  $this->base_model->shoppingcart_items();
		
		$data['main_content'] = 'products/order_review';
		$this->load->view('template', $data);
	}
  
	public function customize()
	{
		$data = array();
		$data['title'] = '';
		$data['main_content'] = 'products/customize';
		$this->load->view('template', $data);
	}
  
	public function browse()
	{
		$data = array();
		$data['title'] = '';
		$data['main_content'] = 'products/browse';
		
		//get model list
		$models = $this->base_model->wp_item('model');
		foreach( $models as $key => $model )
		{
			$models[$key]['Images'] = $this->base_model->wp_gallery_item('image', $model['id']);
		}
		$data['models'] = $models;
		//pr($data);die();
		
		$result = $this->Model_model->find_all();

		$this->load->view('template', $data);
	}
	
	public function view($id = NULL)
	{
		$data = array();
		$data['title'] = '';
		$data['main_content'] = 'products/view';
		$result = $this->base_model->wp_item('model', array('wp_structure.title' => $id), '*', TRUE);
		$data['Model'] = $result[0];
		$this->load->view('template', $data);
	}

  public function index($product_id = NULL, $category = '', $model = '', $size = '') {
	$this->form_validation->set_rules('model', 'Model', 'trim');
	$this->form_validation->set_rules('size', 'Size', 'trim');
	$this->form_validation->set_rules('category', 'Category', 'trim');
	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	

	$customize = $this->input->post('customize');
	if($customize !== FALSE)
	{
		$_SESSION['shoppingcart'] = NULL;
		$data['model'] = $this->input->post('model');
		$data['size'] = $this->input->post('size');
		$data['category'] = $this->input->post('category');
		$data['fabric'] = '';
		$data['leather'] = '';
		
		//get the model
		if(!empty($data['model']))
		{
			$result = $this->base_model->wp_item('model', array('wp_structure.title' => $data['model']));
			$data['current_model'] = $result[0];
			$data['current_model_image'] = $this->base_model->wp_gallery_item('image', $result[0]['id']);
			$model_id = $result[0]['id'];
			
			//get the related options
			$fabrics = $this->Model_model->fabrics($model_id);
			$nails = $this->Model_model->nails($model_id);
			$leathers = $this->Model_model->leathers($model_id);
			$legs = $this->Model_model->legs($model_id);
		}

		$_SESSION['shoppingcart']['model'] = $data['model'];
		$_SESSION['shoppingcart']['size'] = $data['size'];
		$_SESSION['shoppingcart']['category'] = $data['category'];		
		
		$data['title'] = '';
		$data['main_content'] = 'products/index';
		$data['sizes'] = $this->base_model->wp_item('size',array(),'*', false);
		$data['categories'] = $this->base_model->wp_item('category',array(),'*', false);
		$data['models'] = $this->base_model->wp_item('model',array(),'*', false);
		
		$data['fabrics'] = $fabrics;
		$data['leathers'] = $leathers;
		
		$data['shoppingcart'] = isset($_SESSION['shoppingcart']) ? $_SESSION['shoppingcart']: null;
		
		//pr($data);die();
		$this->load->view('template', $data);
		
	}
	elseif ($this->form_validation->run() == FALSE)
	{
		if(!empty($_SESSION['shoppingcart']['model']))
		{
			$result = $this->base_model->wp_item('model', array('wp_structure.title' => $_SESSION['shoppingcart']['model']));
			$data['current_model'] = $result[0];
			$data['current_model_image'] = $this->base_model->wp_gallery_item('image', $result[0]['id']);
			$model_id = $result[0]['id'];
			
			//get the related options
			$fabrics = $this->Model_model->fabrics($model_id);
			$nails = $this->Model_model->nails($model_id);
			$leathers = $this->Model_model->leathers($model_id);
			$legs = $this->Model_model->legs($model_id);
			
		}
		$data['title'] = '';
		$data['main_content'] = 'products/index';
		$data['sizes'] = $this->base_model->wp_item('size',array(),'*', false);
		$data['categories'] = $this->base_model->wp_item('category',array(),'*', false);
		$data['models'] = $this->base_model->wp_item('model',array(),'*', false);
		$data['fabrics'] = $fabrics;
		$data['leathers'] = $leathers;
		$data['shoppingcart'] = isset($_SESSION['shoppingcart']) ? $_SESSION['shoppingcart']: null;
		
		$data['model'] = $data['current_model'];
		$data['size'] = $size;
		$data['category'] = $category;
		
		$data['fabric'] = isset($_SESSION['shoppingcart']['fabric'])?$_SESSION['shoppingcart']['fabric']:'';
		$data['leather'] = isset($_SESSION['shoppingcart']['leather'])?$_SESSION['shoppingcart']['leather']:'';
		
		
		$this->load->view('template', $data);	
	}
	else
	{
		$sessiondata = $_SESSION['shoppingcart'];
		$new_id_temp = (isset($sessiondata) && $sessiondata['id']) ? $sessiondata['id'] : 0;
		
		//get the base price of the model
		$selected_model = $this->base_model->wp_item('model', array('title' => set_value('model')));
		
		
		$form_data = array(
			'category' => set_value('category'),
			'model' => set_value('model'),
			'size' => set_value('size'),
			'id' => $new_id_temp, 
			'price' => $selected_model[0]['price'],
			'fabric' => $this->input->post('fabric'),
			'leather' => $this->input->post('leather'),
		);

		if ($newID = $this->base_model->cartitem_save($form_data)) {
			$form_data['id'] = $newID;		
			$_SESSION['shoppingcart'] = $form_data ;
		}
		
		redirect('/products/nail_fittings/');
	}
	
  }

  public function nail_fittings() {
	$this->form_validation->set_rules('model', 'Model', 'trim');
	$this->form_validation->set_rules('size', 'Size', 'trim');
	$this->form_validation->set_rules('category', 'Category', 'trim');
	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	
	$data['model'] = '';
	$data['size'] = '';
	$data['category'] = '';
	$data['nail'] = '';

	
	if ($this->form_validation->run() == FALSE)
	{
		if(!empty($_SESSION['shoppingcart']['model']))
		{
			$result = $this->base_model->wp_item('model', array('wp_structure.title' => $_SESSION['shoppingcart']['model']));
			$data['current_model'] = $result[0];
			$data['current_model_image'] = $this->base_model->wp_gallery_item('image', $result[0]['id']);
			$model_id = $result[0]['id'];
			
			//get the related options
			$fabrics = $this->Model_model->fabrics($model_id);
			$nails = $this->Model_model->nails($model_id);
			$leathers = $this->Model_model->leathers($model_id);
			$legs = $this->Model_model->legs($model_id);
		}		
		$data['title'] = '';
		$data['main_content'] = 'products/step2.php';
		$data['sizes'] = $this->base_model->wp_item('size',array(),'*', false);
		$data['categories'] = $this->base_model->wp_item('category',array(),'*', false);
		$data['models'] = $this->base_model->wp_item('model',array(),'*', false);
		
		$result = $this->base_model->wp_item('model', array('wp_structure.title' => $_SESSION['shoppingcart']['model']));
		$nails = $this->Model_model->nails($result[0]['id']);
		//$data['nails'] = $this->base_model->wp_item('nail',array(),'*', true);
		$data['nails'] = $nails;
		$data['nail'] = isset($_SESSION['shoppingcart']['nail'])?$_SESSION['shoppingcart']['nail']:'';	
	
		$data['shoppingcart'] = isset($_SESSION['shoppingcart']) ? $_SESSION['shoppingcart']: null;
		$this->load->view('template', $data);		
		
	} else {
		$form_data = array(
			'id' => $_SESSION['shoppingcart']['id'],
			'category' => set_value('category'),
			'model' => set_value('model'),
			'size' => set_value('size'),
			'fabric' => $_SESSION['shoppingcart']['fabric'],
			'leather' => $_SESSION['shoppingcart']['leather'],
			'nail' => $this->input->post('nail'),
		);
		$this->base_model->cartitem_save($form_data);
		// this sets variables in the session 
		$_SESSION['shoppingcart'] = $form_data ;
		
		redirect('/products/wood_fittings/');
	}
	
  }
  
  
  public function wood_fittings() {
	$this->form_validation->set_rules('model', 'Model', 'trim');
	$this->form_validation->set_rules('size', 'Size', 'trim');
	$this->form_validation->set_rules('category', 'Category', 'trim');
	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	
	$data['model'] = '';
	$data['size'] = '';
	$data['category'] = '';
	$data['leg'] = '';
	
	if ($this->form_validation->run() == FALSE)
	{	
		if(!empty($_SESSION['shoppingcart']['model']))
		{
			$result = $this->base_model->wp_item('model', array('wp_structure.title' => $_SESSION['shoppingcart']['model']));
			$data['current_model'] = $result[0];
			$data['current_model_image'] = $this->base_model->wp_gallery_item('image', $result[0]['id']);
			$model_id = $result[0]['id'];
			$data['model'] = $_SESSION['shoppingcart']['model'];
			
			//get the related options
			$fabrics = $this->Model_model->fabrics($model_id);
			$nails = $this->Model_model->nails($model_id);
			$leathers = $this->Model_model->leathers($model_id);
			$legs = $this->Model_model->legs($model_id);
		}		
		$data['title'] = '';
		$data['main_content'] = 'products/step3.php';
		$data['sizes'] = $this->base_model->wp_item('size',array(),'*', false);
		$data['categories'] = $this->base_model->wp_item('category',array(),'*', false);
		
		$result = $this->base_model->wp_item('model', array('wp_structure.title' => $_SESSION['shoppingcart']['model']));
		$nails = $this->Model_model->nails($result[0]['id']);
		$data['models'] = $this->base_model->wp_item('model',array(),'*', false);
		
		$data['legs'] = $legs;
		$data['leg'] = isset($_SESSION['shoppingcart']['leg'])?$_SESSION['shoppingcart']['leg']:'';

		$data['shoppingcart'] = isset($_SESSION['shoppingcart']) ? $_SESSION['shoppingcart']: null;		
		$this->load->view('template', $data);
	}
	else
	{
		$form_data = array(
			'id' => isset($_SESSION['shoppingcart']['id'])?$_SESSION['shoppingcart']['id']:'0',
			'category' => set_value('category'),
			'model' => set_value('model'),
			'size' => set_value('size'),
			'fabric' => isset($_SESSION['shoppingcart']['fabric'])?$_SESSION['shoppingcart']['fabric']:'',
			'leather' => isset($_SESSION['shoppingcart']['leather'])?$_SESSION['shoppingcart']['leather']:'',
			'nail' => isset($_SESSION['shoppingcart']['nail'])?$_SESSION['shoppingcart']['nail']:'',
			'leg' => $this->input->post('leg'),
		
		);
		$this->base_model->cartitem_save($form_data);
		// this sets variables in the session 
		$_SESSION['shoppingcart']=$form_data ;
		
		redirect('/products/checkout/');	}
  }
  
  
  public function checkout() {
	$this->form_validation->set_rules('model', 'Model', 'trim');
	//$_SESSION['shoppingcart'] = null;	
	
		$data['sizes'] = $this->base_model->wp_item('size',array(),'*', false);
		$data['categories'] = $this->base_model->wp_item('category',array(),'*', false);
		$data['models'] = $this->base_model->wp_item('model',array(),'*', false);
			
	if ($this->form_validation->run() == FALSE)
	{		
		if (isset($_GET["remove"]))
		{
			$vid = $_GET["remove"];
			$this->base_model->shoppingcart_remove($vid);
		}
		if (isset($_GET["edit"]))
		{
			$vid = $_GET["edit"];
			$items = $this->base_model->shoppingcart_items(array('id' => $vid ));
			foreach($items as $i) {
				$_SESSION['shoppingcart']=$i ;
			}
			
			redirect('/products/');	
		}
		
		$data['title'] = '';
		$data['main_content'] = 'products/step4.php';		
		$data['shoppingcart_all'] =  $this->base_model->shoppingcart_items();//isset($_SESSION['shoppingcart']) ? $_SESSION['shoppingcart']: null;
		$_SESSION['shopping_cart_count'] = count($data['shoppingcart_all']);

		
		//pr($data);die();
		
		$this->load->view('template', $data);
	}
	else
	{
		$data['title'] = '';
		$data['main_content'] = 'products/step4.php';		
		$data['shoppingcart_all'] =  $this->base_model->shoppingcart_items();//isset($_SESSION['shoppingcart']) ? $_SESSION['shoppingcart']: null;
		$_SESSION['shopping_cart_count'] = count($data['shoppingcart_all']);

		$this->load->view('template', $data);
		
		//redirect('/products/thankyou/');	
	}
  }
  
  
  function update_cart_item()
  {
  	if($_POST)
  	{
  		$data = $_POST;
  		unset($data['id']);
  		$this->db->update('shop_order_items', $data, array('id' => $_POST['id']));
  		echo json_encode($_POST);
  	}
  }  
  
	function model_details($title = '')
	{
		$title = $this->input->post('title');
		$conditions = array(
			'wp_structure.title' => $title
		);
		$model = $this->base_model->wp_item('model', $conditions,'*', false);
		if(empty($model))
		{
			$data['error'] = TRUE;
		} else {
			$data['error'] = FALSE;
			$data['model'] = $model[0];
		}
		echo json_encode($data);
	}
}