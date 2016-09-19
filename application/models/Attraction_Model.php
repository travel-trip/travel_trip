<?php

class Attraction_Model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->has_one['category'] = array('foreign_model' => 'Attraction_Category_Model', 'foreign_table' => 'attraction_category', 'foreign_key' => 'id', 'local_key' => 'attraction_cat_id');
        $this->has_one['country'] = array('foreign_model'=>'Country_model','foreign_table'=>'countries','foreign_key'=>'id','local_key' => '');
         $this->has_one['location'] = array('foreign_model'=>'Location_Model','foreign_table'=>'loction_destination','foreign_key'=>'id','local_key' => '');
        
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
    
    function getAttractionByCategory($cat_id = null,$attrId = null,$by = null) {
        if (!empty($cat_id) && !empty($attrId)) {
            $this->db->select('name,image,country_id,attraction_cat_id,slug,primary_image');
            $this->db->from('attraction');
            $this->db->where('attraction_cat_id', $cat_id);
            
            if(!empty($attrId) && ($by == 'country')){
                $this->db->where('country_id', $attrId);
            }else{
                $this->db->where('location_id', $attrId);
            }
            
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $result = $query->result();
            } else {
                return false;
            }
        }
    }
    
    function addHistoryImage($data = array()) {
        $temp = array();
        if (!empty($data)) {
            $files = $data;
            $images = array();
            $cpt = count($data['name']);
            $config['upload_path'] = FCPATH . 'images/attraction';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $this->upload->initialize($config);
            $this->load->library('upload', $config);
            
            for ($i = 0; $i < $cpt; $i++) {
                 $this->load->library('upload', $config);
                    $_FILES['history_image']['name'] = $data['name'][$i];
                    $_FILES['history_image']['type'] = $data['type'][$i];
                    $_FILES['history_image']['tmp_name'] = $data['tmp_name'][$i];
                    $_FILES['history_image']['error'] = $data['error'][$i];
                    $_FILES['history_image']['size'] = $data['size'][$i];
                    
                if (!$this->upload->do_upload('history_image')) {
                    setMessage('History image'.$this->upload->display_errors(), 'warning');
                    redirect(current_url());
                } else {
                    $upload_data = $this->upload->data();
                    $name = $upload_data['file_name'];
                    $history_image = $upload_data['full_path'];
                    try {
                        chmod($history_image, 0777);
                    } catch (Exception $e) {
                        log_message('file permession: ', $e->getMessage());
                    }
                }
                
            }
            $images = $data['name'];
            return $images;
        }
        return false;
    }
    
    
    public function addAttractionHistory($data = array(),$attraction_id = null) {
        if (!empty($data)) {
            $validData = array();
            $validData['attraction_id'] = $attraction_id;
            
            $title = !empty($data['history_title']) ? $data['history_title'] : NULL;
            $description = !empty($data['history_desc']) ? $data['history_desc'] : NULL;
            $image = !empty($data['history_image']) ? $data['history_image'] : NULL;
            
            if (!empty($title) && is_array($title)) {
                $i = 0;
                $insertQuery = "";
                foreach ($title as $k => $value) {
                        $validData['history_title'] = $title[$i];
                        $validData['history_desc'] = $description[$i];
                        $validData['history_image'] = $image[$i];
                        $insertQuery = $this->db->insert('attraction_history', $validData);
                        $i ++;
                }
                if ($insertQuery) {
                    return true;
                }
            }
        }
        return false;
    }
    
    public function addBestTimeToVisit($data = array(),$attraction_id = null) {
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
                        $validData['attraction_id'] = $attraction_id;
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
    
    public function deleteBestTimeAttraction($id = null) {
        if (!empty($id)) {
            $this->db->where('attraction_id', $id);
            $this->db->where('location_id IS NULL', NULL,false);
            $this->db->where('country_id IS NULL', NULL,false);
            $res = $this->db->delete('loction_peak_duration');
            if ($res) {
                return true;
            }
            return false;
        }
        return false;
    }

}
