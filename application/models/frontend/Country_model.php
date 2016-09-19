<?php

class Country_model extends MY_Model {
    
    function __construct() {
        parent::__construct();
          $this->has_many['cities'] = array('foreign_model'=>'City_model','foreign_table'=>'cities','foreign_key'=>'country_id','local_key'=>'id');
          $this->has_many['loctions'] = array('foreign_model'=>'Loction_model','foreign_table'=>'loction_destination','foreign_key'=>'country_id','local_key'=>'id');
          $this->has_many['packages'] = array('foreign_model'=>'Tour_package_model','foreign_table'=>'tour_package','foreign_key'=>'country_id','local_key'=>'id');
          $this->has_many['attractions'] = array('foreign_model'=>'Attraction_Model','foreign_table'=>'attraction','foreign_key'=>'country_id','local_key'=>'id');
//          $this->has_many['images'] = array('foreign_model'=>'Location_gallery_model','foreign_table'=>'location_gallery','foreign_key'=>'location_id','local_key'=>'id');
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

    function timestamps($country) {
        $country['created_at'] = $country['updated_at'] = date('Y-m-d H:i:s');
        return $country;
    }
    
    function getOtherInfo($id = null) {
        $tempArray = array();
        if (!empty($id)) {
            $this->db->select('*');
            $this->db->from('loction_details');
            $this->db->where('loction_details.country_id', $id);
            $this->db->order_by('loction_details.weightage', 'ASC');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $data = $query->result();
                if (!empty($data)) {
                    //dump($data);die;
                    $absolute_path = FCPATH.'uploads/location_detail/';
                    $file_name = '';
                    $resultData = array();
                    foreach ($data as  $value) {
                        
                        $file_name = $absolute_path.trim($value->image);
                        
                        if (file_exists($file_name)) {
                            $tempArray['image_src'] = base_url() . 'uploads/location_detail/' . $value->image;
                        }else{
                            $tempArray['image_src'] = '';
                        }
                        
                        $tempArray['type']= $value->type;
                        $tempArray['name']= $value->name;
                        $tempArray['description']= $value->description;
                        array_push($resultData,$tempArray);
                    }
                    return $resultData;
                }
                return $resultData;
            } else {
                return false;
            }
        }
    }
    
    function getFaq($id = null) {
        $faqArray = array();
        if (!empty($id)) {

            $this->db->select('*');
            $this->db->from('location_faq');
            $this->db->where('location_faq.country_id', $id);
            $this->db->where('location_faq.status', 1);
            $this->db->order_by('location_faq.weightage', 'ASC');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $faqArray = $query->result();
                return $faqArray;
            }
            return $faqArray;
        }
        return $faqArray;
    }
    
    function bestTimeVisitCountry($country_id = null){
        $resultArray = array();
        if(!empty($country_id)){
            $this->db->select('best_time_from,best_time_to,description');
            $this->db->from('loction_peak_duration');
            $this->db->where('country_id', $country_id);
            $this->db->where('location_id IS NULL',null,false);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $resultArray = $query->result();
                return $resultArray;
            }
            return $resultArray;
        }
        return $resultArray;
        
    }
    
    function getTopDestination($country_id = null) {
        $returnArray = array();
        if (!empty($country_id)) {
            $this->db->select('DISTINCT(gal.location_id) ,des.country_id,gal.image,des.loction,des.country_id,des.weightage,gal.primary_image,des.id,des.slug');
            $this->db->from('loction_destination des');
            $this->db->join('location_gallery gal','gal.location_id = des.id','left');
//            $this->db->where('gal.country_id', $country_id);
            $this->db->where('des.country_id', $country_id);
//            $this->db->where('des.parent_id !=',0);
            $this->db->where('des.show_home', 1);
            $this->db->where('gal.loction_tour_type_id IS NULL', null, false);
            $this->db->order_by('des.weightage','asc');
            $this->db->limit(20);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $returnArray = $query->result();
                return $returnArray;
            }
            return $returnArray;
        }
        return $returnArray;
    }
    
    function relatedArticalsByCountry($slug = null){
        
        $string = str_replace("-", "", $slug);
        $clean_slug = trim($string);
        $final_array = array();
        
        $apiUrl = "http://www.trips365.com/blog/wp-json/posts?filter[posts_per_page]=3&filter[category_name]=$clean_slug";
        if(!empty($slug)){
             $json = file_get_contents($apiUrl);
             $articals = json_decode($json);
             $i = 0;
             if(!empty($articals)){
                 foreach($articals as $artical){
                    $final_array[$i]['post_title'] = $artical->title;
                    $final_array[$i]['post_image_url'] = $artical->featured_image->guid;
                    $final_array[$i]['post_url'] = $artical->link;
                    $final_array[$i]['post_content'] = $artical->excerpt;
                    $final_array[$i]['post_date'] = $artical->date;
                    $i++;
                 }
                 return $final_array;
             }
             return $final_array;
        }
        return $final_array;
    }

}

