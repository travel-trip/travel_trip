<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Country extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('frontend/Country_model');
        $this->load->model('Loction_model');
        $this->load->model('frontend/Attraction_Model');
    }

    public function index($slug = NULL) {
        $countryId = '';
        $faq = array();
        $other_details = array();
        $countryData = array();
        $countryDestination = array();
        $countryAttraction = array();
         
        if(empty($slug))return false;
       
        $table_name = 'countries';
        $countryId = getIdBySlug($table_name,$slug);
        
        $countryData = $this->Country_model->
                        with_loctions('fields:*count*','where:show_home= 1')->
                        with_packages('fields:*count*','where:show_home= 1')->
                        with_attractions('fields:*count*','where:show_home= 1')->where('slug',$slug)->get_all();
        
        $countryTours = $this->Country_model->with_packages('fields:package_price,day,name,slug,banner_image,primary_image |order_inside:counry_weightage asc')->where('slug',$slug)->get_all();
        
        $countryAttraction = $this->Country_model->with_attractions('fields:name,image,attraction_cat_id,counry_weightage |order_inside:counry_weightage asc','where:show_home = 1')->where('slug',$slug)->get_all();
        
        $countryDestination = $this->Country_model->getTopDestination($countryId);
         
        /********************Get Country related information like food culture custom****************/
        $other_details = $this->Country_model->getOtherInfo($countryId);
        
        $bestTimeVisit = $this->Country_model->bestTimeVisitCountry($countryId);
        
        /********************Get Faq Based on Country****************/
        $faq = $this->Country_model->getFaq($countryId);
        
        $relatedArticals = $this->Country_model->relatedArticalsByCountry($slug);
        
        
        /**********************View related Data*********************/
        
        $data = array(
            'title' => $slug,
            'country_data' => $countryData,
            'country_package' => $countryTours,
            'country_attraction' => $countryAttraction,
            'country_location' => $countryDestination,
//            'other_location' => $otherDestinations,
            'country_other_info' => $other_details,
            'country_faq' => $faq,
            'best_time_visit' => $bestTimeVisit,
            'related_articals' => $relatedArticals,
        );
//        
//        dump($data);die;    
         
        $this->template->load('front/front_layout', 'frontend/countries/country_page', $data);
    }

}
