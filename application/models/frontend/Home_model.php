<?php

class Home_model extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    public $before_create = array('timestamps');
    public $table = "countries";
    public $primary_key = "id";

    function getPackageByDestination($condition_array = array(),$country_id = null) {
            $packageDestination = array();
            $this->db->select('p.name as package_name,p.day,p.banner_image,p.primary_image,p.slug,p.package_price,c.name as country_name,c.slug as country_slug,c.id as country_id');
            $this->db->from('tour_package p');
            $this->db->join('countries c', 'c.id = p.country_id');
            
            if(!empty($condition_array) && (in_array('show_home', $condition_array))){
                 $this->db->where('p.show_home', 1);
            }
           
            
            if(!empty($country_id)){
              $this->db->where('c.id', $country_id);
            }
            
            $this->db->order_by('p.counry_weightage', 'ASC');
            
            if(!empty($condition_array) && (in_array('limit', $condition_array))){
                $this->db->limit($condition_array['limit']);
            }
            
            
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $packageDestination = $query->result();
                return $packageDestination;
            }
            return $packageDestination;
    }
    
    
    function getFeaturedDestination() {
        $destination = array();
        $this->db->select('id,name,slug');
        $this->db->from('countries');
        $this->db->where('show_home', 1);
        $this->db->limit(6);

        $this->db->order_by('weightage', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $destination = $query->result();
            return $destination;
        }
        return $destination;
    }
    
    function getPackageByCategory() {
        $packageCategory = array();

        $this->db->select('*');
        $this->db->from('tour_type_group');
        $this->db->where('show_home', 1);
        $this->db->order_by('weightage', 'ASC');
        $this->db->limit(4);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $packageCategory = $query->result();
            return $packageCategory;
        }
        return $packageCategory;
    }
    
    
    function latestBlogs(){
        $tempArray = array();
        $resultArray = array();
        $json = file_get_contents('http://www.trips365.com/blog/wp-json/posts?filter[posts_per_page]=3');
        $posts = json_decode($json);
        if(!empty($posts)){
            foreach ($posts as $blog){
                $tempArray['id'] = $blog->ID;
                $tempArray['title'] = $blog->title;
                $tempArray['image_src'] = $blog->featured_image->guid;
                $tempArray['link'] = $blog->link;
                array_push($resultArray,$tempArray);
            }
            return $resultArray;
        }
            return $resultArray;
    }

}
