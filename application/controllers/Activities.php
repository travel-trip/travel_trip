<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Activities extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $this->load->model('Activity_Category_Model');
        $this->load->model('Activity_Model');
        $this->load->library('form_validation');
        $this->TourActivityIcon = $this->config->item('upload_activity_icon_dir');
    }

    function index() {

        $activities = $this->Activity_Model->with_category('fields:name')->get_all();
//        dump($activities);die;
        $data = array(
            'title' => 'Acitivities',
            'list_heading' => 'Acitivities',
            'activity_list' => $activities,
        );
        $this->template->load('admin/base', 'Activity/activities', $data);
    }
    

    function category() {
        $list = $this->Activity_Category_Model->get_all();
        $data = array(
            'title' => 'Acitivity Category',
            'list_heading' => 'Categories',
            'activity_category_list' => $list,
        );
        $this->template->load('admin/base', 'Activity/activity_category', $data);
    }
    
    function add($category_id = null) {
         $insertedArray = array();
         $categoryByID = '';
        if (!empty($category_id)) {
            $activityCatData = $this->Activity_Category_Model->get($category_id);
            $categoryByID = !empty($activityCatData) ? $activityCatData : NULL;
        }
         
         if(!empty($_POST)){
            $data = $this->input->post();
            $insertedArray = !empty($data) ? $data : '';
            
            try{
                
                if (!empty($category_id)) {
                    $update = $this->Activity_Category_Model->update($insertedArray, $category_id);
                    redirect('activities/category','referesh');
                }
                
                $insert = $this->Activity_Category_Model->insert($insertedArray, FALSE);
                if ($insert) {
                    setMessage('Activity added Successfully!', 'warning');
                    redirect('activities/category','referesh');
                }
                
            } catch (Exception $ex) {
                log_message('error', date('Y-m-d H:i:s').'->'.$ex->getMessage());
                $sdata['message'] = 'Category not added! Something went wrong';
                $flashdata = array(
                    'flashdata' => $sdata['message'],
                    'message_type' => 'error'
                );
                $this->session->set_userdata($flashdata);
            }
        }
        
        $data = array(
            'title' => 'Add Category',
            'list_heading' => 'Add Category',
            'category_data' => $categoryByID,
        );
        $this->template->load('admin/base', 'Activity/add_activity_cat', $data);
        
    }
    
    function addAcitivity($activity_id = null) {
         $insertedArray = array();
         $activityById = '';
        if (!empty($activity_id)) {
            $activityData = $this->Activity_Model->get($activity_id);
            $activityById = !empty($activityData) ? $activityData : NULL;
        }
         
         if(!empty($_POST)){
            $data = $this->input->post();
             $insertedArray = !empty($data) ? $data : '';
             if(!empty($_FILES)){
                $condition_array = array(
                    'path'=>$this->TourActivityIcon,
                    'extention'=>'jpeg|jpg|png',
                    'max_width'=>'200',
                    'max_height'=>'200',
                    'redirect_url'=>'activities/addAcitivity'
                    );
                
                $fileName = $this->Common_Model->uploadFile($_FILES,$condition_array);
            }else{
                unset($_FILES['icon']);
            }
            $insertedArray['icon'] = !empty($fileName) ? $fileName : '';
            
            try{
                if (!empty($activity_id)) {
                    $update = $this->Activity_Model->update($insertedArray, $activity_id);
                    redirect('activities','referesh');
                }
                $insert = $this->Activity_Model->insert($insertedArray,TRUE);
                if ($insert) {
                    setMessage('Activity added Successfully!', 'warning');
                    redirect('activities','referesh');
                }
                
            } catch (Exception $ex) {
                log_message('error', date('Y-m-d H:i:s').'->'.$ex->getMessage());
                setMessage('Activity not added! Something went wrong', 'warning');
                redirect('activities','referesh');
            }
        }
        
        $activityCatID = $this->Activity_Category_Model->fields('id,name')->get_all();
        
        $data = array(
            'title' => 'Add Activity',
            'list_heading' => 'Add Activity',
            'activity_cat' => $activityCatID,
            'activity_data' => $activityById,
        );
        $this->template->load('admin/base', 'Activity/add_activity', $data);
        
    }

}
