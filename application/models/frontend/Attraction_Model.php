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
    
    function getAttractionDetail($id = null) {
        $resultArray = array();
        if (!empty($id)) {
            $this->db->select('attr.*,cat.*,attr.name as attraction_name,cat.name as category_name');
            $this->db->from('attraction attr');
            $this->db->join('attraction_category cat', 'cat.id = attr.attraction_cat_id');
            $this->db->where('attr.id', $id);
            $this->db->order_by('attr.counry_weightage', 'ASC');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $resultArray = $query->row();
                return $resultArray;
            }
            return $resultArray;
        }
    }
    
    function bestTimeVisitAttraction($id = null){
        $resultArray = array();
        if(!empty($id)){
            $this->db->select('best_time_from,best_time_to');
            $this->db->from('loction_peak_duration');
            $this->db->where('attraction_id', $id);
            $this->db->where('location_id IS NULL',null,false);
            $this->db->where('country_id IS NULL',null,false);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $resultArray = $query->result();
                return $resultArray;
            }
            return $resultArray;
        }
        return $resultArray;
        
    }
    
    function getAttractionHistory($id = null) {
        $historyArray = array();
        if (!empty($id)) {
            $this->db->select('*');
            $this->db->from('attraction_history');
            $this->db->where('attraction_id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $historyArray = $query->result();
                return $historyArray;
            }
            return $historyArray;
        }
        return $historyArray;
    }

}
