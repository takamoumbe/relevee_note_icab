<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "functions/cartes/alerts.php";

class Cartes extends CI_Controller  {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url','url_helper'));
		$this->load->model('_Home', 'Dash', true);
		$this->load->library(array('upload', 'form_validation', 'session', 'MY_Form_validation'));
	}
	
	

	public function nouveau_model() {
		$this->load->view('cartes/nouveau');
	}
	
	

	/* fonction pour enregistrer un model */
	public function enregistrer_model_carte(){
		$matricule = "";
		$this->form_validation->set_rules('matricule',  'matricule','trim|min_length[3]|is_unique[carte.matricule]|required');
		$this->form_validation->set_rules('model',  'Model','trim|required');
		$this->form_validation->set_rules('cycle',  'Cycle','trim|min_length[3]|max_length[150]|required');
		$this->form_validation->set_rules('republique',  'République','trim|min_length[3]|max_length[150]|required');
		$this->form_validation->set_rules('devise',  'Dévise','trim|min_length[3]|max_length[150]|required');
		$this->form_validation->set_rules('etablissement',  'établissement','trim|min_length[3]|max_length[150]|required');
		$this->form_validation->set_rules(
			'contact1', 
			"Contact téléphonique1", 
			"trim|required|is_unique[carte.contact1]|is_unique[carte.contact2]|min_length[9]|max_length[9]"
		);
		$this->form_validation->set_rules(
			'contact2', 
			"Contact téléphonique2", 
			"trim|required|is_unique[carte.contact1]|is_unique[carte.contact2]|min_length[9]|max_length[9]"
		);

		if ($this->form_validation->run() == FALSE) {
			$matricule = $this->input->post('matricule');
			$this->session->set_flashdata("message", enregistrement_carte_echoue($matricule));
			$this->load->view('cartes/nouveau');
		}
		else{
			$this->load->library('upload');
			$image_name_model = $_FILES['image_name_model']['name'];
			$image_name_signature = $_FILES['image_name_signature']['name'];

			$array_model = "";

			for($i = 0; $i < count($image_name_model); $i++){
				$_FILES['file']['name']       = $_FILES['image_name_model']['name'][$i];
				$_FILES['file']['type']       = $_FILES['image_name_model']['type'][$i];
				$_FILES['file']['tmp_name']   = $_FILES['image_name_model']['tmp_name'][$i];
				$_FILES['file']['error']      = $_FILES['image_name_model']['error'][$i];
				$_FILES['file']['size']       = $_FILES['image_name_model']['size'][$i];

				$uploadPath = './vendors/uploads/cartes/model/'.$this->input->post('matricule').'/';
				if (!file_exists($uploadPath)) {
					mkdir($uploadPath, 0777, true); 
				} else{ 
					echo "no things"; 
				}
				$array_model = $array_model.$uploadPath.$image_name_model[$i].':';

				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'jpg|jpeg|png|gif';

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if($this->upload->do_upload('file')){
					$imageData = $this->upload->data();
				}
			}

			$array_signatures = "";
			for($i = 0; $i < count($image_name_signature); $i++){
				$_FILES['file']['name']       = $_FILES['image_name_signature']['name'][$i];
				$_FILES['file']['type']       = $_FILES['image_name_signature']['type'][$i];
				$_FILES['file']['tmp_name']   = $_FILES['image_name_signature']['tmp_name'][$i];
				$_FILES['file']['error']      = $_FILES['image_name_signature']['error'][$i];
				$_FILES['file']['size']       = $_FILES['image_name_signature']['size'][$i];

				$uploadPath = './vendors/uploads/cartes/model/'.$this->input->post('matricule').'/';
				if (!file_exists($uploadPath)) {
					mkdir($uploadPath, 0777, true); 
				} else{ 
					echo "no things"; 
				}
				$array_signatures = $array_model.$uploadPath.$image_name_signature[$i].':';

				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'jpg|jpeg|png|gif';

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if($this->upload->do_upload('file')){
					$imageData = $this->upload->data();
				}
			}

			$data = array(
				'matricule'  	=> $this->input->post('matricule'),
				'model' 		=> $this->input->post('model'),
				'cycle' 		=> $this->input->post('cycle'),
				'republique'  	=> $this->input->post('republique'),
				'devise'  		=> $this->input->post('devise'),
				'etablissement' => $this->input->post('etablissement'),
				'contact1'  	=> $this->input->post('contact1'),
				'contact2'  	=> $this->input->post('contact2'),
				'site_web' 		=> $this->input->post('site_web'),
				'email'  		=> $this->input->post('email'),
				'boite_postale' => $this->input->post('boite_postale'),
				'save_as'  		=> date('Y-m-d H:i:s'),
				'save_by'  		=> '',
				'carte'  		=> $array_model,
				'signature'		=> $array_signatures,
				'statut'  		=> 'actif'
			);
			$this->Dash->insert_model_carte($data);
			$matricule = $this->input->post('matricule');
			$this->session->set_flashdata("message", enregistrement_model_carte_reussie($matricule));
			$this->load->view('cartes/nouveau');
		}		
	}
	
	

	/* fonction pour lister les étudiant actif et les etudiants inactifs */
	public function liste_model_carte() {
		$data['listing_model_carte_actif']  = $this->Dash->listing_model_carte_actif();
		$data['listing_model_carte_inactif']  = $this->Dash->listing_model_carte_inactif();
		$this->load->view('cartes/listing', $data);
	}

}




