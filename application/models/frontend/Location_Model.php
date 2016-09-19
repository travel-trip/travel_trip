<?php

class Location_Model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->has_many['attractions'] = array('foreign_model'=>'Attraction_Model','foreign_table'=>'attraction','foreign_key'=>'location_id','local_key'=>'id');
        
    }
    public $table = "loction_destination";
    public $primary_key = "id";
    
    public function getPackages($conditions = array()){
//        dump($conditions);die;
        $packagesArray = array();
        if(!empty($conditions)){
            
            $locationId = $conditions['location_id'];
            $showHome = $conditions['show_home'];
            $tour = $conditions['tour'];
            
            $sql  = "SELECT day,primary_image,package_price,name,slug FROM tour_package";
            if(array_key_exists('show_home', $conditions)){
                $sql .= " WHERE show_home = $showHome";
            }
            
            if(array_key_exists('tour', $conditions) && $conditions['tour'] == 'day'){
                $sql .= " AND day = 1";
            }else{
                $sql .= " AND day != 1";
            }
            if(array_key_exists('location_id', $conditions)){
                 $sql .= " AND ('$locationId' = ANY(covered_loction)";
                $sql .= " OR location_id = $locationId )";
            }
            
            $packagesArray = $this->db->query($sql)->result();
            if (!empty($packagesArray)) {
                return $packagesArray;
            }
        }
        return $packagesArray;
    }
    
    function bestTimeLoction($locId = null){
        $resultArray = array();
        if(!empty($locId)){
            $this->db->select('best_time_from,best_time_to,description');
            $this->db->from('loction_peak_duration');
            $this->db->where('location_id', $locId);
            $this->db->where('country_id IS NULL',null,false);
            $this->db->where('loction_tour_type_id IS NULL',null,false);
            $this->db->where('attraction_id IS NULL',null,false);
            
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $resultArray = $query->result();
                return $resultArray;
            }
            return $resultArray;
        }
        return $resultArray;
        
    }
    

}
