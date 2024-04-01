<?php 

/**
 * christa
 */
class Change_Password extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->connexion();
	}

	function connexion()
	{
		if (empty($this->session->userdata('USER_ID'))) {
			# code...
			redirect(base_url());
		}
	}

	function index()
	{
		$data['error'] = '';
		$data['title'] = 'Modification du mot de passe';
		$this->load->view('Change_Password_View',$data);
	}


	function change_pswd()
	{
		$this->form_validation->set_rules('Old_Password', 'ancien mot de passe', 'trim|required');
		$this->form_validation->set_rules('New_Password', 'nouveau mot de passe', 'trim|required');
		$this->form_validation->set_rules('New_Password1', 'confirmation mot de passe', 'trim|required');

		if ($this->form_validation->run() == FALSE) {


			$data = array();
	  	$data['Old_Password'] = $this->input->post('Old_Password');
	  	$data['New_Password'] = $this->input->post('New_Password');
	  	$data['New_Password1'] = $this->input->post('New_Password1');

	  	$data['title'] = 'Modification du mot de passe';
			$this->load->view('Change_Password_View', $data);

			}else{
				
				$criteres['NOM_UTILISATEUR']=$this->session->userdata('USER_NAME');
			$Old_Password=$this->Modele->getOne('utilisateurs',$criteres);

			if ($Old_Password['MOT_DE_PASSE'] == md5($this->input->post('Old_Password'))) {
				# code...
				$New_Password=md5($this->input->post('New_Password'));
				$New_Password1=md5($this->input->post('New_Password1'));

				if ($New_Password == $New_Password1) {
					# code...
					$data=array(
					'MOT_DE_PASSE'=>$New_Password
				  );
				
				
			  $criteres['NOM_UTILISATEUR']=$this->session->userdata('USER_NAME');

			  $this->Modele->update('utilisateurs',$criteres,$data);

			  $data['message']='<div class="alert alert-success text-center" id="message_succes">Changement de mot de passe fait avec succès! vous pouvez vous connecter</div>';
			  
        $this->session->set_flashdata($data);

       // redirect(base_url('Login/do_logout'));

        redirect(base_url('Change_Password/index'));

			}else{
				$data['message1']='<div class="alert alert-success text-center" id="message">Les deux mots de passe ne sont pas identiques</div>';
			  
        $this->session->set_flashdata($data);

        redirect(base_url('Change_Password/index'));
			}
			}else{
				$data['message1']='<div class="alert alert-success text-center" id="message">L\'ancien mot de passe est incorrect</div>';
			  
        $this->session->set_flashdata($data);

        redirect(base_url('Change_Password/index'));

			}
		}
	}
}
?>