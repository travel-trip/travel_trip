<?php

class Attraction_Category_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
        $this->has_many['attractions'] = array('foreign_model'=>'Attraction_Model','foreign_table'=>'location_attraction','foreign_key'=>'attraction_cat_id','local_key'=>'id');
    }

    public $before_create = array('timestamps');
    public $table = "attraction_category";
    public $primary_key = "id";
    
    
    public $rules = array(
            'insert' => array(

                    'name' => array(
                            'field'=>'name',
                            'label'=>'Name',
                            'rules'=>'trim|required',
                            'errors' => array ('required' => 'Error Message rule "required" for field email',
                                    'trim' => 'Error message for rule "trim" for field email',
                                    'valid_email' => 'Error message for rule "valid_email" for field email')
                        
                        ),
                           
    )
);
    
    function timestamps($state) {
        $state['created_at'] = $state['updated_at'] = date('Y-m-d H:i:s');
        return $state;
    }
    
    
}

