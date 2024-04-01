<?php
class User_Profil extends CI_Controller
{
   function __construct()
  {
    parent::__construct();
  }

  public function index()
  {

    $data['error']='';
    $data['title']='Ajout des droits et profils';
    $this->load->view('User_Profil_View',$data);

  }
  
  public function add_profil()
  {
    $this->form_validation->set_rules('PROFIL_DESCR','','trim|required|is_unique[user_profil.PROFIL_DESCR]',array('required'=>'<font style="color:red;font-size:15px;">*Ce champs est obligatoire</font>','is_unique'=>'<font style="color:red;font-size:15px;">*Le profile doit être unique</font>'));
    $this->form_validation->set_rules('PROFIL_CODE','','trim|required|is_unique[user_profil.PROFIL_CODE]',array('required'=>'<font style="color:red;font-size:15px;">*Ce champs est obligatoire</font>','is_unique'=>'<font style="color:red;font-size:15px;">*Le code doit être unique</font>'));
    if ($this->form_validation->run()==TRUE)
    {
     if ($this->input->post('ADMINISTRATION')==null && $this->input->post('DASHBOARD')==null && $this->input->post('RAPPORT')==null && $this->input->post('SIG')==null&& $this->input->post(' DONNEES')==null && $this->input->post('IHM')==null && $this->input->post('PARAMETRAGE')==null)
     {
       $data['error']='<font style="color:red;font-size:15px;">Choisir d\'abord le droit</font>';
       $this->load->view('User_Profil_View',$data);
     }
     else
     {
       if ($this->input->post('ADMINISTRATION')!=null) 
       {$ADMINISTRATION=1;}else{$ADMINISTRATION=0;}

      if ($this->input->post('DASHBOARD')!=null) 
       {$DASHBOARD=1;}else{$DASHBOARD=0;}

         if ($this->input->post('RAPPORT')!=null) 
         {$RAPPORT=1;}else{$RAPPORT=0;}

         if ($this->input->post('SIG')!=null)
         {$SIG=1;}else{$SIG=0;}
        if ($this->input->post('DONNEES')!=null)
         {$DONNEES=1;}else{$DONNEES=0;}
        if ($this->input->post('IHM')!=null)
         {$IHM=1;}else{$IHM=0;}
        if ($this->input->post('PARAMETRAGE')!=null)
         {$PARAMETRAGE=1;}else{$PARAMETRAGE=0;}

       $COLLABORATEUR = ($this->input->post('COLLABORATEUR')) ? 1 : 0 ;
       $SUIVI_EVALUATION = ($this->input->post('SUIVI_EVALUATION')) ? 1 : 0 ;
       $CRA = ($this->input->post('CRA')) ? 1 : 0 ;
       $E_COMMERCE = ($this->input->post('E_COMMERCE')) ? 1 : 0 ;
       $MESSAGERIE = ($this->input->post('MESSAGERIE')) ? 1 : 0 ;
       $NOTIFICATIONS = ($this->input->post('NOTIFICATIONS')) ? 1 : 0 ;
       $PROFILS = ($this->input->post('PROFILS')) ? 1 : 0 ;
       $UTILISATEURS = ($this->input->post('UTILISATEURS')) ? 1 : 0 ;
       $BAILLEUR = ($this->input->post('BAILLEUR')) ? 1 : 0 ;
       $BENEFICIAIRE = ($this->input->post('BENEFICIAIRE')) ? 1 : 0 ;
       $INDICATEUR = ($this->input->post('INDICATEUR')) ? 1 : 0 ;
       $INTERVENANT = ($this->input->post('INTERVENANT')) ? 1 : 0 ;
       $PILIER = ($this->input->post('PILIER')) ? 1 : 0 ;
       $PROJET = ($this->input->post('PROJET')) ? 1 : 0 ;
       $RESP_UNWOMAN = ($this->input->post('RESP_UNWOMAN')) ? 1 : 0 ;
       $SOURCE_COLLECTE = ($this->input->post('SOURCE_COLLECTE')) ? 1 : 0 ;
       $UNITE_MESURE = ($this->input->post('UNITE_MESURE')) ? 1 : 0 ;
       $AFFECTATIONS = ($this->input->post('AFFECTATIONS')) ? 1 : 0 ;
       $ACTIVITES = ($this->input->post('ACTIVITES')) ? 1 : 0 ;
       $TACHES = ($this->input->post('TACHES')) ? 1 : 0 ;
       $ENQUETEURS = ($this->input->post('ENQUETEURS')) ? 1 : 0 ;
       $SIG_BENEFICIAIRES = ($this->input->post('SIG_BENEFICIAIRES')) ? 1 : 0 ;
       $SIG_PERIMETRE_INTERVENTION = ($this->input->post('SIG_PERIMETRE_INTERVENTION')) ? 1 : 0 ;
       $PRODUITS_DISPONIBLES = ($this->input->post('PRODUITS_DISPONIBLES')) ? 1 : 0 ;
       $E_ARTICLE = ($this->input->post('E_ARTICLE')) ? 1 : 0 ;
       $E_CLIENT = ($this->input->post('E_CLIENT')) ? 1 : 0 ;
       $E_COMMANDE = ($this->input->post('E_COMMANDE')) ? 1 : 0 ;
       $TDB_BENEFICIAIRES = ($this->input->post('TDB_BENEFICIAIRES')) ? 1 : 0 ;
       $TDB_PROJETS = ($this->input->post('TDB_PROJETS')) ? 1 : 0 ;
       $TDB_ACTIVITES = ($this->input->post('TDB_ACTIVITES')) ? 1 : 0 ;
       $RA_EVOLUTION_JOURNALIERE = ($this->input->post('RA_EVOLUTION_JOURNALIERE')) ? 1 : 0 ;
       $EMAIL = ($this->input->post('EMAIL')) ? 1 : 0 ;
       $COMPTABILITE = ($this->input->post('COMPTABILITE')) ? 1 : 0 ;
       $ARCHIVAGE = ($this->input->post('ARCHIVAGE')) ? 1 : 0 ;
  
         $data= array(
                'PROFIL_DESCR' =>$this->input->post('PROFIL_DESCR'),
                'PROFIL_CODE' =>$this->input->post('PROFIL_CODE'),
                'ADMINISTRATION'=>$ADMINISTRATION,
                'DASHBOARD'=>$DASHBOARD,
                'RAPPORT'=>$RAPPORT,
                'SIG'=>$SIG,
                'DONNEES'=>$DONNEES,
                'IHM'=>$IHM,
                'COLLABORATEUR'=>$COLLABORATEUR,
                'SUIVI_EVALUATION'=>$SUIVI_EVALUATION,
                'CRA'=>$CRA,
                'E_COMMERCE'=>$E_COMMERCE,
                'MESSAGERIE'=>$MESSAGERIE,
                'NOTIFICATIONS'=>$NOTIFICATIONS,
                'PROFILS'=>$PROFILS,
                'UTILISATEURS'=>$UTILISATEURS,
                'BAILLEUR'=>$BAILLEUR,
                'INDICATEUR'=>$INDICATEUR,
                'INTERVENANT'=>$INTERVENANT,
                'PILIER'=>$PILIER,
                'RESP_UNWOMAN'=>$RESP_UNWOMAN,
                'SOURCE_COLLECTE'=>$SOURCE_COLLECTE,
                'UNITE_MESURE'=>$UNITE_MESURE,
                'AFFECTATIONS'=>$AFFECTATIONS,
                'ACTIVITES'=>$ACTIVITES,
                'TACHES'=>$TACHES,
                'ENQUETEURS'=>$ENQUETEURS,
                'SIG_BENEFICIAIRES'=>$SIG_BENEFICIAIRES,
                'SIG_PERIMETRE_INTERVENTION'=>$SIG_PERIMETRE_INTERVENTION,
                'PRODUITS_DISPONIBLES'=>$PRODUITS_DISPONIBLES,
                'E_ARTICLE'=>$E_ARTICLE,
                'E_CLIENT'=>$E_CLIENT,
                'E_COMMANDE'=>$E_COMMANDE,
                'TDB_BENEFICIAIRES'=>$TDB_BENEFICIAIRES,
                'TDB_PROJETS'=>$TDB_PROJETS,
                'TDB_ACTIVITES'=>$TDB_ACTIVITES,
                'RA_EVOLUTION_JOURNALIERE'=>$RA_EVOLUTION_JOURNALIERE,
                'EMAIL'=>$EMAIL,
                'COMPTABILITE'=>$COMPTABILITE,
                'ARCHIVAGE'=>$ARCHIVAGE
                     );
         $creation=$this->Model->create('user_profil',$data);
         $message['sms']='<div class="alert alert-success text-center" id="message">Attribution des droits se fait avec succès'.$this->input->post('PROFIL_DESCR').'</div>';
         $this->session->set_flashdata($message);
        redirect(base_url('administration/User_Profil/listing'));

     }
    }
    else
    {
     $data['error']='';
      $this->load->view('User_Profil_View',$data);
    }
  }

