<?php

/*
 * Location Controller - Manage all types of stuff which is related to any locations
 * @author - Jeevan
 * @date - 5-sep-2016
 */

class Location extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('frontend/Location_Model');
        $this->load->model('frontend/Country_model');
        $this->load->model('Attraction_Model');
    }

    public function index($slug = null) {
        
        $ondDayPackages = array();
        $multiDayPackages = array();
        $locationData = array();
        $bestTimeVisit = array();
        $locationAttraction = array();
        
        $locationId = getIdBySlug('loction_destination',$slug);
        if(empty($locationId))redirect (base_url());
        
        $countryId = countryIdByLocation($locationId);
        
        $country_data = $this->Country_model->fields('id,language,currency,population,electcity,stdcode,time_zone')->get($countryId);
        
        $locationData = $this->Location_Model->get($locationId);
        
        /*****************************Get Onde Day Packages Listing***************************/
        $dayPackageCondition = array('show_home'=>1,'location_id'=>$locationId,'tour'=>'day');
        $ondDayPackages = $this->Location_Model->getPackages($dayPackageCondition);
        
        $multiPackageCondition = array('show_home'=>1,'location_id'=>$locationId,'tour'=>'multi');
        
        $multiDayPackages = $this->Location_Model->getPackages($multiPackageCondition);
        
        $bestTimeVisit = $this->Location_Model->bestTimeLoction($locationId);
        
        $locationAttraction = $this->Location_Model->with_attractions('fields:name,image,attraction_cat_id,counry_weightage,slug,primary_image','where:show_home = 1')->where('slug',$slug)->get_all();
        
        $relatedArticals = $this->Country_model->relatedArticalsByCountry($slug);
        
        $data = array(
            'title' => $slug,
            'one_day_packages' => $ondDayPackages,
            'multi_day_packages' => $multiDayPackages,
            'details' => $locationData,
            'best_time_visit' => $bestTimeVisit,
            'locationAttraction' => $locationAttraction,
            'countryInfo' => $country_data,
            'relatedArtical' => $relatedArticals,
        );
        $this->template->load('front/front_layout', 'frontend/location/location_detail', $data);
    }

}
