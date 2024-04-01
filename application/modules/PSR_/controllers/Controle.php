<?php
/**
*NTAHIMPERA Martin Luther King
*	Element de la police 
**/
class Controle extends CI_Controller
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
		$data['title'] = 'Element de Controle';
		$this->load->view('controle/controle_list',$data);
	}

	function listing()
	{
		$i=1;
		$query_principal='SELECT ID_CONTROLE, NUMERO_CONTROLE, NUMERO_PLAQUE, NUMERO_CHASSIS, PROPRIETAIRE, DATE_DEBUT, DATE_VALIDITE,TYPE_VEHICULE FROM otraco_controles WHERE 1';

		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';


		if($_POST['length'] != -1){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}

		$order_by='';


		$order_column=array('TYPE_VEHICULE','NUMERO_CONTROLE','NUMERO_PLAQUE');

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY NUMERO_CONTROLE,NUMERO_PLAQUE ASC';

		$search = !empty($_POST['search']['value']) ? ("AND NUMERO_CONTROLE LIKE '%$var_search%' OR NUMERO_PLAQUE LIKE '%$var_search%' "):'';     

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
			data-target='#mydelete" . $row->ID_CONTROLE . "'><font color='red'>&nbsp;&nbsp;Supprimer</font></a></li>";
			$option .= "<li><a class='btn-md' href='" . base_url('PSR/Controle/getOne/'.$row->ID_CONTROLE) . "'><label class='text-info'>&nbsp;&nbsp;Modifier</label></a></li>";
			$option .= " </ul>
			</div>
			<div class='modal fade' id='mydelete" .  $row->ID_CONTROLE . "'>
			<div class='modal-dialog'>
			<div class='modal-content'>

			<div class='modal-body'>
			<center><h5><strong>Voulez-vous supprimer?</strong> <br><b style='background-color:prink;color:green;'><i>" .$row->NUMERO_CONTROLE."</i></b></h5></center>
			</div>

			<div class='modal-footer'>
			<a class='btn btn-danger btn-md' href='" . base_url('PSR/Controle/delete/'.$row->ID_CONTROLE) . "'>Supprimer</a>
			<button class='btn btn-primary btn-md' data-dismiss='modal'>Quitter</button>
			</div>

			</div>
			</div>
			</div>";

			$sub_array = array();
			$sub_array[]=$i++;
			$sub_array[]=$row->NUMERO_CONTROLE;
			$sub_array[]=$row->NUMERO_PLAQUE;
			$sub_array[]=$row->NUMERO_CHASSIS; 
			$sub_array[]=$row->PROPRIETAIRE;
			$sub_array[]=$row->DATE_DEBUT; 
			$sub_array[]=$row->DATE_VALIDITE; 
			$sub_array[]=$row->TYPE_VEHICULE; 			 			
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
		$data['plaques']=$this->Model->getRequete('SELECT ID_IMMATRICULATION, NUMERO_PLAQUE FROM obr_immatriculations_voitures WHERE 1 ORDER BY NUMERO_PLAQUE ASC');

		$data['title'] = 'Nouveau Element';
		$this->load->view('controle/controle_add_v',$data);
	}



	function add()
	{

		$this->form_validation->set_rules('NUMERO_CONTROLE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('NUMERO_PLAQUE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('NUMERO_CHASSIS','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('PROPRIETAIRE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('DATE_DEBUT','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
		$this->form_validation->set_rules('DATE_VALIDITE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('TYPE_VEHICULE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
		if($this->form_validation->run() == FALSE)
		{
			$this->ajouter();
		}else{

			$data_insert=array(
				'NUMERO_CONTROLE'=>$this->input->post('NUMERO_CONTROLE'),
				'NUMERO_PLAQUE'=>$this->input->post('NUMERO_PLAQUE'),
				'NUMERO_CHASSIS'=>$this->input->post('NUMERO_CHASSIS'),
				'PROPRIETAIRE'=>$this->input->post('PROPRIETAIRE'),
				'DATE_DEBUT'=>$this->input->post('DATE_DEBUT'),
				'DATE_VALIDITE'=>$this->input->post('DATE_VALIDITE'),
				'TYPE_VEHICULE'=>$this->input->post('TYPE_VEHICULE'),
			);
			$table='otraco_controles';

			$this->Modele->create($table,$data_insert);

			$data['message']='<div class="alert alert-success text-center" id="message">'."L'ajout se faite avec succès".'</div>';
			$this->session->set_flashdata($data);
			redirect(base_url('PSR/Controle/'));

		}

	}
	// function getOne($id=0)
	// {
	// 	$membre=$this->Modele->getRequeteOne('SELECT ID_PSR_ELEMENT, NOM, PRENOM, NUMERO_MATRICULE, PROVINCE_ID, COMMUNE_ID, ZONE_ID, COLLINE_ID, TELEPHONE, EMAIL, LATITUDE, LONGITUDE, IS_ACTIF, ID_GRADE FROM psr_elements WHERE  ID_PSR_ELEMENT='.$id);

	// 	$data['membre']=$membre;
	// 	$data['provinces']=$this->Model->getRequete('SELECT PROVINCE_ID,PROVINCE_NAME FROM syst_provinces WHERE 1 ORDER BY PROVINCE_NAME ASC');
	// 	$data['communes']=$this->Model->getRequete('SELECT COMMUNE_ID,COMMUNE_NAME FROM syst_communes WHERE PROVINCE_ID='.$membre['PROVINCE_ID'].' ORDER BY COMMUNE_NAME ASC');
	// 	$data['zones']=$this->Model->getRequete('SELECT ZONE_ID,ZONE_NAME FROM syst_zones WHERE COMMUNE_ID='.$membre['COMMUNE_ID'].' ORDER BY ZONE_NAME ASC');
	// 	$data['collines']=$this->Model->getRequete('SELECT COLLINE_ID,COLLINE_NAME FROM syst_collines WHERE ZONE_ID='.$membre['ZONE_ID'].' ORDER BY COLLINE_NAME ASC');
	
	// 	$data['title'] = "Modification d'un Police";
	// 	$this->load->view('psr_update_view',$data);
	// }

	// function update()
	// {
	// 	$this->form_validation->set_rules('NOM','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

	// 	$this->form_validation->set_rules('PRENOM','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

	// 	$this->form_validation->set_rules('NUMERO_MATRICULE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

	// 	$this->form_validation->set_rules('TELEPHONE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

	// 	$this->form_validation->set_rules('EMAIL','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


	// 	$id=$this->input->post('ID_PSR_ELEMENT');

	// 	if ($this->form_validation->run() == FALSE) {
	// 	//$id=$this->input->post('ID_GERANT');

	// 		$this->getOne();
	// 	}else{
	// 		$id=$this->input->post('ID_PSR_ELEMENT');

	// 		$data=array(
	// 			'NOM'=>$this->input->post('NOM'),
	// 			'PRENOM'=>$this->input->post('PRENOM'),
	// 			'NUMERO_MATRICULE'=>$this->input->post('NUMERO_MATRICULE'),
	// 			'PROVINCE_ID'=>$this->input->post('ID_PROVINCE'),
	// 			'COMMUNE_ID'=>$this->input->post('ID_COMMUNE'),
	// 			'ZONE_ID'=>$this->input->post('ID_ZONE'),
	// 			'COLLINE_ID'=>$this->input->post('ID_COLLINE'),
	// 			'TELEPHONE'=>$this->input->post('TELEPHONE'),
	// 			'EMAIL'=>$this->input->post('EMAIL'),
	// 		);

	// 		$this->Modele->update('psr_elements',array('ID_PSR_ELEMENT'=>$id),$data);
	// 		$datas['message']='<div class="alert alert-success text-center" id="message">La modification du menu est faite avec succès</div>';
	// 		$this->session->set_flashdata($datas);
	// 		redirect(base_url('PSR/Psr_elements/'));
	// 	}
	// }

	function delete()
	{
		$table="otraco_controles";
		$criteres['ID_CONTROLE']=$this->uri->segment(4);
		$data['rows']= $this->Modele->getOne( $table,$criteres);
		$this->Modele->delete($table,$criteres);

		$data['message']='<div class="alert alert-success text-center" id="message">L"Element est supprimé avec succès</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('PSR/Controle'));
	}

}
?>



