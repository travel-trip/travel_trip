<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class State extends CI_Controller {
    
      function __construct() {
        parent::__construct();
        $this->load->model('State_model');
    }

    public function index() {
        $list = $this->State_model->where('is_deleted IS NULL', null)->get_all();
//        dump($list);die;
        $data = array(
            'title' => 'States',
            'list_heading' => 'States',
            'state_list' => $list,
        );
        $this->template->load('admin/base', 'location/states', $data);
    }
    
    public function addState() {
        $insertedArray = array();
        if(!empty($_POST)){
            $data = $this->input->post();
            $name = !empty($data['name']) ? $data['name'] : '';
            $state_alias = url_title($name, 'dash', true);
            $insertedArray = !empty($data) ? $data : '';
            $insertedArray['slug'] = $state_alias;
            try{
                $this->State_model->insert($insertedArray, FALSE);
            } catch (Exception $ex) {
                 //Genrate Exception log file
                log_message('error', date('Y-m-d H:i:s').'->'.$ex->getMessage());
                $sdata['message'] = 'Vehicle not added! Something went wrong';
                $flashdata = array(
                    'flashdata' => $sdata['message'],
                    'message_type' => 'error'
                );
                $this->session->set_userdata($flashdata);
//                redirect('/vehicle/brand_list/', 'refresh');
            }
        }
        
        $data = array(
            'title' => 'Add State',
        );
        $this->load->view('location/add_state', $data);
    }

    
     public function editState($state_id = null) {
        $insertedArray = array();
        if(!$city_id) return false;
        
        $stateData = $this->City_model->get($state_id);
        
        if(!empty($_POST)){
            $data = $this->input->post();
            $name = !empty($data['name']) ? removeExtraspace($data['name']) : '';
            $city_alias = url_title($name, 'dash', true);
            $insertedArray = !empty($data) ? $data : '';
            $insertedArray['slug'] = $city_alias;
            try{
                $this->City_model->update($insertedArray,$state_id);
                
            } catch (Exception $ex) {
                log_message('error', date('Y-m-d H:i:s').'->'.$ex->getMessage());
                $sdata['message'] = 'Vehicle not added! Something went wrong';
                $flashdata = array(
                    'flashdata' => $sdata['message'],
                    'message_type' => 'error'
                );
                $this->session->set_userdata($flashdata);
            }
        }
        
        $data = array(
            'title' => 'Update State',
            'EDIT_DATA' => $stateData,
        );
        $this->load->view('location/edit_state', $data);
    }
    
    public function deleteCity($state_id) {
        if (!$state_id)
            return false;
        $delete = $this->City_model->delete($state_id);
        if ($delete) {
            echo "success";die;
            return true;
        }
        return FALSE;
    }

}
