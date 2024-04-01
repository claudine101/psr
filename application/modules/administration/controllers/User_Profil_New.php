<?php
class User_Profil_New extends CI_Controller
{
   function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data['error']='';
    $this->load->view('User_Profil_New_View',$data);
  }
  
  public function add_profil()
  {
    $this->form_validation->set_rules('PROFIL_DESCR','','trim|required|is_unique[admin_profil.PROFIL_DESCR]',array('required'=>'<font style="color:red;font-size:15px;">*Ce champs est obligatoire</font>','is_unique'=>'<font style="color:red;font-size:15px;">*Le profile doit être unique</font>'));
    $this->form_validation->set_rules('PROFIL_CODE','','trim|required|is_unique[admin_profil.PROFIL_CODE]',array('required'=>'<font style="color:red;font-size:15px;">*Ce champs est obligatoire</font>','is_unique'=>'<font style="color:red;font-size:15px;">*Le code doit être unique</font>'));
    if ($this->form_validation->run()==TRUE)
    {
      if ($this->input->post('PROFILS')==null && $this->input->post('UTILISATEURS')==null && $this->input->post('PILIER')==null && $this->input->post('SOURCE_COLLECTE')==null&& $this->input->post('UNITE_MESURE')==null && $this->input->post('BENEFICIAIRE')==null && $this->input->post('INTERVENANT')==null && $this->input->post('PROJET')==null && $this->input->post('ACTIVITES')==null && $this->input->post('TACHES')==null && $this->input->post('AFFECTATIONS')==null && $this->input->post('COLLABORATEUR')==null && $this->input->post('ENQUETEURS')==null && $this->input->post('LOGISTIQUE')==null && $this->input->post('INCIDENT')==null && $this->input->post('CENTRE_SITUATION')==null && $this->input->post('CARTE_BENEFICIAIRE')==null && $this->input->post('CARTE_PERIMETRE_INTERVENTION')==null && $this->input->post('PRODUITS_DISPONIBLES')==null && $this->input->post('TDB_BENEFICIAIRES')==null && $this->input->post('TDB_COOPERATIVES')==null && $this->input->post('TDB_PROJETS')==null && $this->input->post('TDB_ACTIVITES')==null && $this->input->post('TDB_FORMATIONS')==null && $this->input->post('TDB_INCIDENTS')==null && $this->input->post('RA_EVOLUTION_JOURNALIERE')==null && $this->input->post('NOTIFICATIONS')==null && $this->input->post('MESSAGERIE')==null && $this->input->post('COMPTABILITE')==null && $this->input->post('ARCHIVAGE')==null)
      {
        $data['error']='<font style="color:red;font-size:15px;">Choisir d\'abord le droit</font>';
        $this->load->view('User_Profil_New_View',$data);
      }
      else
      {
        if($this->input->post('TACHES')!=null) 
        {$TACHES=1;}else{$TACHES=0;}

        if($this->input->post('PILIER')!=null) 
        {$PILIER=1;}else{$PILIER=0;}

        if($this->input->post('PROJET')!=null) 
        {$PROJET=1;}else{$PROJET=0;}

        if($this->input->post('PROFILS')!=null)
        {$PROFILS=1;}else{$PROFILS=0;}

        if($this->input->post('INCIDENT')!=null)
        {$INCIDENT=1;}else{$INCIDENT=0;}

        if($this->input->post('ACTIVITES')!=null)
        {$ACTIVITES=1;}else{$ACTIVITES=0;}

        if($this->input->post('ENQUETEURS')!=null)
        {$ENQUETEURS=1;}else{$ENQUETEURS=0;}

        if($this->input->post('LOGISTIQUE')!=null)
        {$LOGISTIQUE=1;}else{$LOGISTIQUE=0;}

        if($this->input->post('INTERVENANT')!=null)
        {$INTERVENANT=1;}else{$INTERVENANT=0;}

        if($this->input->post('AFFECTATIONS')!=null)
        {$AFFECTATIONS=1;}else{$AFFECTATIONS=0;}

        if($this->input->post('BENEFICIAIRE')!=null)
        {$BENEFICIAIRE=1;}else{$BENEFICIAIRE=0;}

        if($this->input->post('UTILISATEURS')!=null)
        {$UTILISATEURS=1;}else{$UTILISATEURS=0;}

        if($this->input->post('COLLABORATEUR')!=null)
        {$COLLABORATEUR=1;}else{$COLLABORATEUR=0;}

        if($this->input->post('UNITE_MESURE')!=null)
        {$UNITE_MESURE=1;}else{$UNITE_MESURE=0;}

        if($this->input->post('SOURCE_COLLECTE')!=null)
        {$SOURCE_COLLECTE=1;}else{$SOURCE_COLLECTE=0;}

        if($this->input->post('ARCHIVAGE')!=null)
        {$ARCHIVAGE=1;}else{$ARCHIVAGE=0;}

        if($this->input->post('MESSAGERIE')!=null)
        {$MESSAGERIE=1;}else{$MESSAGERIE=0;}

        if($this->input->post('COMPTABILITE')!=null)
        {$COMPTABILITE=1;}else{$COMPTABILITE=0;}

        if($this->input->post('NOTIFICATIONS')!=null)
        {$NOTIFICATIONS=1;}else{$NOTIFICATIONS=0;}

        if($this->input->post('TDB_PROJETS')!=null)
        {$TDB_PROJETS=1;}else{$TDB_PROJETS=0;}

        if($this->input->post('CENTRE_SITUATION')!=null)
        {$CENTRE_SITUATION=1;}else{$CENTRE_SITUATION=0;}

        if($this->input->post('TDB_INCIDENTS')!=null)
        {$TDB_INCIDENTS=1;}else{$TDB_INCIDENTS=0;}

        if($this->input->post('TDB_ACTIVITES')!=null)
        {$TDB_ACTIVITES=1;}else{$TDB_ACTIVITES=0;}

        if($this->input->post('TDB_FORMATIONS')!=null)
        {$TDB_FORMATIONS=1;}else{$TDB_FORMATIONS=0;}

        if($this->input->post('PRODUITS_DISPONIBLES')!=null)
        {$PRODUITS_DISPONIBLES=1;}else{$PRODUITS_DISPONIBLES=0;}

        if($this->input->post('CARTE_BENEFICIAIRE')!=null)
        {$CARTE_BENEFICIAIRE=1;}else{$CARTE_BENEFICIAIRE=0;}

        if($this->input->post('TDB_COOPERATIVES')!=null)
        {$TDB_COOPERATIVES=1;}else{$TDB_COOPERATIVES=0;}

        if($this->input->post('TDB_BENEFICIAIRES')!=null)
        {$TDB_BENEFICIAIRES=1;}else{$TDB_BENEFICIAIRES=0;}

        if($this->input->post('RA_EVOLUTION_JOURNALIERE')!=null)
        {$RA_EVOLUTION_JOURNALIERE=1;}else{$RA_EVOLUTION_JOURNALIERE=0;}

        if($this->input->post('CARTE_PERIMETRE_INTERVENTION')!=null)
        {$CARTE_PERIMETRE_INTERVENTION=1;}else{$CARTE_PERIMETRE_INTERVENTION=0;}
  
         $data= array(
                'PROFIL_DESCR' =>$this->input->post('PROFIL_DESCR'),
                'PROFIL_CODE' =>$this->input->post('PROFIL_CODE'),
                'TACHES'=>$TACHES,
                'PILIER'=>$PILIER,
                'PROJET'=>$PROJET,
                'PROFILS'=>$PROFILS,
                'INCIDENT'=>$INCIDENT,
                'ACTIVITES'=>$ACTIVITES,
                'ENQUETEURS'=>$ENQUETEURS,
                'LOGISTIQUE'=>$LOGISTIQUE,
                'INTERVENANT'=>$INTERVENANT,
                'AFFECTATIONS'=>$AFFECTATIONS,
                'BENEFICIAIRE'=>$BENEFICIAIRE,
                'UTILISATEURS'=>$UTILISATEURS,
                'COLLABORATEUR'=>$COLLABORATEUR,
                'UNITE_MESURE'=>$UNITE_MESURE,
                'SOURCE_COLLECTE'=>$SOURCE_COLLECTE,
                'ARCHIVAGE'=>$ARCHIVAGE,
                'MESSAGERIE'=>$MESSAGERIE,
                'COMPTABILITE'=>$COMPTABILITE,
                'NOTIFICATIONS'=>$NOTIFICATIONS,
                'TDB_PROJETS'=>$TDB_PROJETS,
                'CENTRE_SITUATION'=>$CENTRE_SITUATION,
                'TDB_INCIDENTS'=>$TDB_INCIDENTS,
                'TDB_ACTIVITES'=>$TDB_ACTIVITES,
                'TDB_FORMATIONS'=>$TDB_FORMATIONS,
                'PRODUITS_DISPONIBLES'=>$PRODUITS_DISPONIBLES,
                'CARTE_BENEFICIAIRE'=>$CARTE_BENEFICIAIRE,
                'TDB_COOPERATIVES'=>$TDB_COOPERATIVES,
                'TDB_BENEFICIAIRES'=>$TDB_BENEFICIAIRES,
                'RA_EVOLUTION_JOURNALIERE'=>$RA_EVOLUTION_JOURNALIERE,
                'CARTE_PERIMETRE_INTERVENTION'=>$CARTE_PERIMETRE_INTERVENTION
              );
         $creation=$this->Model->create('admin_profil',$data);
         $message['sms']='<div class="alert alert-success text-center" id="message">Attribution des droits se fait avec succès'.$this->input->post('PROFIL_DESCR').'</div>';
         $this->session->set_flashdata($message);
        redirect(base_url('administration/User_Profil_New/listing'));
      }
    }
    else
    {
      $data['error']='';
      $this->load->view('User_Profil_New_View',$data);
    }
  }

  function listing()
  {
    $sql="SELECT * FROM admin_profil";
    $profil = $this->Model->getRequete($sql);

    $data_array = array();
    foreach ($profil as $key) {
      // code...
      $sub_array = array();
      $sub_array[] = $key['PROFIL_DESCR'];
      $sub_array[] = $key['PROFIL_CODE'];
      $sub_array[] = $this->get_icon($key['PROFILS']);
      $sub_array[] = $this->get_icon($key['UTILISATEURS']);
      $sub_array[] = $this->get_icon($key['PILIER']);
      $sub_array[] = $this->get_icon($key['SOURCE_COLLECTE']);
      $sub_array[] = $this->get_icon($key['UNITE_MESURE']);
      $sub_array[] = $this->get_icon($key['BENEFICIAIRE']);
      $sub_array[] = $this->get_icon($key['INTERVENANT']);
      $sub_array[] = $this->get_icon($key['PROJET']);
      $sub_array[] = $this->get_icon($key['ACTIVITES']);
      $sub_array[] = $this->get_icon($key['TACHES']);
      $sub_array[] = $this->get_icon($key['AFFECTATIONS']);
      $sub_array[] = $this->get_icon($key['COLLABORATEUR']);
      $sub_array[] = $this->get_icon($key['ENQUETEURS']);
      $sub_array[] = $this->get_icon($key['LOGISTIQUE']);
      $sub_array[] = $this->get_icon($key['INCIDENT']);
      $sub_array[] = $this->get_icon($key['CENTRE_SITUATION']);
      $sub_array[] = $this->get_icon($key['CARTE_BENEFICIAIRE']);
      $sub_array[] = $this->get_icon($key['CARTE_PERIMETRE_INTERVENTION']);
      $sub_array[] = $this->get_icon($key['PRODUITS_DISPONIBLES']);
      $sub_array[] = $this->get_icon($key['TDB_BENEFICIAIRES']);
      $sub_array[] = $this->get_icon($key['TDB_COOPERATIVES']);
      $sub_array[] = $this->get_icon($key['TDB_PROJETS']);
      $sub_array[] = $this->get_icon($key['TDB_ACTIVITES']);
      $sub_array[] = $this->get_icon($key['TDB_FORMATIONS']);
      $sub_array[] = $this->get_icon($key['TDB_FORMATIONS']);
      $sub_array[] = $this->get_icon($key['NOTIFICATIONS']);
      $sub_array[] = $this->get_icon($key['MESSAGERIE']);
      $sub_array[] = $this->get_icon($key['COMPTABILITE']);
      $sub_array[] = $this->get_icon($key['ARCHIVAGE']);

      $sub_array['OPTIONS'] = '<div class="dropdown" style="color:#fff;">
                       <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog">
                           </i> Options  <span class="caret"></span>
                       </a> 
               <ul class="dropdown-menu dropdown-menu-left">';
      $sub_array['OPTIONS'] .="<li><a href='".base_url('administration/User_Profil_New/editer/').$key['PROFIL_ID'] ."'><label class='text-info'>Modifier</label></a></li>";
      $sub_array['OPTIONS'] .="<li><a href='#' data-toggle='modal' data-target='#mydelete".$key['PROFIL_ID']."'><label class='text-danger'>Supprimer</label></a></li>";


       $sub_array['OPTIONS'] .= " </ul>
       </div>
       <div class='modal fade' id='mydelete".$key['PROFIL_ID']."'>
         <div class='modal-dialog'>
           <div class='modal-content'>

             <div class='modal-body'>
               <center>
               <h5><strong>VOULEZ-VOUS SUPPRIMER L'INTERVENANT </strong> : <b style:'background-color:prink';>
               <i style='color:green;'>" . $key['PROFIL_DESCR'] ."</i></b> ?
               </h5>
               </center>
             </div>

             <div class='modal-footer'>
               <a class='btn btn-danger btn-md' href='" . base_url('administration/User_Profil_New/delete/').$key['PROFIL_ID'] . "'>Supprimer
               </a>
               <button class='btn btn-default btn-md' data-dismiss='modal'>
               Quitter
               </button>
             </div>

           </div>
         </div>
       </div>";
      //  $sub_array['OPTIONS'] .= " <div class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel' aria-hidden='true' id='mydetail" . $key['PROFIL_ID'] ."'>

      // <div class='modal-dialog modal-lg'>
      // <div class='modal-content'>

      // <div class='modal-body'>
      // <h5><center>Detail du profil <b>". $key['PROFIL_DESCR'] ."</b></center> </h5>".$detail."
      // </div>

      // <div class='modal-footer'>

      // <button class='btn btn-primary' class='close' data-dismiss='modal'>Quitter</button>
      // </div>

      // </div>
      // </div>
      // </div>";




      $data_array[] = $sub_array;

    }
    
    $template = array(
      'table_open' => '<table id="mytable" class="table table-striped  table-responsive ">',
      'table_close' => '</table>'
    );
    $this->table->set_template($template);
    $this->table->set_heading(array('DESCRIPTION','CODE','PROFIL','UTILISATEUR','PILIER','S_COLLECTE','U_MESURE','BENEFICIAIRE','INTERVENANT','PROJET','ACTIVITE','TACHE','AFFECTATION','COLLABORATEUR','ENQUETEUR','LOGISTIQUE','INCIDENT','C_SITUATION','C_BENEFICIAIRE','C_PERIMETRE D\'INTERVATION','PRODUIT DISPONIBLE','T_BENEFICIAIRE','T_COOPERATIVE','T_PROJET','T_ACTIVITE','T_FORMATION','E_JOURNALIERE','NOTIFICATION','MESSAGE','COMPTABILITE','ARCHIVAGE','ACTIONS'));
    $data['data']=$data_array;
    $data['title'] = "LISTE DES UTILISATEURS ET LEURS DROITS";
    $this->load->view('User_Profil_List_New_View',$data);
    }



  function get_icon($droit)
  {
    $html = ($droit == 1) ? '<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>' : '<a class = "btn btn-danger btn-sm" style="float:right"><span class = "fa fa-ban" ></span></a>' ;
    return $html;
  }
  
  public function delete()
  {
    $PROFIL_ID=$this->uri->segment(4);
    $delete=$this->Model->delete('admin_profil',array('PROFIL_ID'=>$PROFIL_ID));
    if ($delete)
    {
      $message['message']='<div class="alert alert-success text-center" id="message">La suppression d\'un utilisateur a été bien faite avec succès</div>';
        $this->session->set_flashdata($message);
        redirect(base_url('administration/User_Profil_New/listing'));
      
    }
    else
    {
      $message['message']='<div class="alert alert-success text-center" id="message">La suppression d\'un utilisateur a échouée </div>';
        $this->session->set_flashdata($message);
        
    }
    redirect(base_url('administration/User_Profil_New/listing'));
  }

  public function editer()
  {
    $data['error']='';
    $PROFIL_ID=$this->uri->segment(4);
    $data['profilo']=$this->Model->getOne('admin_profil',array('PROFIL_ID'=>$PROFIL_ID));
    //print_r($data['profilo']);
    $this->load->view('User_Profil_Update_New_View',$data);
  }
  public function update_profile()
  {
    $this->form_validation->set_rules('PROFIL_DESCR','','required|trim',array('required'=>'<font style="color:red;font-size:15px;">*Ce champs ne peut pas être vide</font>'));
    $this->form_validation->set_rules('PROFIL_CODE','','trim|required',array('required'=>'<font style="color:red;font-size:15px;">*Ce champs est obligatoire</font>'));
    if ($this->form_validation->run()==TRUE) 
    {
      if($this->input->post('PROFILS')==null && $this->input->post('UTILISATEURS')==null && $this->input->post('PILIER')==null && $this->input->post('SOURCE_COLLECTE')==null&& $this->input->post('UNITE_MESURE')==null && $this->input->post('BENEFICIAIRE')==null && $this->input->post('INTERVENANT')==null && $this->input->post('PROJET')==null && $this->input->post('ACTIVITES')==null && $this->input->post('TACHES')==null && $this->input->post('AFFECTATIONS')==null && $this->input->post('COLLABORATEUR')==null && $this->input->post('ENQUETEURS')==null && $this->input->post('LOGISTIQUE')==null && $this->input->post('INCIDENT')==null && $this->input->post('CENTRE_SITUATION')==null && $this->input->post('CARTE_BENEFICIAIRE')==null && $this->input->post('CARTE_PERIMETRE_INTERVENTION')==null && $this->input->post('PRODUITS_DISPONIBLES')==null && $this->input->post('TDB_BENEFICIAIRES')==null && $this->input->post('TDB_COOPERATIVES')==null && $this->input->post('TDB_PROJETS')==null && $this->input->post('TDB_ACTIVITES')==null && $this->input->post('TDB_FORMATIONS')==null && $this->input->post('TDB_INCIDENTS')==null && $this->input->post('RA_EVOLUTION_JOURNALIERE')==null && $this->input->post('NOTIFICATIONS')==null && $this->input->post('MESSAGERIE')==null && $this->input->post('COMPTABILITE')==null && $this->input->post('ARCHIVAGE')==null)
      {
        $data['error']='';
        $data['profilo']=$this->Model->getOne('admin_profil',array('PROFIL_ID'=>$this->input->post('PROFIL_ID')));
        $this->load->view('User_Profil_Update_New_View',$data);
        // $this->load->view('Profile_update_view',$data);
      }
      else
      {
        if($this->input->post('TACHES')!=null) 
        {$TACHES=1;}else{$TACHES=0;}

        if($this->input->post('PILIER')!=null) 
        {$PILIER=1;}else{$PILIER=0;}

        if($this->input->post('PROJET')!=null) 
        {$PROJET=1;}else{$PROJET=0;}

        if($this->input->post('PROFILS')!=null)
        {$PROFILS=1;}else{$PROFILS=0;}

        if($this->input->post('INCIDENT')!=null)
        {$INCIDENT=1;}else{$INCIDENT=0;}

        if($this->input->post('ACTIVITES')!=null)
        {$ACTIVITES=1;}else{$ACTIVITES=0;}

        if($this->input->post('ENQUETEURS')!=null)
        {$ENQUETEURS=1;}else{$ENQUETEURS=0;}

        if($this->input->post('LOGISTIQUE')!=null)
        {$LOGISTIQUE=1;}else{$LOGISTIQUE=0;}

        if($this->input->post('INTERVENANT')!=null)
        {$INTERVENANT=1;}else{$INTERVENANT=0;}

        if($this->input->post('AFFECTATIONS')!=null)
        {$AFFECTATIONS=1;}else{$AFFECTATIONS=0;}

        if($this->input->post('BENEFICIAIRE')!=null)
        {$BENEFICIAIRE=1;}else{$BENEFICIAIRE=0;}

        if($this->input->post('UTILISATEURS')!=null)
        {$UTILISATEURS=1;}else{$UTILISATEURS=0;}

        if($this->input->post('COLLABORATEUR')!=null)
        {$COLLABORATEUR=1;}else{$COLLABORATEUR=0;}

        if($this->input->post('UNITE_MESURE')!=null)
        {$UNITE_MESURE=1;}else{$UNITE_MESURE=0;}

        if($this->input->post('SOURCE_COLLECTE')!=null)
        {$SOURCE_COLLECTE=1;}else{$SOURCE_COLLECTE=0;}

        if($this->input->post('ARCHIVAGE')!=null)
        {$ARCHIVAGE=1;}else{$ARCHIVAGE=0;}

        if($this->input->post('MESSAGERIE')!=null)
        {$MESSAGERIE=1;}else{$MESSAGERIE=0;}

        if($this->input->post('COMPTABILITE')!=null)
        {$COMPTABILITE=1;}else{$COMPTABILITE=0;}

        if($this->input->post('NOTIFICATIONS')!=null)
        {$NOTIFICATIONS=1;}else{$NOTIFICATIONS=0;}

        if($this->input->post('TDB_PROJETS')!=null)
        {$TDB_PROJETS=1;}else{$TDB_PROJETS=0;}

        if($this->input->post('CENTRE_SITUATION')!=null)
        {$CENTRE_SITUATION=1;}else{$CENTRE_SITUATION=0;}

        if($this->input->post('TDB_INCIDENTS')!=null)
        {$TDB_INCIDENTS=1;}else{$TDB_INCIDENTS=0;}

        if($this->input->post('TDB_ACTIVITES')!=null)
        {$TDB_ACTIVITES=1;}else{$TDB_ACTIVITES=0;}

        if($this->input->post('TDB_FORMATIONS')!=null)
        {$TDB_FORMATIONS=1;}else{$TDB_FORMATIONS=0;}

        if($this->input->post('PRODUITS_DISPONIBLES')!=null)
        {$PRODUITS_DISPONIBLES=1;}else{$PRODUITS_DISPONIBLES=0;}

        if($this->input->post('CARTE_BENEFICIAIRE')!=null)
        {$CARTE_BENEFICIAIRE=1;}else{$CARTE_BENEFICIAIRE=0;}

        if($this->input->post('TDB_COOPERATIVES')!=null)
        {$TDB_COOPERATIVES=1;}else{$TDB_COOPERATIVES=0;}

        if($this->input->post('TDB_BENEFICIAIRES')!=null)
        {$TDB_BENEFICIAIRES=1;}else{$TDB_BENEFICIAIRES=0;}

        if($this->input->post('RA_EVOLUTION_JOURNALIERE')!=null)
        {$RA_EVOLUTION_JOURNALIERE=1;}else{$RA_EVOLUTION_JOURNALIERE=0;}

        if($this->input->post('CARTE_PERIMETRE_INTERVENTION')!=null)
        {$CARTE_PERIMETRE_INTERVENTION=1;}else{$CARTE_PERIMETRE_INTERVENTION=0;}
  
         $data1= array(
                'PROFIL_DESCR' =>$this->input->post('PROFIL_DESCR'),
                'PROFIL_CODE' =>$this->input->post('PROFIL_CODE'),
                'TACHES'=>$TACHES,
                'PILIER'=>$PILIER,
                'PROJET'=>$PROJET,
                'PROFILS'=>$PROFILS,
                'INCIDENT'=>$INCIDENT,
                'ACTIVITES'=>$ACTIVITES,
                'ENQUETEURS'=>$ENQUETEURS,
                'LOGISTIQUE'=>$LOGISTIQUE,
                'INTERVENANT'=>$INTERVENANT,
                'AFFECTATIONS'=>$AFFECTATIONS,
                'BENEFICIAIRE'=>$BENEFICIAIRE,
                'UTILISATEURS'=>$UTILISATEURS,
                'COLLABORATEUR'=>$COLLABORATEUR,
                'UNITE_MESURE'=>$UNITE_MESURE,
                'SOURCE_COLLECTE'=>$SOURCE_COLLECTE,
                'ARCHIVAGE'=>$ARCHIVAGE,
                'MESSAGERIE'=>$MESSAGERIE,
                'COMPTABILITE'=>$COMPTABILITE,
                'NOTIFICATIONS'=>$NOTIFICATIONS,
                'TDB_PROJETS'=>$TDB_PROJETS,
                'CENTRE_SITUATION'=>$CENTRE_SITUATION,
                'TDB_INCIDENTS'=>$TDB_INCIDENTS,
                'TDB_ACTIVITES'=>$TDB_ACTIVITES,
                'TDB_FORMATIONS'=>$TDB_FORMATIONS,
                'PRODUITS_DISPONIBLES'=>$PRODUITS_DISPONIBLES,
                'CARTE_BENEFICIAIRE'=>$CARTE_BENEFICIAIRE,
                'TDB_COOPERATIVES'=>$TDB_COOPERATIVES,
                'TDB_BENEFICIAIRES'=>$TDB_BENEFICIAIRES,
                'RA_EVOLUTION_JOURNALIERE'=>$RA_EVOLUTION_JOURNALIERE,
                'CARTE_PERIMETRE_INTERVENTION'=>$CARTE_PERIMETRE_INTERVENTION
              );
          $condition=$this->Model->getOne('admin_profil',array('PROFIL_ID'=>$this->input->post('PROFIL_ID')));
          $update=$this->Model->update('admin_profil',array('PROFIL_ID'=>$this->input->post('PROFIL_ID')), $data1);
          //print_r($this->input->post('PROFIL_ID'));exit();
          if ($update) 
          {
            $message['message']='<div class="alert alert-success text-center" id="message">La modification '.$this->input->post('PROFIL_DESCR').' a réussie avec succès</div>';
                $this->session->set_flashdata($message);
                redirect(base_url('administration/User_Profil_New/listing'));
          }
          else
          {
            $message['message']='<div class="alert alert-success text-center" id="message">La modification '.$this->input->post('PROFIL_DESCR').' a échouée</div>';
                $this->session->set_flashdata($message);
                redirect(base_url('administration/User_Profil_New/listing'));

          }
          

      }

    }
    else
    {
      $message['message']='<div class="alert alert-success text-center" id="message">La suppression '.$this->input->post('PROFIL_DESCR').' a échouée</div>';
      $this->session->set_flashdata($message);
      $data['error']='';
      $data['profilo']=$this->Model->getOne('admin_profil',array('PROFIL_ID'=>$this->input->post('PROFIL_ID')));
      $this->load->view('User_Profil_Update_New_View',$data);
    }
  }

}

?>