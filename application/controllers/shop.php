<?php

class Shop extends Controller {

	public function __construct() {
		parent::controller();
		$functionality = $this->config->item('functionality');
		if($functionality['shop'] === false) {
			show_404();
		}
	}

	public function index() {
		$data['ajax_overlay'] = false;
		if(isset($_POST['ajax']) && $_POST['ajax']) {
			$data['ajax_overlay'] = true;
		}
		
		$categories = $this->base_model->wp_item(
			'folder',
			array('parent' => SHOPID),
			'id, title, uri, parent'
		);

		$data['categories'] = array();
		$i = 0;
		foreach($categories as $c) {
			$data['categories'][$i]['title'] = $c['title'];
			$data['categories'][$i]['id'] = $c['id'];

			$product = $this->base_model->wp_item(
				'product',
				array('parent' => $c['id']),
				'id'
			);

			$data['categories'][$i]['image_id'] = '';
			if(is_array($product) && count($product) > 0){
				$product = array_shift($product);
				$image = $this->base_model->wp_gallery_item(
					'image',
					$product['id']
				);

				if(is_array($image) && count($image) > 0){
					$image = array_shift($image);
					$data['categories'][$i]['image_id'] = $image['id'];
				}
			}
			$i++;
		}

		$this->load->view('shop_home_view', $data);
		
	}

	public function products($parent) {

		$data['ajax_overlay'] = false;
		if(isset($_POST['ajax']) && $_POST['ajax']) {
			$data['ajax_overlay'] = true;
		}

		$data['category'] = $this->base_model->wp_item(
			'folder',
			array('id' => $parent)
		);

		$data['category'] = array_shift($data['category']);

		$data['products'] = $this->base_model->wp_item(
			'product',
			array('parent' => $parent),
			'*',
			true
		);

		$data['product_categories'] = $this->base_model->wp_item(

			'folder',
			array('parent' => '12')

		);

		$this->load->view('products_view', $data);
	}

	public function product($id) {

		$data['ajax_overlay'] = false;
		if(isset($_POST['ajax']) && $_POST['ajax']) {
			$data['ajax_overlay'] = true;
		}
		
		$data['product'] = $this->base_model->wp_item(
			'product',
			array('id' => $id),
			'*',
			true
		);

		$data['product'] = array_shift($data['product']);


		$data['category'] = $this->base_model->wp_item(
			'folder',
			array('id' => $data['product']['parent'])
		);

		$pagination = $this->base_model->wp_item(
			'product',
			array('parent' => $data['product']['parent'])
		);

		$data['pagination'] = array();
		$i = 1;
		foreach($pagination as $p) {
			$data['pagination'][$i] = $p['id'];
			$i++;
		}

		$data['category'] = array_shift($data['category']);
		$this->load->view('product_view', $data);
	}

	public function search() {
		
	}
	
	public function needassistance() {
		
		$data['ajax_overlay'] = false;
		if(isset($_POST['ajax']) && $_POST['ajax']) {
			$data['ajax_overlay'] = true;
		}
		
		$cart = $this->cart->contents();

		$count = $this->cart->total_items();
		foreach($cart as $i => $c) {

			$image = $this->base_model->wp_gallery_item(
				'image',
				$cart[$i]['id']
			);
			$cart[$i]['image'] = array_shift($image);
		}

        foreach($cart as &$c)
        {
            $c['postage'] = $this->base_model->get_postage($c['id'], $c['qty']);
        }

		$data['count'] = $count;
		$data['cart'] = $cart;
		
		$this->load->view('need_assistance', $data);
		
	}
	
