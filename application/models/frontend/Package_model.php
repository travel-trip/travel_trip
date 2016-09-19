<?php

class Package_model extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    public $before_create = array('timestamps');
    public $table = "countries";
    public $primary_key = "id";


    function getPackageDetail($package_id = null){
        $packageDetail = array();
        if(!empty($package_id)){
            $this->db->select('p.*,t.*,p.name as package_name,t.name as tour_type,p.id as package_id,con.name as country_name');
            $this->db->from('tour_package p');
            $this->db->join('tour_types t', 't.id = p.tour_type_id','left');
            $this->db->join('countries con', 'con.id = p.country_id','left');
            $this->db->where('p.id', $package_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $packageDetail = $query->row();
                return $packageDetail;
            }
            return $packageDetail;
        }
        return $packageDetail;
    }
    
     function getPackageItnerary($package_id = null){
        $packageItinarary = array();
        if(!empty($package_id)){
            $this->db->select('*');
            $this->db->from('tour_Itinerary');
            $this->db->where('tour_Itinerary.tour_package_id', $package_id);
            $this->db->order_by('day_title', 'ASC');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $packageItinarary = $query->result();
                return $packageItinarary;
            }
            return $packageItinarary;
        }
        return $packageItinarary;
    }
    
    function getPackageActivities($package_id = null){
        $includedActivities = array();
        if(!empty($package_id)){
            $this->db->select('t.id,t.name');
            $this->db->from('tour_activity p');
            $this->db->join('activities t', 't.id = p.activity_id');
            $this->db->where('p.tour_package_id', $package_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $includedActivities = $query->result();
                return $includedActivities;
            }
            return $includedActivities;
        }
        return $includedActivities;
        
    }
    
    public function getPackageHiglights($package_id = null){
        $tourHighlights = array();
        $locationData = array();
        
        if(!empty($package_id)){
             $locationData = getCoveredLocations($package_id);
             $locationData = json_decode(json_encode($locationData),true);
             $locationData = array_column($locationData, 'locations');
             if (!empty($locationData)) {
                $this->db->select('*');
                $this->db->from('attraction');
                $this->db->where_in('location_id', $locationData);
                $this->db->where('show_home', 1);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    $tourHighlights = $query->result();
                    return $tourHighlights;
                }
                return $tourHighlights;
            }
            return $tourHighlights;
        }
        return false;
    }
    
    function getTourTypeCategories($condition_array = array()){
        $resultArray = array();
        if(!empty($condition_array)){
            $this->db->select('group.group_name as group_name,loc_type.id,loc_type.tour_type_id,loc_type.short_description,loc_type.long_desc,loc_type.country_id,loc_type.tour_type_group_id');
            $this->db->from('location_tour_types loc_type');
            $this->db->join('tour_type_group group', 'group.id = loc_type.tour_type_group_id');
            
            if(array_key_exists('country_id', $condition_array)){
                $this->db->where('country_id', $condition_array['country_id']);
            }
            if(array_key_exists('tour_type_group_id', $condition_array)){
                $this->db->where('tour_type_group_id', $condition_array['tour_type_group_id']);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $resultArray = $query->result();
                return $resultArray;
            }
            return $resultArray;
        }
        return $resultArray;
    }
    
    function getAttractionByCategory($condition_array= array()){
        $resultArray = array();
        if(!empty($condition_array)){
            $this->db->select('*');
            $this->db->from('attraction');
            
              if(array_key_exists('country_id', $condition_array)){
                $this->db->where('country_id', $condition_array['country_id']);
            }
            if(array_key_exists('attraction_cat_id', $condition_array)){
                $this->db->where('attraction_cat_id', $condition_array['attraction_cat_id']);
            }
           
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $resultArray = $query->result();
                return $resultArray;
            }
            return $resultArray;
        }
        return $resultArray;
    }
    
    function visitBestTime($package_id = null){
        $resultArray = array();
        if(!empty($package_id)){
            $this->db->select('best_time_from,best_time_to');
            $this->db->from('tour_best_times');
            $this->db->where('tour_package_id', $package_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $resultArray = $query->result();
                return $resultArray;
            }
            return $resultArray;
        }
        $resultArray;
    }
}
