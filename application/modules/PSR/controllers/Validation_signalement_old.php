<?php
class Validation_signalement extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// $this->have_droit();
	}
	 public function have_droit()
	 {
	  if ($this->session->userdata('ASSURANCE') != 1 && $this->session->userdata('PSR_ELEMENT') != 1) {
	   redirect(base_url());
	  }
	 }
	 function index()
        
	 {
    $id_utilisateur = $this->session->userdata('USER_ID');
     $profil = $this->Modele->getRequeteOne('SELECT pro.PROFIL_ID FROM profil pro LEFT JOIN utilisateurs u ON u.PROFIL_ID=pro.PROFIL_ID   WHERE u.ID_UTILISATEUR='.$id_utilisateur);
     if($profil['PROFIL_ID']==17)
     {
       $Nbre_nouveau = $this->Modele->getRequeteOne('SELECT COUNT(*) AS Nombre FROM  signalement_civil_agent_new  WHERE ID_ALERT_STATUT=1');

        $Nbre_valide = $this->Modele->getRequeteOne('SELECT COUNT(*) AS Nombre FROM signalement_civil_agent_histo_traitement  WHERE STATUT_ID=2 AND ID_UTILISATEUR='.$id_utilisateur);

       $Nbre_rejette = $this->Modele->getRequeteOne('SELECT COUNT(*) AS Nombre FROM signalement_civil_agent_histo_traitement WHERE STATUT_ID=5 AND ID_UTILISATEUR='.$id_utilisateur);

      $data['Nbre_nouveau']=$Nbre_nouveau['Nombre'];
      $data['Nbre_valide']=$Nbre_valide['Nombre'];
      $data['Nbre_rejette']=$Nbre_rejette['Nombre'];
      
     }
     else if($profil['PROFIL_ID']==18)
     {
      $Nbre_nouveau = $this->Modele->getRequeteOne('SELECT COUNT(*) AS Nombre FROM  signalement_civil_agent_new  WHERE ID_ALERT_STATUT=2');

        $Nbre_valide = $this->Modele->getRequeteOne('SELECT COUNT(*) AS Nombre FROM signalement_civil_agent_histo_traitement  WHERE STATUT_ID=3 AND ID_UTILISATEUR='.$id_utilisateur);

       $Nbre_rejette = $this->Modele->getRequeteOne('SELECT COUNT(*) AS Nombre FROM signalement_civil_agent_histo_traitement WHERE STATUT_ID=5 AND ID_UTILISATEUR='.$id_utilisateur);

      $data['Nbre_nouveau']=$Nbre_nouveau['Nombre'];
      $data['Nbre_valide']=$Nbre_valide['Nombre'];
      $data['Nbre_rejette']=$Nbre_rejette['Nombre'];
      
     }
     else if($profil['PROFIL_ID']==19)
     {
        $Nbre_nouveau = $this->Modele->getRequeteOne('SELECT COUNT(*) AS Nombre FROM  signalement_civil_agent_new  WHERE ID_ALERT_STATUT=3');

        $Nbre_valide = $this->Modele->getRequeteOne('SELECT COUNT(*) AS Nombre FROM signalement_civil_agent_histo_traitement  WHERE STATUT_ID=4 AND ID_UTILISATEUR='.$id_utilisateur);

       $Nbre_rejette = $this->Modele->getRequeteOne('SELECT COUNT(*) AS Nombre FROM signalement_civil_agent_histo_traitement WHERE STATUT_ID=5 AND ID_UTILISATEUR='.$id_utilisateur);

      $data['Nbre_nouveau']=$Nbre_nouveau['Nombre'];
      $data['Nbre_valide']=$Nbre_valide['Nombre'];
      $data['Nbre_rejette']=$Nbre_rejette['Nombre'];
      
     }

	    $data['title'] = 'Signalement';
	    $this->load->view('validation/Validation_List_View', $data);
	 }
   public function rejette($id)
   {
    $date =date('Y-m-d:H-i');
    $id_utilisateur = $this->session->userdata('USER_ID');
    $id_avis_signalement =$this->input->post('signalement_avis');
     $data = array('ID_SIGNALEMENT_NEW' =>$id ,
                      'STATUT_ID' =>5,
                      'ID_AVIS_SIGNALEMENT' =>$id_avis_signalement,
                      'ID_UTILISATEUR' =>$id_utilisateur,
                      'DATE_TRAITEMENT'=>$date
                     );
        
    $this->Modele->create('signalement_civil_agent_histo_traitement',$data);
     $this->Modele->update('signalement_civil_agent_new', array('ID_SIGNALEMENT_NEW'=>$id ),array('ID_ALERT_STATUT'=>5));
  redirect(base_url('PSR/Validation_signalement/'));

   }
	  public function save($id)
    {
        $date =date('Y-m-d:H-i');
        $id_utilisateur = $this->session->userdata('USER_ID');
        $id_avis_signalement =$this->input->post('signalement_avis');

        $profil = $this->Modele->getRequeteOne('SELECT pro.PROFIL_ID FROM profil pro LEFT JOIN utilisateurs u ON u.PROFIL_ID=pro.PROFIL_ID   WHERE u.ID_UTILISATEUR='.$id_utilisateur);
          if($profil['PROFIL_ID']==17)
          {
              $data = array('ID_SIGNALEMENT_NEW' =>$id ,
                      'STATUT_ID' =>2,
                      'ID_AVIS_SIGNALEMENT' =>$id_avis_signalement,
                      'ID_UTILISATEUR' =>$id_utilisateur,
                      'DATE_TRAITEMENT'=>$date
                     );
                $this->Modele->create('signalement_civil_agent_histo_traitement',$data);

               $this->Modele->update('signalement_civil_agent_new', array('ID_SIGNALEMENT_NEW'=>$id ),array('ID_ALERT_STATUT'=>2));
          }
          else if($profil['PROFIL_ID']==18)
          {
               $data = array('ID_SIGNALEMENT_NEW' =>$id ,
                      'STATUT_ID' =>3,
                      'ID_AVIS_SIGNALEMENT' =>$id_avis_signalement,
                      'ID_UTILISATEUR' =>$id_utilisateur,
                      'DATE_TRAITEMENT'=>$date
                     );
        
                $this->Modele->create('signalement_civil_agent_histo_traitement',$data);
               $this->Modele->update('signalement_civil_agent_new', array('ID_SIGNALEMENT_NEW'=>$id ),array('ID_ALERT_STATUT'=>3));
          }
          else if($profil['PROFIL_ID']==19)
         {
            $data = array('ID_SIGNALEMENT_NEW' =>$id ,
                      'STATUT_ID' =>4,
                      'ID_AVIS_SIGNALEMENT' =>$id_avis_signalement,
                      'ID_UTILISATEUR' =>$id_utilisateur,
                      'DATE_TRAITEMENT'=>$date
                     );
        
                $this->Modele->create('signalement_civil_agent_histo_traitement',$data);
               $this->Modele->update('signalement_civil_agent_new', array('ID_SIGNALEMENT_NEW'=>$id ),array('ID_ALERT_STATUT'=>4));
         }

        $data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
  $this->session->set_flashdata($data);
    redirect(base_url('PSR/Validation_signalement/'));

  // }

 }