  function listing()
  {
    $sql="SELECT * FROM user_profil";
    $profil = $this->Model->getRequete($sql);

    $data_array = array();
    foreach ($profil as $key) {
      // code...
      $sub_array = array();
      $sub_array[] = $key['PROFIL_DESCR'];
      $sub_array[] = $key['PROFIL_CODE'];
      $sub_array[] = $this->get_icon($key['ADMINISTRATION']);
      $sub_array[] = $this->get_icon($key['DASHBOARD']);
      $sub_array[] = $this->get_icon($key['RAPPORT']);
      $sub_array[] = $this->get_icon($key['SIG']);
      $sub_array[] = $this->get_icon($key['DONNEES']);
      $sub_array[] = $this->get_icon($key['IHM']);
      $sub_array[] = $this->get_icon($key['PARAMETRAGE']);
      $sub_array[] = $this->get_icon($key['COLLABORATEUR']);
      $sub_array[] = $this->get_icon($key['SUIVI_EVALUATION']);
      $sub_array[] = $this->get_icon($key['CRA']);
      $sub_array[] = $this->get_icon($key['E_COMMERCE']);
      $sub_array[] = $this->get_icon($key['MESSAGERIE']);
      $sub_array[] = $this->get_icon($key['NOTIFICATIONS']);
      $sub_array[] = $this->get_icon($key['PROFILS']);
      $sub_array[] = $this->get_icon($key['UTILISATEURS']);
      $sub_array[] = $this->get_icon($key['BAILLEUR']);
      $sub_array[] = $this->get_icon($key['BENEFICIAIRE']);
      $sub_array[] = $this->get_icon($key['INDICATEUR']);
      $sub_array[] = $this->get_icon($key['INTERVENANT']);
      $sub_array[] = $this->get_icon($key['PILIER']);
      $sub_array[] = $this->get_icon($key['PROJET']);
      $sub_array[] = $this->get_icon($key['RESP_UNWOMAN']);
      $sub_array[] = $this->get_icon($key['SOURCE_COLLECTE']);
      $sub_array[] = $this->get_icon($key['UNITE_MESURE']);
      $sub_array[] = $this->get_icon($key['AFFECTATIONS']);
      $sub_array[] = $this->get_icon($key['ACTIVITES']);
      $sub_array[] = $this->get_icon($key['TACHES']);
      $sub_array[] = $this->get_icon($key['ENQUETEURS']);
      $sub_array[] = $this->get_icon($key['SIG_BENEFICIAIRES']);
      $sub_array[] = $this->get_icon($key['SIG_PERIMETRE_INTERVENTION']);
      $sub_array[] = $this->get_icon($key['PRODUITS_DISPONIBLES']);
      $sub_array[] = $this->get_icon($key['E_ARTICLE']);
      $sub_array[] = $this->get_icon($key['E_CLIENT']);
      $sub_array[] = $this->get_icon($key['E_COMMANDE']);
      $sub_array[] = $this->get_icon($key['TDB_BENEFICIAIRES']);
      $sub_array[] = $this->get_icon($key['TDB_COOPERATIVES']);
      $sub_array[] = $this->get_icon($key['TDB_PROJETS']);
      $sub_array[] = $this->get_icon($key['TDB_ACTIVITES']);
      $sub_array[] = $this->get_icon($key['RA_EVOLUTION_JOURNALIERE']);
      $sub_array[] = $this->get_icon($key['EMAIL']);
      $sub_array[] = $this->get_icon($key['COMPTABILITE']);
      $sub_array[] = $this->get_icon($key['ARCHIVAGE']);


      // $detail='<table class="table table-striped table-bordered table-responsive" width="100%" >
      
      

      // <tr>
      // <td>Activités(CRA) : <b>'.$this->get_icon($key['ACTIVITES']).'</b></td>
      // <td>Tâches(CRA) : <b>'.$this->get_icon($key['TACHES']).'</b></td> 
      // <td>Bénéficiaires(SIG) : <b>'.$this->get_icon($key['SIG_BENEFICIAIRES']).'</b></td>
      // <td>Périmètre d\'intervention(SIG) : <b>'.$this->get_icon($key['SIG_PERIMETRE_INTERVENTION']).'</b></td>
      // <td>Article(E-COM) : <b>'.$this->get_icon($key['E_ARTICLE']).'</b></td>
      // </tr>

      // <tr>
      // <td><a class="btn btn-primary" href="' .base_url('administration/User_Profil/editer/'. $key['PROFIL_ID']).'">&nbsp;&nbsp; <i class="fa fa-edit"> Modifier</a></td>

      // </tr>
      // </table>';  

      // $sub_array['DETAIL'] = '<a href="#" data-toggle="modal" data-target="#mydetail' .$key['PROFIL_ID']. '" class="btn btn-primary btn-rounded tooltip1"><center> <span class="tooltiptext1"><i class="fa fa-eye"></i></span> </center> </a>';



      $sub_array['OPTIONS'] = '<div class="dropdown" style="color:#fff;">
                       <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog">
                           </i> Options  <span class="caret"></span>
                       </a> 
               <ul class="dropdown-menu dropdown-menu-left">';
      $sub_array['OPTIONS'] .="<li><a href='".base_url('administration/User_Profil/editer/').$key['PROFIL_ID'] ."'><label class='text-info'>Modifier</label></a></li>";
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
               <a class='btn btn-danger btn-md' href='" . base_url('administration/User_Profil/delete/').$key['PROFIL_ID'] . "'>Supprimer
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
    $this->table->set_heading(array('PROFIL','CODE','ADMINISTRATION','TABLEAU DE BORD','RAPPORT','CARTOGRAPHIE','DONNEES','IHM','PARAMETRAGE','COLLABORATEUR','SUIVI ET EVALUATION','CRA','E-COMMERCE','MESSAGERIE','NOTIFICATIONS','PROFILS','UTILISATEURS','BAILLEUR','BENEFICIAIRES','INDICATEUR','INTERVENANT','PILIER','PROJET','RESPONSABLE UNWOMAN','SOURCE DE COLLECTE','UNITE DE MESURE','AFFECTATIONS','ACTIVITES','TACHES','ENQUETEURS','BENEFICIAIRES(SIG)','PERIMETRE D\'INTERVENTION','PRODUITS DISPONIBLES','ARTICLE','CLIENT','COMMANDE','BENEFICIAIRES(TDB)','COOPERATIVES(TDB)' ,'PROJETS(TDB)','ACTIVITES(TDB)','EVOLUTION JOURNALIERE(RAPPORT)','EMAIL','COMPTABILITE','ARCHIVAGE','ACTIONS'));
    $data['data']=$data_array;
    $data['title'] = "LISTE DES UTILISATEURS ET LEURS DROITS";
    $this->load->view('User_Profil_List_View',$data);
    }



  function get_icon($droit)
    {
      $html = ($droit == 1) ? '<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>' : '<a class = "btn btn-danger btn-sm" style="float:right"><span class = "fa fa-ban" ></span></a>' ;
      return $html;
    }
  
  public function delete()
  {
    $PROFIL_ID=$this->uri->segment(4);
    $delete=$this->Model->delete('user_profil',array('PROFIL_ID'=>$PROFIL_ID));
    if ($delete)
    {
      $message['message']='<div class="alert alert-success text-center" id="message">La suppression d\'un utilisateur a été bien faite avec succès</div>';
        $this->session->set_flashdata($message);
        redirect(base_url('administration/User_Profil/listing'));
      
    }
    else
    {
      $message['message']='<div class="alert alert-success text-center" id="message">La suppression d\'un utilisateur a échouée </div>';
        $this->session->set_flashdata($message);
        
    }
    redirect(base_url('administration/User_Profil/listing'));


  }
  public function editer()
  {
    $data['error']='';
    $data['title']= 'Modification des droits et profils';
    $PROFIL_ID=$this->uri->segment(4);
    $data['profilo']=$this->Model->getOne('user_profil',array('PROFIL_ID'=>$PROFIL_ID));
    //print_r($data['profilo']);
    $this->load->view('User_Profil_Update_View',$data);
  }
  public function update_profile()
  {
    
    $this->form_validation->set_rules('PROFIL_DESCR','','required|trim',array('required'=>'<font style="color:red;font-size:15px;">*Ce champs ne peut pas être vide</font>'));
    if ($this->form_validation->run()==TRUE) 
    {
      if ($this->input->post('ADMINISTRATION')==null && $this->input->post('DASHBOARD')==null && $this->input->post('RAPPORT')==null && $this->input->post('SIG')==null&& $this->input->post('DONNEES')==null && $this->input->post('IHM')==null && $this->input->post('PARAMETRAGE')==null)
      {
        $data['error']='';
        $data['profilo']=$this->Model->getOne('user_profil',array('PROFIL_ID'=>$this->input->post('PROFIL_ID')));
        $this->load->view('User_Profil_Update_View',$data);
        // $this->load->view('Profile_update_view',$data);
      }
      else
      {
        if ($this->input->post('ADMINISTRATION')!=null) 
       {$ADMINISTRATION=1;}else{$ADMINISTRATION=0;}

      if ($this->input->post('DASHBOARD')!=null) 
       {$DASHBOARD=1;}else{$DASHBOARD=0;}

         if ($this->input->post('RAPPORT')!=null) 
         {$RAPPORT=1;}else{$RAPPORT=0;}

         if ($this->input->post('SIG')!=null)
         {$SIG=1;}else{$SIG=0;}
        if ($this->input->post('DONNEES')!=null)
         {$DONNEES=1;}else{$DONNEES=0;}
        if ($this->input->post('IHM')!=null)
         {$IHM=1;}else{$IHM=0;}
        if ($this->input->post('PARAMETRAGE')!=null)
         {$PARAMETRAGE=1;}else{$PARAMETRAGE=0;}


       $COLLABORATEUR = ($this->input->post('COLLABORATEUR')) ? 1 : 0 ;
       $SUIVI_EVALUATION = ($this->input->post('SUIVI_EVALUATION')) ? 1 : 0 ;
       $CRA = ($this->input->post('CRA')) ? 1 : 0 ;
       $E_COMMERCE = ($this->input->post('E_COMMERCE')) ? 1 : 0 ;
       $MESSAGERIE = ($this->input->post('MESSAGERIE')) ? 1 : 0 ;
       $NOTIFICATIONS = ($this->input->post('NOTIFICATIONS')) ? 1 : 0 ;
       $PROFILS = ($this->input->post('PROFILS')) ? 1 : 0 ;
       $UTILISATEURS = ($this->input->post('UTILISATEURS')) ? 1 : 0 ;
       $BAILLEUR = ($this->input->post('BAILLEUR')) ? 1 : 0 ;
       $BENEFICIAIRE = ($this->input->post('BENEFICIAIRE')) ? 1 : 0 ;
       $INDICATEUR = ($this->input->post('INDICATEUR')) ? 1 : 0 ;
       $INTERVENANT = ($this->input->post('INTERVENANT')) ? 1 : 0 ;
       $PILIER = ($this->input->post('PILIER')) ? 1 : 0 ;
       $PROJET = ($this->input->post('PROJET')) ? 1 : 0 ;
       $RESP_UNWOMAN = ($this->input->post('RESP_UNWOMAN')) ? 1 : 0 ;
       $SOURCE_COLLECTE = ($this->input->post('SOURCE_COLLECTE')) ? 1 : 0 ;
       $UNITE_MESURE = ($this->input->post('UNITE_MESURE')) ? 1 : 0 ;
       $AFFECTATIONS = ($this->input->post('AFFECTATIONS')) ? 1 : 0 ;
       $ACTIVITES = ($this->input->post('ACTIVITES')) ? 1 : 0 ;
       $TACHES = ($this->input->post('TACHES')) ? 1 : 0 ;
       $ENQUETEURS = ($this->input->post('ENQUETEURS')) ? 1 : 0 ;
       $SIG_BENEFICIAIRES = ($this->input->post('SIG_BENEFICIAIRES')) ? 1 : 0 ;
       $SIG_PERIMETRE_INTERVENTION = ($this->input->post('SIG_PERIMETRE_INTERVENTION')) ? 1 : 0 ;
       $PRODUITS_DISPONIBLES = ($this->input->post('PRODUITS_DISPONIBLES')) ? 1 : 0 ;
       $E_ARTICLE = ($this->input->post('E_ARTICLE')) ? 1 : 0 ;
       $E_CLIENT = ($this->input->post('E_CLIENT')) ? 1 : 0 ;
       $E_COMMANDE = ($this->input->post('E_COMMANDE')) ? 1 : 0 ;
       $TDB_BENEFICIAIRES = ($this->input->post('TDB_BENEFICIAIRES')) ? 1 : 0 ;
       $TDB_PROJETS = ($this->input->post('TDB_PROJETS')) ? 1 : 0 ;
       $TDB_ACTIVITES = ($this->input->post('TDB_ACTIVITES')) ? 1 : 0 ;
       $RA_EVOLUTION_JOURNALIERE = ($this->input->post('RA_EVOLUTION_JOURNALIERE')) ? 1 : 0 ;
       $EMAIL = ($this->input->post('EMAIL')) ? 1 : 0 ;
       $COMPTABILITE = ($this->input->post('COMPTABILITE')) ? 1 : 0 ;
       $ARCHIVAGE = ($this->input->post('ARCHIVAGE')) ? 1 : 0 ;

          $data1= array(

                'PROFIL_DESCR' =>$this->input->post('PROFIL_DESCR'),
                'PROFIL_CODE' =>$this->input->post('PROFIL_CODE'),
                'ADMINISTRATION'=>$ADMINISTRATION,
                'DASHBOARD'=>$DASHBOARD,
                'RAPPORT'=>$RAPPORT,
                'SIG'=>$SIG,
                'DONNEES'=>$DONNEES,
                'IHM'=>$IHM,
                'COLLABORATEUR'=>$COLLABORATEUR,
                'SUIVI_EVALUATION'=>$SUIVI_EVALUATION,
                'CRA'=>$CRA,
                'E_COMMERCE'=>$E_COMMERCE,
                'MESSAGERIE'=>$MESSAGERIE,
                'NOTIFICATIONS'=>$NOTIFICATIONS,
                'PROFILS'=>$PROFILS,
                'UTILISATEURS'=>$UTILISATEURS,
                'BAILLEUR'=>$BAILLEUR,
                'INDICATEUR'=>$INDICATEUR,
                'INTERVENANT'=>$INTERVENANT,
                'PROJET'=>$PROJET,
                'PILIER'=>$PILIER,
                'RESP_UNWOMAN'=>$RESP_UNWOMAN,
                'SOURCE_COLLECTE'=>$SOURCE_COLLECTE,
                'UNITE_MESURE'=>$UNITE_MESURE,
                'AFFECTATIONS'=>$AFFECTATIONS,
                'ACTIVITES'=>$ACTIVITES,
                'TACHES'=>$TACHES,
                'ENQUETEURS'=>$ENQUETEURS,
                'SIG_BENEFICIAIRES'=>$SIG_BENEFICIAIRES,
                'SIG_PERIMETRE_INTERVENTION'=>$SIG_PERIMETRE_INTERVENTION,
                'PRODUITS_DISPONIBLES'=>$PRODUITS_DISPONIBLES,
                'E_ARTICLE'=>$E_ARTICLE,
                'E_CLIENT'=>$E_CLIENT,
                'E_COMMANDE'=>$E_COMMANDE,
                'TDB_BENEFICIAIRES'=>$TDB_BENEFICIAIRES,
                'TDB_PROJETS'=>$TDB_PROJETS,
                'TDB_ACTIVITES'=>$TDB_ACTIVITES,
                'RA_EVOLUTION_JOURNALIERE'=>$RA_EVOLUTION_JOURNALIERE,
                'EMAIL'=>$EMAIL,
                'COMPTABILITE'=>$COMPTABILITE,
                'ARCHIVAGE'=>$ARCHIVAGE
                      );
          $condition=$this->Model->getOne('user_profil',array('PROFIL_ID'=>$this->input->post('PROFIL_ID')));
          $update=$this->Model->update('user_profil',array('PROFIL_ID'=>$this->input->post('PROFIL_ID')), $data1);
          //print_r($this->input->post('PROFIL_ID'));exit();
          if ($update) 
          {
            $message['message']='<div class="alert alert-success text-center" id="message">La modification '.$this->input->post('PROFIL_DESCR').' a réussie avec succès</div>';
                $this->session->set_flashdata($message);
                redirect(base_url('administration/User_Profil/listing'));
          }
          else
          {
            $message['message']='<div class="alert alert-success text-center" id="message">La modification '.$this->input->post('PROFIL_DESCR').' a échouée</div>';
                $this->session->set_flashdata($message);
                redirect(base_url('administration/User_Profil/listing'));

          }
          

      }

    }
    else
    {
      $message['message']='<div class="alert alert-success text-center" id="message">La suppression '.$this->input->post('PROFIL_DESCR').' a échouée</div>';
        $this->session->set_flashdata($message);
        $data['error']='';
        $data['profilo']=$this->Model->getOne('user_profil',array('PROFIL_ID'=>$this->input->post('PROFIL_ID')));
        $this->load->view('Profile_update_view',$data);
        
    }
  }

}

?>