<?php
/*
 * 模型基础父类
 */
class base extends CI_Model {

    var $table   = '';

    function __construct()
    {
        parent::__construct();
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
}
?>
