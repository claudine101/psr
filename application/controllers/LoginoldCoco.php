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

    $droit = $this->Model->getRequeteOne('SELECT *  FROM droits WHERE PROFIL_ID="' . $user['PROFIL_ID'] . '" ');

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
          'POLICE_JUDICIAIRE' => $droit['POLICE_JUDICIAIRE'],
          'TRANSPORT' => $droit['TRANSPORT'],
          'PARAMETRE' => $droit['PARAMETRE'],
          'TB_PJ' => $droit['TB_PJ'],
          'TB_ASSURANCE' => $droit['TB_ASSURANCE'],
          'TB_IMMATRICULATION' => $droit['TB_IMMATRICULATION'],
          'TB_PERMIS' => $droit['TB_PERMIS'],
          'TB_CONTROLE_TECHNIQUE' => $droit['TB_CONTROLE_TECHNIQUE'],
          'TB_FINANCIER' => $droit['TB_FINANCIER'],
          'TB_AMANDE' => $droit['TB_AMANDE'],
          'TB_POLICE' => $droit['TB_POLICE'],
          'TB_SIGNALMENT' => $droit['TB_SIGNALMENT'],
          'TB_CONSTANT' => $droit['TB_CONSTANT'],
          'TB_CONTROLE_RAPIDE' => $droit['TB_CONTROLE_RAPIDE'],
          'TB_AUTRE_CONTROLE' => $droit['TB_AUTRE_CONTROLE'],
          'MAP_CENTRE_SITUATION' => $droit['MAP_CENTRE_SITUATION'],
          'MAP_AGENT_POLICE' => $droit['MAP_AGENT_POLICE'],
          'MAP_SIGNALEMENT' => $droit['SIGNALEMENT'],
          'CONFIGURATION_DATA' => $droit['CONFIGURATION_DATA'],
          'IHM' => $droit['IHM'],
          'RH_FONCTIONNAIRE' => $droit['RH_FONCTIONNAIRE'],
          'RH_POSTE' => $droit['RH_POSTE'],
          'RH_AFFECTATION' => $droit['RH_AFFECTATION'],
          'VERIFICATION' => $droit['VERIFICATION'],
          'SIGNALEMENT' => $droit['SIGNALEMENT'],
          'CONSTANT_SUR_CONTROLE' => $droit['CONSTANT_SUR_CONTROLE'],
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
          redirect(base_url('PSR/Validation_signalement/index'));
        }
        if ($this->session->userdata('VALIDATEUR') == 1) {
          redirect(base_url('PSR/Commentaire/index'));
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
