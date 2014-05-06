<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class index extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $session = $this->session->userdata('admin_session');
        if (!empty($session) && $session->type == 'admission') {
            redirect(base_url() . 'admission', 'refresh');
        } else {
            redirect(base_url() . 'login', 'refresh');
        }
    }

}
