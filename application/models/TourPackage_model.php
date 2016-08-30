<?php

class TourPackage_model extends MY_Model {
    
    function __construct() {
        parent::__construct();
        $this->has_one['country'] = array('foreign_model'=>'Country_model','foreign_table'=>'countries','foreign_key'=>'id','local_key'=>'country_id');
        $this->has_one['tour_type'] = array('foreign_model'=>'Tour_Type_Model','foreign_table'=>'tour_types','foreign_key'=>'id','local_key'=>'tour_type_id');
        $this->has_many['tour_itinerary'] = array('foreign_model'=>'Tour_itinerary_model','foreign_table'=>'tour_Itinerary','foreign_key'=>'tour_package_id','local_key'=> 'id');
        
        $this->PackageBannerImage = $this->config->item('upload_package_banner_image');
        $this->PackagePrimaryImage = $this->config->item('tour_package');
    }

    public $before_create = array('timestamps');
    public $table = "tour_package";
    public $primary_key = "id";
    
    

    function timestamps($state) {
        $state['created_at'] = $state['updated_at'] = date('Y-m-d H:i:s');
        return $state;
    }
    
    function addActivities($data = array(),$tour_id = null) {
        if (!empty($data)) {
            $validData = array();
            $validData['tour_package_id'] = $tour_id;
            $validData['created_at'] = $validData['updated_at'] = date('Y-m-d H:i:s');
            if (!empty($data) && is_array($data)) {
                $i = 0;
                foreach ($data as $value) {
                    $validData['activity_id'] = $value;
                    $insertQuery = $this->db->insert('tour_activity', $validData);
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
    
    function addPackagePrices($hotel_type = array(), $price = array(),$tour_id = null) {
        
        if (!empty($hotel_type) && !empty($price)) {
            $insertedArray = array();
                $i = 0;
                foreach ($price as $k => $v) {
                    $insertedArray['package_id'] = $tour_id;
                    $insertedArray['price'] = $v;
                    $insertedArray['hotel_type'] = (!empty($hotel_type[$k])) ? $hotel_type[$k] : NULL;
                    $insertQuery = $this->db->insert('package_pricing', $insertedArray);
                    if ($insertQuery) {
                        $i++;
                    }
                }
                if ($i > 0) {
                    return true;
                }
            return false;
        }
        return false;
    }

    function addTourImges($data = array(),$tour_id = null) {
        if (!empty($data)) {
            $validData = array();
            $validData['tour_id'] = $tour_id;
            $validData['created_at'] = $validData['updated_at'] = date('Y-m-d H:i:s');
            if (!empty($data) && is_array($data)) {
                $i = 0;
                foreach ($data as $value) {
                    $validData['image_name'] = $value;
                    $insertQuery = $this->db->insert('tour_images', $validData);
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
    
    
    
    public function addIteinaryData($data = array(),$tour_id = null) {
        if (!empty($data)) {
            
            $validData = array();
            $tempArray = array();
            $validData['tour_package_id'] = $tour_id;
            
            if(!empty($data['itinery_activities'])){
                foreach($data['itinery_activities'] as $itinery){
                    $itineryArray = implode(',', $itinery);
                    $tempArray['itinery_activities'][] = '{'.$itineryArray.'}';
                }
            }
            
             if(!empty($data['food'])){
                foreach($data['food'] as $food){
                    $mealArray = implode(',', $food);
                    $tempArray['food'][] = '{'.$mealArray.'}';
                }
            }
            
            
            $validData['created_at'] = $validData['updated_at'] = date('Y-m-d H:i:s');
            
            $day_title = !empty($data['day_title']) ? $data['day_title'] : NULL;
            $loction = !empty($data['loction']) ? $data['loction'] : NULL;
            $sightseen = !empty($data['sightseeing']) ? $data['sightseeing'] : NULL;
            $image = !empty($data['image']) ? $data['image'] : NULL;
            $food = !empty($data['food']) ? $data['food'] : NULL;
            $transport = !empty($data['transport']) ? $data['transport'] : NULL;
            $description = !empty($data['itinery_desc']) ? $data['itinery_desc'] : NULL;
            $itinery_activity = !empty($tempArray['itinery_activities']) ? $tempArray['itinery_activities'] : NULL;
            $itinery_food = !empty($tempArray['food']) ? $tempArray['food'] : NULL;
            $night_plan = !empty($data['night_plan_same_day']) ? $data['night_plan_same_day'] : NULL;
            $next_day_plan = !empty($data['next_day_stay_hotel']) ? $data['next_day_stay_hotel'] : NULL;
            
            if (!empty($day_title) && is_array($day_title)) {
                $i = 0;
                $insertQuery = "";
                foreach ($day_title as $k => $days) {
                    $validData['day_title'] = $day_title[$i];
                    $validData['loction'] = $loction[$i];
                    $validData['transport'] = $transport[$i];
                    $validData['sightseeing'] = $sightseen[$i];
                    $validData['itinery_desc'] = $description[$i];
                    $validData['image'] = $image[$i];
                    $validData['itinery_activities'] = $itinery_activity[$i];
                    $validData['food'] = $itinery_food[$i];
                    $validData['night_plan_same_day'] = !empty($night_plan[$i]) ? $night_plan[$i] : null;
                    $validData['next_day_stay_hotel'] = !empty($next_day_plan[$i]) ? $next_day_plan[$i] : null;
                    $insertQuery = $this->db->insert('tour_Itinerary', $validData);
                    $i ++;
                }
                if ($insertQuery) {
                    return true;
                }
            }
        }
        return false;
    }
    
    function addItineraryImage($data = array()) {
        $temp = array();
        if (!empty($data)) {
            $files = $data;
            $images = array();
            $cpt = count($data['name']);
            $config['upload_path'] = FCPATH . 'uploads/tour_itinerary';
            $config['allowed_types'] = 'jpeg|jpg|png';

            $this->load->library('upload', $config);
            
            for ($i = 0; $i < $cpt; $i++) {
                 $this->load->library('upload', $config);
                    $_FILES['itinerary_image']['name'] = $data['name'][$i];
                    $_FILES['itinerary_image']['type'] = $data['type'][$i];
                    $_FILES['itinerary_image']['tmp_name'] = $data['tmp_name'][$i];
                    $_FILES['itinerary_image']['error'] = $data['error'][$i];
                    $_FILES['itinerary_image']['size'] = $data['size'][$i];
                if (!$this->upload->do_upload('itinerary_image')) {
                    setMessage($this->upload->display_errors(), 'error');
                } else {
                    $upload_data = $this->upload->data();
//                    echo 'texted';
                    $name = $upload_data['file_name'];
                    $itinerary_image = $upload_data['full_path'];
                    try {
                        chmod($itinerary_image, 0777);
                    } catch (Exception $e) {
                        log_message('file permession: ', $e->getMessage());
                    }
                }
                
            }
            $images = $data['name'];
            return $images;
        }
        return 1;
    }
    
    
    function uploadBannerImage($image = array()){
        
        $banner_image_name = '';
        $this->load->library('form_validation');
        
        if (!empty($image)) {
            
            $_FILES['banner_image']['name'] = $image['name'];
            $_FILES['banner_image']['type'] = $image['type'];
            $_FILES['banner_image']['tmp_name'] = $image['tmp_name'];
            $_FILES['banner_image']['error'] = $image['error'];
            $_FILES['banner_image']['size'] = $image['size'];

            if ($this->form_validation->run($this) != FALSE) {
                setMessage('Please select file to upload', 'error');
                redirect('package', 'refresh');
            } else {

                $config['upload_path'] = $this->PackageBannerImage;
                $config['allowed_types'] = 'jpeg|jpg|png|ods';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('banner_image')) {
                    setMessage($this->upload->display_errors(), 'error');
                } else {
                    $upload_data = $this->upload->data();
                    $banner_image_name = $upload_data['file_name'];
                    $banner_image = $upload_data['full_path'];
                    try {
                        chmod($banner_image, 0777);
                    } catch (Exception $e) {
                        log_message('file permession: ', $e->getMessage());
                    }
                }
            }
            return $banner_image_name;
        }
        
        return false;
    }
    
     function uploadPrimaryImage($image = array()){
        
        $primary_image_name = '';
        $this->load->library('form_validation');
        
        if (!empty($image)) {
            
            $_FILES['primary_image']['name'] = $image['name'];
            $_FILES['primary_image']['type'] = $image['type'];
            $_FILES['primary_image']['tmp_name'] = $image['tmp_name'];
            $_FILES['primary_image']['error'] = $image['error'];
            $_FILES['primary_image']['size'] = $image['size'];

            if ($this->form_validation->run($this) != FALSE) {
                setMessage('Please select file to upload', 'error');
                redirect('package', 'refresh');
            } else {
                $uploadArray['upload_path'] = $this->PackagePrimaryImage;
                $uploadArray['allowed_types'] = 'jpeg|jpg|png|ods';
                $this->load->library('upload', $uploadArray);
                if (!$this->upload->do_upload('primary_image')) {
                    setMessage($this->upload->display_errors(), 'error');
                } else {
                    $primary_image = $this->upload->data();
                    $primary_image_name = $primary_image['file_name'];
                    $primary_image = $primary_image['full_path'];
                    try {
                        chmod($primary_image, 0777);
                    } catch (Exception $e) {
                        log_message('file permession: ', $e->getMessage());
                    }
                }
            }
            
            return $primary_image_name;
        }
        
        return false;
    }
    
    
     function deleteActivities($id = null){
        
        $this->db->where('tour_package_id', $id);
        $res = $this->db->delete('tour_activity');
        if($res){
            return true;
        }
        return false;
        
    }
    
    function deleteHotelPricing($id = null){
        $this->db->where('package_id', $id);
        $res = $this->db->delete('package_pricing');
        if($res){
            return true;
        }
        return false;
    }
    
    
     function deleteTourImages($id = null){
        
        $this->db->where('tour_package_id', $id);
        $res = $this->db->delete('tour_images');
        if($res){
            return true;
        }
        return false;
        
    }
    
    function deleteItinarary($id = null){
        $this->db->where('tour_package_id', $id);
        $res = $this->db->delete('tour_Itinerary');
        if($res){
            return true;
        }
        return false;
        
    }
    
    function packageBestTime($data = array(), $tour_id = null) {
        $validData = array();
        if (!empty($data)) {
            $validData['tour_package_id'] = $tour_id;
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
                        $insertQuery = $this->db->insert('tour_best_times', $validData);
                        $i ++;
                    }
                }
                if ($insertQuery) {
                    return true;
                }
            }
            return false;
        }
        return false;
    }

}

