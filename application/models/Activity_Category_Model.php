<?php

class Activity_Category_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }

    public $before_create = array('timestamps');
    public $table = "activity_category";
    public $primary_key = "id";
    
    public $rules = array(
            'insert' => array(

                    'name' => array(
                            'field'=>'name',
                            'label'=>'Name',
                            'rules'=>'trim|required'),
                )
 );
    
    function timestamps($state) {
        $state['created_at'] = $state['updated_at'] = date('Y-m-d H:i:s');
        return $state;
    }
    
    
}

