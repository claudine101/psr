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
		if ($this->session->userdata('PSR_ELEMENT') != 1) {

			redirect(base_url());
		}
	}
	function index()
	{
		$data['title'] = 'Historiques';
		$this->load->view('historique_list_v', $data);
	}

	function listing()
	{
		$i = 1;
		$query_principal = 'SELECT ID_HISTORIQUE,acp.ID_CONTROLE_PLAQUE,h.ID_HISTORIQUE_CATEGORIE, hc.DESCRIPTION as historique_categorie,
		(SELECT AMENDES FROM infra_peines WHERE ID_INFRA_PEINE= ID_IMMATRICULATIO_PEINE) AS IMMATRICULATION,
		(SELECT AMENDES FROM infra_peines WHERE ID_INFRA_PEINE= ID_ASSURANCE_PEINE) AS ASSURANCE,
		(SELECT AMENDES FROM infra_peines WHERE ID_INFRA_PEINE= ID_CONTROLE_TECHNIQUE_PEINE) AS CONTROL_TECHNIQUE,
		(SELECT AMENDES FROM infra_peines WHERE ID_INFRA_PEINE= ID_VOL_PEINE) AS VOL,(SELECT AMENDES FROM infra_peines WHERE ID_INFRA_PEINE= ID_PERMIS_PEINE) AS PERMIS_PEINE,acq.INFRACTIONS as autres_infractions, h.NUMERO_PLAQUE , NUMERO_PERMIS, concat(pe.NOM," ",pe.PRENOM) as user, h.LATITUDE, h.LONGITUDE,h.DATE_INSERTION,h.MONTANT,IS_PAID FROM historiques h LEFT JOIN historiques_categories hc ON h.ID_HISTORIQUE_CATEGORIE=hc.ID_CATEGORIE LEFT JOIN utilisateurs us ON us.ID_UTILISATEUR=h.ID_UTILISATEUR  LEFT JOIN autres_controles ac ON h.ID_CONTROLE=ac.ID_AUTRES_CONTROLES LEFT JOIN autres_controles_plaques acp ON acp.ID_CONTROLE_PLAQUE=ac.ID_CONTROLE_PLAQUE LEFT JOIN autres_controles_questionnaires acq ON acq.ID_CONTROLES_QUESTIONNAIRES=ac.ID_CONTROLES_QUESTIONNAIRES LEFT JOIN obr_immatriculations_voitures obi on obi.ID_IMMATRICULATION=acp.ID_PLAQUE LEFT JOIN psr_elements pe ON pe.ID_PSR_ELEMENT = us.PSR_ELEMENT_ID WHERE 1';



		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit = 'LIMIT 0,10';


		if ($_POST['length'] != -1) {
			$limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
		}

		$order_by = '';

		$order_column = array('NUMERO_PLAQUE', 'historique_categorie', 'IMMATRICULATION', 'ASSURANCE', 'CONTROL_TECHNIQUE', 'VOL', 'PERMIS_PEINE', 'ID_CONTROLE_PLAQUE', 'NUMERO_PLAQUE', 'NUMERO_PERMIS', 'user', 'DATE_INSERTION', 'DATE_INSERTION', '');

		$order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY NUMERO_PLAQUE ASC';

		$search = !empty($_POST['search']['value']) ? ("AND NUMERO_PLAQUE LIKE '%$var_search%' ") : '';

		$critaire = '';

		$query_secondaire = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $order_by . '   ' . $limit;
		$query_filter = $query_principal . ' ' . $critaire . ' ' . $search;

		$fetch_psr = $this->Modele->datatable($query_secondaire);
		$data = array();

		foreach ($fetch_psr as $row) {
			$controlePhysique = '';
			$infraplaque = '';
			$infrassur = '';
			$infracontrp = '';
			$infravol = '';
			$infrapermis = '';
			$plaque = '';
			$permis = '';
			$AutresControles = '';

			if ($row->IMMATRICULATION != Null) {
				$infra = $row->IMMATRICULATION;
			} else {
				$infra = '<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
			}
			if ($row->ASSURANCE != Null) {
				$infrassur = $row->ASSURANCE;
			} else {
				$infrassur = '<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
			}
			if ($row->CONTROL_TECHNIQUE != Null) {
				$infracontrp = $row->CONTROL_TECHNIQUE;
			} else {
				$infracontrp = '<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
			}
			if ($row->VOL != Null) {
				$infravol = $row->VOL;
			} else {
				$infravol = '<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
			}
			if ($row->PERMIS_PEINE != Null) {
				$infrapermis = $row->PERMIS_PEINE;
			} else {
				$infrapermis = '<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
			}

			if ($row->NUMERO_PLAQUE != Null) {
				$plaque = $row->NUMERO_PLAQUE;
			} else {
				$plaque = '<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
			}
			if ($row->NUMERO_PERMIS != Null) {
				$permis = $row->NUMERO_PERMIS;
			} else {
				$permis = '<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
			}

			if ($row->autres_infractions != Null) {
				$AutresControles = $row->autres_infractions;
			} else {
				$AutresControles = '<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
			}

			if ($row->ID_CONTROLE_PLAQUE != Null) {
				$controlePhysique = $row->ID_CONTROLE_PLAQUE;
			} else {
				$controlePhysique = '<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
			}
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
			//print_r($option);die();

			$sub_array = array();
			$sub_array[] = $i++;
			$sub_array[] = $row->historique_categorie;
			$sub_array[] = $infra;
			$sub_array[] = $infrassur;
			$sub_array[] = $infracontrp;
			$sub_array[] = $infravol;
			$sub_array[] = $infrapermis;
			$sub_array[] = $controlePhysique;
			$sub_array[] = $AutresControles;
			$sub_array[] = $plaque;
			$sub_array[] = $permis;
			$sub_array[] = $row->user;
			$sub_array[] = $row->DATE_INSERTION;
			$sub_array[] = $row->MONTANT;
			$sub_array[] = $stat;

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
}
