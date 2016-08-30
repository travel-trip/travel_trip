<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data = array(
            'title' => 'Dashboard',
        );
        $this->template->load('admin/base', 'landing_page', $data);
    }

}
