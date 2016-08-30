<?php

class State_model extends MY_Model {
    
    public $before_create = array('timestamps');
    public $table = "states";
    public $primary_key = "id";
    
    public $validate = array(
        array('field' => 'country_id',
            'label' => 'Name',
            'rules' => 'required'),
        array('field' => 'name',
            'label' => 'Country',
            'rules' => 'required'),
    );

    function timestamps($state) {
        $state['created_at'] = $state['updated_at'] = date('Y-m-d H:i:s');
        return $state;
    }
    
}

