<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Controller {
    
      function __construct() {
        parent::__construct();
        $this->load->model('City_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }

    public function index() {
        $list = $this->City_model->where('is_deleted IS NULL', null)->get_all();
//        dump($list);die;
        $data = array(
            'title' => 'City',
            'list_heading' => 'City',
            'city_list' => $list,
        );
        $this->template->load('admin/base', 'location/cities', $data);
    }
    
    public function addCaptialCity(){
        if(!empty($_POST)){
            
        }
        
        $data = array(
            'title' => 'City',
            'list_heading' => 'City',
        );
        $this->template->load('admin/base', 'location/addcapital_city', $data);
    }
    
    public function addCity() {
        $insertedArray = array();
        if(!empty($_POST)){
            $data = $this->input->post();
            $name = !empty($data['city_name']) ? removeExtraspace($data['city_name']) : '';
            $city_alias = url_title($name, 'dash', true);
            $insertedArray = !empty($data) ? $data : '';
            $insertedArray['slug'] = $city_alias;
            if(!empty($data['is_capital'])){
                $this->City_model->addCapitalCity($insertedArray, FALSE);
            }
            try{
                $this->City_model->insert($insertedArray, FALSE);
                redirect('country/countryView/'.$data['country_id'],'referesh');
                
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
    }
    
    public function editCity($city_id = null) {
        $insertedArray = array();
        if(!$city_id) return false;
        
        $cityData = $this->City_model->get($city_id);
        
        if(!empty($_POST)){
            $data = $this->input->post();
            $name = !empty($data['city_name']) ? removeExtraspace($data['city_name']) : '';
            $city_alias = url_title($name, 'dash', true);
            $insertedArray = !empty($data) ? $data : '';
            $insertedArray['slug'] = $city_alias;
            if(!empty($data['is_capital'])){
                $this->City_model->addCapitalCity($city_id,$insertedArray);
            }
            try{
                $this->City_model->update($insertedArray,$city_id);
                
            } catch (Exception $ex) {
                log_message('error', date('Y-m-d H:i:s').'->'.$ex->getMessage());
                $sdata['message'] = 'City not added! Something went wrong';
                $flashdata = array(
                    'flashdata' => $sdata['message'],
                    'message_type' => 'error'
                );
                $this->session->set_userdata($flashdata);
            }
        }
        
        $data = array(
            'title' => 'Update City',
            'EDIT_DATA' => $cityData,
        );
        $this->load->view('location/edit_city', $data);
    }
    
    public function deleteCity($city_id = NULL) {
        if (!$city_id)
            return false;
        // force deletd meathod delete data permanentaly from the db.
       // $delete = $this->City_model->force_delete($city_id);
        
        $delete = $this->City_model->delete($city_id);
        if ($delete) {
            echo "success";die;
            return true;
        }
        return FALSE;
    }

}
