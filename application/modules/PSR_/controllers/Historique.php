<?php
/**
*
*	Element de la police 
**/
class Historique extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->have_droit();
	}

	public function have_droit()
	{
		if ( $this->session->userdata('PSR_ELEMENT')!=1) {

			redirect(base_url()); 

		}
	}


	function getDetais($id_control = 0){

		$dataDetail='SELECT h.ID_CONTROLE,h.NUMERO_PLAQUE,acp.ID_CONTROLE_PLAQUE,us.NOM_UTILISATEUR,acq.INFRACTIONS,acq.MONTANT,acp.DATE_INSERT FROM historiques h LEFT JOIN autres_controles_plaques acp ON h.ID_CONTROLE= acp.ID_CONTROLE_PLAQUE LEFT JOIN utilisateurs us ON us.ID_UTILISATEUR=acp.ID_UTILISATEUR LEFT JOIN autres_controles ac ON ac.ID_CONTROLE_PLAQUE=acp.ID_CONTROLE_PLAQUE LEFT JOIN autres_controles_questionnaires acq ON acq.ID_CONTROLES_QUESTIONNAIRES=ac.ID_CONTROLES_QUESTIONNAIRES LEFT JOIN obr_immatriculations_voitures obv ON obv.ID_IMMATRICULATION=acp.ID_PLAQUE LEFT JOIN quetionnaire_categories qc ON qc.ID_QUESTIONNAIRE_CATEGORIES=acq.ID_QUESTIONNAIRE_CATEGORIES WHERE 1 and h.ID_CONTROLE = '.$id_control;


		$htmlDetail = "<div class='table-responsive'>
		<table id='mytable2' class='table table-bordered table-striped table-hover table-condensed' style='width:100%'>
		<thead>
		<tr>
		<th>Infractions</th>
		<th>Montant</th>
		</tr>
		</thead>

		<tbody>";

		$total = 0;
		foreach ($this->Modele->getRequete($dataDetail) as $key => $value) {

			$total += $value['MONTANT'];

			$htmlDetail .="<tr>
			<td>".$value['INFRACTIONS']."</td>
			<td><span style='float:right'>".number_format($value['MONTANT'], 0, '.', ' ')." FBU</span></td>
			</tr>";	
			
		}

		$htmlDetail .="<tr>
		<th>Total</th>
		<th><span style='float:right'>".number_format($total, 0, '.', ' ')." FBU</th>
		</span></tr>";

		$htmlDetail .="</tbody></table>
		</div>";
		$htmlDetail.="<div class='row'>
		<form name='myform' method='post' action=''>
		<div class='input-group mb-3'>
		<input type='text' class='form-control' placeholder='Recipient's username' aria-label='Recipient's username' aria-describedby='basic-addon2'>
		<div class='input-group-append'>
		<span class='input-group-text' id='basic-addon2'>Payer</span>
		</div>
		</div> 
		</form>
		</div>";

		return $htmlDetail;






//ID_CONTROLE


	}






	function index()
	{
		$data['title'] = 'Historiques';
		$this->load->view('historique_list_v',$data);
	}








	function listing()
	{
		$i=1;
		$query_principal='SELECT ID_HISTORIQUE,h.ID_CONTROLE,h.ID_HISTORIQUE_CATEGORIE, hc.DESCRIPTION as historique_categorie,
		(SELECT NIVEAU_ALERTE FROM infra_infractions WHERE ID_INFRA_INFRACTION= ID_IMMATRICULATIO_PEINE) AS IMMATRICULATION,
		(SELECT NIVEAU_ALERTE FROM infra_infractions WHERE ID_INFRA_INFRACTION= ID_ASSURANCE_PEINE) AS ASSURANCE,
		(SELECT NIVEAU_ALERTE FROM infra_infractions WHERE ID_INFRA_INFRACTION= ID_CONTROLE_TECHNIQUE_PEINE) AS CONTROL_TECHNIQUE,
		(SELECT NIVEAU_ALERTE FROM infra_infractions WHERE ID_INFRA_INFRACTION= ID_VOL_PEINE) AS VOL,(SELECT NIVEAU_ALERTE FROM infra_infractions WHERE ID_INFRA_INFRACTION= ID_PERMIS_PEINE) AS PERMIS_PEINE, h.NUMERO_PLAQUE ,ID_IMMATRICULATIO_PEINE,ID_ASSURANCE_PEINE,ID_CONTROLE_TECHNIQUE_PEINE,ID_VOL_PEINE,ID_PERMIS_PEINE, NUMERO_PERMIS, concat(pe.NOM," ",pe.PRENOM) as user, h.LATITUDE, h.LONGITUDE,h.DATE_INSERTION,h.MONTANT,h.IS_PAID FROM historiques h LEFT JOIN historiques_categories hc ON h.ID_HISTORIQUE_CATEGORIE=hc.ID_CATEGORIE LEFT JOIN utilisateurs us ON us.ID_UTILISATEUR=h.ID_UTILISATEUR  LEFT JOIN psr_elements pe ON pe.ID_PSR_ELEMENT = us.PSR_ELEMENT_ID WHERE 1';



		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';


		if($_POST['length'] != -1){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}

		$order_by='';

		$order_column=array('NUMERO_PLAQUE', 'historique_categorie', 'IMMATRICULATION', 'ASSURANCE', 'CONTROL_TECHNIQUE', 'VOL', 'PERMIS_PEINE', 'NUMERO_PLAQUE', 'NUMERO_PERMIS', 'user', 'DATE_INSERTION', 'DATE_INSERTION');

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY NUMERO_PLAQUE ASC';

		$search = !empty($_POST['search']['value']) ? ("AND NUMERO_PLAQUE LIKE '%$var_search%' "):'';     

		$critaire = '';

		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
		$query_filter = $query_principal.' '.$critaire.' '.$search;

		$fetch_psr = $this->Modele->datatable($query_secondaire);
		$data = array();

		foreach ($fetch_psr as $row)
		{	

			$controlePhysique='';
			$controlePhy='';
			$infraplaque='';
			$infrassur='';
			$infracontrp='';
			$infravol='';
			$infrapermis='';
			$plaque='';
			$permis='';
			$AutresControles='';
			$option='';

			if($row->IMMATRICULATION != Null){
				$infra=$row->IMMATRICULATION;
			}else{
				$infra='<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
			}	
			if($row->ASSURANCE != Null){
				$infrassur=$row->ASSURANCE;
			}else{
				$infrassur='<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
			}
			if($row->CONTROL_TECHNIQUE != Null){
				$infracontrp=$row->CONTROL_TECHNIQUE;
			}else{
				$infracontrp='<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
			}	
			if($row->VOL != Null){
				$infravol=$row->VOL;
			}else{
				$infravol='<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
			}
			if($row->PERMIS_PEINE != Null){
				$infrapermis=$row->PERMIS_PEINE;
			}else{
				$infrapermis='<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
			}

			if($row->NUMERO_PLAQUE != Null){
				$plaque=$row->NUMERO_PLAQUE;
			}else{
				$plaque='<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
			}
			if($row->MONTANT != Null){
				$montant=$row->MONTANT;
			}else{
				$montant='<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
			}
			if($row->NUMERO_PERMIS != Null){
				$permis=$row->NUMERO_PERMIS;
			}else{
				$permis='<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
			}

			if($row->ID_CONTROLE != Null){
				$controlePhy='<span class = "btn btn-info btn-sm " style="float:right" ><i class = "fa fa-eye" ></i></span>';
			}else{
				$controlePhysique='<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
			}

			
			//print_r($row->ID_CONTROLE);die();
			//$fecth_Detail= $this->Modele->getRequete($dataDetail);
			//print_r($fecth_Detail);die();
			
			$detail='';

			$detail .= "<a hre='#' data-toggle='modal'
			data-target='#detail".$row->ID_CONTROLE."'>".$controlePhy."</a>";
			$detail .= "
			<div class='modal fade' id='detail".$row->ID_CONTROLE."'>
			<div class='modal-dialog'>
			<div class='modal-content'>
			<div class='modal-header'>
			<h5 class='modal-title'>Detail de controle</h5>
			<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
			</div>
			<div class='modal-body'>";


			if ($row->ID_CONTROLE != Null) {
				$detail .= $this->getDetais($row->ID_CONTROLE);
			}

			$detail .= "
			</div>
			<div class='modal-footer'>
			<button class='btn btn-primary btn-md' data-dismiss='modal'>Quitter</button>
			</div>

			</div>
			</div>
			</div>";

			
			
			$detailInfraimmatri='';

			$detailInfraimmatri .= "<a hre='#' data-toggle='modal'
			data-target='#detail".$row->ID_IMMATRICULATIO_PEINE."'><span style='color: red'>".$infra."</spa></a>";
			$detailInfraimmatri .= "
			<div class='modal fade' id='detail".$row->ID_IMMATRICULATIO_PEINE."'>
			<div class='modal-dialog'>
			<div class='modal-content'>
			<div class='modal-header'>
			<h5 class='modal-title'>Detail de controle</h5>
			<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
			</div>
			<div class='modal-body'>";

             if($row->ID_IMMATRICULATIO_PEINE != Null) {
				$detailInfraimmatri .= $this->getInfraImmatri($row->ID_IMMATRICULATIO_PEINE);
			}

			$detailInfraimmatri .= "
			</div>
			<div class='modal-footer'>
			<button class='btn btn-primary btn-md' data-dismiss='modal'>Quitter</button>
			</div>

			</div>
			</div>
			</div>";

			$detailInfrassur='';

			$detailInfrassur .= "<a hre='#' data-toggle='modal'
			data-target='#detail".$row->ID_ASSURANCE_PEINE."'><span style='color: red'>".$infrassur."</span></a>";
			$detailInfrassur .= "
			<div class='modal fade' id='detail".$row->ID_ASSURANCE_PEINE."'>
			<div class='modal-dialog'>
			<div class='modal-content'>
			<div class='modal-header'>
			<h5 class='modal-title'>Detail de controle</h5>
			<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
			</div>
			<div class='modal-body'>";

             if($row->ID_ASSURANCE_PEINE != Null) {
				$detailInfrassur .= $this->getInfrassur($row->ID_ASSURANCE_PEINE);
			}

			$detailInfrassur .= "
			</div>
			<div class='modal-footer'>
			<button class='btn btn-primary btn-md' data-dismiss='modal'>Quitter</button>
			</div>

			</div>
			</div>
			</div>";


			$detailInfrcontroltechnique='';

			$detailInfrcontroltechnique .= "<a hre='#' data-toggle='modal'
			data-target='#detail".$row->ID_CONTROLE_TECHNIQUE_PEINE."'><span style='color: red'>".$infracontrp."</span></a>";
			$detailInfrcontroltechnique .= "
			<div class='modal fade' id='detail".$row->ID_CONTROLE_TECHNIQUE_PEINE."'>
			<div class='modal-dialog'>
			<div class='modal-content'>
			<div class='modal-header'>
			<h5 class='modal-title'>Detail de controle</h5>
			<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
			</div>
			<div class='modal-body'>";

             if($row->ID_CONTROLE_TECHNIQUE_PEINE != Null) {
				$detailInfrcontroltechnique .= $this->getInfracontroleTechnique($row->ID_CONTROLE_TECHNIQUE_PEINE);
			}

			$detailInfrcontroltechnique .= "
			</div>
			<div class='modal-footer'>
			<button class='btn btn-primary btn-md' data-dismiss='modal'>Quitter</button>
			</div>

			</div>
			</div>
			</div>";

			$detailInfravol='';

			$detailInfravol .= "<a hre='#' data-toggle='modal'
			data-target='#detail".$row->ID_VOL_PEINE."'><span style='color: red'>".$infravol."</span></a>";
			$detailInfravol .= "
			<div class='modal fade' id='detail".$row->ID_VOL_PEINE."'>
			<div class='modal-dialog'>
			<div class='modal-content'>
			<div class='modal-header'>
			<h5 class='modal-title'>Detail de controle</h5>
			<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
			</div>
			<div class='modal-body'>";

             if($row->ID_VOL_PEINE != Null) {
				$detailInfravol .= $this->getInfraVol($row->ID_VOL_PEINE);
			}

			$detailInfravol .= "
			</div>
			<div class='modal-footer'>
			<button class='btn btn-primary btn-md' data-dismiss='modal'>Quitter</button>
			</div>

			</div>
			</div>
			</div>";


			$detailInfrapermis='';

			$detailInfrapermis .= "<a hre='#' data-toggle='modal'
			data-target='#detail".$row->ID_PERMIS_PEINE."'><span style='color: red'>".$infrapermis."</span></a>";
			$detailInfrapermis .= "
			<div class='modal fade' id='detail".$row->ID_PERMIS_PEINE."'>
			<div class='modal-dialog'>
			<div class='modal-content'>
			<div class='modal-header'>
			<h5 class='modal-title'>Detail de controle</h5>
			<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
			</div>
			<div class='modal-body'>";

             if($row->ID_PERMIS_PEINE != Null) {
				$detailInfrapermis .= $this->getInfraPermis($row->ID_PERMIS_PEINE);
			}

			$detailInfrapermis .= "
			</div>
			<div class='modal-footer'>
			<button class='btn btn-primary btn-md' data-dismiss='modal'>Quitter</button>
			</div>

			</div>
			</div>
			</div>";


			$option = '<div class="dropdown ">
			<a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
			<i class="fa fa-cog"></i>
			Action
			<span class="caret"></span></a>
			<ul class="dropdown-menu dropdown-menu-left">
			';

			$option .= "<li><a hre='#' data-toggle='modal'
			data-target='#mydelete".$row->ID_HISTORIQUE."'><font color='red'>&nbsp;&nbsp;Supprimer</font></a></li>";
			$option .= " </ul>
			</div>
			<div class='modal fade' id='mydelete".$row->ID_HISTORIQUE."'>
			<div class='modal-dialog'>
			<div class='modal-content'>
			<div class='modal-body'>
			<center><h5><strong>Voulez-vous supprimer l'historique de?</strong> <br><b style='background-color:prink;color:green;'><i>" .$row->historique_categorie."</i></b></h5></center>
			</div>

			<div class='modal-footer'>
			<a class='btn btn-danger btn-md' href='" . base_url('PSR/Historique/delete/'.$row->ID_HISTORIQUE)."'>Supprimer</a>
			<button class='btn btn-primary btn-md' data-dismiss='modal'>Quitter</button>
			</div>

			</div>
			</div>
			</div>";
			$stat = '';

			if ($row->IS_PAID == 1) {
				$val_stat = '<input type="button" style="background-color:green"  value="payé">';
			} else {
				$val_stat = '<input type="button" style="background-color:red" value="non payé">';
			}

			$stat .= "<a href='#' data-toggle='modal'
			data-target='#stat" . $row->ID_HISTORIQUE . "'><font color='blue'>&nbsp;&nbsp;" . $val_stat . "</font></a>";

			$stat .= " 
			<div class='modal fade' id='stat" .  $row->ID_HISTORIQUE . "'>
			<div class='modal-dialog'>
			<div class='modal-content'>

			<div class='modal-body'>
			<center>
			<p> Voulez-vous changer le statut?<br></center>
			</div>

			<div class='modal-footer'>
			<a class='btn btn-primary btn-md' href='" . base_url('PSR/Historique/change_statut/' . $row->ID_HISTORIQUE . '/' . $row->IS_PAID) . "'>Changer</a>
			<button class='btn btn-danger btn-md' data-dismiss='modal'>Quitter</button>
			</div>

			</div>
			</div>
			</div>";

			$sub_array = array();
			$sub_array[]=$i++;
			$sub_array[]=$row->historique_categorie;
			$sub_array[]=$row->ID_IMMATRICULATIO_PEINE==2  ? $detailInfraimmatri : $infra;
			$sub_array[]=($row->ID_ASSURANCE_PEINE == 3 || $row->ID_ASSURANCE_PEINE == 5) ? $detailInfrassur : $infrassur; 
			$sub_array[]=($row->ID_CONTROLE_TECHNIQUE_PEINE==7 || $row->ID_CONTROLE_TECHNIQUE_PEINE == 8 ) ? $detailInfrcontroltechnique : $infracontrp;
			$sub_array[]= $row->ID_VOL_PEINE==9 ? $detailInfravol : $infravol; 
			$sub_array[]=$row->ID_PERMIS_PEINE=12 ? $detailInfrapermis : $infrapermis; 
			$sub_array[]=$controlePhysique ? $controlePhysique : $detail ;					
			$sub_array[]=$plaque; 
			$sub_array[]=$permis; 	
			$sub_array[]=$row->user;
			$sub_array[]=$row->DATE_INSERTION;
			$sub_array[] = $montant;
			$sub_array[] = $stat;
			$sub_array[]=$option;

			$data[] = $sub_array;

		}


		$output = array(
			"draw" => intval($_POST['draw']),
			"recordsTotal" =>$this->Modele->all_data($query_principal),
			"recordsFiltered" => $this->Modele->filtrer($query_filter),
			"data" => $data
		);
		echo json_encode($output);

	}

	function change_statut($ID_HISTORIQUE, $IS_PAID)
	{
		if ($IS_PAID == 1) {
			$val = 0;
		}

		if ($IS_PAID == 0) {
			$val = 1;
		}

		$this->Modele->update('historiques', array('ID_HISTORIQUE' => $ID_HISTORIQUE), array('IS_PAID' => $val));

		$datas['message'] = '<div class="alert alert-success text-center" id="message">La modification du statut est faite avec succès</div>';
		$this->session->set_flashdata($datas);
		redirect(base_url('PSR/Historique'));
	}


	function getInfraImmatri($id_immatri = 0){

		$dataDetail='SELECT ID_INFRA_PEINE, ID_INFRA_INFRACTION, AMENDES, MONTANT, POINTS FROM infra_peines WHERE 1 AND ID_INFRA_INFRACTION= '.$id_immatri;
    // print_r($this->Modele->getRequete($dataDetail));die();

		$htmlDetail = "<div class='table-responsive'>
		<table id='mytable2' class='table table-bordered table-striped table-hover table-condensed' style='width:100%'>
		<thead>
		<tr>
		<th>Infractions</th>
		<th>Montant</th>
		</tr>
		</thead>

		<tbody>";

		$total = 0;
		foreach ($this->Modele->getRequete($dataDetail) as $key => $value) {

			$total += $value['MONTANT'];
			$htmlDetail .="<tr>
			<td>".$value['AMENDES']."</td>
			<td><span style='float:right'>".number_format($value['MONTANT'], 0, '.', ' ')." FBU</span></td>
			</tr>";	
			
		}

		$htmlDetail .="<tr>
		<th>Total</th>
		<th><span style='float:right'>".number_format($total, 0, '.', ' ')." FBU</th>
		</span></tr>";

		// $htmlDetail .="<tr colspan='2'><th></th>
		//                  <th  style='float:right'><div class='row'>
		// <form name='myform' method='post' action=''>
		// <div class='input-group mb-3'>
		// <input type='text' class='form-control' placeholder='Recipient's username' aria-label='Recipient's username' aria-describedby='basic-addon2'>
		// <div class='input-group-append'>
		// <span class='input-group-text' id='basic-addon2'>Payer</span>
		// </div>
		// </div>
		// </form>
		
		// </div></th>
		//                </tr>";

		$htmlDetail .="</tbody></table>
		</div>";
	

		return $htmlDetail;

	}

	function getInfrassur($id_immatri = 0){

		$dataDetail='SELECT ID_INFRA_PEINE, ID_INFRA_INFRACTION, AMENDES, MONTANT, POINTS FROM infra_peines WHERE 1 AND ID_INFRA_INFRACTION= '.$id_immatri;
    

		$htmlDetail = "<div class='table-responsive'>
		<table id='mytable2' class='table table-bordered table-striped table-hover table-condensed' style='width:100%'>
		<thead>
		<tr>
		<th>Infractions</th>
		<th>Montant</th>
		</tr>
		</thead>

		<tbody>";

		$total = 0;
		foreach ($this->Modele->getRequete($dataDetail) as $key => $value) {

			$total += $value['MONTANT'];
			$htmlDetail .="<tr>
			<td>".$value['AMENDES']."</td>
			<td><span style='float:right'>".number_format($value['MONTANT'], 0, '.', ' ')." FBU</span></td>
			</tr>";	
			
		}

		$htmlDetail .="<tr>
		<th>Total</th>
		<th><span style='float:right'>".number_format($total, 0, '.', ' ')." FBU</th>
		</span></tr>";

		// $htmlDetail .="<tr colspan='2'><th></th>
		//                  <th  style='float:right'><div class='row'>
		// <form name='myform' method='post' action=''>
		// <div class='input-group mb-3'>
		// <input type='text' class='form-control' placeholder='Recipient's username' aria-label='Recipient's username' aria-describedby='basic-addon2'>
		// <div class='input-group-append'>
		// <span class='input-group-text' id='basic-addon2'>Payer</span>
		// </div>
		// </div>
		// </form>
		
		// </div></th>
		//                </tr>";

		$htmlDetail .="</tbody></table>
		</div>";
	

		return $htmlDetail;

	}

		function getInfraPermis($id_immatri = 0){

		$dataDetail='SELECT ID_INFRA_PEINE, ID_INFRA_INFRACTION, AMENDES, MONTANT, POINTS FROM infra_peines WHERE 1 AND ID_INFRA_INFRACTION= '.$id_immatri;
    

		$htmlDetail = "<div class='table-responsive'>
		<table id='mytable2' class='table table-bordered table-striped table-hover table-condensed' style='width:100%'>
		<thead>
		<tr>
		<th>Infractions</th>
		<th>Montant</th>
		</tr>
		</thead>

		<tbody>";

		$total = 0;
		foreach ($this->Modele->getRequete($dataDetail) as $key => $value) {

			$total += $value['MONTANT'];
			$htmlDetail .="<tr>
			<td>".$value['AMENDES']."</td>
			<td><span style='float:right'>".number_format($value['MONTANT'], 0, '.', ' ')." FBU</span></td>
			</tr>";	
			
		}

		$htmlDetail .="<tr>
		<th>Total</th>
		<th><span style='float:right'>".number_format($total, 0, '.', ' ')." FBU</th>
		</span></tr>";

		// $htmlDetail .="<tr colspan='2'><th></th>
		//                  <th  style='float:right'><div class='row'>
		// <form name='myform' method='post' action=''>
		// <div class='input-group mb-3'>
		// <input type='text' class='form-control' placeholder='Recipient's username' aria-label='Recipient's username' aria-describedby='basic-addon2'>
		// <div class='input-group-append'>
		// <span class='input-group-text' id='basic-addon2'>Payer</span>
		// </div>
		// </div>
		// </form>
		
		// </div></th>
		//                </tr>";

		$htmlDetail .="</tbody></table>
		</div>";
	

		return $htmlDetail;

	}

		function getInfraVol($id_immatri = 0){

		$dataDetail='SELECT ID_INFRA_PEINE, ID_INFRA_INFRACTION, AMENDES, MONTANT, POINTS FROM infra_peines WHERE 1 AND ID_INFRA_INFRACTION= '.$id_immatri;
    

		$htmlDetail = "<div class='table-responsive'>
		<table id='mytable2' class='table table-bordered table-striped table-hover table-condensed' style='width:100%'>
		<thead>
		<tr>
		<th>Infractions</th>
		<th>Montant</th>
		</tr>
		</thead>

		<tbody>";

		$total = 0;
		foreach ($this->Modele->getRequete($dataDetail) as $key => $value) {

			$total += $value['MONTANT'];
			$htmlDetail .="<tr>
			<td>".$value['AMENDES']."</td>
			<td><span style='float:right'>".number_format($value['MONTANT'], 0, '.', ' ')." FBU</span></td>
			</tr>";	
			
		}

		$htmlDetail .="<tr>
		<th>Total</th>
		<th><span style='float:right'>".number_format($total, 0, '.', ' ')." FBU</th>
		</span></tr>";

		// $htmlDetail .="<tr colspan='2'><th></th>
		//                  <th  style='float:right'><div class='row'>
		// <form name='myform' method='post' action=''>
		// <div class='input-group mb-3'>
		// <input type='text' class='form-control' placeholder='Recipient's username' aria-label='Recipient's username' aria-describedby='basic-addon2'>
		// <div class='input-group-append'>
		// <span class='input-group-text' id='basic-addon2'>Payer</span>
		// </div>
		// </div>
		// </form>
		
		// </div></th>
		//                </tr>";

		$htmlDetail .="</tbody></table>
		</div>";
	

		return $htmlDetail;

	}


		function getInfracontroleTechnique($id_immatri = 0){

		$dataDetail='SELECT ID_INFRA_PEINE, ID_INFRA_INFRACTION, AMENDES, MONTANT, POINTS FROM infra_peines WHERE 1 AND ID_INFRA_INFRACTION= '.$id_immatri;
    

		$htmlDetail = "<div class='table-responsive'>
		<table id='mytable2' class='table table-bordered table-striped table-hover table-condensed' style='width:100%'>
		<thead>
		<tr>
		<th>Infractions</th>
		<th>Montant</th>
		</tr>
		</thead>

		<tbody>";

		$total = 0;
		foreach ($this->Modele->getRequete($dataDetail) as $key => $value) {

			$total += $value['MONTANT'];
			$htmlDetail .="<tr>
			<td>".$value['AMENDES']."</td>
			<td><span style='float:right'>".number_format($value['MONTANT'], 0, '.', ' ')." FBU</span></td>
			</tr>";	
			
		}

		$htmlDetail .="<tr>
		<th>Total</th>
		<th><span style='float:right'>".number_format($total, 0, '.', ' ')." FBU</th>
		</span></tr>";

		// $htmlDetail .="<tr colspan='2'><th></th>
		//                  <th  style='float:right'><div class='row'>
		// <form name='myform' method='post' action=''>
		// <div class='input-group mb-3'>
		// <input type='text' class='form-control' placeholder='Recipient's username' aria-label='Recipient's username' aria-describedby='basic-addon2'>
		// <div class='input-group-append'>
		// <span class='input-group-text' id='basic-addon2'>Payer</span>
		// </div>
		// </div>
		// </form>
		
		// </div></th>
		//                </tr>";

		$htmlDetail .="</tbody></table>
		</div>";
	

		return $htmlDetail;

	}







	function delete()
	{
		$table="Historiques";
		$criteres['ID_HISTORIQUE']=$this->uri->segment(4);
		$data['rows']= $this->Modele->getOne( $table,$criteres);
		$this->Modele->delete($table,$criteres);

		$data['message']='<div class="alert alert-success text-center" id="message">L"Element est supprimé avec succès</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('PSR/Historique'));
	}
}
?>



