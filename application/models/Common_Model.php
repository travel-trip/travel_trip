<?php

class Common_Model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    function uploadFile($file = array(), $conditionArray = array()) {
        $fileName = '';
        $uploadFile = '';
        if (!empty($file) && !empty($conditionArray)) {
                $ab = key($file);
//                dump($file);die;
                if ($this->form_validation->run($this) != FALSE) {
                    setMessage('Please select a file to upload', 'warning');
                    redirect($conditionArray['redirect_url'], 'referesh');
                } else {
                    $setting['upload_path'] = $conditionArray['path'];
                    if(array_key_exists('extention', $conditionArray)){
                          $setting['allowed_types'] = $conditionArray['extention'];
                    }
                    if(array_key_exists('max_width', $conditionArray)){
                          $setting['max_width'] = $conditionArray['max_width'];
                    }
                    if(array_key_exists('max_height', $conditionArray)){
                          $setting['max_height'] = $conditionArray['max_height'];
                    }
                    if(array_key_exists('size', $conditionArray)){
                          $setting['max_size'] = $conditionArray['size'];
                    }
                    
                    $this->upload->initialize($setting);
                    
                    $this->load->library('upload', $setting);
                    if (!$this->upload->do_upload($ab)) {
                        setMessage('Primary Image'.$this->upload->display_errors(), 'warning');
                        redirect($conditionArray['redirect_url'], 'referesh');
                    } else {
                        $upload_data = $this->upload->data();
                        $fileName = $upload_data['file_name'];
                        $image_path = $upload_data['full_path'];
                        try {
                            chmod($image_path, 0777);
                        } catch (Exception $e) {
                            log_message('file permession: ', $e->getMessage());
                        }
                    }
                    
                    return $fileName;
                }
        }
        return false;
    }
    
    function deleteCustomeAttribute($tableName = null, $coloum = null,$id = null,$extraCondition = array()) {
        if (!empty($tableName) && !empty($coloum)) {
            $this->db->where($coloum, $id);
            $res = $this->db->delete($tableName);
            if ($res) {
                return true;
            }
            return false;
        }
    }
    
    function getFaq($id = null,$type = null) {
        $faqArray = array();
        if (!empty($id) && !empty($type)) {
            $this->db->select('*');
            $this->db->from('location_faq');
            if($type == 'country'){
                $this->db->where('location_faq.country_id', $id);
                $this->db->where('location_faq.location_id IS NULL', null,false);
            }else{
                $this->db->where('location_faq.location_id', $id);
                $this->db->where('location_faq.country_id IS NULL', null,false);
            }
            
            $this->db->where('location_faq.status', 1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $faqArray = $query->result();
                return $faqArray;
            }
            return $faqArray;
        }
        return $faqArray;
    }
    
    function addFaq($conditionArray = array()) {
        $country_id = null;
        $location_id = null;
//        dump($conditionArray);die;
        if (!empty($conditionArray['data'])) {
            $data = $conditionArray['data'];
            $validData = array();
            $question = !empty($data['question']) ? $data['question'] : NULL;
            $answers = !empty($data['answer']) ? $data['answer'] : NULL;

            if (!empty($question) && is_array($question)) {
                $i = 0;
                $insertQuery = "";
                foreach ($question as $k => $faqQuestion) {
                    if (!empty($question[$i]) && !empty($question[$i])) {
                        $validData['question'] = $question[$i];
                        $validData['answer'] = $answers[$i];
                        if (array_key_exists('country_id', $conditionArray)) {
                            $country_id = $conditionArray['country_id'];
                            $validData['country_id'] = $country_id;
                        }
                        if (array_key_exists('location_id', $conditionArray)) {
                            $location_id = $conditionArray['location_id'];
                            $validData['location_id'] = $location_id;
                        }
                        $insertQuery = $this->db->insert('location_faq', $validData);
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

}
