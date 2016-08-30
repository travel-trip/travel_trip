<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('frontend/Home_model');
       
    }

    public function index() {
       
    $destinationPackages = array();
    
    /****************Packages by destination******************************/
    
    $destination = $this->Home_model->getFeaturedDestination();
    
    $currentLoction = current($destination);
    
    $country_id = !empty($currentLoction->id) ? $currentLoction->id : null;
    
    $destinationPackages = $this->Home_model->getPackageByDestination(array('limit'=> 8,'show_home'=>true),$country_id);
  
    $tourTypeCategory = $this->Home_model->getPackageByCategory();
//    dump($tourTypeCategory);die;
    
    $latestTourBlogs = $this->Home_model->latestBlogs();
    
//    dump($tourTypeCategory);die;
       $data = array(
            'title' =>'Trip365',
            'package_destination' =>$destinationPackages,
            'locations' =>$destination,
            'package_category' =>$tourTypeCategory,
            'blogs' =>$latestTourBlogs
        );
        
        $this->template->load('front/front_layout', 'frontend/home/index', $data);
        
    }

}
