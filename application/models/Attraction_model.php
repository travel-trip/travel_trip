<?php

class Attraction_model extends MY_Model {
    
    function __construct() {
        parent::__construct();
//        $this->soft_deletes = TRUE;
        $this->has_one['country'] = array('foreign_model'=>'Country_model','foreign_table'=>'countries','foreign_key'=>'id');
    }

    public $before_create = array('timestamps');
    public $table = "location_attraction";
    public $primary_key = "id";
    

    function timestamps($state) {
        $state['created_at'] = $state['updated_at'] = date('Y-m-d H:i:s');
        return $state;
    }
    
}