	public function needassistance_process() {
		$data['ajax_overlay'] = false;
		if(isset($_POST['ajax']) && $_POST['ajax']) {
			$data['ajax_overlay'] = true;
		}		

		$this->load->library('form_validation');

		$outcome['message'] = '';
        $ajax_error = false;
		if(isset($_POST) && count($_POST) > 0) {
		
			$this->form_validation->set_rules('frm_firstname', 'First Name', 'required');			
			$this->form_validation->set_rules('frm_lastname', 'Last Name', 'required');
			$this->form_validation->set_rules('frm_company', 'Company', 'required');
			$this->form_validation->set_rules('frm_directphone', 'Direct Phone', 'required');
			$this->form_validation->set_rules('frm_email', 'Email', 'required|valid_email');
			
			if ($this->form_validation->run() == FALSE) {
				$outcome['message'] = str_replace("\n", "", validation_errors());
                $ajax_error = true;
				//$this->email_link();
			} else {
			
				$cart = $this->cart->contents();

				$count = $this->cart->total_items();
				foreach($cart as $i => $c) {

					$image = $this->base_model->wp_gallery_item(
						'image',
						$cart[$i]['id']
					);
					$cart[$i]['image'] = array_shift($image);
				}

				foreach($cart as &$c)
				{
					$c['postage'] = $this->base_model->get_postage($c['id'], $c['qty']);
				}

				$data['count'] = $count;
				$data['cart'] = $cart;	
				
				if ($_POST['frm_position'] == "Position")
				{
					$varPostion = "";
				}else
				{
					$varPostion = $_POST['frm_position'];
				}
				
				if ($_POST['frm_address1'] == "Address")
				{
					$varAddress1 = "";
				}else
				{
					$varAddress1 = $_POST['frm_address1'];
				}
				
				if ($_POST['frm_address2'] == "Address")
				{
					$varAddress2 = "";
				}else
				{
					$varAddress2 = $_POST['frm_address2'];
				}
				
				if ($_POST['frm_suberb'] == "Suberb")
				{
					$varSuberb = "";
				}
				else
				{
					$varSuberb = $_POST['frm_suberb'];
				}
				
				if ($_POST['frm_postcode'] == "Postcode")
				{
					$varPostcode = "";
				}
				else
				{
					$varPostcode = $_POST['frm_postcode'];
				}
				
				if ($_POST['frm_country'] == "Country")
				{
					$varCountry = "";
				}
				else
				{
					$varCountry = $_POST['frm_country'];
				}
				
				if ($_POST['frm_workphone'] == "Work Phone")
				{
					$varWorkphone = "";
				}
				else
				{
					$varWorkphone = $_POST['frm_workphone'];
				}
				
				if ($_POST['frm_mobile'] == "Mobile")
				{
					$varMobile = "";
				}
				else
				{
					$varMobile = $_POST['frm_mobile'];
				}
				
				if ($_POST['frm_fax'] == "Fax")
				{
					$varFax = "";
				}
				else
				{
					$varFax = $_POST['frm_fax'];
				}
				
				if ($_POST['frm_workemail'] == "Work email")
				{
					$varWorkemail = "";
				}
				else
				{
					$varWorkemail = $_POST['frm_workemail'];
				}			
			
				$email_message = "  
								  
					<table width=\"90%\"  align=\"center\"  cellpadding=\"1\"  cellspacing=\"2\">
					  <tr>
						<td colspan=\"2\" align=\"center\">CONTACT VIA NEED ASSISTANCE WEBSITE FORM</td>
					  </tr>
					  <tr>
						<td width=\"25%\">First Name</td>
						<td width=\"75%\">".addslashes($_POST['frm_firstname'])."</td>
					  </tr>
					  <tr>
						<td>Last Name</td>
						<td>".addslashes($_POST['frm_lastname'])."</td>
					  </tr>
					  <tr>
						<td>Position</td>
						<td>".addslashes($varPostion)."</td>
					  </tr>
					  <tr>
						<td>Company</td>
						<td>".addslashes($_POST['frm_company'])."</td>
					  </tr>
					  <tr>
						<td>Address</td>
			<td>".addslashes($varAddress1)." ".addslashes($varAddress2)."</td>
					  </tr>
					  <tr>
						<td>Suberb</td>
						<td>".addslashes($varSuberb)."</td>
					  </tr>
					  <tr>
						<td>State</td>
						<td>".addslashes($_POST['frm_state'])."</td>
					  </tr>
					  <tr>
						<td>Postcode</td>
						<td>".addslashes($varPostcode)."</td>
					  </tr>
					  <tr>
						<td>Country</td>
						<td>".addslashes($varCountry)."</td>
					  </tr>
					  <tr>
						<td>Direct Phone</td>
						<td>".addslashes($_POST['frm_directphone'])."</td>
					  </tr>
					  <tr>
						<td>Work Phone</td>
						<td>".addslashes($varWorkphone)."</td>
					  </tr>
					  <tr>
						<td>Mobile</td>
						<td>".addslashes($varMobile)."</td>
					  </tr>
					  <tr>
						<td>Fax</td>
						<td>".addslashes($varFax)."</td>
					  </tr>
					  <tr>
						<td>Email</td>
						<td>".addslashes($_POST['frm_email'])."</td>
					  </tr>
					  <tr>
						<td>Work email</td>
						<td>".addslashes($varWorkemail)."</td>
					  </tr>
					  </table>
					  ";
					  
				$email_message .= 
		"<table width=\"70%\"  align=\"center\" border=\"1\" cellpadding=\"1\"  cellspacing=\"2\">
					    <tr>
							<td colspan=\"4\" align=\"center\">CART CONTENTS</td>
					    </tr>
						<tr>
							<td>Item</td>
							<td>Quantity</td>
							<td>Item Price</td>
							<td>Item Total</td>
						</tr>";
						
						foreach($cart as $item) {
						
						$total = $item['qty'] * $item['price'];
						
						$email_message .= 
						"<tr>
							<td>".$item['name']."</td>
							<td>".$item['qty']."</td>
							<td>".$item['price']."</td>
							<td>".$total."</td>
						</tr>";
						
						}
					$email_message .= "</table> ";	
						
				$email_message .= "</table> ";					        
				
				//$to = 'max@visiontechdigital.com,sales@realtools.com.au, visiontech@me.com,max.emb@gmail.com';
				$to = 'support@realtools.com.au,george@visiontechdigital.com,
			          max@visiontechdigital.com,sales@realtools.com.au';
				
				$from = 'support@realtools.com.au';
				$message = $this->email_message($to,$from,SITETITLE . ' - Contact via "Need Assistance" Link',$email_message,true);
															
				if($message == false) {
					$outcome['message'] = '<p>Unable to send your message. Please wait a minute and submit this form again.</p>';
				} else {
					$outcome['message'] = '<h2>Thank you!</h2><p>Your enquiry has been sent. We will be in contact with you shortly.</p>';
				}

			}

		}
		if(isset($_POST['ajax']) || $ajax_error) {
			echo json_encode($outcome);
		} else { 
			$this->load->view('content_view', $data);
		}
		
	}
	
