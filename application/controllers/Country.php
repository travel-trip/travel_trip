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
        if (!empty($country_id)) {
            $country_data = $this->Country_model->get($country_id);
            $CountryByID = !empty($country_data) ? $country_data : NULL;
            
            $sql = "select best_time_from,best_time_to,description from loction_peak_duration where location_id IS NULL AND country_id = $country_id";
            $bestTimeVisit = $this->db->query($sql)->result();
        }
       
        $data = $this->input->post();
        if (!empty($data)) {
//            dump($data);die;
            $name = !empty($data['name']) ? $data['name'] : '';
            $country_desc = !empty($data['country_desc']) ? $data['country_desc'] : '';
            
            $country_alias = url_title($name, 'dash', true);
            
            $insertedArray =   returnValidData('countries',$data);
//            dump($insertedArray);die;
            
            $insertedArray['slug'] = $country_alias;
            $insertedArray['description'] = $country_desc;
//            $insertedArray['travel_tips'] = !empty($insertedArray['travel_tips']) ? htmlentities($insertedArray['travel_tips']) : '';
//            dump($insertedArray);die;
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
//                    dump($best_timeData);die;
                    $best_timeData['country_id'] = $country_id;

                    if (!empty($best_timeData)) {
                        $res = $this->Loction_model->deleteBestTimeCountry($country_id);
                        $this->Loction_model->addBestTimeToVisit($best_timeData, null);
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
