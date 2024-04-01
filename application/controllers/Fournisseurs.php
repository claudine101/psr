
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fournisseurs extends CI_Controller
{
	public function index()        
	{
		$data['title']='LISTE Fournisseurs';
		$this->load->view('fournisseurs/fournisseur_list_view',$data);
	}
		public function listing()
	{
        // $id=$this->session->userdata('Publicite_ID');
		$tabledata=array();
		$list=$this->Model->getList('slides');
		foreach ($list as $user) 
		{
			
			
			$utilisateur=array();
			$utilisateur[]=$user['DESCRIPTION_SLIDER'];
			$utilisateur[]=$user['TEXTE'];
			$utilisateur[] = '<img class="img img-circle" width="40px" height="40px" src="' . base_url('uploads/photos_up/' . $user['IMAGE_SLIDER']) . '" alt="">';
			
			
			$utilisateur['OPTIONS'] = '<div class="dropdown ">
			<a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Action
			<span class="caret"></span></a>
			<ul class="dropdown-menu dropdown-menu-left">
			';
			
			
			$utilisateur['OPTIONS'] .= "<li><a class='btn-md' href='" . base_url('slider/Slider/editer/'. $user['SLIDER_ID']) . "'>Modifier</a></li>";
			$utilisateur['OPTIONS'] .= "<li><a hre='#' data-toggle='modal' 
			data-target='#myelete" . $user['SLIDER_ID'] . "'><font color='red'>Supprimer</font></a></li>";
			$utilisateur['OPTIONS'] .= " </ul>
			</div>
			<div class='modal fade' id='myelete" . $user['SLIDER_ID'] . "'>
			<div class='modal-dialog'>
			<div class='modal-content'>

			<div class='modal-body'>
			<center><h5><strong>VOULEZ-VOUS SUPPRIMER LE SLIDER</strong> : <b style:'background-color:prink';><i style='color:green;'>" . $user['DESCRIPTION_SLIDER']."</i></b>?</h5></center>
			</div>

			<div class='modal-footer'>
			<a class='btn btn-danger btn-md' href='" . base_url('slider/Slider/delete/'. $user['SLIDER_ID']) . "'>Supprimer</a>
			<button class='btn btn-warning btn-md' data-dismiss='modal'>Quitter</button>
			</div>

			</div>
			</div>
			</div></form>";
			$tabledata[]=$utilisateur;

		}
		$template=array(
			'table_open' => '<table id="user_list" class="table table-bordered table-striped table-hover table-condensed">',
			'table_close' => '</table>'
		);
		$this->table->set_template($template);
		$this->table->set_heading(array('SLIDER',' TEXTE','IMAGE','OPTIONS'));
		$data['liste']=$tabledata;
		$data['title']='LISTE DES SLIDER';
		$this->load->view('Slider_Liste_view',$data);
	}
}