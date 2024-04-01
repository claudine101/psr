<?php

class Assureur extends CI_Controller
{
  function __construct()
  {
   parent::__construct();
   $this->have_droit();
 }

 public function have_droit()
 {
  if ( $this->session->userdata('PSR_ELEMENT')!=1) {

    redirect(base_url()); 

  }
}
function index()
{
  
  $data['title'] = 'Listes des Assurances';
  $this->load->view('assurances/Assureur_List_View',$data);
}


function listing()

{
 
 $i=1;
 $query_principal="SELECT `ID_ASSUREUR`,`ASSURANCE`,`EMAIL`,`NIF`,`ADRESSE` FROM `assureur` WHERE 1";

 $var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

 $limit='LIMIT 0,10';

 if($_POST['length'] != -1)
 {
   $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
 }

 $order_by='';

 $order_column=array('ASSURANCE','EMAIL','NIF','ADRESSE');

 $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY ASSURANCE,NIF,ADRESSE ASC';

 $search = !empty($_POST['search']['value']) ? ("AND ASSURANCE LIKE '%$var_search%' OR EMAIL LIKE '%$var_search%' OR NIF LIKE '%$var_search%'  "):'';


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
  data-target='#mydelete" . $row->ID_ASSUREUR . "'><font color='red'>&nbsp;&nbsp;Supprimer</font></a></li>";
  $option .= "<li><a class='btn-md' href='" . base_url('PSR/Assureur/getOne/'.$row->ID_ASSUREUR) . "'><label class='text-info'>&nbsp;&nbsp;Modifier</label></a></li>";
  $option .= " </ul>
  </div>
  <div class='modal fade' id='mydelete" .  $row->ID_ASSUREUR . "'>
  <div class='modal-dialog'>
  <div class='modal-content'>

  <div class='modal-body'>
  <center><h5><strong>Voulez-vous supprimer?</strong> <br><b style='background-color:prink;color:green;'><i>".$row->ASSURANCE." ".$row->EMAIL." ".$row->NIF." ".$row->ADRESSE."</i></b></h5></center>
  </div>

  <div class='modal-footer'>
  <a class='btn btn-danger btn-md' href='" . base_url('PSR/Assureur/delete/'.$row->ID_ASSUREUR) . "'>Supprimer</a>
  <button class='btn btn-primary btn-md' data-dismiss='modal'>Quitter</button>
  </div>

  </div>
  </div>
  </div>";

  $sub_array = array();
  $sub_array[]=$i++;
  $sub_array[]=$row->ASSURANCE;
  $sub_array[]=$row->EMAIL;
  $sub_array[]=$row->NIF; 
  $sub_array[]=$row->ADRESSE; 
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
  $data['infraPeines'] = $this->Modele->getRequete('SELECT `ID_ASSUREUR`,`ASSURANCE`,`EMAIL`,`NIF`,`ADRESSE` FROM `assureur` WHERE 1');

  $data['title'] = 'Nouveau Infraction';
  $this->load->view('assurances/Assureur_Add_View',$data);
  
}

function add()
{
 
 $this->form_validation->set_rules('ASSURANCE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

 $this->form_validation->set_rules('EMAIL','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

 $this->form_validation->set_rules('NIF','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

 $this->form_validation->set_rules('ADRESSE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

 if($this->form_validation->run() == FALSE)
 {
  $this->ajouter();
}else{

  $data_insert=array(

    'ASSURANCE'=>$this->input->post('ASSURANCE'),

    'EMAIL'=>$this->input->post('EMAIL'),

    'NIF'=>$this->input->post('NIF'), 

    'ADRESSE'=>$this->input->post('ADRESSE'),  
  );

  $table='assureur';
  $this->Modele->create($table,$data_insert);

  $data['message']='<div class="alert alert-success text-center" id="message">'."L'ajout se faite avec succès".'</div>';
  $this->session->set_flashdata($data);
  redirect(base_url('PSR/Assureur/'));

}

}

function getOne()
{
  $id=$this->uri->segment(4);
  $data['data']=$this->Modele->getOne('assureur',array('ID_ASSUREUR'=>$id));

  $data['title'] = "Modification sur un assureur";
  $this->load->view('assurances/Assureur_Update_View',$data);
}

function update()
{
	$this->form_validation->set_rules('ASSURANCE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


 $this->form_validation->set_rules('EMAIL','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

 $this->form_validation->set_rules('NIF','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

 $this->form_validation->set_rules('ADRESSE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


 $id=$this->input->post('ID_ASSUREUR');

 if ($this->form_validation->run() == FALSE) {
    //$id=$this->input->post('ID_GERANT');

  $this->getOne();
}else{
  $id=$this->input->post('ID_ASSUREUR');

  $data=array(
   'ASSURANCE'=>$this->input->post('ASSURANCE'),

   'EMAIL'=>$this->input->post('EMAIL'),

   'NIF'=>$this->input->post('NIF'), 

   'ADRESSE'=>$this->input->post('ADRESSE'),  
 );

  $this->Modele->update('assureur',array('ID_ASSUREUR'=>$id),$data);
  $datas['message']='<div class="alert alert-success text-center" id="message">La modification du menu est faite avec succès</div>';
  $this->session->set_flashdata($datas);
  redirect(base_url('PSR/Assureur/'));
}
}


function delete()
{
 $table="assureur";
 $criteres['ID_ASSUREUR']=$this->uri->segment(4);
 $data['rows']= $this->Modele->getOne( $table,$criteres);
 $this->Modele->delete($table,$criteres);

 $data['message']='<div class="alert alert-success text-center" id="message">L"Element est supprimé avec succès</div>';
 $this->session->set_flashdata($data);
 redirect(base_url('PSR/Assureur/'));
}

}
?>