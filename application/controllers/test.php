<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		echo 'in...';
		//$this->load->view('welcome_message');
		
		$this->load->model('tips');
		echo $this->tips->get_table();
		$this->tips->select('*');
		
		
		$this->load->model('base');
		$this->base->set_table('ssss');
		echo $this->base->select();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */