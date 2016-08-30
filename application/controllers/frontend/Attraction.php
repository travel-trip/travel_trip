<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Attraction extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('frontend/Attraction_Model');

    }
    
    function attraction_detail($slug= null){
        $loctionAttractionDetail = array();
        if(!empty($slug)){
            $id = getIdBySlug('attraction', $slug);
            $loctionAttractionDetail = $this->Attraction_Model->getAttractionDetail($id);
        }
//        dump($loctionAttractionDetail);die;
        $data = array(
            'title' => 'Attraction -'.$slug,
            'attraction_details' => $loctionAttractionDetail
            
        );
        
        $this->template->load('front/front_layout', 'frontend/attraction/detail', $data);
        
    }
    
    
}
