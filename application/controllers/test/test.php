<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

    public function index()
    {
      /*  echo 'in...';
        $this->load->view('welcome_message');

        $this->load->model('tips');
        echo $this->tips->get_table();
        $this->tips->select('*');*/

        $this->load->model('news');
    $a =     $this->news->read();
print_r($a);
die;
        $query = $this->db->query('select * from wp_posts');

        print_r($query->result_array());
        die;
        foreach ($query->result_array() as $row)
        {
            print_r($row);
        }
die;

       // $this->load->model('base');
        $this->base->add('wp_terms',array(
            'name'=>'篮球',
            'slug'=>urldecode('篮球'),
        ));
        //echo $this->base->select();
    }
}
