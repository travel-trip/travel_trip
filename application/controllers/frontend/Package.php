<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('frontend/Package_model');
        $this->load->model('frontend/Country_model');
       
    }

    public function package_detail($slug = null) {
        $package_id = '';
       if(!empty($slug)){
           $package_id = getIdBySlug('tour_package',removeExtraspace($slug));
       }
       
       /*********************Package details**********************************/
       $package_detail = $this->Package_model->getPackageDetail($package_id);
       
       $packageBestTime = $this->Package_model->visitBestTime($package_id);
       
       /*********************Package itnerary details**********************************/
       $package_itnerary = $this->Package_model->getPackageItnerary($package_id);
       
       /*********************Package activities details**********************************/
       $included_activities = $this->Package_model->getPackageActivities($package_id);
       
       $packageHighlights = $this->Package_model->getPackageHiglights($package_id);
       
        $data = array(
            'title' =>$slug,
            'package_details' =>$package_detail,
            'package_itneraries' =>$package_itnerary,
            'included_activities' =>$included_activities,
            'best_time' =>$packageBestTime,
            'tour_higlights' =>$packageHighlights
        );
        
        $this->template->load('front/front_layout', 'frontend/package/package_detail', $data);
        
    }
    
    function tripByCategory($location = null,$category = null){
        $getTourTypeCategories = array();
        $categoryAttraction = array();
        $countryId = '';
        $categoryId = '';
        
        $countryId = getIdBySlug('countries',$location);
        
        $categoryId = getIdBySlug('tour_type_group',$category);
        
        $countryName = getCountryNameById($countryId);
        
        $condition_array = array('country_id'=>$countryId,'tour_type_group_id'=>$categoryId);
        
        $getTourTypeCategories = $this->Package_model->getTourTypeCategories($condition_array);
        
        $attraction_cat_id = getIdBySlug('attraction_category',$category);
        
        $attraction_condition = array('country_id'=>$countryId,'attraction_cat_id'=>$attraction_cat_id);
        
        $categoryAttraction = $this->Package_model->getAttractionByCategory($attraction_condition);
        
        $relatedAtricals = $this->Package_model->getAttractionByCategory($attraction_condition);
        
        $relatedAtricals = $this->Country_model->relatedArticalsByCountry($category);
        
//        dump($relatedAtricals);die;
        
        $data = array(
            'title' =>$slug,
            'location_tour_types' =>$getTourTypeCategories,
            'country_name' =>$countryName->name,
            'category_attraction' =>$categoryAttraction,
            'related_articals' =>$relatedAtricals
        );
        
        
        $this->template->load('front/front_layout', 'frontend/package/category_trips', $data);
        
    }

}
