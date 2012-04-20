<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * Twist Lifestyle
 * 
 * @author     Michael Cortes
 */
class Products extends MY_Controller {

	function __construct() {
	    parent::__construct();
	    session_start(); 
		$this->load->model('base_model');
	}
  
	function index()
	{
		
	}  

	public function cover_fabric() 
	{
		$this->form_validation->set_rules('model', 'Model', 'trim');
		$this->form_validation->set_rules('size', 'Size', 'trim');
		$this->form_validation->set_rules('category', 'Category', 'trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	
	if ($this->form_validation->run() == FALSE)
	{
		$data['title'] = '';
		$data['main_content'] = 'products/cover_fabric';
		$data['sizes'] = $this->base_model->wp_item('size',array(),'*', false);
		$data['categories'] = $this->base_model->wp_item('category',array(),'*', false);
		$data['models'] = $this->base_model->wp_item('model',array(),'*', false);
		$data['fabrics'] = $this->base_model->wp_item('fabric',array(),'*', true);
		$data['leathers'] = $this->base_model->wp_item('leather',array(),'*', true);
		$data['shoppingcart'] = isset($_SESSION['shoppingcart']) ? $_SESSION['shoppingcart']: null;
		
		$this->load->view('template', $data);	
	}
	else
	{
		$sessiondata = $_SESSION['shoppingcart'];
		//if (!isset($sessiondata))
		//	$_SESSION['current_item'] = 0;
		//else
		//	$_SESSION['current_item'] = $_SESSION['current_item'] + 1;
		$new_id_temp = (isset($sessiondata) && $sessiondata['id']) ? $sessiondata['id'] : 0;
		
		$form_data = array(
          'category' => set_value('category'),
          'model' => set_value('model'),
		  'size' => set_value('size'),
		  'id' => $new_id_temp, 
		  'price' => 100,
		);
		
		if ($newID = $this->base_model->cartitem_save($form_data)) {
			$form_data['id'] = $newID;		
			$_SESSION['shoppingcart']=$form_data ;
		}
		
		redirect('/products/nail_fittings/');
	}
	
  }

  public function nail_fittings() {
	$this->form_validation->set_rules('model', 'Model', 'trim');
	$this->form_validation->set_rules('size', 'Size', 'trim');
	$this->form_validation->set_rules('category', 'Category', 'trim');
	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	
	if ($this->form_validation->run() == FALSE)
	{
		$data['title'] = '';
		$data['main_content'] = 'products/step2.php';
		$data['sizes'] = $this->base_model->wp_item('size',array(),'*', false);
		$data['categories'] = $this->base_model->wp_item('category',array(),'*', false);
		$data['models'] = $this->base_model->wp_item('model',array(),'*', false);
		$data['nails'] = $this->base_model->wp_item('nail',array(),'*', true);
		$data['shoppingcart'] = isset($_SESSION['shoppingcart']) ? $_SESSION['shoppingcart']: null;
		$this->load->view('template', $data);		
		
	}
	else
	{
    //$sessiondata = $_SESSION['shoppingcart'];
		//if (!isset($sessiondata))
		//	$_SESSION['current_item'] = 0;
		//else
		//	$_SESSION['current_item'] = $_SESSION['current_item'] + 1;
		$form_data = array(
          'category' => set_value('category'),
          'model' => set_value('model'),
		  'size' => set_value('size'),
		);
	
		// this sets variables in the session 
		$_SESSION['shoppingcart']=$form_data ;
		
		redirect('/products/wood_fittings/');
	}
	
  }
  
  
  public function wood_fittings() {
	$this->form_validation->set_rules('model', 'Model', 'trim');
	$this->form_validation->set_rules('size', 'Size', 'trim');
	$this->form_validation->set_rules('category', 'Category', 'trim');
	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	
	if ($this->form_validation->run() == FALSE)
	{	
		$data['title'] = '';
		$data['main_content'] = 'products/step3.php';
		$data['sizes'] = $this->base_model->wp_item('size',array(),'*', false);
		$data['categories'] = $this->base_model->wp_item('category',array(),'*', false);
		$data['models'] = $this->base_model->wp_item('model',array(),'*', false);
		$data['legs'] = $this->base_model->wp_item('legs',array(),'*', true);
		$data['shoppingcart'] = isset($_SESSION['shoppingcart']) ? $_SESSION['shoppingcart']: null;		
		$this->load->view('template', $data);
	}
	else
	{
		//$sessiondata = $_SESSION['shoppingcart'];
		//if (!isset($sessiondata))
		//	$_SESSION['current_item'] = 0;
		//else
		//	$_SESSION['current_item'] = $_SESSION['current_item'] + 1;
		$form_data = array(
          'category' => set_value('category'),
          'model' => set_value('model'),
		  'size' => set_value('size'),
		);
	
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