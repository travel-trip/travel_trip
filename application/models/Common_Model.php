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
                $uploadFile = key($file);
                
                if ($this->form_validation->run($this) != FALSE) {
                    setMessage('Please select a file to upload', 'warning');
                    redirect($conditionArray['redirect_url'], 'referesh');
                } else {
                    $config['upload_path'] = $conditionArray['path'];
                    if(array_key_exists('extention', $conditionArray)){
                          $config['allowed_types'] = $conditionArray['extention'];
                    }
                    if(array_key_exists('max_width', $conditionArray)){
                          $config['max_width'] = $conditionArray['max_width'];
                    }
                    if(array_key_exists('max_height', $conditionArray)){
                          $config['max_height'] = $conditionArray['max_height'];
                    }
                    if(array_key_exists('size', $conditionArray)){
                          $config['max_size'] = $conditionArray['size'];
                    }
                    
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload($uploadFile)) {
                        setMessage($this->upload->display_errors(), 'warning');
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
        if (!empty($tableName) && !empty($where)) {
            $this->db->where($coloum, $id);
            $res = $this->db->delete('loction_peak_duration');
            if ($res) {
                return true;
            }
            return false;
        }
    }

}
