<?php
class Model_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function find_all($options = array())
	{
		$conditions = empty($options['conditions'])?array():$options['conditions'];
		$order_row = empty($options['order_row'])?'id':$options['order_row'];
		$order_direction = empty($options['order_direction'])?'asc':$options['order_direction'];
		
		$this->db->select('*');
		$this->db->join(
			'wp_model',
			'wp_structure.id = wp_model.link',
			'inner'
		);
		$this->db->order_by($order_row, $order_direction);
		if(count($conditions) > 0) {
			foreach($conditions as $row => $value) {
				$this->db->where($row, $value, $back_ticks);
			}
		}
		if(!array_key_exists('online', $conditions)) {
			$this->db->where('online', 1);
		}
		$this->db->from('wp_structure');
		
		return $this->db->get();
	}
	
	function fabrics($id = NULL) 
	{
		$result = array();
		$sql = "
			SELECT wm.*, ws.title 
			FROM `wp_model_element` wm, `wp_fabric` wf, `wp_structure` ws 
			WHERE ws.id = wf.link AND wm.type_id = wf.link 
			AND wm.`parent` = '{$id}' AND wm.type = 'fabric' ORDER BY wm.`position`
		";
		$result = $this->db->query($sql)->result_array();
		
		foreach($result as $key => $value)
		{
			$this->db->select('*');
			$this->db->where('parent', $value['type_id']);
			$this->db->where('online', 1);
			$this->db->from('wp_image_gallery');
			$this->db->order_by('position', 'asc');
			
			$result[$key]['images'] = $this->db->get()->result_array();
		}
		return $result;
	}
	
	function leathers($id = NULL)
	{
		$result = array();
		$sql = "
			SELECT wm.*, ws.title 
			FROM `wp_model_element` wm, `wp_leather` wl, `wp_structure` ws 
			WHERE ws.id = wl.link AND wm.type_id = wl.link AND wm.`parent` = '{$id}' 
			AND wm.type = 'leather' ORDER BY wm.`position`
		";
		$result = $this->db->query($sql)->result_array();
		
		foreach($result as $key => $value)
		{
			$this->db->select('*');
			$this->db->where('parent', $value['type_id']);
			$this->db->where('online', 1);
			$this->db->from('wp_image_gallery');
			$this->db->order_by('position', 'asc');
			
			$result[$key]['images'] = $this->db->get()->result_array();
		}
		
		return $result;
	}
	
	function legs($id = NULL)
	{
		$result = array();
		$sql = "
			SELECT wm.*, ws.title 
			FROM `wp_model_element` wm, `wp_legs` wl, `wp_structure` ws 
			WHERE ws.id = wl.link AND wm.type_id = wl.link AND wm.`parent` = '{$id}' AND wm.type = 'legs' 
			ORDER BY wm.`position`
		";
		$result = $this->db->query($sql)->result_array();
		
		foreach($result as $key => $value)
		{
			$this->db->select('*');
			$this->db->where('parent', $value['type_id']);
			$this->db->where('online', 1);
			$this->db->from('wp_image_gallery');
			$this->db->order_by('position', 'asc');
			
			$result[$key]['images'] = $this->db->get()->result_array();
		}
		
		return $result;
	}
	
	function nails($id = NULL)
	{
		$result = array();
		$sql = "
			SELECT wm.*, ws.title 
			FROM `wp_model_element` wm, `wp_nail` wn, `wp_structure` ws 
			WHERE ws.id = wn.link AND wm.type_id = wn.link AND wm.`parent` = '{$id}' 
			AND wm.type = 'nail' 
			ORDER BY wm.`position`
		";
		$result = $this->db->query($sql)->result_array();
		
		foreach($result as $key => $value)
		{
			$this->db->select('*');
			$this->db->where('parent', $value['type_id']);
			$this->db->where('online', 1);
			$this->db->from('wp_image_gallery');
			$this->db->order_by('position', 'asc');
			
			$result[$key]['images'] = $this->db->get()->result_array();
		}
		
		return $result;
	}
}