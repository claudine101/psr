<?php
/**
*Allan
*	Element de la police 
**/
class Declaration_Vol extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->have_droit();
	}


	public function have_droit()
	{
		if ($this->session->userdata('DECLARATION')!=1 && $this->session->userdata('PSR_ELEMENT')!=1) {

			redirect(base_url());

		}
	}
	function index()
	{
		$data['title'] = 'liste de declaration du vol';
		$this->load->view('declarations_list',$data);
	}

	function listing()
	{
		$i=1;
		$query_principal="SELECT ID_DECLARATION, NUMERO_PLAQUE, NOM_DECLARANT, PRENOM_DECLARANT, COULEUR_VOITURE, MARQUE_VOITURE, DATE_VOLER, STATUT FROM pj_declarations WHERE 1";

		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';


		if($_POST['length'] != -1){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}

		$order_by='';


		$order_column=array('NUMERO_PLAQUE','NOM_DECLARANT','PRENOM_DECLARANT');

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY Nom ASC';

		$search = !empty($_POST['search']['value']) ? ("AND NUMERO_PLAQUE LIKE '%$var_search%' OR NOM_DECLARANT LIKE '%$var_search%' OR PRENOM_DECLARANT LIKE '%$var_search%'  "):'';     

		$critaire = '';

		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
		$query_filter = $query_principal.' '.$critaire.' '.$search;

		$fetch_psr = $this->Modele->datatable($query_secondaire);
		$data = array();

		foreach ($fetch_psr as $row)
		{
			$stat='';

			if ($row->STATUT == 1) {
				$val_stat=' <a class = "btn btn-success btn-sm " style="float:center" ><span class = "fa fa-check" ></span></a>' ;
			}else{
				$val_stat='<a class = "btn btn-danger btn-sm" style="float:center"><span class = "fa fa-ban" ></span></a>' ;
			}

			$option = '<div class="dropdown ">
			<a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
			<i class="fa fa-cog"></i>
			Action
			<span class="caret"></span></a>
			<ul class="dropdown-menu dropdown-menu-left">
			';

			$option .= "<li><a hre='#' data-toggle='modal'
			data-target='#mydelete" . $row->ID_DECLARATION . "'><font color='red'>&nbsp;&nbsp;Supprimer</font></a></li>";
			$option .= "<li><a class='btn-md' href='" . base_url('PSR/Declaration_Vol/getOne/'.$row->ID_DECLARATION). "'><label class='text-info'>&nbsp;&nbsp;Modifier</label></a></li>";
			$option .= " </ul>
			</div>
			<div class='modal fade' id='mydelete" .$row->ID_DECLARATION. "'>
			<div class='modal-dialog'>
			<div class='modal-content'>

			<div class='modal-body'>
			<center><h5><strong>Voulez-vous supprimer?</strong> <br><b style='background-color:prink;color:green;'><i>".$row->NUMERO_PLAQUE."</i></b></h5></center>
			</div>

			<div class='modal-footer'>
			<a class='btn btn-danger btn-md' href='" . base_url('PSR/Declaration_Vol/delete/'.$row->ID_DECLARATION) . "'>Supprimer</a>
			<button class='btn btn-primary btn-md' data-dismiss='modal'>Quitter</button>
			</div>

			</div>
			</div>
			</div>";

			$stat .= "<a href='#' data-toggle='modal'
			data-target='#stat" . $row->ID_DECLARATION . "'><font color='blue'>&nbsp;&nbsp;".$val_stat."</font></a>";



			$stat .= " 
			<div class='modal fade' id='stat" .  $row->ID_DECLARATION . "'>
			<div class='modal-dialog'>
			<div class='modal-content'>

			<div class='modal-body'>
			<center>
			<p> Voulez-vous changer le statut?<br></center>
			</div>

			<div class='modal-footer'>
			<a class='btn btn-primary btn-md' href='" . base_url('PSR/Declaration_Vol/change_statut/'.$row->ID_DECLARATION.'/'.$row->STATUT) . "'>Changer</a>
			<button class='btn btn-danger btn-md' data-dismiss='modal'>Quitter</button>
			</div>

			</div>
			</div>
			</div>";

			$sub_array = array();
			$sub_array[]=$i++;
			$sub_array[]=$row->NUMERO_PLAQUE; 
			$sub_array[]=$row->NOM_DECLARANT;
			$sub_array[]=$row->PRENOM_DECLARANT;
			$sub_array[]=$row->COULEUR_VOITURE; 
			$sub_array[]=$row->MARQUE_VOITURE; 
			$sub_array[]=$row->DATE_VOLER; 
			$sub_array[]=$stat;
			
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


	function change_statut($ID_DECLARATION,$STATUT)
	{
		if ($STATUT==1) {
			$val=0;
		}

		if ($STATUT==0) {
			$val=1;
		}

		$this->Modele->update('pj_declarations',array('ID_DECLARATION'=>$ID_DECLARATION),array('STATUT'=>$val));

		$datas['message']='<div class="alert alert-success text-center" id="message">La modification du statut est faite avec succès</div>';
		$this->session->set_flashdata($datas);
		redirect(base_url('PSR/Declaration_Vol'));

	}


	function ajouter()
	{
		$data['plaques']=$this->Model->getRequete('SELECT ID_IMMATRICULATION, NUMERO_PLAQUE FROM obr_immatriculations_voitures WHERE 1 ORDER BY NUMERO_PLAQUE ASC');
		$data['title'] = 'Nouvelle Affectation';
		$this->load->view('declarations_add_v',$data);
	}


	function add()
	{

		$this->form_validation->set_rules('NUMERO_PLAQUE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('NOM_DECLARANT','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('PRENOM_DECLARANT','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('COULEUR_VOITURE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('MARQUE_VOITURE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('DATE_VOLER','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));




		if($this->form_validation->run() == FALSE)
		{
			$this->ajouter();
		}else{

			$data_insert=array(
				'NUMERO_PLAQUE'=>$this->input->post('NUMERO_PLAQUE'),
				'NOM_DECLARANT'=>$this->input->post('NOM_DECLARANT'),
				'PRENOM_DECLARANT'=>$this->input->post('PRENOM_DECLARANT'),
				'COULEUR_VOITURE'=>$this->input->post('COULEUR_VOITURE'),
				'MARQUE_VOITURE'=>$this->input->post('MARQUE_VOITURE'),
				'DATE_VOLER'=>$this->input->post('DATE_VOLER'),
			);
			$table='pj_declarations';
			$this->Modele->create($table,$data_insert);

			$data['message']='<div class="alert alert-success text-center" id="message">'."L'ajout se faite avec succès".'</div>';
			$this->session->set_flashdata($data);
			redirect(base_url('PSR/Declaration_Vol/index'));

		}

	}
	function getOne($id=0)
	{
		$id=$this->uri->segment(4);
		$data['title'] = "Modification d'un Police";
		$data['data']=$this->Modele->getOne('pj_declarations',array('ID_DECLARATION'=>$id));
		$this->load->view('declarations_update_v',$data);
	}

	function update()
	{
		
		$this->form_validation->set_rules('NUMERO_PLAQUE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('NOM_DECLARANT','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('PRENOM_DECLARANT','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('COULEUR_VOITURE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('MARQUE_VOITURE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('DATE_VOLER','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));



		$id=$this->input->post('ID_DECLARATION');

		if ($this->form_validation->run() == FALSE) {
			$this->getOne();
		}else{
			$id=$this->input->post('ID_DECLARATION');

			$data=array(
				'NUMERO_PLAQUE'=>$this->input->post('NUMERO_PLAQUE'),
				'NOM_DECLARANT'=>$this->input->post('NOM_DECLARANT'),
				'PRENOM_DECLARANT'=>$this->input->post('PRENOM_DECLARANT'),
				'COULEUR_VOITURE'=>$this->input->post('COULEUR_VOITURE'),
				'MARQUE_VOITURE'=>$this->input->post('MARQUE_VOITURE'),
				'DATE_VOLER'=>$this->input->post('DATE_VOLER'),
			);

			$this->Modele->update('pj_declarations',array('ID_DECLARATION'=>$id),$data);
			$datas['message']='<div class="alert alert-success text-center" id="message">La modification du menu est faite avec succès</div>';
			$this->session->set_flashdata($datas);
			redirect(base_url('PSR/Declaration_Vol/index'));
		}
	}

	function delete()
	{
		$table="pj_declarations";
		$criteres['ID_DECLARATION']=$this->uri->segment(4);
		$data['rows']= $this->Modele->getOne( $table,$criteres);
		$this->Modele->delete($table,$criteres);

		$data['message']='<div class="alert alert-success text-center" id="message">L"Element est supprimé avec succès</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('PSR/Declaration_Vol/index'));
	}

}
?>



