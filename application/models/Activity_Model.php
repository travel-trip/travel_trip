<?php

class Activity_Model extends MY_Model {
    
    

    function __construct() {
        parent::__construct();
        $this->has_one['category'] = array('foreign_model'=>'Activity_Category_Model','foreign_table'=>'activity_category','foreign_key'=>'id','local_key'=>'activity_category_id');
    }

    public $before_create = array('timestamps');
    public $table = "activities";
    public $primary_key = "id";
    public $rules = array(
        'insert' => array(
            'name' => array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required'),
        )
    );

    function timestamps($state) {
        $state['created_at'] = $state['updated_at'] = date('Y-m-d H:i:s');
        return $state;
    }

}