	private function email_message($to, $from, $subject, $message, $html_message = false) {
		$this->load->library('email');
		$this->load->helper(array('url', 'cookie'));

		$cookie = get_cookie('email', TRUE);
		if($cookie == 1) {
			return false;
			//exit('Spam protection. Please wait more than 30 seconds before submitting forms.');
		}

		$config['mailtype'] = 'text';
		if(isset($html_message) && $html_message === true) {
			$config['mailtype'] = 'html';
		}

		$this->email->initialize($config);

		$this->email->from($from);
		$this->email->to($to); 

		$this->email->subject($subject);
		if(isset($html_message) && !empty($html_message)) {
						
			$this->email->message($message);
			$this->email->set_alt_message($message);
		} else {
			$this->email->message($message);
		}

		if($this->email->send()) {

			$domain = str_replace(
				array('http://www', 'http://', '/'),
				array('', '', ''),
				$this->config->item('base_url')
			);

			$cookie_data = array(
				'name'   => 'email',
				'value'  => true,
				'expire' => 30
			);
			set_cookie($cookie_data);
			return true;
		} else {
			return false;
		}

	}

	public function view_cart() {
		$data['ajax_overlay'] = false;
		if(isset($_POST['ajax']) && $_POST['ajax']) {
			$data['ajax_overlay'] = true;
		}

		$cart = $this->cart->contents();

		$count = $this->cart->total_items();
		foreach($cart as $i => $c) {

			$image = $this->base_model->wp_gallery_item(
				'image',
				$cart[$i]['id']
			);
			$cart[$i]['image'] = array_shift($image);
		}

        foreach($cart as &$c)
        {
            $c['postage'] = $this->base_model->get_postage($c['id'], $c['qty']);
        }

		$data['count'] = $count;
		$data['cart'] = $cart; 

		$this->load->view('shop_cart_view', $data);		
	}

