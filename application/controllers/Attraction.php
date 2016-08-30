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
        $insertedArray = array();

        if (!empty($_POST)) {
            $data = $this->input->post();
            $name = !empty($data['name']) ? $data['name'] : '';
            $slug = url_title($name, 'dash', true);
            $data['slug'] = $slug;

            $insertedArray = !empty($data) ? $data : null;

            if (!empty($_FILES['attraction_image']['tmp_name'][0])) {
//                dump($_FILES);die;
                $files = $_FILES;
                $images = array();

                $cpt = count($_FILES['attraction_image']['name']);

                $config['upload_path'] = $this->attractionImageDir;
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_width'] = 400;
                $config['max_height'] = 400;
                $this->load->library('upload', $config);
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['attraction_image']['name'] = $files['attraction_image']['name'][$i];
                    $_FILES['attraction_image']['type'] = $files['attraction_image']['type'][$i];
                    $_FILES['attraction_image']['tmp_name'] = $files['attraction_image']['tmp_name'][$i];
                    $_FILES['attraction_image']['error'] = $files['attraction_image']['error'][$i];
                    $_FILES['attraction_image']['size'] = $files['attraction_image']['size'][$i];

                    if (!$this->upload->do_upload('attraction_image')) {
                        setMessage($this->upload->display_errors(),'warning');
                        redirect('attraction/addAttraction');
                       
                    } else {
                        $upload_data = $this->upload->data();
                       
                    }

                    $images[] = $_FILES['attraction_image']['name'];
                }

                $fileName = implode(',', $images);
                $insertedArray['image'] = '{' . $fileName . '}';
            }

            try {

                $insert = $this->Attraction_Model->insert($insertedArray, FALSE);
                if ($insert) {
                    setMessage('Attraction Added Successfully','success');
                    redirect('attraction', 'referesh');
                }
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
        $insertedArray = array();
        $imageData = '';
        if (!$at_id)
            return false;

        $attractionData = $this->Attraction_Model->get($at_id);
        $sql = 'SELECT unnest(image) AS Image from attraction where id =' . $at_id;
        $imageData = $this->db->query($sql)->result();

        if (!empty($imageData)) {
            $attractionData->images = $imageData;
        }

        $data = $this->input->post();
        if (!empty($data)) {
            try {

                $name = !empty($data['name']) ? $data['name'] : '';
                $slug = url_title($name, 'dash', true);
                $data['slug'] = $slug;

                $insertedArray = !empty($data) ? $data : null;

                /*                 * *******************Image upload******************* */
//                dump($_FILES);die;    
                if (!empty($_FILES['attraction_image']['size'][0]) && !empty($_FILES['attraction_image']['name'][0])) {
                    $files = $_FILES;
                    $images = array();

                    $cpt = count($_FILES['attraction_image']['name']);

                    $config['upload_path'] = $this->attractionImageDir;
                    $config['allowed_types'] = 'jpeg|jpg|png|ods';
                    $config['max_width'] = 300;
                    $config['max_height'] = 300;
                    $this->load->library('upload', $config);
                    for ($i = 0; $i < $cpt; $i++) {
                        $_FILES['attraction_image']['name'] = $files['attraction_image']['name'][$i];
                        $_FILES['attraction_image']['type'] = $files['attraction_image']['type'][$i];
                        $_FILES['attraction_image']['tmp_name'] = $files['attraction_image']['tmp_name'][$i];
                        $_FILES['attraction_image']['error'] = $files['attraction_image']['error'][$i];
                        $_FILES['attraction_image']['size'] = $files['attraction_image']['size'][$i];

                        if (!$this->upload->do_upload('attraction_image')) {
                           setMessage($this->upload->display_errors(),'warning');
                           redirect('edit/addAttraction/'.$at_id);
                        } else {
                           $images[] = $_FILES['attraction_image']['name'];
                        }
                        
                    }

                    $fileName = implode(',', $images);
                    $insertedArray['image'] = '{' . $fileName . '}';
                } else {
                    unset($insertedArray['image']);
                }
                $update = $this->Attraction_Model->update($insertedArray, $at_id);
                if ($update) {
                    $sdata['message'] = 'Attration Added!';
                    $flashdata = array(
                        'flashdata' => $sdata['message'],
                        'message_type' => 'success'
                    );
                    $this->session->set_userdata($flashdata);
                    redirect('attraction', 'referesh');
                }
            } catch (Exception $ex) {
                log_message('error', date('Y-m-d H:i:s') . '->' . $ex->getMessage());
                $sdata['message'] = 'Category not added! Something went wrong';
                $flashdata = array(
                    'flashdata' => $sdata['message'],
                    'message_type' => 'error'
                );
                $this->session->set_userdata($flashdata);
            }
        }

        $att_category = $this->Attraction_Category_Model->fields('id,name')->get_all();
        $data = array(
            'title' => 'Update Attraction',
            'EDIT_DATA' => $attractionData,
            'attraction_category' => $att_category,
        );
        $this->template->load('admin/base', 'Attraction/edit', $data);
    }

    /*     * ***************************************Attraction Category Management***************************** */

    /**
     * @meathod category - List category of attraction.
     * @param N/A
     * @description - Fetches all attraction category listing.
     * @return NULL
     */
    function category() {
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
