<?php
/*
 * 模型基础父类
 */
class base extends CI_Model {

    var $db;
    var $table = '';

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database();
        echo 'base construct';
    }

	function set_table( $v )
	{
		$this->table = $v;
	}
	
	function get_table()
	{
		return $this->table;
	}

    function term( $array, $join = 'and' )
    {
        if( !is_array( $array ) ) {
            return '';
        }

        $sql = '';
        foreach( $array as $k => $v ) $sql .= is_numeric( $k ) ? ( ' ( ' . $v . ' ) ' . $join . ' ' ) : '`' . $k . "` = '" . $v . "' " . $join . " ";
        return ( $sql == '' ) ? '' : substr( $sql, 0, '-' . ( strlen( $join ) + 1 ) );
    }

    function query( $term )
    {
        return $this->db->query('select * from '.$this->table.' where '. $this->term( $term ) );
    }

    /*
     * CRUD
     */
    function create()
    {

    }

    function read( $term=array(), $order='', $limit=10 )
    {
        $query = $this->db->query('select * from '.$this->table.' where '. $this->term( $term ) .
        $order!=''?' order by '.$order:'' .
        $limit!=''?' limit '.$limit:'' );

        return $query->result_array();
    }

    function update()
    {

    }

    function delete()
    {

    }

    /*
     * 简洁写法CRUD
     * 根据载入模块指定table使用
     */
	function add( $insert_array )
	{
        return $this->create( $this->table, $insert_array );
    }

    function get( $term_array )
    {
        return $this->read( $this->table, $term_array );
    }

    function get_one()
    {

    }

	function set( $update_array, $term_array )
	{
        return $this->update( $this->table, $update_array, $term_array );
	}
	
	function del( $term_array )
	{
        return $this->delete( $this->table, $term_array );
	}

	function debug()
	{
		echo $this->db->sql;
	}
}
?>
