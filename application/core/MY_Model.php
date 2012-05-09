<?php
class MY_Model extends CI_Model
{
	var $table_name;
	var $list_name;
	var $fields = array();
	
	public function __construct()
	{
		parent::__construct();
	}
	
    
    function find($conditions = null, $limit=1, $offset=0, $order = null) {
    	$this->db->select('*');
    	$this->db->from($this->table_name);
    	$this->db->where($conditions);
    	if(!empty($order))
    	{
    		while(list($field, $sort) = each($order))
    		{
    			$this->db->order_by($field, $sort);
    		} 
    	}
    	$this->db->limit($limit, $offset);
    	
    	return $this->db->get();
    }

    
    function delete($id) 
    {
    	return false;
    }
    
    function save($data) 
    {
    	if (isset($data['id'])) {
			$pk = $data['id'];
			unset($data['id']);
			$data['modified'] = date('Y-m-d H:i:s');
			$data = array_intersect_key($data, $this->fields);

			return $this->db->update($this->table_name, $data, array('id' => $pk));
    	} else {
    		$data['created'] = $data['modified'] = date('Y-m-d H:i:s');
    		$data = array_intersect_key($data, $this->fields);  		
    		return $this->db->insert($this->table_name, $data);
    	}
    }
    
    function get_list($conditions = null)
    {
    	$result = array('0' => '-');
    	$this->db->select("id, {$this->list_name}");
    	if(empty($conditions))
    	{
    		$data = $this->db->get($this->table_name);
    	} else {
    		$data = $this->db->get_where($this->table_name, $conditions);
    	}
    	foreach($data->result_array() as $item)
    	{
    		$result[$item['id']] = $item[$this->list_name];
    	}
    	return $result;
    }
}