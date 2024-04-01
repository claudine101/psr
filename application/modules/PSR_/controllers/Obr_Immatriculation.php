<?php
/**
*NTAHIMPERA Martin Luther King
*	Element de la police 
**/
class Obr_Immatriculation extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->have_droit();
	}

	public function have_droit()
	{
	  if ($this->session->userdata('IMMATRICULATION')!=1 && $this->session->userdata('PSR_ELEMENT')!=1) {

	  	redirect(base_url()); 

	  }
}
	function index()
	{
		$data['title'] = 'Immatriculation';
		$this->load->view('obr/immatriculation_list',$data);
	}

	function listing()
	{
		$i=1;
		$query_principal='SELECT ID_IMMATRICULATION, NUMERO_CARTE_ROSE, NUMERO_PLAQUE, CATEGORIE_PLAQUE, MARQUE_VOITURE, NUMERO_CHASSIS, NOMBRE_PLACE, NOM_PROPRIETAIRE, PRENOM_PROPRIETAIRE, NUMERO_IDENTITE, sp.PROVINCE_NAME, CATEGORIE_PROPRIETAIRE, CATEGORIE_USAGE, PUISSANCE, COULEUR, ANNEE_FABRICATION, DATE_INSERTION, MODELE_VOITURE, POIDS, TYPE_CARBURANT, TAXE_DMC, NIF, DATE_DELIVRANCE FROM obr_immatriculations_voitures obr LEFT JOIN syst_provinces sp ON obr.PROVINCE=sp.PROVINCE_ID  WHERE 1';

		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';


		if($_POST['length'] != -1){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}

		$order_by='';


		$order_column=array('NUMERO_CARTE_ROSE','NUMERO_PLAQUE','NOM_PROPRIETAIRE','NUMERO_IDENTITE');

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY NOM,PRENOM ASC';

		$search = !empty($_POST['search']['value']) ? ("AND NUMERO_CARTE_ROSE LIKE '%$var_search%' OR NUMERO_PLAQUE LIKE '%$var_search%' OR NOM_PROPRIETAIRE LIKE '%$var_search%'  "):'';     

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
			data-target='#mydelete" . $row->ID_IMMATRICULATION . "'><font color='red'>&nbsp;&nbsp;Supprimer</font></a></li>";
			$option .= "<li><a class='btn-md' href='" . base_url('PSR/Obr_Immatriculation/getOne/'.$row->ID_IMMATRICULATION) . "'><label class='text-info'>&nbsp;&nbsp;Modifier</label></a></li>";
			$option .= " </ul>
			</div>
			<div class='modal fade' id='mydelete" .  $row->ID_IMMATRICULATION . "'>
			<div class='modal-dialog'>
			<div class='modal-content'>

			<div class='modal-body'>
			<center><h5><strong>Voulez-vous supprimer?</strong> <br><b style='background-color:prink;color:green;'><i>" .$row->NOM_PROPRIETAIRE."</i></b></h5></center>
			</div>

			<div class='modal-footer'>
			<a class='btn btn-danger btn-md' href='" . base_url('PSR/Obr_Immatriculation/delete/'.$row->ID_IMMATRICULATION) . "'>Supprimer</a>
			<button class='btn btn-primary btn-md' data-dismiss='modal'>Quitter</button>
			</div>

			</div>
			</div>
			</div>";

			$sub_array = array();
			$sub_array[]=$i++;
			$sub_array[]=$row->NUMERO_CARTE_ROSE;
			$sub_array[]=$row->NUMERO_PLAQUE;
			$sub_array[]=$row->CATEGORIE_PLAQUE; 
			$sub_array[]=$row->MARQUE_VOITURE;
			$sub_array[]=$row->NUMERO_CHASSIS; 
			$sub_array[]=$row->NOMBRE_PLACE; 
			$sub_array[]=$row->NOM_PROPRIETAIRE; 			
			$sub_array[]=$row->PRENOM_PROPRIETAIRE; 
			$sub_array[]=$row->NUMERO_IDENTITE; 	
			$sub_array[]=$row->PROVINCE_NAME;
			$sub_array[]=$row->CATEGORIE_PROPRIETAIRE;
			$sub_array[]=$row->CATEGORIE_USAGE;
			$sub_array[]=$row->PUISSANCE; 
			$sub_array[]=$row->COULEUR;
			$sub_array[]=$row->ANNEE_FABRICATION; 
			$sub_array[]=$row->MODELE_VOITURE; 			
			$sub_array[]=$row->POIDS; 
			$sub_array[]=$row->TYPE_CARBURANT;
			$sub_array[]=$row->TAXE_DMC; 
			$sub_array[]=$row->NIF; 			
			$sub_array[]=$row->DATE_DELIVRANCE; 
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
        $data['provinces']=$this->Model->getRequete('SELECT PROVINCE_ID,PROVINCE_NAME FROM syst_provinces WHERE 1 ORDER BY PROVINCE_NAME ASC');
		$data['title'] = 'Nouveau immatriculation';
		$this->load->view('obr/immatriculation_add_v',$data);

	}



	function add()
	{

		$this->form_validation->set_rules('NUMERO_CARTE_ROSE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('NUMERO_PLAQUE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('CATEGORIE_PLAQUE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('MARQUE_VOITURE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('NUMERO_CHASSIS','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('NOMBRE_PLACE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('NOM_PROPRIETAIRE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('PRENOM_PROPRIETAIRE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('NUMERO_IDENTITE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('ID_PROVINCE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


		$this->form_validation->set_rules('CATEGORIE_PROPRIETAIRE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('CATEGORIE_USAGE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('PUISSANCE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('COULEUR','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('ANNEE_FABRICATION','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


		$this->form_validation->set_rules('MODELE_VOITURE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('POIDS','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('TYPE_CARBURANT','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('TAXE_DMC','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


		$this->form_validation->set_rules('NIF','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('DATE_DELIVRANCE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


		if($this->form_validation->run() == FALSE)
		{
			$this->ajouter();
		}else{
			$data_insert=array(
				'NUMERO_CARTE_ROSE'=>$this->input->post('NUMERO_CARTE_ROSE'),
				'NUMERO_PLAQUE'=>$this->input->post('NUMERO_PLAQUE'),
				'CATEGORIE_PLAQUE'=>$this->input->post('CATEGORIE_PLAQUE'),
				'MARQUE_VOITURE'=>$this->input->post('MARQUE_VOITURE'),
				'NUMERO_CHASSIS'=>$this->input->post('NUMERO_CHASSIS'),
				'NOMBRE_PLACE'=>$this->input->post('NOMBRE_PLACE'),
				'NOM_PROPRIETAIRE'=>$this->input->post('NOM_PROPRIETAIRE'),
				'PRENOM_PROPRIETAIRE'=>$this->input->post('PRENOM_PROPRIETAIRE'),
				'NUMERO_IDENTITE'=>$this->input->post('NUMERO_IDENTITE'),
				'PROVINCE_ID'=>$this->input->post('ID_PROVINCE'),
				'CATEGORIE_PROPRIETAIRE'=>$this->input->post('CATEGORIE_PROPRIETAIRE'),
				'CATEGORIE_USAGE'=>$this->input->post('CATEGORIE_USAGE'),
				'PUISSANCE'=>$this->input->post('PUISSANCE'),
				'COULEUR'=>$this->input->post('COULEUR'),
				'ANNEE_FABRICATION'=>$this->input->post('ANNEE_FABRICATION'),
				'MODELE_VOITURE'=>$this->input->post('MODELE_VOITURE'),
				'POIDS'=>$this->input->post('POIDS'),
				'TYPE_CARBURANT'=>$this->input->post('TYPE_CARBURANT'),
				'TAXE_DMC'=>$this->input->post('TAXE_DMC'),
				'NIF'=>$this->input->post('NIF'),
				'DATE_DELIVRANCE'=>$this->input->post('DATE_DELIVRANCE'),
				
			);
			
			$tabl='obr_immatriculations_voitures';
			$this->Modele->create($tabl,$data_insert);

			$data['message']='<div class="alert alert-success text-center" id="message">'."L'ajout se faite avec succès".'</div>';
			$this->session->set_flashdata($data);
			redirect(base_url('PSR/Obr_Immatriculation/'));

		}

	}
	function getOne($id=0)
	{
		
		$data['membre']=$this->Modele->getRequeteOne('SELECT ID_IMMATRICULATION, NUMERO_CARTE_ROSE, NUMERO_PLAQUE, CATEGORIE_PLAQUE, MARQUE_VOITURE, NUMERO_CHASSIS, NOMBRE_PLACE, NOM_PROPRIETAIRE, PRENOM_PROPRIETAIRE, NUMERO_IDENTITE, PROVINCE_ID, CATEGORIE_PROPRIETAIRE, CATEGORIE_USAGE, PUISSANCE, COULEUR, ANNEE_FABRICATION, DATE_INSERTION, MODELE_VOITURE, POIDS, TYPE_CARBURANT, TAXE_DMC, NIF, DATE_DELIVRANCE FROM obr_immatriculations_voitures  WHERE ID_IMMATRICULATION='.$id);
		$data['provinces']=$this->Model->getRequete('SELECT PROVINCE_ID,PROVINCE_NAME FROM syst_provinces WHERE 1 ORDER BY PROVINCE_NAME ASC');
		
		$data['title'] = "Modification d'un Policien";
		$this->load->view('obr/immatriculation_update_v',$data);
	}

	function update()
	{
		$this->form_validation->set_rules('NUMERO_CARTE_ROSE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('NUMERO_PLAQUE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('CATEGORIE_PLAQUE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('MARQUE_VOITURE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('NUMERO_CHASSIS','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('NOMBRE_PLACE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('NOM_PROPRIETAIRE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('PRENOM_PROPRIETAIRE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('NUMERO_IDENTITE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('ID_PROVINCE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


		$this->form_validation->set_rules('CATEGORIE_PROPRIETAIRE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('CATEGORIE_USAGE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('PUISSANCE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('COULEUR','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('ANNEE_FABRICATION','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


		$this->form_validation->set_rules('MODELE_VOITURE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('POIDS','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('TYPE_CARBURANT','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('TAXE_DMC','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


		$this->form_validation->set_rules('NIF','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('DATE_DELIVRANCE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));



		$id=$this->input->post('ID_IMMATRICULATION');

		if ($this->form_validation->run() == FALSE) {
		//$id=$this->input->post('ID_GERANT');

			$this->getOne();
		}else{
			$id=$this->input->post('ID_IMMATRICULATION');

			$data=array(
				'NUMERO_CARTE_ROSE'=>$this->input->post('NUMERO_CARTE_ROSE'),
				'NUMERO_PLAQUE'=>$this->input->post('NUMERO_PLAQUE'),
				'CATEGORIE_PLAQUE'=>$this->input->post('CATEGORIE_PLAQUE'),
				'MARQUE_VOITURE'=>$this->input->post('MARQUE_VOITURE'),
				'NUMERO_CHASSIS'=>$this->input->post('NUMERO_CHASSIS'),
				'NOMBRE_PLACE'=>$this->input->post('NOMBRE_PLACE'),
				'NOM_PROPRIETAIRE'=>$this->input->post('NOM_PROPRIETAIRE'),
				'PRENOM_PROPRIETAIRE'=>$this->input->post('PRENOM_PROPRIETAIRE'),
				'NUMERO_IDENTITE'=>$this->input->post('NUMERO_IDENTITE'),
				'PROVINCE_ID'=>$this->input->post('ID_PROVINCE'),
				'CATEGORIE_PROPRIETAIRE'=>$this->input->post('CATEGORIE_PROPRIETAIRE'),
				'CATEGORIE_USAGE'=>$this->input->post('CATEGORIE_USAGE'),
				'PUISSANCE'=>$this->input->post('PUISSANCE'),
				'COULEUR'=>$this->input->post('COULEUR'),
				'ANNEE_FABRICATION'=>$this->input->post('ANNEE_FABRICATION'),
				'MODELE_VOITURE'=>$this->input->post('MODELE_VOITURE'),
				'POIDS'=>$this->input->post('POIDS'),
				'TYPE_CARBURANT'=>$this->input->post('TYPE_CARBURANT'),
				'TAXE_DMC'=>$this->input->post('TAXE_DMC'),
				'NIF'=>$this->input->post('NIF'),
				'DATE_DELIVRANCE'=>$this->input->post('DATE_DELIVRANCE'),
				
			);

			$this->Modele->update('obr_immatriculations_voitures',array('ID_IMMATRICULATION'=>$id),$data);
			$datas['message']='<div class="alert alert-success text-center" id="message">La modification du menu est faite avec succès</div>';
			$this->session->set_flashdata($datas);
			redirect(base_url('PSR/Obr_Immatriculation/'));
		}
	}

	function delete()
	{
		$table="obr_immatriculations_voitures";
		$criteres['ID_IMMATRICULATION']=$this->uri->segment(4);
		$data['rows']= $this->Modele->getOne( $table,$criteres);
		$this->Modele->delete($table,$criteres);

		$data['message']='<div class="alert alert-success text-center" id="message">L"Element est supprimé avec succès</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('PSR/Obr_Immatriculation'));
	}

}
?>



