<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	include 'functions/alerts.php';
	class welcome extends CI_Controller  {
		function __construct(){
			parent::__construct();
			$this->load->helper(array('form', 'url','url_helper'));
			$this->load->model('_Home', 'Dash', true);
			$this->load->library(array('upload', 'form_validation', 'session', 'Enc_lib', 'MY_Form_validation', 'zip'));
		}



		/* page de connexion */
		public function index() {
			$this->load->view('newLog');
		}

		/* page pour l'importation des notes*/
		public function relever(){
			$this->load->view('acceuil/relever');
		}

		/* page d'erreur */
		public function _404() {
			$this->load->view('newLog');
		}


		/*********************** Inserer un administrateur *****************************/

		public function insertAdmin(){

			$inserdata = $this->Dash->InsertAdmin('TAKAM', 'LIONEL123');

		}


		/*********************** fonction d'authentification **************************/

		public function authentification() {            

			$this->form_validation->set_rules('login', 'login','trim|required');
			$this->form_validation->set_rules('password', 'password', 'trim|required');

			/* recupération des données et affectation aux variables */
			$login    = $this->input->post('login'); 
			$password = $this->input->post('password');

			if ($this->form_validation->run() == FALSE) {

				$response[] = array(
					'success' =>  false,
					'status'  =>  502,
					'msg'     => 'Mot de Passe ou Login Incorrect'
				);
				echo json_encode($response);

			}else{

				$result	= $this->Dash->getOneAdmin($login, $password); 

				if ((sizeof($result) != 1)) {
					
					$response[] = array(
						'success' => false,
						'status'  =>  502,
						'msg'     => 'Mot de Passe ou Login Incorrect '
					);
					echo json_encode($response);

				}else{

					$data = $this->Dash->getOneAdmin($login, $password);
					foreach ($data as $key) {
						$response[] = array(
							'success'   => true,
							'status'    =>  201,
							'msg'       => 'Conexion Reussir !!!!!!!!!',
							'login' 	=> $login,
							'id'  		=> $key->id,
							'password'  => $key->password,
							'statut'  	=> $key->statut,
						);

						echo json_encode($response);
					}
				}
			}
		}



		/* fonction pour creer les repertoires */
		public function creer_repertoires($type, $filiere, $niveau) {
			$path_repertory = "./vendors/uploads/";

			if ($type == "etudiant") {
				$type = "etudiants";
			} 
			else if($type == "administrateurs") {
				$type = "administrateurs";
			}
			
			$path_repertory = "./vendors/uploads/".$type."/".$filiere.$niveau."/".date('Y')."/";
			
			if (is_dir($path_repertory)) {
				echo ' ';  
			}
			else { 
				mkdir($path_repertory);
			}
			return $path_repertory;
		}



		/* page d'acceuil */
		public function dashboard() {
			// $this->verifier_authetification();

			// $data['count_admin']  			= $this->Dash->compter_tout_administrateur();
			// $data['count_admin_actif']  	= $this->Dash->compter_tout_administrateur_actif();
			// $data['count_admin_inactif']  	= $this->Dash->compter_tout_administrateur_inactif();
			// $data['count_etudiants']  		= $this->Dash->compter_tout_etudiants();
			// $data['count_etudiant_actif']  	= $this->Dash->compter_tout_etudiants_actif();
			// $data['count_etudiant_inactif'] = $this->Dash->compter_tout_etudiants_inactif();
			// $data['liste_etudiant']  		= $this->Dash->listing_etudiant_actif();

			$this->load->view('acceuil/acceuil');
		}

	}