	public function add_item_prompt($id) {
		$product = $this->base_model->wp_item(
			'product',
			array('id' => $id),
			'*',
			true
		);
		$data['product'] = array_shift($product);

		$this->load->view('shop_item_add_view', $data);
		
	}

	public function add_to_cart() {

		$product = $this->base_model->wp_item(
			'product',
			array('id' => $_POST['product_id'])
		);

		$product = array_shift($product);

		$colour = '';
		if(isset($_POST['colour'])) {
			$colour = $_POST['colour'];
		}
		$size = '';
		if(isset($_POST['size'])) {
			$size = $_POST['size'];
		}

		$data = array(
			'id'      => $_POST['product_id'],
			'qty'     => $_POST['quantity'],
			'price'   => $product['price'],
			'name'    => $product['title'],
			'options' => array('Size' => $size, 'Colour' => $colour)
		);

		$this->cart->insert($data);

		// go back to the product page
		$this->product($_POST['product_id']);
	}

	public function update_cart() {

		if(isset($_POST) && count($_POST) > 0) {
			$i = 0;
			foreach($_POST as $id => $qty) {
				$data[$i]['rowid'] = $id;
				$data[$i]['qty'] = $qty;
				$i++;
			}
			$this->cart->update($data);
		}

		$json['message'] = 'Updated Cart';
		echo json_encode($json);

	}

	public function empty_cart() {
		$this->cart->destroy();
		$this->view_cart();	
	}

	public function checkout() {
		$user = $this->session->userdata('userid');
		if(isset($user)) {

		} else {

		}
	}

	public function paypal_checkout() {
		$this->load->library('paypal_lib');
		$order_id = 100;
		//$this->paypal_lib->add_field('business', PAYPALACCOUNT);paypal@visiontechdigital.com
		$this->paypal_lib->add_field('business', 'paypal@visiontechdigital.com');
		$this->paypal_lib->add_field('return', site_url('shop/paypal_success'));
		$this->paypal_lib->add_field('cancel_return', site_url('shop/paypal_cancel'));
		$this->paypal_lib->add_field('notify_url', site_url('shop/paypal_ipn')); // <-- IPN url
		//$this->paypal_lib->add_field('custom', $order_id);
		$this->paypal_lib->add_field('cmd', '_cart');
		$this->paypal_lib->add_field('upload', '1');

		$i = 1; 
        
        $sum_tot = (integer)$this->cart->total();
		foreach($this->cart->contents() as $item) {

			$options = '';
			if(isset($item['options']) && count($item['options'])) {
				foreach($item['options'] as $opt => $val) {
					$options .= $opt . ' - ' . $val . ', ';
				}
				$options = '(' . trim($options, ' ,') . ')';
			}
			/*$this->paypal_lib->add_field('item_name_' . $i, $item['name'] . $options . ')');
			$this->paypal_lib->add_field('amount_' . $i, $item['price']);
			$this->paypal_lib->add_field('quantity_' . $i, $item['qty']);
            */
            
            if($sum_tot> 1000){
                $this->paypal_lib->add_field('item_name_' . $i, $item['name'] .' 50% deposit ');
                $this->paypal_lib->add_field('amount_' . $i, ($item['price']/2));
                $this->paypal_lib->add_field('quantity_' . $i, $item['qty']);
            }else
            {
                $this->paypal_lib->add_field('item_name_' . $i, $item['name'] );
                $this->paypal_lib->add_field('amount_' . $i, $item['price']);
                $this->paypal_lib->add_field('quantity_' . $i, $item['qty']);
     
            }
            // Because paypal doesn't provide a field to handle the total postage,
            // we have to calculate again by item.
            $postage = $this->base_model->get_postage($item['id'], $item['qty']);
            $item_p = 0;
            if(isset($_POST['postage_type']) and $_POST['postage_type'] == "local")
            {
                $item_p = $postage[0];
            }elseif( isset($_POST['postage_type']) and  $_POST['postage_type'] == "intel"){
                $item_p = $postage[1];
            }
			//$this->paypal_lib->add_field('shipping_' . $i, $item_p);

			$i++;
		}

		$this->paypal_lib->paypal_auto_form();
	}
	public function paypal_cancel()
	{
		$data['ajax_overlay'] = false;
		if(isset($_POST['ajax']) && $_POST['ajax']) {
			$data['ajax_overlay'] = true;
		}
		
		$this->load->view('shop_paypal_cancel_view', $data);
	}
	
