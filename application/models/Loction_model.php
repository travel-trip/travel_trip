<?php

class Loction_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->has_one['country'] = array('foreign_model'=>'Country_model','foreign_table'=>'countries','foreign_key'=>'id','local_key'=>'country_id');
//        $this->has_many['images'] = array('foreign_model'=>'Location_gallery_model','foreign_table'=>'location_gallery','foreign_key'=>'location_id','local_key'=>'id');
        
    }

    public $before_create = array('timestamps');
    public $table = "loction_destination";
    public $primary_key = "id";
//    public $rules = array(
//        'insert' => array(
//            'name' => array(
//                'field' => 'name',
//                'label' => 'Name',
//                'rules' => 'trim|required'),
//        )
//    );

    function timestamps($state) {
        $state['created_at'] = $state['updated_at'] = date('Y-m-d H:i:s');
        return $state;
    }
    
    public function addAttraction($data = array(),$loction_id = null) {
        if (!empty($data)) {
            $validData = array();
            
            $validData['location_id'] = $loction_id;
            $validData['country_id'] = !empty($data['country_id']) ? $data['country_id'] : null;
            
            $attraction = !empty($data['attraction_id']) ? $data['attraction_id'] : NULL;
            
            if (!empty($attraction) && is_array($attraction)) {
                $i = 0;
                foreach ($attraction as $k => $v) {
                    $val = !empty($v) ? $v : NULL;
                    $validData['attraction_id'] = $val;
                    $insertQuery = $this->db->insert('loction_attraction', $validData);
                    if ($insertQuery) {
                        $i++;
                    }
                }
                if ($i > 0) {
                    return true;
                }
            }
        }
        return false;
    }
    
    
     public function addBestTimeToVisit($data = array(),$loction_id = null) {
        if (!empty($data)) {
//            dump($data);die;
            $validData = array();
            $validData['location_id'] = $loction_id;
            $validData['country_id'] = !empty($data['country_id']) ? $data['country_id'] : null;
            
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
    
     public function addImages($data = array(),$loction_id = null,$countryId = null) {
        if (!empty($data)) {
            $validData = array();
            
            $validData['location_id'] = $loction_id;
            $validData['country_id'] = $countryId;
            
            if (!empty($data) && is_array($data)) {
                $i = 0;
                foreach ($data as $k => $v) {
                    $val = !empty($v) ? $v : NULL;
                    $validData['image'] = $val;
                    $insertQuery = $this->db->insert('location_gallery', $validData);
                    if ($insertQuery) {
                        $i++;
                    }
                }
                if ($i > 0) {
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
            $res = $this->db->delete('loction_peak_duration');
            if ($res) {
                return true;
            }
            return false;
        }
        return false;
    }
    
     function deleteBestTimeVisit($id = null){
        
        $this->db->where('location_id', $id);
        $res = $this->db->delete('loction_peak_duration');
        if($res){
            return true;
        }
        return false;
        
    }
    
    function deleteImages($id = null){
        $this->db->where('location_id', $id);
        $res = $this->db->delete('location_gallery');
        if($res){
            return true;
        }
        return false;
        
    }
    
    function delLocationAttraction($id = null) {
        if (!empty($id)) {
            $this->db->where('location_id', $id);
            $res = $this->db->delete('loction_attraction');
            if ($res) {
                return true;
            }
            return false;
        }
        return false;
    }

}
