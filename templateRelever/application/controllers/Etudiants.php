<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "functions/etudiants/alerts.php";
include 'FPDF/fpdf.php';
include 'Qrcode/phpqrcode.php';
include 'Qrcode/Qrlib.php';

class Etudiants extends CI_Controller  {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url','url_helper'));
		$this->load->model('_Home', 'Dash', true);
		$this->load->library(array('upload', 'form_validation', 'session', 'MY_Form_validation'));
	}
	
	

	public function nouveau_etudiant() {
		// $this->verifier_authetification();
		$this->load->view('etudiants/new');
	}
	
	

	/* fonction pour enregistrer un etudiant */
	public function enregistrer_etudiant(){
		$nom = "";
		$this->form_validation->set_rules('matricule',  'matricule','trim|min_length[3]|is_unique[etudiant.matricule]|required');
		$this->form_validation->set_rules('nom',  'Nom','trim|min_length[3]|max_length[15]|required');
		$this->form_validation->set_rules('prenom',  'Prenom','trim|min_length[3]|max_length[15]|required');
		$this->form_validation->set_rules('date_naiss', "date de naissance de l'étudiant $nom", 'trim|required');
		$this->form_validation->set_rules('lieu_naiss', "lieu de naissance de l'étudiant $nom", 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('sexe', "sexe de l'étudiant $nom", 'trim|required');
		$this->form_validation->set_rules('filiere', "Filière de l'étudiant $nom", 'trim|required');
		$this->form_validation->set_rules('niveau', "niveau de l'étudiant $nom", 'trim|required');
		$this->form_validation->set_rules('contact', "Contact téléphonique de l'étudiant $nom", 'trim|required|is_unique[etudiant.contact]|min_length[9]');
		$this->form_validation->set_rules('tuteur', "tuteur de l'étudiant $nom", 'trim|required|min_length[3]|max_length[30]');


		if ($this->form_validation->run() == FALSE) {
			$nom = $this->input->post('nom')." ".$this->input->post('prenom');
			$this->session->set_flashdata("message", enregistrement_etudiant_echoue($nom));
			$this->load->view('etudiants/new');
		}
		else{
			$this->load->library('upload');
			$image = array();
			$array = array(
				'matricule'  	=> $this->input->post('matricule'),
				'nom' 			=> $this->input->post('nom'),
				'prenom' 		=> $this->input->post('prenom'),
				'date_naiss'  	=> $this->input->post('date_naiss'),
				'lieu_naiss'  	=> $this->input->post('lieu_naiss'),
				'sexe'  		=> $this->input->post('sexe'),
				'filiere'  		=> $this->input->post('filiere'),
				'niveau'  		=> $this->input->post('niveau'),
				'contact' 		=> $this->input->post('contact'),
				'tuteur'  		=> $this->input->post('tuteur'),
				'save_as'  		=> date('Y-m-d H:i:s'),
				'save_by'  		=> '',
				'statut'  		=> 'actif'
			);
			for($i = 0; $i < 1; $i++){
				$_FILES['file']['name']       = $_FILES['image_name']['name'];
				$_FILES['file']['type']       = $_FILES['image_name']['type'];
				$_FILES['file']['tmp_name']   = $_FILES['image_name']['tmp_name'];
				$_FILES['file']['error']      = $_FILES['image_name']['error'];
				$_FILES['file']['size']       = $_FILES['image_name']['size'];

				$filiere = $this->input->post('filiere'); 
				$niveau = $this->input->post('niveau'); 
				$path_repertory = "./vendors/uploads/etudiants/".Extraire_specialite($filiere, $niveau)."/".date('Y')."/";

				if (!file_exists($path_repertory)) {
					mkdir($path, 0777, true);
				}
				else{
					echo "no things";
				}
				$uploadPath = $path_repertory;
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'jpg|jpeg|png|gif';

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if($this->upload->do_upload('file')){
					$imageData = $this->upload->data();
					$uploadImgData['avatar'] = $uploadPath.$imageData['file_name'];
				}
			}

			if ($uploadImgData != '') {
				$data = array_merge($array, $uploadImgData);
			} else {
				$data = $array;
			}
			
			$data = array_merge($array, $uploadImgData);
			$this->Dash->insert_etudiant($data);
			$this->session->set_flashdata("message", enregistrement_etudiant_reussie($nom));
			$this->load->view('etudiants/new');
		}
	}
	
	

	/* fonction pour lister les étudiant actif et les etudiants inactifs */
	public function liste_etudiant() {
		$data['liste_etudiant_actif']  = $this->Dash->listing_etudiant_actif();
		$data['liste_etudiant_inactif']  = $this->Dash->listing_etudiant_inactif();
		$this->load->view('etudiants/listing', $data);
	}
	
	

	/* fonction pour rendre un étudiant inactif */
	public function supprimer_etudiant($id) {
		$this->Dash->supprimer_etudiant($id);
		redirect('Liste_Etudiant');
	}
	
	

	/* fonction pour rendre un étudiant inactif */
	public function retablir_etudiant($id) {
		$this->Dash->retablir_etudiant($id);
		redirect('Liste_Etudiant');
	}
	
	

	/* fonction pour upgrate un étudiant actif */
	public function upgrate_etudiant($id){
		$data['upgrate_etudiant'] = $this->Dash->upgrate_etudiant($id);
		$this->load->view('etudiants/update', $data);
	}
	
	

	/* fonction pour upgrate un étudiant actif */
	public function consulter_donnees_etudiant($id){
		$data['upgrate_etudiant'] = $this->Dash->upgrate_etudiant($id);
		$this->load->view('etudiants/consulting', $data);
	}
	
	

	/* fonction pour modifier les données d'un etudiant */
	public function modifier_etudiant(){
		$nom = "";
		$id = $this->input->post('id');
		if (isset($id)){
			$this->form_validation->set_rules('matricule',  'matricule','trim|min_length[3]|required');
			$this->form_validation->set_rules('nom',  'Nom','trim|min_length[3]|max_length[15]|required');
			$this->form_validation->set_rules('prenom',  'Prenom','trim|min_length[3]|max_length[15]|required');
			$this->form_validation->set_rules('date_naiss', "date de naissance de l'étudiant $nom", 'trim|required');
			$this->form_validation->set_rules('lieu_naiss', "lieu de naissance de l'étudiant $nom", 'trim|required|min_length[3]|max_length[30]');
			$this->form_validation->set_rules('sexe', "sexe de l'étudiant $nom", 'trim|required');
			$this->form_validation->set_rules('filiere', "Filière de l'étudiant $nom", 'trim|required');
			$this->form_validation->set_rules('niveau', "niveau de l'étudiant $nom", 'trim|required');
			$this->form_validation->set_rules('contact', "Contact téléphonique de l'étudiant $nom", 'trim|required|min_length[9]');
			$this->form_validation->set_rules('tuteur', "tuteur de l'étudiant $nom", 'trim|required|min_length[3]|max_length[30]');


			if ($this->form_validation->run() == FALSE) {
				$nom = $this->input->post('nom')." ".$this->input->post('prenom');
				$this->session->set_flashdata("message", modification_etudiant_echoue($nom));
				$this->upgrate_etudiant($id);
			}
			else{
				$this->load->library('upload');
				$image = array();
				$array = array(
					'nom' 			=> $this->input->post('nom'),
					'prenom' 		=> $this->input->post('prenom'),
					'date_naiss'  	=> $this->input->post('date_naiss'),
					'lieu_naiss'  	=> $this->input->post('lieu_naiss'),
					'sexe'  		=> $this->input->post('sexe'),
					'filiere'  		=> $this->input->post('filiere'),
					'niveau'  		=> $this->input->post('niveau'),
					'contact' 		=> $this->input->post('contact'),
					'tuteur'  		=> $this->input->post('tuteur'),
					'save_as'  		=> date('Y-m-d H:i:s'),
					'save_by'  		=> '',
					'statut'  		=> 'actif'
				);
				for($i = 0; $i < 1; $i++){
					$_FILES['file']['name']       = $_FILES['image_name']['name'];
					$_FILES['file']['type']       = $_FILES['image_name']['type'];
					$_FILES['file']['tmp_name']   = $_FILES['image_name']['tmp_name'];
					$_FILES['file']['error']      = $_FILES['image_name']['error'];
					$_FILES['file']['size']       = $_FILES['image_name']['size'];

					$filiere = $this->input->post('filiere'); 
					$niveau = $this->input->post('niveau'); 
					$path_repertory = "./vendors/uploads/etudiants/".Extraire_specialite($filiere, $niveau)."/".date('Y')."/";

					if (!file_exists($path_repertory)) {
						mkdir($path_repertory, 0777, true);
					}
					else{
						echo "no things";
					}
					$uploadPath = $path_repertory;
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'jpg|jpeg|png|gif';

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('file')){
						$imageData = $this->upload->data();
						$uploadImgData['avatar'] = $uploadPath.$imageData['file_name'];
					}
				}
				$data = array_merge($array, $uploadImgData);
				$this->Dash->modifier_etudiant($id, $data);
				$this->session->set_flashdata("message", modification_etudiant_reussie($nom));
				redirect('Liste_Etudiant');
			}
		}	
	}
	
	

	// /* fonction pour importer les données des etudiants */
	// public function importer_etudiant(){
	// }
	
	

	// /* fonction pour exporter les données des etudiants */
	// public function exporter_etudiants() {
	// }
}