	public function paypal_success()
	{
		$data['ajax_overlay'] = false;
		if(isset($_POST['ajax']) && $_POST['ajax']) {
			$data['ajax_overlay'] = true;
		}
		
		// This is where you would probably want to thank the user for their order
		// or what have you.  The order information at this point is in POST 
		// variables.  However, you don't want to "process" the order until you
		// get validation from the IPN.  That's where you would have the code to
		// email an admin, update the database with payment status, activate a
		// membership, etc.
	
		// You could also simply re-direct them to another page, or your own 
		// order status page which presents the user with the status of their
		// order based on a database (which can be modified with the IPN code 
		// below).

		$this->cart->destroy();
		
		$data['pp_info'] = $this->input->post();
		$this->load->view('shop_paypal_success_view', $data);
	}
	
	public function paypal_ipn()
	{
		$this->load->library('paypal_lib');
		// Payment has been received and IPN is verified.  This is where you
		// update your database to activate or process the order, or setup
		// the database with the user's order details, email an administrator,
		// etc. You can access a slew of information via the ipn_data() array.
 
		// Check the paypal documentation for specifics on what information
		// is available in the IPN POST variables.  Basically, all the POST vars
		// which paypal sends, which we send back for validation, are now stored
		// in the ipn_data() array.
 
		// For this example, we'll just email ourselves ALL the data.
		$to    = 'orders@visiontechdigital.com';    //  your email
		$to_payer = $this->paypal_lib->ipn_data['payer_email'];
		$this->load->library('paypal_lib');
		if ($this->paypal_lib->validate_ipn()) 
		{
			$body  = 'An instant payment notification was successfully received from ';
			$body .= $this->paypal_lib->ipn_data['payer_email'] . ' on '.date('m/d/Y') . ' at ' . date('g:i A') . "\n\n";
			$body .= " Details:\n";


			$body_payer  = 'An instant payment notification was successfully received from ';
			$body_payer .= $this->paypal_lib->ipn_data['payer_name'].' on '.date('m/d/Y') . ' at ' . date('g:i A') . "\n\n";
			$body_payer .= " Details:\n";

			foreach ($this->paypal_lib->ipn_data as $key=>$value){
				$body .= "\n$key: $value";
				$body_payer .= "\n$key: $value";				
			}
			// load email lib and email results
			$this->load->library('email');
			$this->email->to($to);
			$this->email->from($this->paypal_lib->ipn_data['payer_email'], $this->paypal_lib->ipn_data['payer_name']);
			$this->email->subject('Payment Received');
			$this->email->message($body);	
			$this->email->send();
			
			$this->email->to($to_payer);
			$this->email->from('no-Reply', '');
			$this->email->subject('Payment Received');
			$this->email->message($body_payer);	
			$this->email->send();
		}
	}
	
	public function payment_gateway() {
		
	}

	public function __destruct() {
		
	}

}
