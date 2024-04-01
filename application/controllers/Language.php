<?php


class Language extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
      
      $array_session_language = array('site_lang' => $this->uri->segment(3));
     // $array_session_language = array('site_lang' => 'french');

      $this->session->set_userdata($array_session_language);

      redirect(base_url());
    }

  }

?>