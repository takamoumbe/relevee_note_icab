<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class _Home extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	

	/* ================= selectionner u administrateur ================= */

		public function getOneAdmin($login, $password) {

			$this->db->select('*');
			$this->db->from('administrateur');
			$this->db->where('login', md5($login));
			$this->db->where('password', md5($password));
			$this->db->where('statut', 'actif');
			$query = $this->db->get();
			return $query->result();  

	    }

	 /* ================= Inserer un administrateur ================= */

	 	public function InsertAdmin($login, $password){

	 		$data = [
	 			'login' 	=> md5($login),
	 			'password'  => md5($password),
	 			'statut'    => 'actif'
	 		];

	 		$this->db->insert('administrateur',$data);

	 	}




	/* ================= Finalisation du Module de gestion des étudiants ================= */



		public function insert_etudiant($data){
			$this->db->insert('etudiant',$data);
		}

		public function insert_etudiant_bash($data, $table){
			$verdic = $this->db->insert_batch($table, $data);
			return $verdic;
		}
		

		// modifier les notes pour le semestre2
		public function update_etudiant_bash($data){
			$count = 0;
			for ($i=0; $i < sizeof($data); $i++) {

				$this->db->set('intro_gl', 			$data[$i]['intro_gl']);
				$this->db->set('trait_donnee_mult', $data[$i]['trait_donnee_mult']);
				$this->db->set('anglais', 			$data[$i]['anglais']);
				$this->db->set('web_1', 			$data[$i]['web_1']);
				$this->db->set('progra_evene_1', 	$data[$i]['progra_evene_1']);
				$this->db->set('min_projet', 		$data[$i]['min_projet']);
				$this->db->set('nego_info', 		$data[$i]['nego_info']);
				$this->db->where('matricule',       $data[$i]['matricule']);
				$this->db->update('etudiant');
				$count++;
			}
			
			return $count;
		}

		// modifier les etudiants mcv
		public function update_etudiant_bash_mcv($data){
			$count = 0;
			for ($i=0; $i < sizeof($data); $i++) {

				$this->db->set('mark_fond_1', 		$data[$i]['mark_fond_1']);
				$this->db->set('pol_prix', 			$data[$i]['pol_prix']);
				$this->db->set('tech_vent', 		$data[$i]['tech_vent']);
				$this->db->set('forc_vent_1', 		$data[$i]['forc_vent_1']);
				$this->db->set('gest_com', 			$data[$i]['gest_com']);
				$this->db->set('stat', 				$data[$i]['stat']);
				$this->db->set('mark_fond_2', 		$data[$i]['mark_fond_2']);
				$this->db->set('etud_mar_2', 		$data[$i]['etud_mar_2']);
				$this->db->set('gest_com_2', 		$data[$i]['gest_com_2']);
				$this->db->set('tech_neg_com', 		$data[$i]['tech_neg_com']);
				$this->db->set('forc_vent_2', 		$data[$i]['forc_vent_2']);
				$this->db->set('math_gen_2', 		$data[$i]['math_gen_2']);
				$this->db->where('matricule',       $data[$i]['matricule']);
				$this->db->update('etudiant_mcv');
				$count++;
			}

			return $count;
		} 


		// modifier les etudiants cge
		public function update_etudiant_bash_cge($data){
			$count = 0;
			for ($i=0; $i < sizeof($data); $i++) {

				$this->db->set('opera_cou_I', 		$data[$i]['opera_cou_I']);
				$this->db->set('opera_speci_I', 	$data[$i]['opera_speci_I']);
				$this->db->set('compta_anal_I', 	$data[$i]['compta_anal_I']);
				$this->db->set('intro_fisc', 		$data[$i]['intro_fisc']);
				$this->db->set('intro_analyse_fin_I',$data[$i]['intro_analyse_fin_I']);
				$this->db->set('math_fin_I',		$data[$i]['math_fin_I']);
				$this->db->set('opera_cou_II', 		$data[$i]['opera_cou_II']);
				$this->db->set('opera_speci_II', 	$data[$i]['opera_speci_II']);
				$this->db->set('compta_anal_II', 	$data[$i]['compta_anal_II']);
				$this->db->set('math_fin_II', 		$data[$i]['math_fin_II']);
				$this->db->set('recherche_opera', 	$data[$i]['recherche_opera']);
				$this->db->set('anglais', 			$data[$i]['anglais']);
				$this->db->set('econo_orga_entre', 	$data[$i]['econo_orga_entre']);
				$this->db->where('matricule',       $data[$i]['matricule']);
				$this->db->update('etudiant_cge');
				$count++;
			}

			return $count;
		}

		// modifier les etudiants batiment
		public function update_etudiant_bash_batiment($data){
			$count = 0;
			for ($i=0; $i < sizeof($data); $i++) {

				$this->db->set('matricule', 		$data[$i]['matricule']);
				$this->db->set('physi_II', 			$data[$i]['physi_II']);
				$this->db->set('chimie', 			$data[$i]['chimie']);
				$this->db->set('proce_gene_const_I',$data[$i]['proce_gene_const_I']);
				$this->db->set('dessin_tech_bati',	$data[$i]['dessin_tech_bati']);
				$this->db->set('organi_chantier', 	$data[$i]['organi_chantier']);
				$this->db->set('architecture', 		$data[$i]['architecture']);
				$this->db->set('projet_beton_ar', 	$data[$i]['projet_beton_ar']);
				$this->db->set('pro_gene_const_II', $data[$i]['pro_gene_const_II']);
				$this->db->set('topographie_I', 	$data[$i]['topographie_I']);
				$this->db->set('beton_arme_I', 		$data[$i]['beton_arme_I']);
				$this->db->set('geometrique', 		$data[$i]['geometrique']);
				$this->db->set('math_I', 			$data[$i]['math_I']);
				$this->db->set('math_II', 			$data[$i]['math_II']);
				$this->db->set('info_I',			$data[$i]['info_I']);
				$this->db->set('forma_bilingue',	$data[$i]['forma_bilingue']);
				$this->db->set('francais',			$data[$i]['francais']);
				$this->db->set('entrepreunariat',	$data[$i]['entrepreunariat']);
				$this->db->where('matricule',       $data[$i]['matricule']);
				$this->db->update('etudiant_batiment');
				$count++;
			}

			return $count;
		}

		// modifier les etudiants iia
		public function update_etudiant_bash_iia($data){
			$count = 0;
			for ($i=0; $i < sizeof($data); $i++) {

				$this->db->set('eletrotech_I', 			$data[$i]['eletrotech_I']);
				$this->db->set('elect_puissance_I', 	$data[$i]['elect_puissance_I']);
				$this->db->set('circuit_log_I',			$data[$i]['circuit_log_I']);
				$this->db->set('reseseau_teleinfo',		$data[$i]['reseseau_teleinfo']);
				$this->db->set('domoti_I', 				$data[$i]['domoti_I']);
				$this->db->set('phy_gene_I', 			$data[$i]['phy_gene_I']);
				$this->db->set('algebre_line_I', 		$data[$i]['algebre_line_I']);
				$this->db->set('anglais', 				$data[$i]['anglais']);
				$this->db->set('domoti_II', 			$data[$i]['domoti_II']);
				$this->db->set('circuit_logi_II', 		$data[$i]['circuit_logi_II']);
				$this->db->set('econo_orga_entre', 		$data[$i]['econo_orga_entre']);
				$this->db->where('matricule',       	$data[$i]['matricule']);
				$this->db->update('etudiant_iia');
				$count++;
			}

			return $count;
		}


		// modifier les etudiants glt
		public function update_etudiant_bash_glt($data){
			$count = 0;
			for ($i=0; $i < sizeof($data); $i++) {
				$this->db->set('trans_terest_II', 		$data[$i]['trans_terest_II']);
				$this->db->where('matricule',       	$data[$i]['matricule']);
				$this->db->update('etudiant_glt');
				$count++;
			}

			return $count;
		}


		// modifier les etudiants bif
		public function update_etudiant_bash_bif($data){
			$count = 0;
			for ($i=0; $i < sizeof($data); $i++) {

				$this->db->set('math_fin_I', 				$data[$i]['math_fin_I']);
				$this->db->set('tech_banc_march_parti', 	$data[$i]['tech_banc_march_parti']);
				$this->db->set('opera_banc_tansfro_I', 		$data[$i]['opera_banc_tansfro_I']);
				$this->db->set('strat_mark_banc', 			$data[$i]['strat_mark_banc']);
				$this->db->set('syst_fin_decentr_I', 		$data[$i]['syst_fin_decentr_I']);
				$this->db->set('ethiq_deont_banc', 			$data[$i]['ethiq_deont_banc']);
				$this->db->set('math_fin_II', 				$data[$i]['math_fin_II']);
				$this->db->set('fisc_des_opre_banc', 		$data[$i]['fisc_des_opre_banc']);
				$this->db->set('teh_banc_marc_des_ent_I', 	$data[$i]['teh_banc_marc_des_ent_I']);
				$this->db->set('opera_banc_tansfro_II', 	$data[$i]['opera_banc_tansfro_II']);
				$this->db->set('syst_fin_decentr_II', 		$data[$i]['syst_fin_decentr_II']);
				$this->db->set('fin_islami_II', 			$data[$i]['fin_islami_II']);
				$this->db->set('econo_moneta_II', 			$data[$i]['econo_moneta_II']);
				$this->db->set('expre_angl', 				$data[$i]['expre_angl']);
				$this->db->set('econo_org_des_ent', 		$data[$i]['econo_org_des_ent']);
				$this->db->where('matricule',       		$data[$i]['matricule']);
				$this->db->update('etudiant_bif');
				$count++;
			}
			
			return $count;
		}


		// liste des etudiants
		public function listing_etudiants($table) {
			$this->db->select('*');
			$this->db->from($table);
			$query=$this->db->get();
			return $query->result();
		}

}

