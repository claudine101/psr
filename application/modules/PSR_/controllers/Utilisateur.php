<?php
/**
*NTAHIMPERA Martin Luther King
*	Element de la police 
**/
class Utilisateur extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->have_droit();
	}


	public function have_droit()
	{
		if ($this->session->userdata('PSR_ELEMENT')!=1) {

			redirect(base_url());

		}
	}
	function index()
	{
		$data['title'] = 'Liste des utilisateurs';
		$this->load->view('user/user_list_v',$data);
	}
     

	function listing()
	{

		$i=1;
		$query_principal='SELECT ID_UTILISATEUR, NOM_UTILISATEUR, MOT_DE_PASSE, pr.STATUT AS statut, concat(psr.NOM," ",psr.PRENOM)  AS nom,user.IS_ACTIF FROM utilisateurs user LEFT JOIN psr_elements psr on psr.ID_PSR_ELEMENT =user.PSR_ELEMENT_ID LEFT JOIN profil pr on pr.PROFIL_ID=user.PROFIL_ID WHERE 1';

		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';


		if($_POST['length'] != -1){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}

		$order_by='';


		$order_column=array('NOM_UTILISATEUR','MOT_DE_PASSE','statut','nom','IS_ACTIF');

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY NOM_UTILISATEUR,nom ASC';

		$search = !empty($_POST['search']['value']) ? ("AND nom LIKE '%$var_search%'  OR NOM_UTILISATEUR LIKE '%$var_search%'  "):'';     

		$critaire = '';

		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
		$query_filter = $query_principal.' '.$critaire.' '.$search;

		$fetch_psr = $this->Modele->datatable($query_secondaire);
		$data = array();

		foreach ($fetch_psr as $row)
		{
            $actif='';
            if($row->IS_ACTIF ==1){
              $actif='<a class = "btn btn-success btn-sm " style="float:right" ><span class = "fa fa-check" ></span></a>';
            }else{
            	$actif='<a class = "btn btn-danger btn-sm" style="float:right"><span class = "fa fa-ban" ></span></a>';
            }
			$option = '<div class="dropdown ">
			<a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
			<i class="fa fa-cog"></i>
			Action
			<span class="caret"></span></a>
			<ul class="dropdown-menu dropdown-menu-left">
			';

			$option .= "<li><a hre='#' data-toggle='modal'
			data-target='#mydelete" . $row->ID_UTILISATEUR . "'><font color='red'>&nbsp;&nbsp;Supprimer</font></a></li>";
			//$option .= "<li><a class='btn-md' href='" . base_url('PSR/Utilisateur/getOne/'.$row->ID_UTILISATEUR) . "'><label class='text-info'>&nbsp;&nbsp;Modifier</label></a></li>";
			$option .= " </ul>
			</div>
			<div class='modal fade' id='mydelete" .  $row->ID_UTILISATEUR . "'>
			<div class='modal-dialog'>
			<div class='modal-content'>

			<div class='modal-body'>
			<center><h5><strong>Voulez-vous supprimer?</strong> <br><b style='background-color:prink;color:green;'><i>" .$row->NOM_UTILISATEUR."</i></b></h5></center>
			</div>

			<div class='modal-footer'>
			<a class='btn btn-danger btn-md' href='" . base_url('PSR/Utilisateur/delete/'.$row->ID_UTILISATEUR) . "'>Supprimer</a>
			<button class='btn btn-primary btn-md' data-dismiss='modal'>Quitter</button>
			</div>

			</div>
			</div>
			</div>";

			$sub_array = array();
			$sub_array[]=$i++;
			$sub_array[]=$row->NOM_UTILISATEUR;
			$sub_array[]=$row->MOT_DE_PASSE;
			$sub_array[]=$row->statut; 
			$sub_array[]=$row->nom;	
			$sub_array[]=$actif	;
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

	
	function getOne($id=0)
	{
		$data['user']=$this->Modele->getRequeteOne('SELECT ID_UTILISATEUR, NOM_UTILISATEUR, MOT_DE_PASSE, PROFIL_ID, PSR_ELEMENT_ID FROM utilisateurs WHERE  ID_UTILISATEUR='.$id);

		$data['profil']=$this->Model->getRequete('SELECT PROFIL_ID, STATUT FROM profil WHERE 1 ORDER BY STATUT ASC');
		
		$data['title'] = "Modification l'utilisateur";
		$this->load->view('user/user_update_v',$data);
	}

	function update()
	{
		$this->form_validation->set_rules('NOM_UTILISATEUR','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('MOT_DE_PASSE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
		$this->form_validation->set_rules('PROFIL_ID','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


		$id=$this->input->post('ID_UTILISATEUR');

		if ($this->form_validation->run() == FALSE) {
		//$id=$this->input->post('ID_GERANT');

			$this->getOne();
		}else{
			$id=$this->input->post('ID_UTILISATEUR');
			$data=array(
				'NOM_UTILISATEUR'=>$this->input->post('NOM_UTILISATEUR'),
				'MOT_DE_PASSE'=>$this->input->post('MOT_DE_PASSE'),
				'PROFIL_ID'=>$this->input->post('PROFIL_ID'),
					
			);

			$this->Modele->updateData('utilisateurs',$data,array('ID_UTILISATEUR'=>$id));

			$datas['message']='<div class="alert alert-success text-center" id="message">La modification du menu est faite avec succès</div>';
			$this->session->set_flashdata($datas);
			redirect(base_url('PSR/Utilisateur/'));
		}
	}

	function delete()
	{
		$table="psr_elements";
		$criteres['ID_UTILISATEUR']=$this->uri->segment(4);
		$data['rows']= $this->Modele->getOne( $table,$criteres);
		$this->Modele->delete($table,$criteres);

		$data['message']='<div class="alert alert-success text-center" id="message">L"Element est supprimé avec succès</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('PSR/Utilisateur'));
	}

}
?>



