<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Region extends CI_Controller {
    
      function __construct() {
        parent::__construct();
        $this->load->model('Region_model');
    }

    public function index() {
        $this->db->select('*');
        $query = $this->db->get('regions');
        $data = $query->result();
    }
    
    public function addRegion() {
        $insertedArray = array();
        if(!empty($_POST)){
            $insertedArray = $this->input->post();
            try{
                $this->Region_model->insert($insertedArray, FALSE);
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
            'title' => 'Add Region',
        );
        $this->load->view('location/add_region', $data);
    }

    
     public function editRegion($region_id = null) {
        $insertedArray = array();
        if(!$region_id) return false;
        
        $regionData = $this->Region_model->get($region_id);
        if(!empty($_POST)){
            $insertedArray = $this->input->post();
            try{
                $res = $this->Region_model->update($insertedArray,$region_id);
                if (!$res) {
                    $sdata['message'] = 'Region Updated Successfully';
                    $flashdata = array(
                        'flashdata' => $sdata['message'],
                        'message_type' => 'error'
                    );
                    $this->session->set_userdata($flashdata);
                }
            } catch (Exception $ex) {
                log_message('error', date('Y-m-d H:i:s').'->'.$ex->getMessage());
                $sdata['message'] = 'Region not Updated! Something went wrong';
                $flashdata = array(
                    'flashdata' => $sdata['message'],
                    'message_type' => 'error'
                );
                $this->session->set_userdata($flashdata);
            }
        }
        
        $data = array(
            'title' => 'Update Region',
            'EDIT_DATA' => $regionData,
        );
        $this->load->view('location/edit_region', $data);
    }
    
    public function deleteRegion($region_id = null) {
        if (!$region_id)
            return false;
        $deleted = $this->Region_model->delete($region_id);
        if ($deleted) {
            echo "success";die;
            return true;
        }
        return FALSE;
    }
    
    public function addRegionLocations() {
        if (!empty($_POST)) {
            $insertedArray = $this->input->post();
//            dump($insertedArray);die;
            try {
                $res = $this->Region_model->addRegionLoction($insertedArray);
                if (!$res) {
                    $sdata['message'] = 'Region Updated Successfully';
                    $flashdata = array(
                        'flashdata' => $sdata['message'],
                        'message_type' => 'error'
                    );
                    $this->session->set_userdata($flashdata);
                }
            } catch (Exception $ex) {
                log_message('error', date('Y-m-d H:i:s') . '->' . $ex->getMessage());
                $sdata['message'] = 'Region not Updated! Something went wrong';
                $flashdata = array(
                    'flashdata' => $sdata['message'],
                    'message_type' => 'error'
                );
                $this->session->set_userdata($flashdata);
            }
        }
         $data = array(
            'title' => 'Update Region',
        );
        $this->load->view('location/add_region_location', $data);
    }

}
