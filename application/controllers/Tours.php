<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tours extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $this->load->model('Tour_Type_Model');
        $this->load->library('form_validation');
        $this->load->model('Tour_Type_Group_Model');
        
        $this->TourTypeImage = $this->config->item('upload_tour_type_dir');
        $this->TourGroupImage = $this->config->item('upload_tour_group');
    }

    function index() {
       
    }

    function type() {
        $list = array();
        $list = $this->Tour_Type_Model->with_group('fields:id,group_name')->get_all();
//        dump($list);die;
        $data = array(
            'title' => 'Tour Type',
            'list_heading' => 'Tour Types',
            'tour_type_list' => $list,
        );
        $this->template->load('admin/base', 'Tours/tour_type', $data);
    }
    
    function tour_type_group() {
        $list = array();
        $list = $this->Tour_Type_Group_Model->get_all();
        $data = array(
            'title' => 'Tour Type Group',
            'list_heading' => 'Tour Types Group',
            'tour_type_group_list' => $list,
        );
        $this->template->load('admin/base', 'Tours/tour_type_group', $data);
    }
    
    function addTourGroup(){
        $insertedArray = array();
        $tourGroupData = array();
        $GroupPrimaryImage = "";
        $images = array();
        $postData = $this->input->post();
        
        if(!empty($postData)){
            $data = !empty($postData) ? $postData : null;
//            dump($postData);die;
            /************************Upload tour group icon*****************/
             if(!empty($_FILES['icon']['name'])){
                 
                    if ($this->form_validation->run($this) != FALSE) {
                        setMessage('Please select a file to upload','warning');
                        redirect('tours/addTourGroup');
                } else {
                        $config['upload_path'] = $this->TourGroupImage;
                        $config['allowed_types'] = 'jpeg|jpg|png';
                        $config['max_width']  = '60';
                        $config['max_height']  = '60';
                        $this->load->library('upload', $config);
                            if (!$this->upload->do_upload('icon')) {
                            setMessage('Group Icon-'.$this->upload->display_errors(),'warning');
                            redirect('tours/addTourGroup','referesh');
                    } else {
                        $upload_data = $this->upload->data();
                        $data['icon'] = $upload_data['file_name'];
                        $tour_group_image = $upload_data['full_path'];
                        try {
                            chmod($tour_group_image, 0777);
                        } catch (Exception $e) {
                            log_message('file permession: ', $e->getMessage());
                        }
                    }
                }
        }
            
           /**************upload Tour type multiple images***************** */
          if (!empty($_FILES['images']['name'][0])) {
                $files = $_FILES;
                $images = array();

                $cpt = count($_FILES['images']['name']);

                $config['upload_path'] = $this->TourGroupImage;
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_width']  = '275';
                $config['max_height']  = '200';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['images']['name'] = $files['images']['name'][$i];
                    $_FILES['images']['type'] = $files['images']['type'][$i];
                    $_FILES['images']['tmp_name'] = $files['images']['tmp_name'][$i];
                    $_FILES['images']['error'] = $files['images']['error'][$i];
                    $_FILES['images']['size'] = $files['images']['size'][$i];

                    if ($this->upload->do_upload('images')) {
                       $uploads = $this->upload->data();
                        $imgName = $uploads['file_name'];
                        if ($data['primary'] == $i) {
                            $GroupPrimaryImage = $imgName;
                        }
                        $images[$i] = $imgName;
                    } else {
                        setMessage('Group Images-'.$this->upload->display_errors(),'warning');
                        redirect('tours/addTourGroup');
                    }
                }
                 $group_images = implode(',', $images);
                $data['images'] = '{' . $group_images . '}';
                $data['primary_image'] = $GroupPrimaryImage;
            }
            
            try{
                if(empty($data['descriptions']) && empty($data['short_desc']) && empty($data['weightage']) ){
                    unset($data['descriptions']);
                    unset($data['short_desc']);
                    unset($data['weightage']);
                }
//                dump($data);die;
                $res = $this->Tour_Type_Group_Model->insert($data, FALSE);
                 if($res){
                     setMessage('Tour Group Added Successfully','success');
                    redirect('tours/tour_type_group','referesh');
                }
                
            } catch (Exception $ex) {
                setMessage('Tour Group Not Added! Something went wrong.');
                redirect('tours/tour_type_group','referesh');
            }
        }
       
        $data = array(
            'title' => 'Add Tour Group',
            'list_heading' => 'Tour Group',
        );
        $this->template->load('admin/base', 'Tours/add_tour_group', $data);
    }
    
    
    function add_tour_type() {
         $insertedArray = array();
         $tourGroupData = array();
         
         if(!empty($_POST)){
            $data = $this->input->post();
            $name = !empty($data['name']) ? $data['name'] : '';
            $group_id = !empty($data['group_id']) ? (integer)$data['group_id'] : null;
            $weightage = !empty($data['weightage']) ? $data['weightage'] : '';
            $country_alias = url_title($name, 'dash', true);
            $insertedArray = !empty($data) ? $data : '';
            $insertedArray['slug'] = $country_alias;
            $insertedArray['name'] = $name;
            
            /**************upload Tour type icon image***************** */
                if(!empty($_FILES['image']['name'])){
                   
                    if ($this->form_validation->run($this) != FALSE) {
                        setMessage('Please select file to upload','warning');
                } else {
                        $config['upload_path'] = $this->TourTypeImage;
                        $config['allowed_types'] = 'jpeg|jpg|png';
                        $config['max_width']  = '100';
                        $config['max_height']  = '100';
                        
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                            if (!$this->upload->do_upload('image')) {
                            setMessage($this->upload->display_errors(),'warning');
                            redirect('tours/add_tour_type');
                    } else {
                        $upload_data = $this->upload->data();
                        $insertedArray['icon'] = $upload_data['file_name'];
                        $tour_type_image = $upload_data['full_path'];
                        try {
                            chmod($tour_type_image, 0777);
                        } catch (Exception $e) {
                            log_message('file permession: ', $e->getMessage());
                        }
                    }
                }
        }
        
        /**************upload Tour type multiple images***************** */
        if (!empty($_FILES['tour_images']['name'][0])) {
                $files = $_FILES;

                $images = array();

                $cpt = count($_FILES['tour_images']['name']);

                $config['upload_path'] = $this->TourTypeImage;
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_width'] = 300;
                $config['max_height'] = 300;
                $this->load->library('upload', $config);
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['tour_images']['name'] = $files['tour_images']['name'][$i];
                    $_FILES['tour_images']['type'] = $files['tour_images']['type'][$i];
                    $_FILES['tour_images']['tmp_name'] = $files['tour_images']['tmp_name'][$i];
                    $_FILES['tour_images']['error'] = $files['tour_images']['error'][$i];
                    $_FILES['tour_images']['size'] = $files['tour_images']['size'][$i];

                    if (!$this->upload->do_upload('tour_images')) {
                        setMessage($this->upload->display_errors(),'warning');
                        redirect('tours/add_tour_type');
                    } else {
                        $upload_data = $this->upload->data();
                    }
                    $images[] = $_FILES['tour_images']['name'];
                }

                $fileName = implode(',', $images);
                $insertedArray['tour_images'] = '{' . $fileName . '}';
            }
            
//            dump($insertedArray);die;

            try{
              
                $res = $this->Tour_Type_Model->insert($insertedArray, FALSE);
                
                if($res){
                    setMessage('Tour Type added Successfully!','success');
                    redirect('tours/type','referesh');
                }
                
            } catch (Exception $ex) {
                log_message('error', date('Y-m-d H:i:s').'->'.$ex->getMessage());
                 setMessage('Tour Type not added.Something went wrong!','warning');
                 redirect('tours/type','referesh');
            }
        }
        
        $data = array(
            'title' => 'Add Tour type',
            'list_heading' => 'Add Tour type',
        );
        $this->template->load('admin/base', 'Tours/add_tour_type', $data);
        
    }
    
    function edit_tour_type($tour_typeID = null) {
         $insertedArray = array();
         $tour_typeById = '';
         
         if(!empty($tour_typeID)){
             $tourTypeData = $this->Tour_Type_Model->get($tour_typeID);
             $tour_typeById = !empty($tourTypeData) ? $tourTypeData : NULL;
             
             $sql = 'SELECT unnest(tour_images) AS Image from tour_types where id =' . $tour_typeID;
             $imageData = $this->db->query($sql)->result();

                if (!empty($imageData)) {
                    $tour_typeById->tour_images = $imageData;
                }
        }
         $data = $this->input->post();
         if(!empty($data)){
            
            $name = !empty($data['name']) ? $data['name'] : '';
            $group_id = !empty($data['group_id']) ? (integer)$data['group_id'] : null;
            $weightage = !empty($data['weightage']) ? $data['weightage'] : '';
            $tour_alias = url_title($name, 'dash', true);
            $insertedArray = !empty($data) ? $data : '';
            $insertedArray['slug'] = $tour_alias;
            $insertedArray['name'] = $name;
            
            /**************upload country banner image***************** */
            if(!empty($_FILES['image']['name'])){
                if ($this->form_validation->run($this) != FALSE) {
                    setMessage('Please select a file to upload','warning');
                    redirect('tours/edit_tour_type/'.$tour_typeID);
                } else {
                        $config['upload_path'] = $this->TourTypeImage;
                        $config['allowed_types'] = 'jpeg|jpg|png|ods';
                        $config['max_width']  = '100';
                        $config['max_height']  = '100';
                        $this->load->library('upload', $config);
                        
                            if (!$this->upload->do_upload('image')) {
                                setMessage($this->upload->display_errors(),'warning');
                                redirect('tours/edit_tour_type/'.$tour_typeID);
                    } else {
                        $upload_data = $this->upload->data();
                        $insertedArray['icon'] = $upload_data['file_name'];
                        $tour_type_image = $upload_data['full_path'];
                        try {
                            chmod($tour_type_image, 0777);
                        } catch (Exception $e) {
                            log_message('file permession: ', $e->getMessage());
                        }
                    }
                }
        }
        
        if (!empty($_FILES['tour_images']['name'][0])) {
                $files = $_FILES;
                $images = array();
                $cpt = count($_FILES['tour_images']['name']);

                $config['upload_path'] = $this->TourTypeImage;
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_width'] = 300;
                $config['max_height'] = 300;
                $this->load->library('upload', $config);
                 $this->upload->initialize($config);
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['tour_images']['name'] = $files['tour_images']['name'][$i];
                    $_FILES['tour_images']['type'] = $files['tour_images']['type'][$i];
                    $_FILES['tour_images']['tmp_name'] = $files['tour_images']['tmp_name'][$i];
                    $_FILES['tour_images']['error'] = $files['tour_images']['error'][$i];
                    $_FILES['tour_images']['size'] = $files['tour_images']['size'][$i];

                    if (!$this->upload->do_upload('tour_images')) {
                        setMessage($this->upload->display_errors(),'warning');
                    } else {
                            $upload_data = $this->upload->data();
                    }
                    $images[] = $_FILES['tour_images']['name'];
                }
                $fileName = implode(',', $images);
                $insertedArray['tour_images'] = '{' . $fileName . '}';
            }

            try{
              
                $res = $this->Tour_Type_Model->update($insertedArray, $tour_typeID);
                if($res){
                    setMessage('Tour Type updated Successfully','success');
                    redirect('tours/type','referesh');
                }
                
            } catch (Exception $ex) {
                 log_message('error', date('Y-m-d H:i:s').'->'.$ex->getMessage());
                 setMessage('Tour type not updated. Something went wrong!');
                 redirect('tours/type','referesh');
            }
        }
        
        $data = array(
            'title' => 'Edit Tour type',
            'list_heading' => 'Add Tour type',
            'tour_type_data' => $tour_typeById,
        );
        $this->template->load('admin/base', 'Tours/edit_tour_type', $data);
        
    }
    
    function edit_tour_type_group($group_id = null) {
         $insertedArray = array();
         $tourGroupById = array();
         
         if(!empty($group_id)){
             $tourTypeGroupData = $this->Tour_Type_Group_Model->get($group_id);
             $tourGroupById = !empty($tourTypeGroupData) ? $tourTypeGroupData : NULL;
             $sql = 'SELECT unnest(images) AS Image from tour_type_group where id =' . $group_id;
             $imageData = $this->db->query($sql)->result();
                if (!empty($imageData)) {
                    $tourGroupById->images = $imageData;
                }
        }
         $data = $this->input->post();
         if(!empty($data)){
            
             /*             * ************upload icon image***************** */
            if (!empty($_FILES['icon']['name'])) {
                if ($this->form_validation->run($this) != FALSE) {
                    setMessage('Please select a file to upload','warning');
                    redirect('tours/edit_tour_type_group/'.$group_id);
                } else {
                    $config['upload_path'] = $this->TourGroupImage;
                    $config['allowed_types'] = 'jpeg|jpg|png';
                    $config['max_width'] = 100;
                    $config['max_height'] = 100;
                    
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('icon')) {
                        setMessage($this->upload->display_errors(),'warning');
                        redirect('tours/edit_tour_type_group/'.$group_id);
                    } else {
                        $upload_data = $this->upload->data();
                        $data['icon'] = $upload_data['file_name'];
                        $tour_group_image = $upload_data['full_path'];
                        try {
                            chmod($tour_group_image, 0777);
                        } catch (Exception $e) {
                            log_message('file permession: ', $e->getMessage());
                        }
                    }
                }
            } else {
                unset($data['icon']);
            }

            /*             * ************upload Tour type multiple images***************** */
            if (!empty($_FILES['images']['name'][0])) {
                $files = $_FILES;
                $images = array();
                $GroupPrimaryImage = "";

                $cpt = count($_FILES['images']['name']);

                $config['upload_path'] = $this->TourGroupImage;
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_width'] = 300;
                $config['max_height'] = 200;
                $this->load->library('upload', $config);
                
                 $this->upload->initialize($config);
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['images']['name'] = $files['images']['name'][$i];
                    $_FILES['images']['type'] = $files['images']['type'][$i];
                    $_FILES['images']['tmp_name'] = $files['images']['tmp_name'][$i];
                    $_FILES['images']['error'] = $files['images']['error'][$i];
                    $_FILES['images']['size'] = $files['images']['size'][$i];

                    if ($this->upload->do_upload('images')) {
                        $uploads = $this->upload->data();
                        $imgName = $uploads['file_name'];
                        if ($data['primary'] == $i) {
                            $GroupPrimaryImage = $imgName;
                        }
                        $images[$i] = $imgName;
                    } else {
                        setMessage($this->upload->display_errors(),'warning');
                    }
                }
                $data['primary_image'] = $GroupPrimaryImage;
                $group_images = implode(',', $images);
                $data['images'] = '{' . $group_images . '}';
            } else {
                unset($data['images']);
                unset($data['primary_image']);
            }

            try{
                
                if(empty($data['descriptions']) && empty($data['short_desc']) && empty($data['weightage']) ){
                    unset($data['descriptions']);
                    unset($data['short_desc']);
                    unset($data['weightage']);
                }
                
                $res = $this->Tour_Type_Group_Model->update($data, $group_id);
                if($res){
                    setMessage('Tour Group updated Successfully','success');
                    redirect('tours/tour_type_group','referesh');
                }
                
            } catch (Exception $ex) {
                log_message('error', date('Y-m-d H:i:s').'->'.$ex->getMessage());
                 setMessage('Tour Group not updated. Something went wrong','warning');
                 redirect('tours/tour_type_group','referesh');
            }
        }
        
        $data = array(
            'title' => 'Edit Tour type',
            'list_heading' => 'Update Tour Group',
            'tour_group_data' => $tourGroupById,
        );
        $this->template->load('admin/base', 'Tours/edit_tour_group', $data);
    }
}
