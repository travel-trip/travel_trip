<?php

class City_model extends MY_Model {
    
    function __construct() {
        parent::__construct();
//        $this->soft_deletes = TRUE;
//        $this->has_one['country'] = 'Country_model';
        $this->has_one['country'] = array('foreign_model'=>'Country_model','foreign_table'=>'countries','foreign_key'=>'id');
    }

    public $before_create = array('timestamps');
    public $table = "cities";
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
    
    function addCapitalCity($data){
        unset($data['is_capital']);
        $data['created_at'] = $data['updated_at'] = date('Y-m-d H:i:s');
        if (!empty($data)) {
            $this->db->insert('capitals', $data);
            return TRUE;
        }
        return false;
        
    }
    
}