function listing_valide()
{
    $id=$this->session->userdata('USER_ID');
  $profil = $this->Modele->getRequeteOne('SELECT pro.PROFIL_ID FROM profil pro LEFT JOIN utilisateurs u ON u.PROFIL_ID=pro.PROFIL_ID   WHERE u.ID_UTILISATEUR='.$id);
   if($profil['PROFIL_ID']==17)
  {
  $query_principal = "SELECT scan.DATE_SIGNAL,scan.ID_AUTRE_CONTROL,scan.ID_SIGNALEMENT_NEW,cas.NOM AS STATUT, cat.DESCRIPTION,pe.PHOTO, u.NOM_CITOYEN,u.PRENOM_CITOYEN ,pe.NOM,pe.PRENOM,scan.IMAGE_UNE,scan.IMAGE_DEUX,scan.IMAGE_TROIS,scan.DATE_SIGNAL  FROM signalement_civil_agent_new scan LEFT JOIN signalement_civil_agent_histo_traitement uu  ON uu.ID_SIGNALEMENT_NEW=scan.ID_SIGNALEMENT_NEW LEFT JOIN utilisateurs u  ON u.ID_UTILISATEUR=scan.ID_UTILISATEUR LEFT JOIN psr_elements pe ON pe.ID_PSR_ELEMENT=u.PSR_ELEMENT_ID  LEFT JOIN civil_alerts_types cat ON cat.ID_TYPE=scan.ID_CATEGORIE_SIGNALEMENT  LEFT JOIN civil_alerts_statuts cas ON cas.ID_ALERT_STATUT=scan.ID_ALERT_STATUT
            WHERE  cas.ID_ALERT_STATUT=2 AND  uu.ID_UTILISATEUR=".$id;
}
else if($profil['PROFIL_ID']==18)
{
  $query_principal = "SELECT scan.DATE_SIGNAL,scan.ID_AUTRE_CONTROL,scan.ID_SIGNALEMENT_NEW,cas.NOM AS STATUT, cat.DESCRIPTION,pe.PHOTO, u.NOM_CITOYEN,u.PRENOM_CITOYEN ,pe.NOM,pe.PRENOM,scan.IMAGE_UNE,scan.IMAGE_DEUX,scan.IMAGE_TROIS,scan.DATE_SIGNAL  FROM signalement_civil_agent_new scan LEFT JOIN utilisateurs u  ON u.ID_UTILISATEUR=scan.ID_UTILISATEUR LEFT JOIN psr_elements pe ON pe.ID_PSR_ELEMENT=u.PSR_ELEMENT_ID  LEFT JOIN civil_alerts_types cat ON cat.ID_TYPE=scan.ID_CATEGORIE_SIGNALEMENT  LEFT JOIN civil_alerts_statuts cas ON cas.ID_ALERT_STATUT=scan.ID_ALERT_STATUT
            WHERE  cas.ID_ALERT_STATUT=3";
}
else if($profil['PROFIL_ID']==19){
  $query_principal = "SELECT scan.DATE_SIGNAL,scan.ID_AUTRE_CONTROL,scan.ID_SIGNALEMENT_NEW,cas.NOM AS STATUT, cat.DESCRIPTION,pe.PHOTO, u.NOM_CITOYEN,u.PRENOM_CITOYEN ,pe.NOM,pe.PRENOM,scan.IMAGE_UNE,scan.IMAGE_DEUX,scan.IMAGE_TROIS,scan.DATE_SIGNAL  FROM signalement_civil_agent_new scan LEFT JOIN utilisateurs u  ON u.ID_UTILISATEUR=scan.ID_UTILISATEUR LEFT JOIN psr_elements pe ON pe.ID_PSR_ELEMENT=u.PSR_ELEMENT_ID  LEFT JOIN civil_alerts_types cat ON cat.ID_TYPE=scan.ID_CATEGORIE_SIGNALEMENT  LEFT JOIN civil_alerts_statuts cas ON cas.ID_ALERT_STATUT=scan.ID_ALERT_STATUT WHERE  cas.ID_ALERT_STATUT=4";
}
 $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

        $limit = 'LIMIT 0,10';

        if ($_POST['length'] != -1) {
          $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
        }

        $order_by = '';

        $order_column = array('DATE_SIGNAL', 'DATE');

        $order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY DATE_SIGNAL ASC';

        $search = !empty($_POST['search']['value']) ? ("AND DATE_SIGNAL LIKE '%$var_search%'  ") : '';


        $critaire = '';

        $query_secondaire = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $order_by . '   ' . $limit;
        $query_filter = $query_principal . ' ' . $critaire . ' ' . $search;

        $fetch_psr = $this->Modele->datatable($query_secondaire);
        $data = array();
        foreach ($fetch_psr as $row) {
          


            $sub_array=array();
            if($row->NOM_CITOYEN!=null){
             $source = !empty($row->PHOTO) ? $row->PHOTO : "https://app.mediabox.bi/wasiliEate/uploads/personne.png";
             $sub_array[] = '<table> <tbody><tr><td><a href="' . $source . '" target="_blank" ><img alt="Avtar" style="border-radius:50%;width:30px;height:30px" src="' . $source . '"></a></td><td>' . $row->NOM . ' ' . $row->PRENOM . '</td></tr></tbody></table></a>';
            }
            else{
              $source = !empty($row->PHOTO) ? $row->PHOTO : "https://app.mediabox.bi/wasiliEate/uploads/personne.png";
              $sub_array[] = '<table> <tbody><tr><td><a href="' . $source . '" target="_blank" ><img alt="Avtar" style="border-radius:50%;width:30px;height:30px" src="' . $source . '"></a></td><td>' . $row->NOM . ' ' . $row->PRENOM . '</td></tr></tbody></table></a>';
            }
            $sub_array[] = $row->DESCRIPTION;
            
            if (!empty($row->IMAGE_UNE)) {
     				$sub_array[]= "

               <a class='btn-md'  href='#' data-toggle='modal'
                     data-target='#myPicture" . $row->ID_SIGNALEMENT_NEW . "'><font color='red'><img style='width:20%' src='" . $row->IMAGE_UNE . "'></a>";
     			}
     			else{
     				$sub_array[]= "Aucun";

     			}
            $sub_array[] = $row->STATUT;
            $sub_array[] = $row->DATE_SIGNAL;


       $questionList = $this->Model->getRequete('SELECT acq.INFRACTIONS,acqr.REPONSE_DECRP FROM  autres_controles ac  LEFT JOIN autres_controles_questionnaires acq on acq.ID_CONTROLES_QUESTIONNAIRES= ac.ID_CONTROLES_QUESTIONNAIRES LEFT  JOIN  autres_contr_quest_rp acqr ON acqr.ID_REPONSE=ac.ID_REPONSE   WHERE ac.ID_CONTROLE_PLAQUE ='.$row->ID_AUTRE_CONTROL.'');
        $avisList = $this->Model->getRequete('SELECT * FROM signalement_avis_traitement WHERE 1');
        $select="";
        $select.=" <select name='signalement_avis' id='signalement_avis' class='form-control'>
                   <option value=''>Sélectionner un avis</option>";
                    foreach ($avisList as $val) { 
               $select.="<option  value='".$val['ID_AVIS_SIGNALEMENT']." '>".$val['AVIS']."</option>";
                    }
                 $select.="</select>";
	                     
       $html="<div class='col-sm-12 text-left'>";
       $no=0;
        foreach ($questionList as $value) { 
        	$no++;
                     $html.="<li>
	                       <div class='row'>
	                        <div class='col-md-8'>
                              ".$value['INFRACTIONS']." 
                             </div>
	                        <div class='col-md-1'>
                              </div>

                             <div class='col-md-3'>
                              ".$value['REPONSE_DECRP']."
                             </div>
                              </div>
                              </li>
                        ";

                    }

            $option='</div><div class="dropdown">
                       <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-cog"></i>
            Action<span class="caret"></span></a>
              <ul class="dropdown-menu dropdown-menu-left">
              ';
                  
                   $option .= "<li><a class='btn-md'  href='#' data-toggle='modal'
                     data-target='#myAccepte" . $row->ID_SIGNALEMENT_NEW . "'><font >&nbsp;&nbsp;Valider</font></a></li>";
                   $option .= "<li><a class='btn-md'  href='#' data-toggle='modal'
                     data-target='#mydelete" . $row->ID_SIGNALEMENT_NEW . "'><font color='red'>&nbsp;&nbsp;Rejetter</font></a></li>";
                  $option .= " </ul>
              </div>

               <div class='modal fade' id='mydelete" .  $row->ID_SIGNALEMENT_NEW . "'>
                <div class='modal-dialog'>
                  <div class='modal-content'>
                    <div class='modal-body'>
                     <center><h5><strong>Voulez-vous Annuler?</strong> <br><b style='background-color:prink;color:green;'><i> Le constant de  type " . $row->ID_SIGNALEMENT_NEW . " faite le " . $row->ID_SIGNALEMENT_NEW . "</i></b></h5>
                     </center>
                    </div>

                    <div class='modal-footer'>
               <a class='btn btn-outline-danger btn-md' href='".base_url('PSR/Validation_signalement/reejette/' . $row->ID_SIGNALEMENT_NEW )."'>Rejetter</a>
                    <button class='btn btn-outline-primary btn-md' data-dismiss='modal'>Quitter</button>
               </div>
             </div>
            </div>
          </div>
          <div class='modal fade' id='myAccepte" .  $row->ID_SIGNALEMENT_NEW . "'>
                <div class='modal-dialog'>
                  <div class='modal-content'>
                    <div class='modal-body'>
                    <form id='myForm".$row->ID_SIGNALEMENT_NEW."'action=".base_url('PSR/Validation_signalement/save/'.$row->ID_SIGNALEMENT_NEW)." method='post' autocomplete='off'>
                   <div class='col-md-12 mt-4'>
                   <label>Avis</label>
                      ".$select."
                      </div> 
                   <div class='col-md-12 mt-4'>
                   
                   </div> 
                    
                    </div>

                    <div class='modal-footer'>
                    <button type='button' onclick='subForm(".$row->ID_SIGNALEMENT_NEW.")' class='btn btn-primary btn-md' >Valider</button> </form> 
           </form> 

                    <button class='btn btn-outline-primary btn-md' data-dismiss='modal'>Quitter</button>
               </div>
             </div>
            </div>
          </div>
          <div class='modal fade' id='myPicture" .  $row->ID_SIGNALEMENT_NEW . "'>
                <div class='modal-dialog'>
                  <div class='modal-content'>
                  <div class='modal-header' style='background: black;'>
            <div id='title'><b>Détails<h4 
            style='color:#fff;font-size: 18px;'></h4>

            </div>

            <div class='close' style='color:#fff' data-dismiss='modal' aria-label='Close'>
             <span aria-hidden='true'>&times;</span>
           </div>
         </div>
                    <div class='modal-body'>
                     <center><h5><strong></strong> <br><b style='background-color:prink;color:green;'>
                      <div class='row'> 

        
        <div class='col-md-12'>
          <div class='card mb-4 mb-md-0'>
            
            <div class='card-body'>
             ".$html. "
            </div>
          </div>
        </div>
         <div class='col-md-12'>
          <div class='card mb-4 mb-md-0'>
            <div class='card-body'>
              <img style='width:100%'  src='" . $row->IMAGE_UNE . "'>
            </div>
          </div>
        </div>
                       </div>
                    
                     </center>
                    </div>

                    <div class='modal-footer'>
                    
                    <a class='btn btn-outline-danger btn-md' href='" . base_url('PSR/Commentaire/maintenir/' . $row->ID_SIGNALEMENT_NEW .'/'.$row->ID_SIGNALEMENT_NEW) . "'>Valider</a>
                    <button class='btn btn-outline-primary btn-md' data-dismiss='modal'>Quitter</button>
               </div>
             </div>
            </div>
          </div>
          ";
            $sub_array[] = $option;

            $data[] = $sub_array;

        }
        $output = array(
           "draw" => intval($_POST['draw']),
           "recordsTotal" => $this->Modele->all_data($query_principal),
           "recordsFiltered" => $this->Modele->filtrer($query_filter),
           "data" => $data
         );
         echo json_encode($output);

	 }

   function listing()
{
    $id=$this->session->userdata('USER_ID');
  $profil = $this->Modele->getRequeteOne('SELECT pro.PROFIL_ID FROM profil pro LEFT JOIN utilisateurs u ON u.PROFIL_ID=pro.PROFIL_ID   WHERE u.ID_UTILISATEUR='.$id);
   if($profil['PROFIL_ID']==17)
  {
  $query_principal = "SELECT scan.DATE_SIGNAL,scan.ID_AUTRE_CONTROL,scan.ID_SIGNALEMENT_NEW,cas.NOM AS STATUT, cat.DESCRIPTION,pe.PHOTO, u.NOM_CITOYEN,u.PRENOM_CITOYEN ,pe.NOM,pe.PRENOM,scan.IMAGE_UNE,scan.IMAGE_DEUX,scan.IMAGE_TROIS,scan.DATE_SIGNAL  FROM signalement_civil_agent_new scan LEFT JOIN utilisateurs u  ON u.ID_UTILISATEUR=scan.ID_UTILISATEUR LEFT JOIN psr_elements pe ON pe.ID_PSR_ELEMENT=u.PSR_ELEMENT_ID  LEFT JOIN civil_alerts_types cat ON cat.ID_TYPE=scan.ID_CATEGORIE_SIGNALEMENT  LEFT JOIN civil_alerts_statuts cas ON cas.ID_ALERT_STATUT=scan.ID_ALERT_STATUT
            WHERE  cas.ID_ALERT_STATUT=1 ";
}
else if($profil['PROFIL_ID']==18)
{
  $query_principal = "SELECT scan.DATE_SIGNAL,scan.ID_AUTRE_CONTROL,scan.ID_SIGNALEMENT_NEW,cas.NOM AS STATUT, cat.DESCRIPTION,pe.PHOTO, u.NOM_CITOYEN,u.PRENOM_CITOYEN ,pe.NOM,pe.PRENOM,scan.IMAGE_UNE,scan.IMAGE_DEUX,scan.IMAGE_TROIS,scan.DATE_SIGNAL  FROM signalement_civil_agent_new scan LEFT JOIN utilisateurs u  ON u.ID_UTILISATEUR=scan.ID_UTILISATEUR LEFT JOIN psr_elements pe ON pe.ID_PSR_ELEMENT=u.PSR_ELEMENT_ID  LEFT JOIN civil_alerts_types cat ON cat.ID_TYPE=scan.ID_CATEGORIE_SIGNALEMENT  LEFT JOIN civil_alerts_statuts cas ON cas.ID_ALERT_STATUT=scan.ID_ALERT_STATUT
            WHERE  cas.ID_ALERT_STATUT=2 ";
}
else if($profil['PROFIL_ID']==19){
  $query_principal = "SELECT scan.DATE_SIGNAL,scan.ID_AUTRE_CONTROL,scan.ID_SIGNALEMENT_NEW,cas.NOM AS STATUT, cat.DESCRIPTION,pe.PHOTO, u.NOM_CITOYEN,u.PRENOM_CITOYEN ,pe.NOM,pe.PRENOM,scan.IMAGE_UNE,scan.IMAGE_DEUX,scan.IMAGE_TROIS,scan.DATE_SIGNAL  FROM signalement_civil_agent_new scan LEFT JOIN utilisateurs u  ON u.ID_UTILISATEUR=scan.ID_UTILISATEUR LEFT JOIN psr_elements pe ON pe.ID_PSR_ELEMENT=u.PSR_ELEMENT_ID  LEFT JOIN civil_alerts_types cat ON cat.ID_TYPE=scan.ID_CATEGORIE_SIGNALEMENT  LEFT JOIN civil_alerts_statuts cas ON cas.ID_ALERT_STATUT=scan.ID_ALERT_STATUT WHERE  cas.ID_ALERT_STATUT=3";
}
    

            $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

        $limit = 'LIMIT 0,10';

        if ($_POST['length'] != -1) {
          $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
        }

        $order_by = '';

        $order_column = array('DATE_SIGNAL', 'DATE');

        $order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY DATE_SIGNAL ASC';

        $search = !empty($_POST['search']['value']) ? ("AND DATE_SIGNAL LIKE '%$var_search%'  ") : '';


        $critaire = '';

        $query_secondaire = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $order_by . '   ' . $limit;
        $query_filter = $query_principal . ' ' . $critaire . ' ' . $search;

        $fetch_psr = $this->Modele->datatable($query_secondaire);
        $data = array();
        foreach ($fetch_psr as $row) {
          


            $sub_array=array();
            if($row->NOM_CITOYEN!=null){
             $source = !empty($row->PHOTO) ? $row->PHOTO : "https://app.mediabox.bi/wasiliEate/uploads/personne.png";
             $sub_array[] = '<table> <tbody><tr><td><a href="' . $source . '" target="_blank" ><img alt="Avtar" style="border-radius:50%;width:30px;height:30px" src="' . $source . '"></a></td><td>' . $row->NOM . ' ' . $row->PRENOM . '</td></tr></tbody></table></a>';
            }
            else{
              $source = !empty($row->PHOTO) ? $row->PHOTO : "https://app.mediabox.bi/wasiliEate/uploads/personne.png";
              $sub_array[] = '<table> <tbody><tr><td><a href="' . $source . '" target="_blank" ><img alt="Avtar" style="border-radius:50%;width:30px;height:30px" src="' . $source . '"></a></td><td>' . $row->NOM . ' ' . $row->PRENOM . '</td></tr></tbody></table></a>';
            }
            $sub_array[] = $row->DESCRIPTION;
            
            if (!empty($row->IMAGE_UNE)) {
            $sub_array[]= "

               <a class='btn-md'  href='#' data-toggle='modal'
                     data-target='#myPicture" . $row->ID_SIGNALEMENT_NEW . "'><font color='red'><img style='width:20%' src='" . $row->IMAGE_UNE . "'></a>";
          }
          else{
            $sub_array[]= "Aucun";

          }
            $sub_array[] = $row->STATUT;
            $sub_array[] = $row->DATE_SIGNAL;


       $questionList = $this->Model->getRequete('SELECT acq.INFRACTIONS,acqr.REPONSE_DECRP FROM  autres_controles ac  LEFT JOIN autres_controles_questionnaires acq on acq.ID_CONTROLES_QUESTIONNAIRES= ac.ID_CONTROLES_QUESTIONNAIRES LEFT  JOIN  autres_contr_quest_rp acqr ON acqr.ID_REPONSE=ac.ID_REPONSE   WHERE ac.ID_CONTROLE_PLAQUE ='.$row->ID_AUTRE_CONTROL.'');
        $avisList = $this->Model->getRequete('SELECT * FROM signalement_avis_traitement WHERE 1');
        $select="";
        $select.=" <select name='signalement_avis' id='signalement_avis' class='form-control'>
                   <option value=''>Sélectionner un avis</option>";
                    foreach ($avisList as $val) { 
               $select.="<option  value='".$val['ID_AVIS_SIGNALEMENT']." '>".$val['AVIS']."</option>";
                    }
                 $select.="</select>";
                       
       $html="<div class='col-sm-12 text-left'>";
       $no=0;
        foreach ($questionList as $value) { 
          $no++;
                     $html.="<li>
                         <div class='row'>
                          <div class='col-md-8'>
                              ".$value['INFRACTIONS']." 
                             </div>
                          <div class='col-md-1'>
                              </div>

                             <div class='col-md-3'>
                              ".$value['REPONSE_DECRP']."
                             </div>
                              </div>
                              </li>
                        ";

                    }

            $option='</div><div class="dropdown">
                       <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-cog"></i>
            Action<span class="caret"></span></a>
              <ul class="dropdown-menu dropdown-menu-left">
              ';
                  
                   $option .= "<li><a class='btn-md'  href='#' data-toggle='modal'
                     data-target='#myAccepte" . $row->ID_SIGNALEMENT_NEW . "'><font >&nbsp;&nbsp;Valider</font></a></li>";
                   $option .= "<li><a class='btn-md'  href='#' data-toggle='modal'
                     data-target='#mydelete" . $row->ID_SIGNALEMENT_NEW . "'><font color='red'>&nbsp;&nbsp;Rejetter</font></a></li>";
                  $option .= " </ul>
              </div>


            <div class='modal fade' id='mydelete" .$row->ID_SIGNALEMENT_NEW."'>
                <div class='modal-dialog'>

                <div class='modal-header' style='background: black;'>
            <div id='title'><b><h4 id='donneTitre' style='color:#fff;font-size: 18px;'>Annulation d'un signalement</h4></b></div>

            <div class='close' style='color:#fff' data-dismiss='modal' aria-label='Close'>
             <span aria-hidden='true'>&times;</span>
           </div>
         </div>
                  <div class='modal-content'>
                    <div class='modal-body'>

               <form id='myForm1".$row->ID_SIGNALEMENT_NEW."'action=".base_url('PSR/Validation_signalement/rejette/'.$row->ID_SIGNALEMENT_NEW)." method='post' autocomplete='off'>
                   <div class='col-md-12 mt-4'>
                   <label>Avis</label>
                      ".$select."
                      </div> 
                   <div class='col-md-12 mt-4'>
                   </div> 
                    </div>
                    <div class='modal-footer'>
                    <button type='button' onclick='subForm1(".$row->ID_SIGNALEMENT_NEW.")' class='btn btn-primary btn-md' >Rejetter</button> </form> 
                    </form>
                    <div class='modal-footer'>
                    <button class='btn btn-outline-primary btn-md' data-dismiss='modal'>Quitter</button>
               </div>
             </div>
            </div>
          </div>
          </div>
          <div class='modal fade' id='myAccepte" .  $row->ID_SIGNALEMENT_NEW . "'>
                <div class='modal-dialog'>
                  <div class='modal-content'>
                  <div class='modal-header' style='background: black;'>
            <div id='title'><b><h4 id='donneTitre' style='color:#fff;font-size: 18px;'>Validation d'un signalement</h4></b></div>

            <div class='close' style='color:#fff' data-dismiss='modal' aria-label='Close'>
             <span aria-hidden='true'>&times;</span>
           </div>
         </div>
                    <div class='modal-body'>
                    <form id='myForm".$row->ID_SIGNALEMENT_NEW."'action=".base_url('PSR/Validation_signalement/save/'.$row->ID_SIGNALEMENT_NEW)." method='post' autocomplete='off'>
                   <div class='col-md-12 mt-4'>
                   <label>Avis</label>
                      ".$select."
                      </div> 
                   <div class='col-md-12 mt-4'>
                   
                   </div> 
                    
                    </div>

                    <div class='modal-footer'>
                    <button type='button' onclick='subForm(".$row->ID_SIGNALEMENT_NEW.")' class='btn btn-primary btn-md' >Valider</button> </form> 
           </form> 

                    <button class='btn btn-outline-primary btn-md' data-dismiss='modal'>Quitter</button>
               </div>
             </div>
            </div>
          </div>
          <div class='modal fade' id='myPicture" .  $row->ID_SIGNALEMENT_NEW . "'>
                <div class='modal-dialog'>
                  <div class='modal-content'>
                  <div class='modal-header' style='background: black;'>
            <div id='title'><b>Détails<h4 
            style='color:#fff;font-size: 18px;'></h4>

            </div>

            <div class='close' style='color:#fff' data-dismiss='modal' aria-label='Close'>
             <span aria-hidden='true'>&times;</span>
           </div>
         </div>
                    <div class='modal-body'>
                     <center><h5><strong></strong> <br><b style='background-color:prink;color:green;'>
                      <div class='row'> 

        
        <div class='col-md-12'>
          <div class='card mb-4 mb-md-0'>
            
            <div class='card-body'>
             ".$html. "
            </div>
          </div>
        </div>
         <div class='col-md-12'>
          <div class='card mb-4 mb-md-0'>
            <div class='card-body'>
              <img style='width:100%'  src='" . $row->IMAGE_UNE . "'>
            </div>
          </div>
        </div>
                       </div>
                    
                     </center>
                    </div>

                    <div class='modal-footer'>
                    
                    <a class='btn btn-outline-danger btn-md' href='" . base_url('PSR/Commentaire/maintenir/' . $row->ID_SIGNALEMENT_NEW .'/'.$row->ID_SIGNALEMENT_NEW) . "'>Valider</a>
                    <button class='btn btn-outline-primary btn-md' data-dismiss='modal'>Quitter</button>
               </div>
             </div>
            </div>
          </div>
          ";
            $sub_array[] = $option;

            $data[] = $sub_array;

        }
        $output = array(
           "draw" => intval($_POST['draw']),
           "recordsTotal" => $this->Modele->all_data($query_principal),
           "recordsFiltered" => $this->Modele->filtrer($query_filter),
           "data" => $data
         );
         echo json_encode($output);

   }


   function listing_rejette()
{
    $id=$this->session->userdata('USER_ID');
  $profil = $this->Modele->getRequeteOne('SELECT pro.PROFIL_ID FROM profil pro LEFT JOIN utilisateurs u ON u.PROFIL_ID=pro.PROFIL_ID   WHERE u.ID_UTILISATEUR='.$id);
   
  $query_principal = "SELECT scan.DATE_SIGNAL,scan.ID_AUTRE_CONTROL,scan.ID_SIGNALEMENT_NEW,cas.NOM AS STATUT, cat.DESCRIPTION,pe.PHOTO, u.NOM_CITOYEN,u.PRENOM_CITOYEN ,pe.NOM,pe.PRENOM,scan.IMAGE_UNE,scan.IMAGE_DEUX,scan.IMAGE_TROIS,scan.DATE_SIGNAL  FROM signalement_civil_agent_new scan LEFT JOIN utilisateurs u  ON u.ID_UTILISATEUR=scan.ID_UTILISATEUR LEFT JOIN psr_elements pe ON pe.ID_PSR_ELEMENT=u.PSR_ELEMENT_ID  LEFT JOIN civil_alerts_types cat ON cat.ID_TYPE=scan.ID_CATEGORIE_SIGNALEMENT  LEFT JOIN civil_alerts_statuts cas ON cas.ID_ALERT_STATUT=scan.ID_ALERT_STATUT LEFT JOIN signalement_civil_agent_histo_traitement scaht ON scaht.ID_SIGNALEMENT_NEW=scan.ID_SIGNALEMENT_NEW WHERE  cas.ID_ALERT_STATUT=5 AND scaht.ID_UTILISATEUR=".$id;
     $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

        $limit = 'LIMIT 0,10';

        if ($_POST['length'] != -1) {
          $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
        }

        $order_by = '';

        $order_column = array('DATE_SIGNAL');

        $order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY DATE_SIGNAL ASC';

        $search = !empty($_POST['search']['value']) ? ("AND DATE_SIGNAL LIKE '%$var_search%'  ") : '';


        $critaire = '';

        $query_secondaire = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $order_by . '   ' . $limit;
        $query_filter = $query_principal . ' ' . $critaire . ' ' . $search;

        $fetch_psr = $this->Modele->datatable($query_secondaire);
        $data = array();
        foreach ($fetch_psr as $row) {
          


            $sub_array=array();
            if($row->NOM_CITOYEN!=null){
             $source = !empty($row->PHOTO) ? $row->PHOTO : "https://app.mediabox.bi/wasiliEate/uploads/personne.png";
             $sub_array[] = '<table> <tbody><tr><td><a href="' . $source . '" target="_blank" ><img alt="Avtar" style="border-radius:50%;width:30px;height:30px" src="' . $source . '"></a></td><td>' . $row->NOM . ' ' . $row->PRENOM . '</td></tr></tbody></table></a>';
            }
            else{
              $source = !empty($row->PHOTO) ? $row->PHOTO : "https://app.mediabox.bi/wasiliEate/uploads/personne.png";
              $sub_array[] = '<table> <tbody><tr><td><a href="' . $source . '" target="_blank" ><img alt="Avtar" style="border-radius:50%;width:30px;height:30px" src="' . $source . '"></a></td><td>' . $row->NOM . ' ' . $row->PRENOM . '</td></tr></tbody></table></a>';
            }
            $sub_array[] = $row->DESCRIPTION;
            
            if (!empty($row->IMAGE_UNE)) {
            $sub_array[]= "

               <a class='btn-md'  href='#' data-toggle='modal'
                     data-target='#myPicture" . $row->ID_SIGNALEMENT_NEW . "'><font color='red'><img style='width:20%' src='" . $row->IMAGE_UNE . "'></a>";
          }
          else{
            $sub_array[]= "Aucun";

          }
            $sub_array[] = $row->STATUT;
            $sub_array[] = $row->DATE_SIGNAL;


       $questionList = $this->Model->getRequete('SELECT acq.INFRACTIONS,acqr.REPONSE_DECRP FROM  autres_controles ac  LEFT JOIN autres_controles_questionnaires acq on acq.ID_CONTROLES_QUESTIONNAIRES= ac.ID_CONTROLES_QUESTIONNAIRES LEFT  JOIN  autres_contr_quest_rp acqr ON acqr.ID_REPONSE=ac.ID_REPONSE   WHERE ac.ID_CONTROLE_PLAQUE ='.$row->ID_AUTRE_CONTROL.'');
        $avisList = $this->Model->getRequete('SELECT * FROM signalement_avis_traitement WHERE 1');
        $select="";
        $select.=" <select name='signalement_avis' id='signalement_avis' class='form-control'>
                   <option value=''>Sélectionner un avis</option>";
                    foreach ($avisList as $val) { 
               $select.="<option  value='".$val['ID_AVIS_SIGNALEMENT']." '>".$val['AVIS']."</option>";
                    }
                 $select.="</select>";
                       
       $html="<div class='col-sm-12 text-left'>";
       $no=0;
        foreach ($questionList as $value) { 
          $no++;
                     $html.="<li>
                         <div class='row'>
                          <div class='col-md-8'>
                              ".$value['INFRACTIONS']." 
                             </div>
                          <div class='col-md-1'>
                              </div>

                             <div class='col-md-3'>
                              ".$value['REPONSE_DECRP']."
                             </div>
                              </div>
                              </li>
                        ";

                    }

            $option='</div><div class="dropdown">
                       <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-cog"></i>
            Action<span class="caret"></span></a>
              <ul class="dropdown-menu dropdown-menu-left">
              ';
                  
                   $option .= "<li><a class='btn-md'  href='#' data-toggle='modal'
                     data-target='#myAccepte" . $row->ID_SIGNALEMENT_NEW . "'><font >&nbsp;&nbsp;Valider</font></a></li>";
                   $option .= "<li><a class='btn-md'  href='#' data-toggle='modal'
                     data-target='#mydelete" . $row->ID_SIGNALEMENT_NEW . "'><font color='red'>&nbsp;&nbsp;Rejetter</font></a></li>";
                  $option .= " </ul>
              </div>

               <div class='modal fade' id='mydelete" .  $row->ID_SIGNALEMENT_NEW . "'>
                <div class='modal-dialog'>
                  <div class='modal-content'>
                    <div class='modal-body'>
                     <center><h5><strong>Voulez-vous Annuler?</strong> <br><b style='background-color:prink;color:green;'><i> Le constant de  type " . $row->ID_SIGNALEMENT_NEW . " faite le " . $row->ID_SIGNALEMENT_NEW . "</i></b></h5>
                     </center>
                    </div>

                    <div class='modal-footer'>
                    <a class='btn btn-outline-danger btn-md' href='" . base_url('PSR/Commentaire/canceler/' . $row->ID_SIGNALEMENT_NEW .'/'.$row->ID_SIGNALEMENT_NEW) . "'>Annuler</a>
                    <button class='btn btn-outline-primary btn-md' data-dismiss='modal'>Quitter</button>
               </div>
             </div>
            </div>
          </div>
          <div class='modal fade' id='myAccepte" .  $row->ID_SIGNALEMENT_NEW . "'>
                <div class='modal-dialog'>
                  <div class='modal-content'>
                    <div class='modal-body'>
                    <form id='myForm".$row->ID_SIGNALEMENT_NEW."'action=".base_url('PSR/Validation_signalement/save/'.$row->ID_SIGNALEMENT_NEW)." method='post' autocomplete='off'>
                   <div class='col-md-12 mt-4'>
                   <label>Avis</label>
                      ".$select."
                      </div> 
                   <div class='col-md-12 mt-4'>
                   
                   </div> 
                    
                    </div>

                    <div class='modal-footer'>
                    <button type='button' onclick='subForm(".$row->ID_SIGNALEMENT_NEW.")' class='btn btn-primary btn-md' >Valider</button> </form> 
           </form> 

                    <button class='btn btn-outline-primary btn-md' data-dismiss='modal'>Quitter</button>
               </div>
             </div>
            </div>
          </div>
          <div class='modal fade' id='myPicture" .  $row->ID_SIGNALEMENT_NEW . "'>
                <div class='modal-dialog'>
                  <div class='modal-content'>
                  <div class='modal-header' style='background: black;'>
            <div id='title'><b>Détails<h4 
            style='color:#fff;font-size: 18px;'></h4>

            </div>

            <div class='close' style='color:#fff' data-dismiss='modal' aria-label='Close'>
             <span aria-hidden='true'>&times;</span>
           </div>
         </div>
                    <div class='modal-body'>
                     <center><h5><strong></strong> <br><b style='background-color:prink;color:green;'>
                      <div class='row'> 

        
        <div class='col-md-12'>
          <div class='card mb-4 mb-md-0'>
            
            <div class='card-body'>
             ".$html. "
            </div>
          </div>
        </div>
         <div class='col-md-12'>
          <div class='card mb-4 mb-md-0'>
            <div class='card-body'>
              <img style='width:100%'  src='" . $row->IMAGE_UNE . "'>
            </div>
          </div>
        </div>
                       </div>
                    
                     </center>
                    </div>

                    <div class='modal-footer'>
                    
                    <a class='btn btn-outline-danger btn-md' href='" . base_url('PSR/Commentaire/maintenir/' . $row->ID_SIGNALEMENT_NEW .'/'.$row->ID_SIGNALEMENT_NEW) . "'>Valider</a>
                    <button class='btn btn-outline-primary btn-md' data-dismiss='modal'>Quitter</button>
               </div>
             </div>
            </div>
          </div>
          ";
            $sub_array[] = $option;

            $data[] = $sub_array;

        }
        $output = array(
           "draw" => intval($_POST['draw']),
           "recordsTotal" => $this->Modele->all_data($query_principal),
           "recordsFiltered" => $this->Modele->filtrer($query_filter),
           "data" => $data
         );
         echo json_encode($output);

   }
 }