<?php

class Base_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function cartitem_save($form_data,$data=array()) {
		$newId = 0;
		echo 'aaaa'.$form_data['id'];
		if ($form_data['id'] == 0) {
		  $this->db->insert('shop_order_items', $form_data);
		  $newId = $this->db->insert_id();		  		  
		} 
		else {
		  $this->db->where('id', $form_data['id']);
		  $this->db->update('shop_order_items', $form_data);
		  $newId = $form_data['id'];
		}

		return $newId;
	}
  
	function shoppingcart_remove($id)
	{
		$this->db->delete('shop_order_items', array('id' => $id)); 
	}
	 
	function shoppingcart_items(
		$conditions = array(),
		$rows = '*',
		$order_row = 'id',
		$order_direction = 'asc'
	) {
		$this->db->select($rows);
		$this->db->order_by($order_row, $order_direction);
		if(count($conditions) > 0) {
			foreach($conditions as $row => $value) {
				$this->db->where($row, $value);
			}
		}
		$this->db->from('shop_order_items');

		$query = $this->db->get();
		$data = $query->result_array();
		foreach($data as $key => $value)
		{
			//Model details
			$result = $this->wp_item('model', array('wp_structure.title' => $value['model']), '*', TRUE);
			$data[$key]['Model'] = $result;
			//Fabric details
			$result = $this->wp_item('fabric', array('wp_fabric.link' => $value['fabric']), '*', TRUE);
			$data[$key]['Fabric'] = $result;
			//Leather details
			$result = $this->wp_item('leather', array('wp_leather.link' => $value['leather']),'*', TRUE);
			$data[$key]['Leather'] = $result;
			//Nail details
			$result = $this->wp_item('nail', array('wp_nail.link' => $value['nail']),'*', TRUE);
			$data[$key]['Nail'] = $result;
			
			//Leg details
			$result = $this->wp_item('legs', array('wp_legs.link' => $value['leg']),'*', TRUE);
			$data[$key]['Legs'] = $result;
			
		}

		return $data;
	}
	
	function wp_item(
		$item_type = 'folder',
		$conditions = array(),
		$rows = '*',
		$additionals = false,
		$order_row = 'position',
		$order_direction = 'asc',
		$back_ticks = true
	) {
		$this->db->select($rows);
		$this->db->join(
			'wp_' . $item_type,
			'wp_structure.id = wp_' . $item_type . '.link',
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

		$query = $this->db->get();
		$data = $query->result_array($query);

		if($additionals === true) {
			$count = count($data);
			for($i = 0; $i < $count; $i++) {
				$data[$i]['images'] = $this->wp_gallery_item('image', $data[$i]['id']);
				$data[$i]['files'] = $this->wp_gallery_item('file', $data[$i]['id']);
			}
		}
		return $data;
	}

	function calendar_items(
		$conditions = array(),
		$rows = '*',
		$order_row = 'StartTime',
		$order_direction = 'asc'
	) {
		$this->db->select($rows);
		$this->db->order_by($order_row, $order_direction);
		if(count($conditions) > 0) {
			foreach($conditions as $row => $value) {
				$this->db->where($row, $value);
			}
		}
		$this->db->from('jqcalendar');

		$query = $this->db->get();
		$data = $query->result_array($query);

		return $data;
	}

	public function wp_gallery_item(
		$item_type = 'image', // image | file
		$parent = 0
	) {
		$this->db->select('*');
		$this->db->where('parent', $parent);
		$this->db->where('online', 1);


		$this->db->from('wp_' . $item_type . '_gallery');
		$this->db->order_by('position', 'asc');
		$query = $this->db->get();
		return $query->result_array();

	}

	public function wp_gallery_item_id(
		$item_type = 'image', // image | file
		$id = 0
	) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->where('online', 1);


		$this->db->from('wp_' . $item_type . '_gallery');
		$this->db->order_by('position', 'asc');
		$query = $this->db->get();
		return $query->result_array();

	}

	public function meta_data($id) {

		// The purpose of this is to find the parent menu item
		// and get the meta data.
		//
		// All that is required is one id. From here the function
		// will be able to find the parent menu item.
		
		$sql = 'SELECT id, parent, type FROM wp_structure WHERE id = %s';
		$parent_sql = 'SELECT parent FROM wp_structure WHERE id = %d';
		$children_sql = 'SELECT id FROM wp_structure WHERE parent = %d';

		$meta_sql = 'SELECT meta_words, meta_description FROM wp_%s WHERE id = %d';

		$descended_levels = 0;
		$ascended_levels = 0;
		$max_levels_navigated = 3;

		$in_array = array();
		$in_array[] = $id;

		// Find the ids of each item 3 up and 3 down from the provided id.
		for($i = 0; $i < $max_levels_navigated; $i++) {
			$parent_query = sprintf($parent_sql, $id);
			$query = $this->db->query($parent_query);
			$row = $query->row_array();
			$id = $row['parent'];
			$in_array[] = $row['parent'];
		}

		for($i = 0; $i < $max_levels_navigated; $i++) {
			
		}

		/*
		$meta = array();

		// Check up.
		for($i = 0; $i < $max_levels_navigated; $i++) {
			$sql_query = sprintf($sql, $id);
			$query = $this->db->query($sql_query);
			$results = $query->result_array();
			$count = $query->num_rows();
			
			if($count > 0) {
				foreach($results as $r) {
					if(in_array($r['type'], array('article', 'menu'))) {
						$meta_query = $this->db->query(
							sprintf($meta_sql, $r['type'], $r['id'])
						);
						array_merge($meta, $meta_query->result_array());
					}
				}
			}
		}
		 */
	}

	public function recursive_ids($id) {
		$children_sql = 'SELECT id, type FROM wp_structure WHERE parent = %d';

		$in_ids = array();

		$query = $this->db->query(sprintf($children_sql, $id));
		$results = $query->result_array();
		foreach($results as $r) {
			if($r['type'] == 'article') {
				$in_ids[] = $r['id'];
			} else {
				$in_ids[] = $this->recursive_ids($r['id']);
			}
		}
		return(array_values($in_ids));
	}

	public function format_events ($events) {
	

		$return = array();
		foreach($events as $e) {
			$date = strtotime($e['StartTime']);
			$day = date('w', $date);
			$hour = date('G', $date);
			$return[$day][$hour][] = $e;
		}

		return $return;
	
	}
	
	function form_elements($id =0) {
		$this->db->select('*');
		$this->db->order_by('position', 'asc');
		$this->db->where('parent', $id);
		$this->db->from('wp_form_element');

		$query = $this->db->get();
		$data = $query->result_array($query);

		return $data;
	}

	/**
	 * Get all blogs
	 */
	public function get_blogs($limit = 10){
		$sql = "SELECT * FROM `blog_entries` WHERE `online` = 1 ORDER BY `date` DESC LIMIT 0, " . $limit;
		$query = $this->db->query($sql);

		$data = $query->result_array();
		for($i = 0; $i < count($data); $i++) {
			$data[$i]['comments_total'] = $this->count_comments($data[$i]['id']);
		}
		return $data;
	}
	/**
	 * Get single blog
	 */
	public function get_blog($id){
		$this->db->select('*');
		$this->db->where('online', '1');
		$this->db->where('id', $id);
		$query = $this->db->get('blog_entries');
		return $query->result_array($query);
	}
	/**
	 * Get all comments for blog $id
	 */
	public function get_comments($id){
		$this->db->select('*');
		$this->db->where('link', $id); 
		$query = $this->db->get('blog_comments');
		return $query->result_array($query);
	}

	/**
	 * Get latest blogs
	 */
	public function get_latest_blogs(){
		$this->db->select('title, id');
		$this->db->order_by("date", "desc"); 
		$this->db->limit(3);
		$query = $this->db->get('blog_entries');
		return $query->result_array($query);
	}

	/**
	 * Get blogs archive
	 */
	public function get_blog_archives(){
		$sql = "SELECT DISTINCT DATE_FORMAT(date,'%b %Y') as format_date FROM blog_entries WHERE `online` = 1 ORDER BY `date` DESC";
		$query = $this->db->query($sql);
		return $query->result_array($query);
	}

	/**
	 * Get all blogs by date range
	 */
	public function get_blog_by_archive($date){
		$sql = "SELECT * FROM blog_entries WHERE DATE_FORMAT(date,'%b %Y')  = '" . mysql_escape_string($date) . "'";
		$query = $this->db->query($sql);
		//Not yet tested
		$data = $query->result_array();
		for($i = 0; $i < count($data); $i++) {
			$data[$i]['comments_total'] = $this->count_comments($data[$i]['id']);
		}
		return $data;
	}

	/**
	 * Insert comment
	 */
	public function insert_comment($id, $user, $email, $website, $comments){
		$data = array(
			'link' => $id ,
			'date' => date('Y-m-d H:i:s') ,
			'user' => $user,
			'email' => $email,
			'website' => $website,
			'content' => $comments
		);
		$query = $this->db->insert('blog_comments', $data);
	}

	public function get_agents(){
		$sql = "SELECT `id`, `title` FROM `wp_structure` WHERE `type` = 'agent'";
		$query = $this->db->query($sql);
		return $query->result_array($query);
	}

	/**
	 *Count all comments for article $id
	 */
	public function count_comments($id){
		$this->db->where('link', $id); 
		$this->db->from('blog_comments');
		return $this->db->count_all_results();
	}

	/*
	 * Blog posts by user
	 */

	public function user_posts($user_id) {

		$this->db->select('*');
		$this->db->order_by("date", "desc"); 
		$this->db->where('author', $user_id);
		$query = $this->db->get('blog_entries');

	

		$data = $query->result_array($query);
		
		for($i = 0; $i < count($data); $i++) {
			$data[$i]['comments_total'] = $this->count_comments($data[$i]['id']);
		}

		return $data;

	}

    public function get_postage($product_id, $quantity){
		$sql = "SELECT product_postage1, product_postage2, product_postage3 FROM wp_product WHERE link = '" .$product_id ."'";
		$query = $this->db->query($sql);
		$postages = $query->result_array($query);
        $postage = array();
        if($quantity < 4){
            $postage[0] = $postages[0]['product_postage1'];
        }else{
            $postage[0] = $postages[0]['product_postage2'];
        }
        $postage[1] = $postages[0]['product_postage3'];
        return $postage;
	}

}
