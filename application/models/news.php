<?php
class news extends base {

    var $table;

    function __construct()
    {
        parent::__construct();
        parent::set_table('wp_posts');
    }




    function add_tag( $in )
    {
        $this->table = 'wp_terms';
        $this->add( $in );
    }

}
?>
