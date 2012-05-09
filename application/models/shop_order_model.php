<?php

class Shop_order_model extends MY_Model {
	var $fields = array(
	'id' => '',
	'userid' => '',
	'billing_firstname' => '',
	'billing_lastname' => '',
	'billing_email' => '',
	'billing_address' => '',
	'billing_address2' => '',
	'billing_city' => '',
	'billing_state' => '',
	'billing_region' => '',
	'billing_town' => '',
	'billing_postal' => '',
	'billing_telephone' => '',
	'shipping_firstname' => '',
	'shipping_lastname' => '',
	'shipping_email' => '',
	'shipping_address' => '',
	'shipping_address2' => '',
	'shipping_city' => '',
	'shipping_state' => '',
	'shipping_region' => '',
	'shipping_town' => '',
	'shipping_postal' => '',
	'shipping_telephone' => '',
	'payment_method' => '',
	'total_amount' => '',
	'created' => '',
	'modified' => '',	
	);
	function __construct() {
		parent::__construct();
		$this->table_name = 'shop_order';
	}
}