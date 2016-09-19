<?php

/**
 * @package    CI
 * @subpackage Controller
 * @author     Jeevan<jeevan@tisindiasupport.com>
 * @description  It controlled all request respective with all attraction related stuff such as add , update and list plan at admin section.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Attraction extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        $this->load->model('Attraction_Model');
        $this->load->model('Attraction_Category_Model');
        $this->load->library('form_validation');
        $this->attractionImageDir = $this->config->item('upload_attraction_image');
    }

    function index() {

        $attraction = $this->Attraction_Model->with_category('fields:name')->get_all();
//        dump($attraction);die;
        $data = array(
            'title' => 'Attraction',
            'list_heading' => 'Attraction',
            'attraction_list' => $attraction,
        );
        $this->template->load('admin/base', 'Attraction/attraction', $data);
    }

    function addAttraction() {
        
        $this->load->model('Common_Model');
        $insertedArray = array();
        $imageName = array();
        $primaryImg = '';
        $data = $this->input->post();
        
        if (!empty($data)) {
//            dump($data);die;
            $name = !empty($data['name']) ? $data['name'] : '';
            $slug = url_title($name, 'dash', true);
            $insertedArray = returnValidData('attraction',$data);
            if(empty($insertedArray['location_id'])){
                $insertedArray['location_id'] = null;
            }
            
            $insertedArray['slug'] = $slug;
            
            if (!empty($_FILES['attraction_image']['tmp_name'][0])) {
                $files = $_FILES;
                $images = array();

                $cpt = count($_FILES['attraction_image']['name']);

                $config['upload_path'] = $this->attractionImageDir;
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_width'] = 580;
                $config['max_height'] = 400;
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['attraction_image']['name'] = $files['attraction_image']['name'][$i];
                    $_FILES['attraction_image']['type'] = $files['attraction_image']['type'][$i];
                    $_FILES['attraction_image']['tmp_name'] = $files['attraction_image']['tmp_name'][$i];
                    $_FILES['attraction_image']['error'] = $files['attraction_image']['error'][$i];
                    $_FILES['attraction_image']['size'] = $files['attraction_image']['size'][$i];

                    if (!$this->upload->do_upload('attraction_image')) {
                        setMessage('Attraction Image'.$this->upload->display_errors(),'warning');
                        redirect('attraction/addAttraction');
                       
                    } else {
                        $upload_data = $this->upload->data();
                    }

                    $images[] = $_FILES['attraction_image']['name'];
                }

                $fileName = implode(',', $images);
                $insertedArray['image'] = '{' . $fileName . '}';
            }
            
            
             if(!empty($_FILES['primary_image']['name'])){
                
                 $newImage['primary_image'] = $_FILES['primary_image'];
                 $condition_array = array(
                    'path'=>$this->attractionImageDir,
                    'extention'=>'jpeg|jpg|png',
                    'redirect_url'=>'attraction',
                    'max_width'=> 270,
                    'max_height'=> 280
                    );
                
                $primaryImg = $this->Common_Model->uploadFile($newImage,$condition_array);
                $insertedArray['primary_image'] = $primaryImg;
            }
            
            
            if (!empty($_FILES['history_image']['name'][0])) {
              $imageData = $_FILES['history_image'];
              $imageName = $this->Attraction_Model->addHistoryImage($imageData);
            }
            

            try {
                $last_inserted_id = $this->Attraction_Model->insert($insertedArray, FALSE);
                 $historyData = returnValidData('attraction_history',$data);
                 $historyData['history_image'] = $imageName;
                 $this->Attraction_Model->addAttractionHistory($historyData,$last_inserted_id);
                 
                  
                 
                 $best_timeData = returnValidData('loction_peak_duration', $data);
                 $best_timeData['attraction_id'] = $last_inserted_id;

                    if (!empty($best_timeData)) {
                            unset($best_timeData['country_id']);
                            $res = $this->Attraction_Model->addBestTimeToVisit($best_timeData, $last_inserted_id);
                    }
                 
                    setMessage('Attraction Added Successfully','success');
                    redirect('attraction', 'referesh');
            } catch (Exception $ex) {
                setMessage('Something went wrong! Please try again','error');
            }
        }

        $att_category = $this->Attraction_Category_Model->fields('id,name')->get_all();

        $data = array(
            'title' => 'Add Attraction',
            'list_heading' => 'Add Attraction',
            'attraction_category' => $att_category,
        );
        $this->template->load('admin/base', 'Attraction/add', $data);
    }

    function edit($at_id) {
        
        $this->load->model('Common_Model');
        $insertedArray = array();
        $previousHistoryImage = array();
        $bestTimeVisit = array();
        $imageData = '';
        if (!$at_id)
            return false;

        $attractionData = $this->Attraction_Model->get($at_id);

        $sql = 'SELECT unnest(image) AS Image from attraction where id =' . $at_id;
        $imageData = $this->db->query($sql)->result();

        $sql2 = 'SELECT * from attraction_history where attraction_id =' . $at_id;
        $attractionHistroy = $this->db->query($sql2)->result();
        
        $sql3 = "select best_time_from,best_time_to,description from loction_peak_duration where location_id IS NULL AND location_id IS NULL AND loction_tour_type_id IS NULL AND attraction_id = $at_id";
        $bestTimeVisit = $this->db->query($sql3)->result();
        

        if (!empty($imageData)) {
            $attractionData->images = $imageData;
        }

        if (!empty($attractionHistroy)) {
            $attractionData->history = $attractionHistroy;
        }
        
        if(!empty($attractionData->history)){
            foreach($attractionData->history as $history){
                $previousHistoryImage[] = $history->history_image;
            }
        }
        

        $data = $this->input->post();
        if (!empty($data)) {
            try {
//               dump($data);die;
                $name = !empty($data['name']) ? $data['name'] : '';
                $slug = url_title($name, 'dash', true);
                $insertedArray = returnValidData('attraction',$data);
                
                if(!array_key_exists('cost_varying', $insertedArray)){
                    $insertedArray['cost_varying'] = null;
                }
                 if(!array_key_exists('winter_open_time', $insertedArray)){
                    $insertedArray['winter_open_time'] = null;
                }
                 if(!array_key_exists('summer_open_time', $insertedArray)){
                    $insertedArray['summer_open_time'] = null;
                }
                
                if(empty($insertedArray['location_id'])){
                    $insertedArray['location_id'] = null;
                }
                $insertedArray['slug'] = $slug;
//                 dump($insertedArray);die;
                
                /********************Image upload*******************/
                if (!empty($_FILES['attraction_image']['size'][0]) && !empty($_FILES['attraction_image']['name'][0])) {
                    $files = $_FILES;
                    $images = array();

                    $cpt = count($_FILES['attraction_image']['name']);

                    $config['upload_path'] = $this->attractionImageDir;
                    $config['allowed_types'] = 'jpeg|jpg|png|ods';
                    $config['max_width'] = 580;
                    $config['max_height'] = 400;
                
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    for ($i = 0; $i < $cpt; $i++) {
                        $_FILES['attraction_image']['name'] = $files['attraction_image']['name'][$i];
                        $_FILES['attraction_image']['type'] = $files['attraction_image']['type'][$i];
                        $_FILES['attraction_image']['tmp_name'] = $files['attraction_image']['tmp_name'][$i];
                        $_FILES['attraction_image']['error'] = $files['attraction_image']['error'][$i];
                        $_FILES['attraction_image']['size'] = $files['attraction_image']['size'][$i];

                        if (!$this->upload->do_upload('attraction_image')) {
                            setMessage('Attraction Image'.$this->upload->display_errors(), 'warning');
                            redirect('attraction/edit/' . $at_id);
                        } else {
                            $images[] = $_FILES['attraction_image']['name'];
                        }
                    }

                    $fileName = implode(',', $images);
                    $insertedArray['image'] = '{' . $fileName . '}';
                } else {
                    unset($insertedArray['image']);
                }
                
                 if (!empty($_FILES['primary_image']['name'])) {
                    $condition_array = array(
                        'path' => $this->attractionImageDir,
                        'extention' => 'jpeg|jpg|png',
                        'max_width' => 270,
                        'max_height' => 280,
                        'redirect_url' => 'attraction'
                    );

                    $primaryImg = $this->Common_Model->uploadFile($_FILES, $condition_array);
                    $insertedArray['primary_image'] = $primaryImg;
                } else {
                    unset($insertedArray['primary_image']);
                }

                $historyData = returnValidData('attraction_history', $data);
                if (!empty($_FILES['history_image']['name'][0])) {
                    $imageData = $_FILES['history_image'];
                    $imageName = $this->Attraction_Model->addHistoryImage($imageData);
                    $historyData['history_image'] = $imageName;
                }else{
                    $historyData['history_image'] = $previousHistoryImage;
                }

                if (!empty($historyData)) {
                    $del = $this->Common_Model->deleteCustomeAttribute('attraction_history', 'attraction_id', $at_id);
                    if ($del) {
                        $this->Attraction_Model->addAttractionHistory($historyData, $at_id);
                    }
                }
                
                $best_timeData = returnValidData('loction_peak_duration', $data);
                $best_timeData['attraction_id'] = $at_id;

                if (!empty($best_timeData)) {
                    unset($best_timeData['country_id']);
                    $res = $this->Attraction_Model->deleteBestTimeAttraction($at_id);
                    if ($res) {
                        $this->Attraction_Model->addBestTimeToVisit($best_timeData, $at_id);
                    }
                }

                $update = $this->Attraction_Model->update($insertedArray, $at_id);
                
                if ($update) {
                    setMessage('Attraction successfully updated', 'success');
                    redirect('attraction');
                }
            } catch (Exception $ex) {
                log_message('error', date('Y-m-d H:i:s') . '->' . $ex->getMessage());
                setMessage('Attraction not updated! Something went wrong', 'warning');
                redirect('attraction');
            }
        }

        $att_category = $this->Attraction_Category_Model->fields('id,name')->get_all();
        $data = array(
            'title' => 'Update Attraction',
            'EDIT_DATA' => $attractionData,
            'best_time_visit' => $bestTimeVisit,
            'attraction_category' => $att_category,
        );
        $this->template->load('admin/base', 'Attraction/edit', $data);
    }

    /*****************************************Attraction Category Management***************************** */

    /**
     * @meathod category - List category of attraction.
     * @param N/A
     * @description - Fetches all attraction category listing.
     * @return NULL
     */
    function attractionCategory() {
        $list = $this->Attraction_Category_Model->get_all();
        $data = array(
            'title' => 'Attraction Category',
            'list_heading' => 'Attraction Category',
            'category_list' => $list,
        );
        $this->template->load('admin/base', 'Attraction/attraction_category', $data);
    }

    /**
     * @meathod category - List category of attraction.
     * @param N/A
     * @description - Fetches all attraction category listing.
     * @return NULL
     */
    function add_category($category_id = null) {
        $insertedArray = array();
        $categoryByID = '';

        if (!empty($category_id)) {
            $categoryData = $this->Attraction_Category_Model->get($category_id);
            $categoryByID = !empty($categoryData) ? $categoryData : NULL;
        }
        $data = $this->input->post();
        if (!empty($data)) {
            $insertedArray = $data;

            if (!empty($category_id)) {
                $update = $this->Attraction_Category_Model->update($insertedArray, $category_id);
                redirect('attraction/category', 'referesh');
            }

            $id = $this->Attraction_Category_Model->from_form()->insert();

            if ($id === FALSE) {
                $this->session->set_flashdata('error', validation_errors());
            } else {
                $sdata['message'] = 'Attraction Category added Successfully!';
                $flashdata = array(
                    'flashdata' => $sdata['message'],
                    'message_type' => 'success'
                );
                $this->session->set_userdata($flashdata);
                redirect('attraction/category', 'referesh');
            }
        }

        $data = array(
            'title' => 'Add Attraction Category',
            'list_heading' => 'Add Attraction Category',
            'category_data' => $categoryByID,
        );

        $this->template->load('admin/base', 'Attraction/add_attraction_category', $data);
    }

}
