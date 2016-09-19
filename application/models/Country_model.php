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
    
     public function addBestTimeToVisit($data = array(),$country_id = null) {
        if (!empty($data)) {
            $validData = array();
            $validData['created_at'] = $validData['updated_at'] = date('Y-m-d H:i:s');
            
            $best_time_from = !empty($data['best_time_from']) ? $data['best_time_from'] : NULL;
            $best_time_to = !empty($data['best_time_to']) ? $data['best_time_to'] : NULL;
            $description = !empty($data['description']) ? $data['description'] : NULL;
            
            if (!empty($best_time_from) && is_array($best_time_from)) {
                $i = 0;
                $insertQuery = "";
                foreach ($best_time_from as $k => $duration_from) {
                    if (!empty($best_time_from[$i]) && !empty($best_time_to[$i]) && !empty($description[$i])) {
                        $validData['best_time_from'] = $best_time_from[$i];
                        $validData['country_id'] =   $country_id;
                        $validData['best_time_to'] = $best_time_to[$i];
                        $validData['description'] = $description[$i];
                        $insertQuery = $this->db->insert('loction_peak_duration', $validData);
                        $i ++;
                    }
                }
                if ($insertQuery) {
                    return true;
                }
            }
        }
        return false;
    }
    
     public function deleteBestTimeCountry($id = null) {
        if (!empty($id)) {
            $this->db->where('country_id', $id);
            $this->db->where('location_id IS NULL', NULL,false);
            $this->db->where('attraction_id IS NULL', NULL,false);
            $this->db->where('loction_tour_type_id IS NULL', NULL,false);
            $res = $this->db->delete('loction_peak_duration');
            if ($res) {
                return true;
            }
            return false;
        }
        return false;
    }
}

