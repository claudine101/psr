<?php
/**
*NTAHIMPERA Martin Luther King
*	autres_controles_questionnaires 
**/
class  Autres_controles_questionnaires extends CI_Controller
{
	function __construct()
	{

		parent::__construct();
		$this->have_droit();
	}

	public function have_droit()
	{
		if ($this->session->userdata('QUESTIONNAIRE')!=1) {

			redirect(base_url());

		}
	}

	function index()
	{
		$data['title'] = 'Autres questions de controle ';
		$this->load->view('PSR/autres_controles_questionnaires_List_view',$data);
	}

	function listing(){
		$i=1;

		$query_principal='SELECT `ID_CONTROLES_QUESTIONNAIRES`,`INFRACTIONS` FROM `autres_controles_questionnaires` WHERE 1';


		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';


		if($_POST['length'] != -1){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}

		$order_by='';

		$order_column=array('ID_CONTROLES_QUESTIONNAIRES','INFRACTIONS');

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY INFRACTIONS, ASC';

		$search = !empty($_POST['search']['value']) ? ("AND INFRACTIONS LIKE '%$var_search%'"):'';     

		$critaire = '';

		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
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
			$option .= "<li><a class='btn-md' href='" . base_url('PSR/Autres_controles_questionnaires/getOne/'.$row->ID_CONTROLES_QUESTIONNAIRES) . "'><label class='text-info'>&nbsp;&nbsp;Modifier</label></a></li>";
			$option .= " </ul>
			</div>
			<div class='modal fade' id='mydelete" .  $row->ID_CONTROLES_QUESTIONNAIRES . "'>
			<div class='modal-dialog'>
			<div class='modal-content'>

			<div class='modal-body'>
			<center><h5><strong>Voulez-vous supprimer?</strong> <br><b style='background-color:prink;color:green;'><i>" .$row->INFRACTIONS." </i></b></h5></center>
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
		$data['infraction_g'] = $this->Modele->getRequete('SELECT ID_CONTROLES_QUESTIONNAIRES,INFRACTIONS FROM autres_controles_questionnaires WHERE 1');


		$data['title'] = 'Nouvelle Infraction';
		$this->load->view('PSR/autres_controles_questionnaires_add_view',$data);
	}

	function add()
	{
		$this->form_validation->set_rules('INFRACTION','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		if($this->form_validation->run() == FALSE)
		{
			$this->ajouter();
		}else{

			$data_insert=array(

				'INFRACTIONS'=>$this->input->post('INFRACTION'),									                  );

			$table='autres_controles_questionnaires';
			$this->Modele->create($table,$data_insert);

			$data['message']='<div class="alert alert-success text-center" id="message">'."L'ajout se faite avec succès".'</div>';
			$this->session->set_flashdata($data);
			redirect(base_url('PSR/Autres_controles_questionnaires/'));

		}
	}

	function getOne()
	{
		$id=$this->uri->segment(4);
		$data['data']=$this->Modele->getOne('autres_controles_questionnaires',array('ID_CONTROLES_QUESTIONNAIRES'=>$id));
		
		$data['title'] = 'Modification Infraction';
		$this->load->view('PSR/autres_controles_questionnaires_udpate_view',$data);
	}

	function update()
	{

		$this->form_validation->set_rules('INFRACTIONS','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$id=$this->input->post('ID_CONTROLES_QUESTIONNAIRES');

		if ($this->form_validation->run() == FALSE) {


			$this->getOne();
		}else{
			$id=$this->input->post('ID_CONTROLES_QUESTIONNAIRES');

			$data=array(
				'INFRACTIONS'=>$this->input->post('INFRACTIONS'),
			);

			$this->Modele->update('autres_controles_questionnaires',array('ID_CONTROLES_QUESTIONNAIRES'=>$id),$data);
			$datas['message']='<div class="alert alert-success text-center" id="message">La modification du menu est faite avec succès</div>';
			$this->session->set_flashdata($datas);
			redirect(base_url('PSR/Autres_controles_questionnaires/'));
		}
	}

	function delete()
	{
		$table="autres_controles_questionnaires";
		$criteres['ID_CONTROLES_QUESTIONNAIRES']=$this->uri->segment(4);
		$data['rows']= $this->Modele->getOne( $table,$criteres);
		$this->Modele->delete($table,$criteres);

		$data['message']='<div class="alert alert-success text-center" id="message">L"Element est supprimé avec succès</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('PSR/Autres_controles_questionnaires'));
	}
}
?>