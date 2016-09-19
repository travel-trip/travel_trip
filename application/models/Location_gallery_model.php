<?php

class Location_gallery_model extends MY_Model {

    function __construct() {
        parent::__construct();
//        $this->has_one['location'] = array('foreign_model'=>'Loction_model','foreign_table'=>'loction_destination','foreign_key'=>'id','local_key'=>'location_id');
        $this->has_one['location'] = array('foreign_model'=>'Loction_model','foreign_table'=>'loction_destination','foreign_key'=>'id','local_key'=>'location_id');
    }
    
    public $before_create = array('timestamps');
    public $table = "location_gallery";
    public $primary_key = "id";
    
    function timestamps($state) {
        $state['created_at'] = $state['updated_at'] = date('Y-m-d H:i:s');
        return $state;
    }

}
