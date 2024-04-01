<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index($params = NULL)
  {

    if (!empty($this->session->userdata('NOM_UTILISATEUR'))) {
      redirect(base_url('PSR/Psr_elements/index'));
    } else {
      $datas['message'] = $params;
      $this->load->view('Login_View.php', $datas);
    }
  }
  public function do_login()
  {

    $login = $this->input->post('USER_NAME');
    $PASSWORD = $this->input->post('PASSWORD');

    $criteresmail['NOM_UTILISATEUR'] = $login;
    $criteresmail['MOT_DE_PASSE'] = $PASSWORD;

    $user = $this->Model->getRequeteOne('SELECT * FROM utilisateurs WHERE  NOM_UTILISATEUR="' . $login . '"');

    $droit = $this->Model->getRequeteOne('SELECT ID_DROIT, INFRACTION, PSR_ELEMENT, PEINES, AFFECTATION, PERMIS,DECLARATION, IMMATRICULATION, CONTROLE_TECHNIQUE, ASSURANCE,QUESTIONNAIRE,SIGNALEMENT,VALIDATEUR, PROFIL_ID FROM droits WHERE PROFIL_ID="' . $user['PROFIL_ID'] . '" ');

    //print_r($droit);die();

    if (!empty($user)) {

      if ($user['MOT_DE_PASSE'] == md5($PASSWORD)) {

        $session = array(
          'USER_ID' => $user['ID_UTILISATEUR'],
          'USER_NAME' => $user['NOM_UTILISATEUR'],
          'PROFIL_ID' => $user['PROFIL_ID'],
          'INFRACTION' => $droit['INFRACTION'],
          'PSR_ELEMENT' => $droit['PSR_ELEMENT'],
          'PEINES' => $droit['PEINES'],
          'AFFECTATION' => $droit['AFFECTATION'],
          'ID_INSTITUTION' => $user['ID_INSTITUTION'],
          'PERMIS' => $droit['PERMIS'],
          'DECLARATION' => $droit['DECLARATION'],
          'IMMATRICULATION' => $droit['IMMATRICULATION'],
          'CONTROLE_TECHNIQUE' => $droit['CONTROLE_TECHNIQUE'],
          'ASSURANCE' => $droit['ASSURANCE'],
          'QUESTIONNAIRE' => $droit['QUESTIONNAIRE'],
          'SIGNALEMENT' => $droit['SIGNALEMENT'],
          'VALIDATEUR' => $droit['VALIDATEUR'],
        );

        $this->session->set_userdata($session);


        if ($this->session->userdata('PSR_ELEMENT') == 1) {
          redirect(base_url('PSR/Psr_elements/index'));
        }
        if ($this->session->userdata('PERMIS') == 1) {
          redirect(base_url('PSR/Chauffeur_permis/index'));
        }
        if ($this->session->userdata('DECLARATION') == 1) {
          redirect(base_url('PSR/Declaration_Vol/index'));
        }
        if ($this->session->userdata('IMMATRICULATION') == 1) {
          redirect(base_url('PSR/Obr_Immatriculation/index'));
        }
        if ($this->session->userdata('CONTROLE_TECHNIQUE') == 1) {
          redirect(base_url('PSR/Controle/index'));
        }
        if ($this->session->userdata('ASSURANCE') == 1) {
          redirect(base_url('PSR/Assurances/index'));
        }
        if ($this->session->userdata('QUESTIONNAIRE') == 1) {
          redirect(base_url('PSR/Autres_controles_questionnaires/index'));
        }
        if ($this->session->userdata('SIGNALEMENT') == 1) {
          redirect(base_url('PSR/Civil_alert/index'));
        }
        if ($this->session->userdata('VALIDATEUR') == 1) {
          redirect(base_url('PSR/Civil_alert/index'));
        }
      } else
        $message = "<center><span  id='erro_msg' style='color:red;font-size:12px'> Le nom d'utilisateur ou/et mot de passe incorect(s) !</span></center>";
    } else
      $message = "<center><span id='erro_msg' style='color:red;font-size:12px'>L'utilisateur n'existe pas/plus dans notre système informatique !</span></center>";
    $this->index($message);
  }

  public function do_logout()

  {

    $session = array(
      'USER_ID' => NULL,
      'USER_NAME' => NULL,
      'PROFIL_ID' => NULL,
      'INFRACTION' => NULL,
      'PSR_ELEMENT' => NULL,
      'PEINES' => NULL,
      'AFFECTATION' => NULL,
      'PERMIS' => NULL,
      'DECLARATION' => NULL,
      'IMMATRICULATION' => NULL,
      'CONTROLE_TECHNIQUE' => NULL,
      'ASSURANCE' => NULL,
      'QUESTIONNAIRE' => NULL,
      'SIGNALEMENT' => NULL,
      'VALIDATEUR' => NULL,
    );

    $this->session->set_userdata($session);
    redirect(base_url('index.php/Login'));
  }
}
