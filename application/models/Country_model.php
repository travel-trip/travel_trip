<?php

class Country_model extends MY_Model {
    
    function __construct() {
        parent::__construct();
          $this->has_many['cities'] = array('foreign_model'=>'City_model','foreign_table'=>'cities','foreign_key'=>'country_id','local_key'=>'id');
          $this->has_many['packages'] = array('foreign_model'=>'Tour_package_model','foreign_table'=>'tour_package','foreign_key'=>'country_id','local_key'=>'id');
          $this->has_many['attractions'] = array('foreign_model'=>'Attraction_Model','foreign_table'=>'attraction','foreign_key'=>'country_id','local_key'=>'id');
    }

    public $before_create = array('timestamps');
    public $table = "countries";
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
        if (!empty($data)) {
            $this->db->insert('capital_cities', $data);
            return TRUE;
        }
        return false;
        
    }
}

