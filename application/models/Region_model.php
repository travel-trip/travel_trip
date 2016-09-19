<?php

class Region_model extends MY_Model {
    
    function __construct() {
        parent::__construct();
        $this->soft_deletes = TRUE;
    }

    public $before_create = array('timestamps');
    public $table = "regions";
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
    
    function addRegionLoction($data) {
        unset($data['type']);
        if (empty($data['country_id'])) {
            $data['country_id'] = NULL;
        }
        $data['created_at'] = $data['updated_at'] = date('Y-m-d H:i:s');
        if (!empty($data)) {

            $this->db->insert('region_loctions', $data);
            return TRUE;
        }
        return false;
    }

}

