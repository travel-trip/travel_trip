<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        
        
        $this->load->model('TourPackage_model');
        $this->load->model('Tour_Type_Model');
        $this->load->model('Tour_itinerary_model');
        $this->load->library('form_validation');
        
        $this->PackageBannerImage = $this->config->item('upload_package_banner_image');
        $this->PackageImage = $this->config->item('tour_package');
        $this->tour_itinerary_image_path = $this->config->item('tour_itinerary_image');
    }
    

    function index() {

        $tour_packages = $this->TourPackage_model->with_tour_type('fields:name')->get_all();
        $data = array(
            'title' => 'Package',
            'list_heading' => 'Package',
            'package_list' => $tour_packages,
        );
        $this->template->load('admin/base', 'tour_package/package', $data);
    }

    function add(){
        
        $package_data = array();
        $iteinary_data = array();
        $banner_image_name = '';
        $primary_image_name = '';
        $imageName = array();
        if (!empty($_FILES['iteniry_image']['name'][0])) {
              $imageData = $_FILES['iteniry_image'];
              $imageName = $this->TourPackage_model->addItineraryImage($imageData);
        }
        
            
        /*****************upload country banner image********************/
        if(!empty($_FILES['banner_image']['name'])){
            $bannerImage = $_FILES['banner_image'];
            $banner_image_name = $this->TourPackage_model->uploadBannerImage($bannerImage);
        }
        
         if(!empty($_FILES['primary_image']['name'])){
            $primaryImage = $_FILES['primary_image'];
            $primary_image_name = $this->TourPackage_model->uploadPrimaryImage($primaryImage);
        }
        
        $data = $this->input->post();
        
        if(!empty($data)){
//            dump($data);die;
            $package_data = array();
            $name = !empty($data['name']) ? $data['name'] : '';
            $package_alias = url_title($name, 'dash', true);
            
           
            $package_data = returnValidData('tour_package',$data);
            $best_timeData = returnValidData('tour_best_times',$data);
            
            if(empty($package_data['location_id'])){
                unset($package_data['location_id']);
            }
            if(empty($package_data['country_id'])){
                unset($package_data['country_id']);
            }
            if(empty($package_data['covered_loction'])){
                unset($package_data['covered_loction']);
            }
            
            $code = getPackageCode();
            
            $package_data['code'] = !empty($code) ? $code : null;
            $package_data['banner_image'] = !empty($banner_image_name) ? $banner_image_name : null;
            $package_data['primary_image'] = !empty($primary_image_name) ? $primary_image_name : null;
            $package_data['slug'] = $package_alias;
            
             if(!empty($package_data['covered_loction'])){
                    $covered_cities = implode(',', $package_data['covered_loction']);
                    $package_data['covered_loction'] = '{'.$covered_cities.'}';
                }
              
              try{
                  
                  $tour_id = $this->TourPackage_model->insert($package_data,false);
                  if($tour_id){
                      if(!empty($data['activity_id'])){
                          $acvitityArray = array();
                          $acvitityArray = $data['activity_id'];
                          $this->TourPackage_model->addActivities($acvitityArray,$tour_id);
                      }
                      
                      if(!empty($best_timeData)){
                         $this->TourPackage_model->packageBestTime($best_timeData,$tour_id);
                      }
                      
                      if(!empty($data['hotel_type'][0]) && ($data['hotel_price'][0])){
                          $hotelArray = $data['hotel_type'];
                          $pricingArray = $data['hotel_price'];
                          $this->TourPackage_model->addPackagePrices($hotelArray,$pricingArray,$tour_id);
                      }
                      
                      if(!empty($data['package_image'])){
                          $imageArray = array();
                          $imageArray = $data['package_image'];
                          $this->TourPackage_model->addTourImges($imageArray,$tour_id);
                      }
                      
                      if(!empty($data['day_title'])){
                          $iteinary_data = returnValidData('tour_Itinerary',$data);
                          $iteinary_data['image'] = $imageName;
                          $this->TourPackage_model->addIteinaryData($iteinary_data,$tour_id);
                      }
                      
                       //Add Tour Iteniarey
                      
                        setMessage(' Tour Package Successfully Added','success');
                        redirect('package', 'refresh');
                }
              } catch (Exception $ex) {
                         setMessage(' Tour Package Not Added!' . $ex->getMessage(),'warning');
                         redirect('package', 'refresh');
                         log_message('error', 'Package not added'.$ex->getMessage());
            }
        }
        
        $tour_types = $this->Tour_Type_Model->fields('id,name')->get_all();
       
        $data = array(
            'title' => 'Add Package',
            'tour_types' => $tour_types,
        );
        $this->template->load('admin/base', 'tour_package/add', $data);
    }
    
    
    function edit_package($id = null){
        
        $package_data = array();
        $iteinary_data = array();
        $edit_data = array();
        $banner_image_name = '';
        $primary_image_name = '';
        $imageName = '';
        $itinararyImg = array();
        $coveredLoction = '';
        $tour_activities = '';
        $bestTimeVisit = array();
        
        if(!empty($id)){
            $edit_data = $this->TourPackage_model->with_tour_itinerary('fields:* |order_inside:day_title asc')->get($id);
            $sql = "select unnest(covered_loction) AS id from tour_package where id = $id";
            $coveredLoction = $this->db->query($sql)->result();
            
            $activity_sql = "select activity_id AS id from tour_activity where tour_package_id = $id";
            $tour_activities = $this->db->query($activity_sql)->result();
            
            $hotel_pricing_sql = "select * from package_pricing where package_id = $id";
            $hotel_pricing = $this->db->query($hotel_pricing_sql)->result();
            
            $query = "select best_time_from,best_time_to,description from tour_best_times where tour_package_id = $id";
            $bestTimeVisit = $this->db->query($query)->result();
            
        }
        
        if(!empty($coveredLoction)){
            $edit_data->covered_loction = $coveredLoction;
        }
        
        if(!empty($tour_activities)){
            $edit_data->tour_activities = $tour_activities;
        }
        
         if(!empty($hotel_pricing)){
            $edit_data->hotel_pricing = $hotel_pricing;
        }
        
        $data = $this->input->post();
        if (!empty($data)) {
            
            $package_data = returnValidData('tour_package', $data);
            $best_timeData = returnValidData('tour_best_times',$data);
//            dump($best_timeData);die;
            
             if (!empty($_FILES['iteniry_image']['name'][0])) {
                $imageData = $_FILES['iteniry_image'];
                $imageName = $this->TourPackage_model->addItineraryImage($imageData);
            }


            /*****************upload country banner image******************* */
            if (!empty($_FILES['banner_image']['name'])) {
                $bannerImage = $_FILES['banner_image'];
                $banner_image_name = $this->TourPackage_model->uploadBannerImage($bannerImage);
            }

            if (!empty($_FILES['primary_image']['name'])) {
                $primaryImage = $_FILES['primary_image'];
                $primary_image_name = $this->TourPackage_model->uploadPrimaryImage($primaryImage);
            } 


            $name = !empty($data['name']) ? $data['name'] : '';
            $package_alias = url_title($name, 'dash', true);
            
            if (empty($data['departure_date']) || !isset($data['departure_date']))
                unset($data['departure_date']);

            
            if(empty($package_data['location_id'])){
                unset($package_data['location_id']);
            }
            
            if(empty($package_data['country_id'])){
                unset($package_data['country_id']);
            }
            
            
            if(!empty($banner_image_name)){
                 $package_data['banner_image'] = $banner_image_name;
            }  else {
                unset($package_data['banner_image']);
            }
            
            if(!empty($primary_image_name)){
                $package_data['primary_image'] = $primary_image_name;
            }  else {
                unset($package_data['primary_image']);
            }
            
            
            $package_data['slug'] = $package_alias;

            if (!empty($package_data['covered_loction'])) {
                $covered_cities = implode(',', $package_data['covered_loction']);
                $package_data['covered_loction'] = '{' . $covered_cities . '}';
            }

            try {
//                 dump($package_data);die;
                $res = $this->TourPackage_model->update($package_data, $id);

                if (!empty($data['activity_id'])) {
                    $acvitityArray = array();
                    $acvitityArray = $data['activity_id'];

                    $del = $this->TourPackage_model->deleteActivities($id);

                    if ($del) {
                        $this->TourPackage_model->addActivities($acvitityArray, $id);
                    }
                }
                
                if (!empty($data['hotel_type'])) {

                    $del = $this->TourPackage_model->deleteHotelPricing($id);
                    if ($del) {
                        $hotelArray = $data['hotel_type'];
                        $pricingArray = $data['hotel_price'];
                        $this->TourPackage_model->addPackagePrices($hotelArray, $pricingArray, $id);
                    }
                }

                if (!empty($best_timeData)) {
                    $this->load->model('Common_Model');
                    $del = $this->Common_Model->deleteCustomeAttribute('tour_best_times', 'tour_package_id', $id);
                    if ($del) {
                        $this->TourPackage_model->packageBestTime($best_timeData, $id);
                    }
                }

                if (!empty($data['package_image'])) {
                    $imageArray = array();
                    $imageArray = $data['package_image'];

                    $del = $this->TourPackage_model->deleteTourImages($id);
                    if ($del) {
                        $this->TourPackage_model->addTourImges($imageArray, $id);
                    }
                }

                if (!empty($data['day_title'])) {
                    $iteinary_data = returnValidData('tour_Itinerary', $data);
                    
                    if(!empty($imageName)){
                        $iteinary_data['image'] = $imageName;
                    }
                    
                    $del = $this->TourPackage_model->deleteItinarary($id);
                    if ($del) {
                      $this->TourPackage_model->addIteinaryData($iteinary_data, $id);
                    }
                }
//                die;
                setMessage(' Tour Package Successfully Updated', 'success');
                redirect('package', 'refresh');
                
            } catch (Exception $ex) {
                setMessage(' Tour Package Not Added!' . $ex->getMessage(), 'warning');
                redirect('package', 'refresh');
                log_message('error', 'Package not added' . $ex->getMessage());
            }
        }

        $tour_types = $this->Tour_Type_Model->fields('id,name')->get_all();

        $data = array(
            'title' => 'Update Package',
            'tour_types' => $tour_types,
            'edit_data' => $edit_data,
            'covered_loction' => $coveredLoction,
            'best_time_visit' => $bestTimeVisit,
        );
        $this->template->load('admin/base', 'tour_package/edit', $data);
    }
    
    
    /**
     * @meathod add_multiple_image - Add tour package images via ajax.
     * @param Image file array using post meathod
     * @return uploaded image name
     */
    
    function add_multiple_image() {
        if (!empty($_FILES['file'])) {

            $files = $_FILES['file'];
            $images = array();

            $cpt = count($_FILES['file']['name']);
            $config['upload_path'] = $this->PackageImage;
            $config['allowed_types'] = 'jpeg|jpg|png';
            $this->load->library('upload', $config);
            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['package']['name'] = $files['name'][$i];
                $_FILES['package']['type'] = $files['type'][$i];
                $_FILES['package']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['package']['error'] = $files['error'][$i];
                $_FILES['package']['size'] = $files['size'][$i];
                
                if (!$this->upload->do_upload('package')) {
                    $sdata['message'] = $this->upload->display_errors();
                    $flashdata = array(
                        'flashdata' => $sdata['message'],
                        'message_type' => 'notice'
                    );
                    $this->session->set_userdata($flashdata);
                } else {
                    $sdata['message'] = $this->upload->display_errors();
                    $flashdata = array(
                        'flashdata' => $sdata['message'],
                        'message_type' => 'notice'
                    );
                    $this->session->set_userdata($flashdata);
                }

                $images[] = $_FILES['package']['name'];
            }
            echo json_encode($images);die;
        }
        
    }

}
