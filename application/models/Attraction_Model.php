<?php

class Attraction_Model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->has_one['category'] = array('foreign_model' => 'Attraction_Category_Model', 'foreign_table' => 'attraction_category', 'foreign_key' => 'id', 'local_key' => 'attraction_cat_id');
        $this->has_one['country'] = array('foreign_model'=>'Country_model','foreign_table'=>'countries','foreign_key'=>'id','local_key' => '');
        
    }

    public $before_create = array('timestamps');
    public $table = "attraction";
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
    
    function getAttractionByCategory($id = null,$country_id = null) {
        
        if (!empty($id) && !empty($country_id)) {
            $this->db->select('name,image,country_id,attraction_cat_id');
            $this->db->from('attraction');
            $this->db->where('attraction_cat_id', $id);
            $this->db->where('country_id', $country_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $result = $query->result();
            } else {
                return false;
            }
        }
    }

}
