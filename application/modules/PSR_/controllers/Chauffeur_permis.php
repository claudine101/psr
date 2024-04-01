<?php
/**
*NTAHIMPERA Martin Luther King
*	Element de la police 
**/
class Chauffeur_permis extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->have_droit();
	}

	public function have_droit()
	{
	if ($this->session->userdata('CONTROLE_TECHNIQUE')!=1 && $this->session->userdata('PSR_ELEMENT')!=1) {

			redirect(base_url());

		}
	}
	function index()
	{
		$data['title'] = 'liste des permis';
		$this->load->view('permis_list_v',$data);
	}

	function listing()
	{
		$i=1;
		$query_principal="SELECT ID_PERMIS, NUMERO_PERMIS, NOM_PROPRIETAIRE, CATEGORIES, DATE_NAISSANCE, DATE_DELIVER, DATE_EXPIRATION FROM chauffeur_permis WHERE 1";

		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';


		if($_POST['length'] != -1){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}

		$order_by='';


		$order_column=array('NUMERO_PERMIS','NOM_PROPRIETAIRE','CATEGORIES');

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY Nom ASC';

		$search = !empty($_POST['search']['value']) ? ("AND NUMERO_PERMIS LIKE '%$var_search%' OR NOM_PROPRIETAIRE LIKE '%$var_search%' OR CATEGORIES LIKE '%$var_search%'  "):'';     

		$critaire = '';

		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
		$query_filter = $query_principal.' '.$critaire.' '.$search;

		$fetch_psr = $this->Modele->datatable($query_secondaire);
		$data = array();

		foreach ($fetch_psr as $row)
		{

			$option = '<div class="dropdown ">
			<a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
			<i class="fa fa-cog"></i>
			Action
			<span class="caret"></span></a>
			<ul class="dropdown-menu dropdown-menu-left">
			';

			$option .= "<li><a hre='#' data-toggle='modal'
			data-target='#mydelete" . $row->ID_PERMIS . "'><font color='red'>&nbsp;&nbsp;Supprimer</font></a></li>";
			$option .= "<li><a class='btn-md' href='" . base_url('PSR/Chauffeur_permis/getOne/'.$row->ID_PERMIS) . "'><label class='text-info'>&nbsp;&nbsp;Modifier</label></a></li>";
			$option .= " </ul>
			</div>
			<div class='modal fade' id='mydelete" .$row->ID_PERMIS. "'>
			<div class='modal-dialog'>
			<div class='modal-content'>

			<div class='modal-body'>
			<center><h5><strong>Voulez-vous supprimer?</strong> <br><b style='background-color:prink;color:green;'><i>".$row->NOM_PROPRIETAIRE."</i></b></h5></center>
			</div>

			<div class='modal-footer'>
			<a class='btn btn-danger btn-md' href='" . base_url('PSR/Chauffeur_permis/delete/'.$row->ID_PERMIS) . "'>Supprimer</a>
			<button class='btn btn-primary btn-md' data-dismiss='modal'>Quitter</button>
			</div>

			</div>
			</div>
			</div>";

			$sub_array = array();
			$sub_array[]=$i++;
			$sub_array[]=$row->NUMERO_PERMIS; 
			$sub_array[]=$row->NOM_PROPRIETAIRE;
			$sub_array[]=$row->CATEGORIES;
			$sub_array[]=$row->DATE_NAISSANCE; 
			$sub_array[]=$row->DATE_DELIVER; 
			$sub_array[]=$row->DATE_EXPIRATION; 					
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

		$data['title'] = 'Nouvelle Permis';
		$this->load->view('permis_add_v',$data);

	}


	function add()
	{

		$this->form_validation->set_rules('NUMERO_PERMIS','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('NOM_PROPRIETAIRE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('CATEGORIES','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('DATE_NAISSANCE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('DATE_DELIVER','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('DATE_EXPIRATION','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		if($this->form_validation->run() == FALSE)
		{
			$this->ajouter();
		}else{

			$data_insert=array(
				'NUMERO_PERMIS'=>$this->input->post('NUMERO_PERMIS'),
				'NOM_PROPRIETAIRE'=>$this->input->post('NOM_PROPRIETAIRE'),
				'CATEGORIES'=>$this->input->post('CATEGORIES'),
				'DATE_NAISSANCE'=>$this->input->post('DATE_NAISSANCE'),
				'DATE_DELIVER'=>$this->input->post('DATE_DELIVER'),
				'DATE_EXPIRATION'=>$this->input->post('DATE_EXPIRATION'),
			);
			$table='chauffeur_permis';
			$this->Modele->create($table,$data_insert);

			$data['message']='<div class="alert alert-success text-center" id="message">'."L'ajout se faite avec succès".'</div>';
			$this->session->set_flashdata($data);
			redirect(base_url('PSR/Chauffeur_permis/index'));

		}

	}
	function getOne($id=0)
	{
		$id=$this->uri->segment(4);
		$data['title'] = "Modification d'un Police";
		$data['data']=$this->Modele->getOne('chauffeur_permis',array('ID_PERMIS'=>$id));
		$this->load->view('permis_update_v',$data);
	}

	function update()
	{
		
		$this->form_validation->set_rules('NUMERO_PERMIS','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('NOM_PROPRIETAIRE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('CATEGORIES','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('DATE_NAISSANCE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('DATE_DELIVER','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('DATE_EXPIRATION','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));



		$id=$this->input->post('ID_PERMIS');

		if ($this->form_validation->run() == FALSE) {
			$this->getOne();
		}else{
			$id=$this->input->post('ID_PERMIS');

			$data=array(
				'NUMERO_PERMIS'=>$this->input->post('NUMERO_PERMIS'),
				'NOM_PROPRIETAIRE'=>$this->input->post('NOM_PROPRIETAIRE'),
				'CATEGORIES'=>$this->input->post('CATEGORIES'),
				'DATE_NAISSANCE'=>$this->input->post('DATE_NAISSANCE'),
				'DATE_DELIVER'=>$this->input->post('DATE_DELIVER'),
				'DATE_EXPIRATION'=>$this->input->post('DATE_EXPIRATION'),
			);

			$this->Modele->update('chauffeur_permis',array('ID_PERMIS'=>$id),$data);
			$datas['message']='<div class="alert alert-success text-center" id="message">La modification du menu est faite avec succès</div>';
			$this->session->set_flashdata($datas);
			redirect(base_url('PSR/Chauffeur_permis/index'));
		}
	}

	function delete()
	{
		$table="chauffeur_permis";
		$criteres['ID_PERMIS']=$this->uri->segment(4);
		$data['rows']= $this->Modele->getOne( $table,$criteres);
		$this->Modele->delete($table,$criteres);

		$data['message']='<div class="alert alert-success text-center" id="message">L"Element est supprimé avec succès</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('PSR/Chauffeur_permis/index'));
	}

}
?>



