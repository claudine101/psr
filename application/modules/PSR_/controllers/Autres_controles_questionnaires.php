<?php
/**
*NTAHIMPERA Martin Luther King
*	autres_controles_questionnaires (PSR) 
**/

class Autres_controles_questionnaires extends CI_Controller
{
	function __construct()
	{

		parent::__construct();
	}

	function index()
	{

		$data['title'] = 'AUTRES QUESTIONS DE CONTROLE';
		$this->load->view('autres_controles_questionnaire_List_view',$data);

	}

	function listing()
	{
        $i=1;
		$query_principal="SELECT `ID_CONTROLES_QUESTIONNAIRES`,`INFRACTIONS`,`MONTANT`,`POURCENTAGE`,questionnaire_categories.CATEGORIES FROM autres_controles_questionnaires JOIN questionnaire_categories ON questionnaire_categories.ID_QUESTIONNAIRE_CATEGORIES=autres_controles_questionnaires.ID_QUESTIONNAIRE_CATEGORIES";

		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';

		if($_POST['length'] != -1){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}

		$order_by='';

		$order_column=array('ID_CONTROLES_QUESTIONNAIRES','INFRACTIONS','MONTANT','POURCENTAGE','CATEGORIES');

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY INFRACTIONS,MONTANT,POURCENTAGE  ASC';

		$search = !empty($_POST['search']['value']) ? ("AND INFRACTIONS LIKE '%$var_search%' OR MONTANT LIKE '%$var_search%' "):'';     

		$critaire = '';

		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.' '.$limit;
		$query_filter = $query_principal.' '.$critaire.' '.$search;

		$fetch_infraction = $this->Modele->datatable($query_secondaire);
		$data = array();

		foreach ($fetch_infraction as $row)
		{

			$option = '<div class="dropdown ">
			<a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
			<i class="fa fa-cog"></i>
			Action
			<span class="caret"></span></a>
			<ul class="dropdown-menu dropdown-menu-left">
			';

			$option .= "<li><a hre='#' data-toggle='modal'
			data-target='#mydelete" . $row->ID_CONTROLES_QUESTIONNAIRES . "'><font color='red'>&nbsp;&nbsp;Supprimer</font></a></li>";
			$option .= "<li><a class='btn-md' href='" . base_url('PSR/Autres_controles_questionnaires/getOne/'.$row->ID_CONTROLES_QUESTIONNAIRES ) . "'><label class='text-info'>&nbsp;&nbsp;Modifier</label></a></li>";
			$option .= " </ul>
			</div>
			<div class='modal fade' id='mydelete" .  $row->ID_CONTROLES_QUESTIONNAIRES . "'>
			<div class='modal-dialog'>
			<div class='modal-content'>

			<div class='modal-body'>
			<center><h5><strong>Voulez-vous supprimer?</strong> <br><b style='background-color:prink;color:green;'><i>" .$row->INFRACTIONS." ".$row->MONTANT." ".$row->CATEGORIES." ".$row->POURCENTAGE." </i></b></h5></center>
			</div>

			<div class='modal-footer'>
			<a class='btn btn-danger btn-md' href='" . base_url('PSR/Autres_controles_questionnaires/delete/'.$row->ID_CONTROLES_QUESTIONNAIRES) . "'>Supprimer</a>
			<button class='btn btn-primary btn-md' data-dismiss='modal'>Quitter</button>
			</div>

			</div>
			</div>
			</div>";

			$sub_array = array();
			$sub_array[]=$i++;
			$sub_array[]=$row->INFRACTIONS;
			$sub_array[]=$row->MONTANT;
			$sub_array[]=$row->CATEGORIES;
			$sub_array[]=$row->POURCENTAGE;    			
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


	function ajouter()

	{

		$data['categorie_g'] = $this->Modele->getRequete('SELECT ID_QUESTIONNAIRE_CATEGORIES, CATEGORIES FROM questionnaire_categories WHERE 1');
		$data['title'] = 'NOUVEAU CATEGORIE';

		$this->load->view('autres_controles_questionnaire_add_view',$data);
	//var_dump($data);die();
	}

	function add()

	{

		$this->form_validation->set_rules('ID_QUESTIONNAIRE_CATEGORIES','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('INFRACTION','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('MONTANT','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('POURCENTAGE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


		if($this->form_validation->run() == FALSE)
		{
			$this->ajouter();
		}else{

			$data_insert=array(

				'ID_QUESTIONNAIRE_CATEGORIES'=>$this->input->post('ID_QUESTIONNAIRE_CATEGORIES'),

				'INFRACTIONS'=>$this->input->post('INFRACTION'),

				'MONTANT'=>$this->input->post('MONTANT'),

				'POURCENTAGE'=>$this->input->post('POURCENTAGE'),

			);

			$table='autres_controles_questionnaires';
			$this->Modele->create($table,$data_insert);

			$data['message']='<div class="alert alert-success text-center" id="message">'."L'ajout se faite avec succès".'</div>';
			$this->session->set_flashdata($data);
			redirect(base_url('PSR/Autres_controles_questionnaires'));

		}

	}

	function getOne($id=0)
	{

		// $id=$this->uri->segment(4);
		$data['questions']=$this->Modele->getRequeteOne('SELECT ID_CONTROLES_QUESTIONNAIRES, INFRACTIONS, MONTANT, ID_QUESTIONNAIRE_CATEGORIES, POURCENTAGE FROM autres_controles_questionnaires WHERE ID_CONTROLES_QUESTIONNAIRES='.$id);
		$data['categorie_g'] = $this->Modele->getRequete('SELECT ID_QUESTIONNAIRE_CATEGORIES, CATEGORIES FROM questionnaire_categories WHERE 1');

		$data['title']='MODIFICATION DES INFRACTIONS';
		$this->load->view('autres_controles_questionnaire_update_view',$data);
	}

	function update()
	{
   // print_r();die();
		$this->form_validation->set_rules('ID_QUESTIONNAIRE_CATEGORIES','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('INFRACTIONS','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('MONTANT','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('POURCENTAGE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$id=$this->input->post('ID_CONTROLES_QUESTIONNAIRES');

		if ($this->form_validation->run() == FALSE) {

			$this->getOne();
		}else{
			$id=$this->input->post('ID_CONTROLES_QUESTIONNAIRES');
			$data_update=array(
				
				'ID_QUESTIONNAIRE_CATEGORIES'=>$this->input->post('ID_QUESTIONNAIRE_CATEGORIES'),

				'INFRACTIONS'=>$this->input->post('INFRACTIONS'),

				'MONTANT'=>$this->input->post('MONTANT'),

				'POURCENTAGE'=>$this->input->post('POURCENTAGE'),
			);
			$this->Modele->update('autres_controles_questionnaires',array('ID_CONTROLES_QUESTIONNAIRES'=>$id),$data_update);
			$datas['message']='<div class="alert alert-success text-center" id="message">La modification infraction et du montant se fait avec succes</div>';
			$this->session->set_flashdata($datas);
			redirect(base_url('PSR/Autres_controles_questionnaires/'));
		}

	}

	function delete()
	{
		$table="autres_controles_questionnaires";
		$criteres['ID_CONTROLES_QUESTIONNAIRES']=$this->uri->segment(4);
		$data['data']=$this->Modele->getOne($table,$criteres);
		$this->Modele->delete($table,$criteres);

		$data['message']='<div class="alert alert-success text-center" id="message">Infraction est supprimé avec succès</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('PSR/Autres_controles_questionnaires'));
	}

}

?>