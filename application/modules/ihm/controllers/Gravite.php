<?php

class Gravite extends CI_Controller
{

	function index()
	{
		$data['title'] = "Listes gravité";
		$this->load->view('Gravite_List_View', $data);
	}

	function listing()
	{
		$i = 1;
		$query_principal = "SELECT `ID_TYPE_GRAVITE`,`DESCRIPTION` FROM `type_gravite` WHERE 1";


		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit = 'LIMIT 0,10';

		if ($_POST['length'] != -1) {



			$limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
		}


		$order_by = '';

		$order_column = array('DESCRIPTION');


		$order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY DESCRIPTION ASC';

		$search = !empty($_POST['search']['value']) ? ("AND DESCRIPTION LIKE '%$var_search%' ") : '';

		$critaire = '';

		$query_secondaire = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $order_by . '   ' . $limit;
		$query_filter = $query_principal . ' ' . $critaire . ' ' . $search;

		$fetch_peine = $this->Modele->datatable($query_secondaire);
		$data = array();





		foreach ($fetch_peine as $row) {

			$option = '<div class="dropdown ">
			<a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
			<i class="fa fa-cog"></i>
			Action
			<span class="caret"></span></a>
			<ul class="dropdown-menu dropdown-menu-left">
			';

			$option .= "<li><a hre='#' data-toggle='modal'
			data-target='#mydelete" . $row->ID_TYPE_GRAVITE . "'><font color='red'>&nbsp;&nbsp;Supprimer</font></a></li>";
			$option .= "<li><a class='btn-md' href='" . base_url('ihm/Gravite/getOne/' . $row->ID_TYPE_GRAVITE) . "'><label class='text-info'>&nbsp;&nbsp;Modifier</label></a></li>";
			$option .= " </ul>
			</div>
			<div class='modal fade' id='mydelete" . $row->ID_TYPE_GRAVITE . "'>
			<div class='modal-dialog'>
			<div class='modal-content'>

			<div class='modal-body'>
			<center><h5><strong>Voulez-vous supprimer?</strong> <br><b style='background-color:prink;color:green;'><i>" . $row->DESCRIPTION . "</i></b></h5></center>
			</div>

			<div class='modal-footer'>
			<a class='btn btn-danger btn-md' href='" . base_url('ihm/Gravite/delete/' . $row->ID_TYPE_GRAVITE) . "'>Supprimer</a>
			<button class='btn btn-primary btn-md' data-dismiss='modal'>Quitter</button>
			</div>

			</div>
			</div>
			</div>";

			$sub_array = array();
			$sub_array[] = $row->DESCRIPTION;
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

	function ajouter()
	{
		//$data['COULEUR'] = $this->Modele->getRequete('SELECT `ID_TYPE_GRAVITE`,`DESCRIPTION` FROM `type_gravite` WHERE 1');

		$data['title'] = 'Nouvelle gravité';
		$this->load->View('ihm/Gravite_Add_View', $data);
	}

	function add()
	{

		$this->form_validation->set_rules('DESCRIPTION', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


		if ($this->form_validation->run() == FALSE) {
			$this->ajouter();
		} else {

			$data_insert = array(

				'DESCRIPTION' => $this->input->post('DESCRIPTION'),
				'GRAVITE_TRADUCTION' => $this->input->post('GRAVITE_TRADUCTION'),
			);

			$table = 'type_gravite';
			$this->Modele->create($table, $data_insert);

			$data['message'] = '<div class="alert alert-success text-center" id="message">' . "L'ajout se faite avec succès" . '</div>';
			$this->session->set_flashdata($data);
			redirect(base_url('ihm/Gravite/index'));
		}
	}


	function saveForma()
	{
		$FR = $this->input->post('FR');
		$ENG = $this->input->post('ENG');
		$KIR = $this->input->post('KIR');
		$KISW = $this->input->post('KISW');

		$data  = array(
			'FR' => $FR,
			'ENG' => $ENG,
			'KIR' => $KIR,
			'KISW' => $KISW,
		);

		echo json_encode($data);
	}

	function getOne()
	{
		$id = $this->uri->segment(4);
		$data['data'] = $this->Modele->getOne('type_gravite', array('ID_TYPE_GRAVITE' => $id));
		$data['title'] = 'Modification de gravité';
		$this->load->view('Gravite_Update_View', $data);
	}

	function update()
	{

		$this->form_validation->set_rules('DESCRIPTION', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


		$id = $this->input->post('ID_TYPE_GRAVITE');

		if ($this->form_validation->run() == FALSE) {


			$this->getOne();
		} else {
			$id = $this->input->post('ID_TYPE_GRAVITE');

			$data = array(
				'DESCRIPTION' => $this->input->post('DESCRIPTION'),
				'GRAVITE_TRADUCTION' => $this->input->post('GRAVITE_TRADUCTION'),
			);

			$this->Modele->update('type_gravite', array('ID_TYPE_GRAVITE' => $id), $data);
			$datas['message'] = '<div class="alert alert-success text-center" id="message">La modification du menu est faite avec succès</div>';
			$this->session->set_flashdata($datas);
			redirect(base_url('ihm/Gravite'));
		}
	}


	function delete()
	{
		$table = "type_gravite";
		$criteres['ID_TYPE_GRAVITE'] = $this->uri->segment(4);
		$data['rows'] = $this->Modele->getOne($table, $criteres);
		$this->Modele->delete($table, $criteres);

		$data['message'] = '<div class="alert alert-success text-center" id="message">L"Element est supprimé avec succès</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('ihm/Gravite'));
	}
}
