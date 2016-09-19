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
        $attractionHistory = array();
        $attractionVisitTime = array();
        
        if(!empty($slug)){
            $id = getIdBySlug('attraction', $slug);
            $loctionAttractionDetail = $this->Attraction_Model->getAttractionDetail($id);
            $attractionHistory = $this->Attraction_Model->getAttractionHistory($id);
            $attractionVisitTime = $this->Attraction_Model->bestTimeVisitAttraction($id);
//            dump($attractionVisitTime);die;
        }
        
        $data = array(
            'title' => 'Attraction -'.$slug,
            'attraction_details' => $loctionAttractionDetail,
            'attraction_history' => $attractionHistory,
            'attraction_best_time' => $attractionVisitTime,
            
        );
        
        $this->template->load('front/front_layout', 'frontend/attraction/detail', $data);
        
    }
    
    
}
