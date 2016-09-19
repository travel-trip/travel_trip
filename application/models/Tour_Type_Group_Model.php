<?php

class Tour_Type_Group_Model extends MY_Model {

    function __construct() {
        parent::__construct();
         $this->has_many['tour_types'] = array('foreign_model'=>'Tour_Type_Model','foreign_table'=>'tour_types','foreign_key'=>'group_id','local_key'=> 'id');
    }

    public $before_create = array('timestamps');
    public $table = "tour_type_group";
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
