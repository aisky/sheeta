<?php
/*
 * 模型基础父类
 */
class base extends CI_Model {

    var $table = '';
	var $field = 'id,time';

    function __construct()
    {
        parent::__construct();
    }
	
	/*
	 * 获得数组形式的字段列表，供内部使用，不必重载
	 */
	function _field()
	{
		return array_flip( explode( ',', $this->field ) );
	}
    
	function set_table( $v )
	{
		$this->table = $v;
	}
	
	function get_table()
	{
		return $this->table;
	}
	
    function command( $sql )
	{
		$this->load->database();
		return $this->db->query($sql);
	}
	
	function select( $field = '*', $other = '' )
	{
		$sql = 'select ' . $field . ' from ' . $this->table . ' ' . $other . 'limit 10';
		echo $sql;
		
		$query = $this->command($sql);
		
		
		

		
		foreach ($query->result_array() as $row)
		{
		   echo $row['id'];
		   
		   echo '||';
		   echo $row['uid'];
		   
		}
	}

	function add( $in )
	{
		$field = self::_field();

		foreach( $in as $k => $v )
		{
			if (!isset($field[$k]))
				unset($in[$k]);
			else
				$in[$k] = addslashes( $v );
		}
		
		return $this->command($sql);
	}
	
	function set( $in )
	{
		
	}
	
	function del( $id )
	{
		
	}
	
	function get()
	{
		
	}
	
	function get_one()
	{
		
	}
	
	function debug()
	{
		echo $this->db->sql;
	}
}
?>
