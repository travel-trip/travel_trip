<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Country extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $this->load->model('Country_model');
        $this->load->model('Loction_model');
        $this->load->model('City_model');
        $this->load->model('Attraction_Model');
        $this->load->model('Common_Model');
        
        $this->load->library('form_validation');
        $this->countryBannerImage = $this->config->item('upload_banner_image');
    }

    public function index() {
        $country_list = array();
        
        $country_list = $this->Country_model->
                with_cities('fields:*count*')->
                with_packages('fields:*count*')->
                with_attractions('fields:*count*')->get_all();

        $data = array(
            'title' => 'Countries',
            'list_heading' => 'Countries',
            'country_list' => $country_list,
        );
        $this->template->load('admin/base', 'location/countries', $data);
    }

    public function add($country_id = null) {
        $insertedArray = array();
        $CountryByID = '';
        $bestTimeVisit = array();
        $countryFaqList = array();
        if (!empty($country_id)) {
            $country_data = $this->Country_model->get($country_id);
            $CountryByID = !empty($country_data) ? $country_data : NULL;
            
            $sql = "select best_time_from,best_time_to,description from loction_peak_duration where location_id IS NULL AND attraction_id IS NULL AND loction_tour_type_id IS NULL AND country_id = $country_id";
            $bestTimeVisit = $this->db->query($sql)->result();
            
            $faqSql = "select question,answer from location_faq where location_id IS NULL AND country_id = $country_id";
            $countryFaqList = $this->db->query($faqSql)->result();
        }
       
        $data = $this->input->post();
        
        if (!empty($data)) {
            $name = !empty($data['name']) ? $data['name'] : '';
            $country_desc = !empty($data['country_desc']) ? $data['country_desc'] : '';
            $country_alias = url_title($name, 'dash', true);
            $insertedArray =   returnValidData('countries',$data);
           
            if(!array_key_exists('show_home', $insertedArray)){
                $insertedArray['show_home'] = null;
            }
            
            $insertedArray['slug'] = $country_alias;
            $insertedArray['description'] = $country_desc;
            
            $countryFaq =  returnValidData('location_faq',$data);
            
            /*****************upload country banner image********************/
            if(!empty($_FILES['banner_image']['name']) && !empty($_FILES['banner_image']['tmp_name'])){
                if ($this->form_validation->run($this) != FALSE) {
                    $sdata['message'] = 'Please select a file to import';
                    $flashdata = array(
                        'flashdata' => $sdata['message'],
                        'message_type' => 'notice'
                    );
                    $this->session->set_userdata($flashdata);
                    redirect('country', 'refresh');
                } else {
                        $config['upload_path'] = $this->countryBannerImage;
                        $config['allowed_types'] = 'jpeg|jpg|png|ods';
                        $config['max_width'] = '1720';
                        $config['max_height'] = '545';
                        $this->load->library('upload', $config);
                            if (!$this->upload->do_upload('banner_image')) {
                                setMessage($this->upload->display_errors(),'warning');
                                redirect('country', 'refresh');
                    } else {
                        $upload_data = $this->upload->data();
                        $insertedArray['banner_image'] = $upload_data['file_name'];
                        $banner_image = $upload_data['full_path'];
                        try {
                            chmod($banner_image, 0777);
                        } catch (Exception $e) {
                            log_message('file permession: ', $e->getMessage());
                        }
                    }
                }
        }else{
            unset($insertedArray['banner_image']);
        }
            try {
                
                if (!empty($country_id)) {
                    $best_timeData = returnValidData('loction_peak_duration', $data);
                    if (!empty($best_timeData)) {
                        $res = $this->Country_model->deleteBestTimeCountry($country_id);
                        $this->Country_model->addBestTimeToVisit($best_timeData,$country_id);
                    }
                    
                    if (!empty($countryFaq)) {
                        $this->Common_Model->deleteCustomeAttribute('location_faq','country_id',$country_id);
                        $conditionArray = array('data'=>$countryFaq,'country_id'=>$country_id);
                        $this->Common_Model->addFaq($conditionArray);
                    }
                  
                    $update = $this->Country_model->update($insertedArray, $country_id);
                    redirect('country', 'refresh');
                }

                $last_inserted_id = $this->Country_model->insert($insertedArray, FALSE);
                if($last_inserted_id){
                    $best_timeData =  returnValidData('loction_peak_duration',$data);
                    if(!empty($best_timeData)){
                       $this->Loction_model->addBestTimeToVisit($best_timeData, $last_inserted_id);
                   }
                   
                   if(!empty($countryFaq)){
                       $conditionArray = array('data'=>$countryFaq,'country_id'=>$last_inserted_id);
                       $this->Common_Model->addFaq($conditionArray);
                   }
                    setMessage('Country added Successfully','success');
                    redirect('country', 'refresh');
                }else{
                    $sdata['message'] = 'Country not added! Something went wrong';
                    $flashdata = array(
                        'flashdata' => $sdata['message'],
                        'message_type' => 'error'
                    );
                    $this->session->set_userdata($flashdata);
                    redirect('country', 'refresh');
                }
                    
            } catch (Exception $ex) {
                    log_message('error', date('Y-m-d H:i:s') . '->' . $ex->getMessage());
                    setMessage('Country not added! Something went wrong','warning');
                    redirect('country', 'refresh');
            }
        }

        $data = array(
            'title' => 'Add Country',
            'country_data' => $CountryByID,
            'best_time_visit' => $bestTimeVisit,
            'country_faq' => $countryFaqList,
            
        );
        $this->template->load('admin/base', 'location/add_country', $data);
    }
    
    function countryView($country_id = NULL){
        $countryID = !empty($country_id) ? $country_id : NULL;
//        echo $countryID;die;
        $list = $this->City_model->where('country_id',$countryID)->get_all();
        $data = array(
            'title' => 'Country Detail',
            'country_id' => $countryID,
            'city_list' => $list,
        );
        $this->template->load('admin/base', 'location/country_detail', $data);
       
    }

}
