<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'vendors/Excel/vendor/autoload.php';
include "functions/etudiants/alerts.php";
include 'fpdf/fpdf.php';
include 'redefine_class_pdf.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; 

class PhpSpreesheet extends CI_Controller  {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url','url_helper'));
		$this->load->model('_Home', 'Dash', true);
		$this->load->library(array('upload', 'form_validation', 'session', 'Enc_lib', 'MY_Form_validation', 'zip'));
	}

	 /*
	    |-------------------------------------------------------------------
	    | Generate QR Code
	    |-------------------------------------------------------------------
	    |
	    | @param $data   QR Content
	    |
	    */
		function generate_qrcode($mat, $nom, $date)
		{
	        /* Load QR Code Library */
	        $this->load->library('ciqrcode');
	        
	        /* Data */
	        $save_name  = $mat.'.png';

	        /* QR Code File Directory Initialize */
	        $dir = './photos/qrCode/';
	        if (!file_exists($dir)) {
	            mkdir($dir, 0775, true);
	        }

	        /* QR Configuration  */
	        $config['cacheable']    = true;
	        $config['imagedir']     = $dir;
	        $config['quality']      = true;
	        $config['size']         = '1024'; //1024
	        $config['black']        = array(62,117,209); //255 255 255 255
	        $config['white']        = array(255,255,255);
	        $this->ciqrcode->initialize($config);
	  
	        /* QR Data  */
	        $params['data']     = $mat.' | '.$nom.' | '.$date.' | ICAB '.md5($mat).''.rand(1, 1000);
	        $params['level']    = 'L';
	        $params['size']     = 10;
	        $params['savename'] = FCPATH.$config['imagedir']. $save_name;
	        
	        $this->ciqrcode->generate($params);

	        return $dir."".$save_name;
	    }


	 /*
	    |-------------------------------------------------------------------
	    | Importer les notes du semestre I gl
	    |-------------------------------------------------------------------
	    |
	    | @param null
	    |
	    */
	public function import_gl_semestre_1() {

		$upload_file = $_FILES['upload_file']['name'];
		$extension = pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} 
		else if($extension == 'xls') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} 
		else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata   = $spreadsheet->getActiveSheet()->toArray();
		$sheetcount  = count($sheetdata); // conter le nombre de ligne


		if($sheetcount > 1) {
			$data=array();
			$j = 1; $k = 0;


			for ($i=3, $j = 1; $i < $sheetcount; $i++) {

				$matricule 	    	= $sheetdata[$i][1]; // -
				$nom 				= $sheetdata[$i][2]; // -
				$filiere 			= $sheetdata[$i][3]; // -
				$date_nais 			= $sheetdata[$i][4]; // -
				$lieu_nais 			= $sheetdata[$i][5]; // -
				$sexe 				= $sheetdata[$i][6]; // -
				$niveau 			= "I";
				$envi_b_1          	= $sheetdata[$i][18];// info géné -
				$outilsB			= $sheetdata[$i][18];// info géné -
				$archi				= $sheetdata[$i][25];// archi
				$algorithme			= $sheetdata[$i][88];// 
				$intro_si			= $sheetdata[$i][81];// systeme d information
				$intro_gl			= rand(12, 13); // -
				$trait_donnee_mult	= rand(12, 13); // -
				$algebre_l			= $sheetdata[$i][39];// math1 -
				$ana_math_1			= $sheetdata[$i][46];// math1 -
				$anglais		    = 10.0;
				$compta			    = $sheetdata[$i][11];// -
				$s_exploi_1			= $sheetdata[$i][96];// -
				$web_1			    = 10;// web 2
				$progra_1			= $sheetdata[$i][53];// programmation c -
				$intro_bd			= $sheetdata[$i][74];// bd et sql -
				$s_infor_2			= $sheetdata[$i][81];// systeme d information
				$progra_evene_1		= 10.0;
				$min_projet			= 10.0;
				$ins_maint_mat_log	= $sheetdata[$i][25];
				$nego_info			= 10.0;
				$alge_bool_circuit	= $sheetdata[$i][25]; 
				$stat_des			= $sheetdata[$i][60];// -
				$economie			= $sheetdata[$i][67];// -
				$francais			= $sheetdata[$i][32];// -

				$oldDate = strtotime(trim($date_nais));
				$newDate = date('d/m/Y',$oldDate);
				if ($date_nais == "") {$newDate = "";}

				$array = $data[] =	array(
					"matricule" 	    => trim($matricule),
					"nom" 				=> $nom,
					"filiere" 			=> $filiere,
					"date_naiss" 		=> $newDate,
					"lieu_naiss" 		=> $lieu_nais,
					"sexe" 				=> $sexe,
					"niveau" 			=> $niveau,
					"envi_b_1"          => $envi_b_1,
					"outilsB"			=> $outilsB,
					"archi"				=> $archi,
					"algorithme"		=> $algorithme,
					"intro_si"			=> $intro_si,
					"intro_gl"			=> $intro_gl,
					"trait_donnee_mult"	=> $trait_donnee_mult,
					"algebre_l"			=> $algebre_l, 
					"ana_math_1"		=> $ana_math_1, 
					"anglais"		    => $anglais, 
					"compta"			=> $compta, 
					"s_exploi_1"	    => $s_exploi_1, 
					"web_1"			    => $web_1, 
					"progra_1"			=> $progra_1,
					"intro_bd"			=> $intro_bd, 
					"s_infor_2"			=> $s_infor_2, 
					"progra_evene_1"	=> $progra_evene_1, 
					"min_projet"		=> $min_projet, 
					"ins_maint_mat_log"	=> $ins_maint_mat_log, 
					"nego_info"			=> $nego_info, 
					"alge_bool_circuit"	=> $alge_bool_circuit,
					"stat_des"			=> $stat_des, 
					"economie"			=> $economie, 
					"francais"			=> $francais, 
					"qrCode"			=> $this->generate_qrcode($matricule, $nom, $newDate), 
				);
			}


			$inserdata = $this->Dash->insert_etudiant_bash($data, "etudiant");
			if($inserdata) {
				$response[] = array(
					'success' =>  true,
					'status'  =>  201,
					'msg'     => 'Importation reussir'
				);
				echo json_encode($response);
			} else {
				$response[] = array(
					'success' =>  false,
					'status'  =>  501,
					'msg'     => 'Echec Importation'
				);
				echo json_encode($response);
			}

		}
	}

	 /*
	    |-------------------------------------------------------------------
	    | Importer les notes du semestre II gl
	    |-------------------------------------------------------------------
	    |
	    | @param null
	    |
	    */

    public function import_gl_semestre_2(){
    	$upload_file = $_FILES['upload_file']['name'];
		$extension = pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} 
		else if($extension == 'xls') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} 
		else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata   = $spreadsheet->getActiveSheet()->toArray();
		$sheetcount  = count($sheetdata); // conter le nombre de ligne


		if($sheetcount > 1) {
			$data=array();
			$j = 1; $k = 0;

			for ($i=3, $j = 1; $i < $sheetcount; $i++) {


				$matricule 	    	= $sheetdata[$i][1];
				$intro_gl			= $sheetdata[$i][36];//intro gl1
				$trait_donnee_mult	= rand(12, 13); // -
				$anglais		    = rand(12, 13);
				$web_1			    = $sheetdata[$i][22];
				$progra_evene_1		= $sheetdata[$i][50];//web 2 
				$min_projet			= rand(12, 13);
				$nego_info			= $sheetdata[$i][15];// intro gl2

				$array = $data[] =	array(
					"matricule" 	    => trim($matricule),
					"intro_gl"			=> $intro_gl,
					"trait_donnee_mult"	=> $trait_donnee_mult,
					"anglais"		    => $anglais, 
					"web_1"			    => $web_1, 
					"progra_evene_1"	=> $progra_evene_1, 
					"min_projet"		=> $min_projet, 
					"nego_info"			=> $nego_info, 
				);
		}


		$count = $this->Dash->update_etudiant_bash($data);
		if($count == sizeof($data)) {
			$response[] = array(
				'success' =>  true,
				'status'  =>  201,
				'msg'     => 'Importation Semestre 2 reussir'
			);
			echo json_encode($response);
		} else {
			$response[] = array(
				'success' =>  false,
				'status'  =>  501,
				'msg'     => 'Echec  Semestre 2 Importation'
			);
			echo json_encode($response);
		}

		}
	}

	/*********************************************************************************************************************************************************************/
	 /*
	    |-------------------------------------------------------------------
	    | Importer les notes du semestre I mcv
	    |-------------------------------------------------------------------
	    |
	    | @param null
	    |
	    */
	public function import_mcv_semestre_1() {

		$upload_file = $_FILES['upload_file']['name'];
		$extension = pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} 
		else if($extension == 'xls') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} 
		else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata   = $spreadsheet->getActiveSheet()->toArray();
		$sheetcount  = count($sheetdata); // conter le nombre de ligne


		if($sheetcount > 1) {
			$data=array();
			$j = 1; $k = 0;


			for ($i=3, $j = 1; $i < $sheetcount; $i++) {

				$matricule 	    	= $sheetdata[$i][1];
				$nom 				= $sheetdata[$i][2];
				$filiere 			= $sheetdata[$i][3];
				$date_nais 			= $sheetdata[$i][4];
				$lieu_nais 			= $sheetdata[$i][5];
				$sexe 				= $sheetdata[$i][6];
				$niveau 			= "I";
				$mark_fond_1		= 10.0;
				$mark_in_1  		= $sheetdata[$i][67];
				$pol_pro			= $sheetdata[$i][60];
				$pol_prix			= 10.0;
				$tech_vent			= 10.0;
				$veil_conc			= $sheetdata[$i][81];
				$forc_vent_1		= 10.0;
				$etud_mar_1			= $sheetdata[$i][74];
				$gest_com			= 10.0;
				$math_gen_1			= $sheetdata[$i][53];
				$info_gen_1			= $sheetdata[$i][18];
				$math_fin_1			= $sheetdata[$i][95]; 
				$stat				= 10.0;
				$exp_franc			= $sheetdata[$i][39];
				$eco_gen			= $sheetdata[$i][25]; // droit commerciale
				$mark_fond_2		= 10.0;
				$mark_int_2			= $sheetdata[$i][88];
				$etud_mar_2			= 10.0;
				$gest_com_2			= 10.0;
				$tech_neg_com		= 10.0;
				$forc_vent_2		= 10.0;
				$info_gen_2			= $sheetdata[$i][18];
				$math_gen_2			= 10.0;
				$math_fin_2			= $sheetdata[$i][46]; //ro
				$comp_gen			= $sheetdata[$i][11];
				$exp_ang			= rand(12, 13); 
				$eco_org_entre 		= $sheetdata[$i][32];

				$oldDate = strtotime(trim($date_nais));
				$newDate = date('d/m/Y',$oldDate);
				if ($date_nais == "") {$newDate = "";}

				$array = $data[] =	array(
					"matricule" 	    => trim($matricule),
					"nom" 				=> $nom,
					"filiere" 			=> $filiere,
					"date_naiss" 		=> $newDate,
					"lieu_naiss" 		=> $lieu_nais,
					"sexe" 				=> $sexe,
					"niveau" 			=> $niveau, 
					"mark_fond_1"		=> $mark_fond_1,
					"mark_in_1"			=> $mark_in_1,
					"pol_pro"			=> $pol_pro,
					"pol_prix"			=> $pol_prix,
					"tech_vent"			=> $tech_vent,
					"veil_conc"			=> $veil_conc,
					"forc_vent_1"		=> $forc_vent_1,
					"etud_mar_1"		=> $etud_mar_1,
					"gest_com"			=> $gest_com,
					"math_gen_1"		=> $math_gen_1,
					"info_gen_1"		=> $info_gen_1,
					"math_fin_1"		=> $math_fin_1,
					"stat"				=> $stat,
					"exp_franc"			=> $exp_franc,
					"eco_gen"			=> $eco_gen,
					"mark_fond_2"		=> $mark_fond_2,
					"mark_int_2"		=> $mark_int_2,
					"etud_mar_2"		=> $etud_mar_2,
					"gest_com_2"		=> $gest_com_2,
					"tech_neg_com"		=> $tech_neg_com,
					"forc_vent_2"		=> $forc_vent_2,
					"info_gen_2"		=> $info_gen_2,
					"math_gen_2"		=> $math_gen_2,
					"math_fin_2"		=> $math_fin_2,
					"comp_gen"			=> $comp_gen,
					"exp_ang"			=> $exp_ang,
					"eco_org_entre"		=> $eco_org_entre,
					"qrCode"			=> $this->generate_qrcode($matricule, $nom, $newDate), 
				);
			}


			$inserdata = $this->Dash->insert_etudiant_bash($data, "etudiant_mcv");
			if($inserdata) {
				$response[] = array(
					'success' =>  true,
					'status'  =>  201,
					'msg'     => 'Importation reussir'
				);
				echo json_encode($response);
			} else {
				$response[] = array(
					'success' =>  false,
					'status'  =>  501,
					'msg'     => 'Echec Importation'
				);
				echo json_encode($response);
			}

		}
	}


	 /*
	    |-------------------------------------------------------------------
	    | Importer les notes du semestre II mcv
	    |-------------------------------------------------------------------
	    |
	    | @param null
	    |
	    */
	public function import_mcv_semestre_2(){
		$upload_file = $_FILES['upload_file']['name'];
		$extension = pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} 
		else if($extension == 'xls') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} 
		else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata   = $spreadsheet->getActiveSheet()->toArray();
		$sheetcount  = count($sheetdata); // conter le nombre de ligne


		if($sheetcount > 1) {
			$data=array();
			$j = 1; $k = 0;



			for ($i=3, $j = 1; $i < $sheetcount; $i++) {


				$matricule 	    	= $sheetdata[$i][1];

				$mark_fond_1		= $sheetdata[$i][43];
				$pol_prix			= $sheetdata[$i][22];
				$tech_vent			= $sheetdata[$i][71];
				$forc_vent_1		= $sheetdata[$i][50];
				$gest_com			= $sheetdata[$i][29]; // politique  de distribution
				$stat				= $sheetdata[$i][8];
				$mark_fond_2		= $sheetdata[$i][36];
				$etud_mar_2			= $sheetdata[$i][78];
				$gest_com_2			= rand(12, 13);
				$tech_neg_com		= $sheetdata[$i][15]; // negociation
				$forc_vent_2		= $sheetdata[$i][57];
				$math_gen_2			= $sheetdata[$i][64];
				

				$array = $data[] =	array(
					"matricule" 	=> trim($matricule),
					"mark_fond_1"	=> $mark_fond_1,
					"pol_prix"		=> $pol_prix,
					"tech_vent"		=> $tech_vent, 
					"forc_vent_1"	=> $forc_vent_1, 
					"gest_com"		=> $gest_com, 
					"stat"			=> $stat, 
					"mark_fond_2"	=> $mark_fond_2, 
					"etud_mar_2"	=> $etud_mar_2, 
					"gest_com_2"	=> $gest_com_2,  
					"tech_neg_com"	=> $tech_neg_com,  
					"forc_vent_2"	=> $forc_vent_2,  
					"math_gen_2"	=> $math_gen_2  
				);
			}

			$count = $this->Dash->update_etudiant_bash_mcv($data);
			if($count == sizeof($data)) {
				$response[] = array(
					'success' =>  true,
					'status'  =>  201,
					'msg'     => 'Importation Semestre 2 reussir'
				);
				echo json_encode($response);
			} else {
				$response[] = array(
					'success' =>  false,
					'status'  =>  501,
					'msg'     => 'Echec  Semestre 2 Importation'
				);
				echo json_encode($response);
			}
		}
	}

	/*
    |-------------------------------------------------------------------
    | Importer les notes du CGE semestre I 
    |-------------------------------------------------------------------
    |
    | @param null
    |
    */
	public function import_cge_semestre_1() {

		$upload_file = $_FILES['upload_file']['name'];
		$extension = pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} 
		else if($extension == 'xls') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} 
		else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata   = $spreadsheet->getActiveSheet()->toArray();
		$sheetcount  = count($sheetdata); // conter le nombre de ligne


		if($sheetcount > 1) {
			$data=array();
			$j = 1; $k = 0;


			for ($i=3, $j = 1; $i < $sheetcount; $i++) {

				$matricule 	    	= $sheetdata[$i][1];
				$nom 				= $sheetdata[$i][2];
				$filiere 			= $sheetdata[$i][3];
				$date_nais 			= $sheetdata[$i][4];
				$lieu_nais 			= $sheetdata[$i][5];
				$sexe 				= $sheetdata[$i][6];
				$niveau 			= "I";
				$opera_cou_I     	= 10.0;
				$opera_speci_I     	= 10.0;
				$compta_anal_I     	= 10.0;
				$intro_fisc     	= 10.0;
				$intro_analyse_fin_I= 10.0;
				$math_fin_I 		= 10.0;
				$math_gene_I   		= $sheetdata[$i][25];;
				$info_gene_I     	= $sheetdata[$i][18];
				$stat_I     		= $sheetdata[$i][11];
				$francais     		= $sheetdata[$i][32];
				$econo_gene     	= $sheetdata[$i][39];
				$opera_cou_II     	= 10.0;
				$opera_speci_II 	= 10.0;
				$compta_anal_II     = 10.0;
				$compta_societe_I   = rand(12, 13);
				$math_fin_II  		= 10.0;
				$math_gene_II     	= $sheetdata[$i][46];
				$recherche_opera    = 10.0;
				$anglais     		= 10.0;
				$econo_orga_entre   = 10.0;

				$oldDate = strtotime(trim($date_nais));
				$newDate = date('d/m/Y',$oldDate);
				if ($date_nais == "") {$newDate = "";}

				$array = $data[] =	array(
					"matricule" 	    => trim($matricule),
					"nom" 				=> $nom,
					"filiere" 			=> $filiere,
					"date_naiss" 		=> $newDate,
					"lieu_naiss" 		=> $lieu_nais,
					"sexe" 				=> $sexe,
					"niveau" 			=> $niveau,
					"opera_cou_I"		=> $opera_cou_I,
					"opera_speci_I"		=> $opera_speci_I,
					"compta_anal_I"		=> $compta_anal_I,
					"intro_fisc"		=> $intro_fisc,
					"intro_analyse_fin_I"=> $intro_analyse_fin_I,
					"math_fin_I"		=> $math_fin_I,
					"math_gene_I"		=> $math_gene_I,
					"info_gene_I"		=> $info_gene_I,
					"stat_I"			=> $stat_I,
					"francais"			=> $francais,
					"econo_gene"		=> $econo_gene,
					"opera_cou_II"		=> $opera_cou_II,
					"opera_speci_II"	=> $opera_speci_II,
					"compta_anal_II"	=> $compta_anal_II,
					"compta_societe_I"	=> $compta_societe_I,
					"math_fin_II"	 	=> $math_fin_II,
					"math_gene_II"		=> $math_gene_II,
					"recherche_opera"	=> $recherche_opera,
					"anglais"			=> $anglais,
					"econo_orga_entre"	=> $econo_orga_entre,
					"qrCode"			=> $this->generate_qrcode($matricule, $nom, $newDate), 
				);
			}


			$inserdata = $this->Dash->insert_etudiant_bash($data, "etudiant_cge");
			if($inserdata) {
				$response[] = array(
					'success' =>  true,
					'status'  =>  201,
					'msg'     => 'Importation reussir'
				);
				echo json_encode($response);
			} else {
				$response[] = array(
					'success' =>  false,
					'status'  =>  501,
					'msg'     => 'Echec Importation'
				);
				echo json_encode($response);
			}

		}
	}


	 /*
	    |-------------------------------------------------------------------
	    | Importer les notes du CGE semestre II
	    |-------------------------------------------------------------------
	    |
	    | @param null
	    |
	    */
	public function import_cge_semestre_2(){
		$upload_file = $_FILES['upload_file']['name'];
		$extension = pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} 
		else if($extension == 'xls') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} 
		else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata   = $spreadsheet->getActiveSheet()->toArray();
		$sheetcount  = count($sheetdata); // conter le nombre de ligne


		if($sheetcount > 1) {
			$data=array();
			$j = 1; $k = 0;


			for ($i=3, $j = 1; $i < $sheetcount; $i++) {

				$matricule 	    	= $sheetdata[$i][1];
				$opera_cou_I     	= $sheetdata[$i][78+7];
				$opera_speci_I     	= $sheetdata[$i][57+7]; // travaux fin exo
				$compta_anal_I     	= $sheetdata[$i][64+7];
				$intro_fisc     	= $sheetdata[$i][8];
				$intro_analyse_fin_I= $sheetdata[$i][15];
				$math_fin_I 		= $sheetdata[$i][50];
				$opera_cou_II     	= $sheetdata[$i][43];
				$opera_speci_II 	= $sheetdata[$i][22]; // compta des societes
				$compta_anal_II     = $sheetdata[$i][86+7]; // compta gene
				$math_fin_II  		= rand(12, 13);
				$recherche_opera    = $sheetdata[$i][71+7];
				$anglais     		= rand(12, 13);
				$econo_orga_entre   = rand(12, 13);

				$array = $data[] =	array(
					"matricule" 	    => trim($matricule),
					"opera_cou_I"		=> $opera_cou_I,
					"opera_speci_I"		=> $opera_speci_I,
					"compta_anal_I"		=> $compta_anal_I,
					"intro_fisc"		=> $intro_fisc,
					"intro_analyse_fin_I"=> $intro_analyse_fin_I,
					"math_fin_I"		=> $math_fin_I,
					"opera_cou_II"		=> $opera_cou_II,
					"opera_speci_II"	=> $opera_speci_II,
					"compta_anal_II"	=> $compta_anal_II,
					"math_fin_II"		=> $math_fin_II,
					"recherche_opera"	=> $recherche_opera,
					"anglais"			=> $anglais,
					"econo_orga_entre"	=> $econo_orga_entre
				);

			}

			

			$count = $this->Dash->update_etudiant_bash_cge($data);
			if($count == sizeof($data)) {
				$response[] = array(
					'success' =>  true,
					'status'  =>  201,
					'msg'     => 'Importation Semestre 2 reussir'
				);
				echo json_encode($response);
			} else {
				$response[] = array(
					'success' =>  false,
					'status'  =>  501,
					'msg'     => 'Echec  Semestre 2 Importation'
				);
				echo json_encode($response);
			}
		}
	}

		/*
	    |-------------------------------------------------------------------
	    | Importer les notes du batiment semestre I 
	    |-------------------------------------------------------------------
	    |
	    | @param null
	    |
	    */
	public function import_batiment_semestre_1() {

		$upload_file = $_FILES['upload_file']['name'];
		$extension = pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} 
		else if($extension == 'xls') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} 
		else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata   = $spreadsheet->getActiveSheet()->toArray();
		$sheetcount  = count($sheetdata); // conter le nombre de ligne


		if($sheetcount > 1) {
			$data=array();
			$j = 1; $k = 0;

 
			for ($i=3, $j = 1; $i < $sheetcount; $i++) {

				$matricule 	    	= trim($sheetdata[$i][1]);
				$nom 				= $sheetdata[$i][2];
				$filiere 			= $sheetdata[$i][3];
				$date_nais 			= $sheetdata[$i][4];
				$lieu_nais 			= $sheetdata[$i][5];
				$sexe 				= $sheetdata[$i][6];
				$niveau 			= "I";
				$physi_I     		= $sheetdata[$i][25];
				$physi_II     		= 10.0; 
				$chimie     		= 10.0; 
				$proce_gene_const_I = 10.0; 
				$dessin_tech_bati   = 10.0; 
				$organi_chantier    = 10.0; 
				$architecture     	= 10.0; 
				$resis_mat_I     	= $sheetdata[$i][11]; 
				$route_I     		= $sheetdata[$i][60];
				$projet_beton_ar    = 10.0; 
				$pro_gene_const_II  = 10.0; 
				$topographie_I     	= 10.0;
				$beton_arme_I     	= 10.0; 
				$geometrique     	= 10.0; 
				$resis_mat_II     	= $sheetdata[$i][11]; 
				$math_I     		= 10.0; 
				$math_II     		= 10.0; 
				$info_I     		= 10.0; 
				$forma_bilingue     = 10.0; 
				$francais     		= 10.0; 
				$entrepreunariat    = 10.0; 
				$ethique     		= $sheetdata[$i][18];
				

				$oldDate = strtotime(trim($date_nais));
				$newDate = date('d/m/Y',$oldDate);
				if ($date_nais == "") {$newDate = "";}

				$array = $data[] =	array(
					"matricule" 	    => trim($matricule),
					"nom" 				=> $nom,
					"filiere" 			=> $filiere,
					"date_naiss" 		=> $newDate,
					"lieu_naiss" 		=> $lieu_nais,
					"sexe" 				=> $sexe,
					"niveau" 			=> $niveau,
					"physi_I"			=> $physi_I,
					"physi_II"			=> $physi_II,
					"chimie"			=> $chimie,
					"proce_gene_const_I"=> $proce_gene_const_I,
					"dessin_tech_bati"	=> $dessin_tech_bati,
					"organi_chantier"	=> $organi_chantier,
					"architecture"		=> $architecture,
					"resis_mat_I"		=> $resis_mat_I,
					"route_I"			=> $route_I,
					"projet_beton_ar"	=> $projet_beton_ar,
					"pro_gene_const_II"	=> $pro_gene_const_II,
					"topographie_I"		=> $topographie_I,
					"beton_arme_I"		=> $beton_arme_I,
					"geometrique"		=> $geometrique,
					"resis_mat_II"		=> $resis_mat_II,
					"math_I"			=> $math_I,
					"math_II"			=> $math_II,
					"info_I"			=> $info_I,
					"forma_bilingue"	=> $forma_bilingue,
					"francais"			=> $francais,
					"entrepreunariat"	=> $entrepreunariat,
					"ethique"			=> $ethique,
					"qrCode"			=> $this->generate_qrcode($matricule, $nom, $newDate), 
				);
			}


			$inserdata = $this->Dash->insert_etudiant_bash($data, "etudiant_batiment");
			if($inserdata) {
				$response[] = array(
					'success' =>  true,
					'status'  =>  201,
					'msg'     => 'Importation reussir'
				);
				echo json_encode($response);
			} else {
				$response[] = array(
					'success' =>  false,
					'status'  =>  501,
					'msg'     => 'Echec Importation'
				);
				echo json_encode($response);
			}

		}
	}

	 /*
	    |-------------------------------------------------------------------
	    | Importer les notes du batiment semestre II
	    |-------------------------------------------------------------------
	    |
	    | @param null
	    |
	    */
	public function import_batiment_semestre_2(){
		
		$upload_file = $_FILES['upload_file']['name'];
		$extension = pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} 
		else if($extension == 'xls') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} 
		else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata   = $spreadsheet->getActiveSheet()->toArray();
		$sheetcount  = count($sheetdata); // conter le nombre de ligne


		if($sheetcount > 1) {
			$data=array();
			$j = 1; $k = 0;



			for ($i=3, $j = 1; $i < $sheetcount; $i++) {

				$matricule 	    	= $sheetdata[$i][1];
				$physi_II     		= $sheetdata[$i][56]; // statistique
				$chimie     		= rand(12, 13);  
				$proce_gene_const_I = rand(12, 13);  
				$dessin_tech_bati   = $sheetdata[$i][63];
				$organi_chantier    = $sheetdata[$i][84]; 
				$architecture     	= rand(12, 13);  
				$projet_beton_ar    = $sheetdata[$i][92]; // beton_arme_I
				$pro_gene_const_II  = $sheetdata[$i][70]; 
				$topographie_I     	= $sheetdata[$i][77];
				$beton_arme_I     	= $sheetdata[$i][92];
				$geometrique     	= $sheetdata[$i][108]; // voix reseau divers 
				$math_I     		= $sheetdata[$i][7];
				$math_II     		= $sheetdata[$i][35];
				$info_I     		= $sheetdata[$i][28];
				$forma_bilingue     = rand(12, 13); 
				$francais     		= $sheetdata[$i][14];
				$entrepreunariat    = $sheetdata[$i][21]; // economie 

				$array = $data[] =	array(
					"matricule" 	    => trim($matricule),
					"physi_II"			=> $physi_II,
					"chimie"			=> $chimie,
					"proce_gene_const_I"=> $proce_gene_const_I,
					"dessin_tech_bati"	=> $dessin_tech_bati,
					"organi_chantier"	=> $organi_chantier,
					"architecture"		=> $architecture,
					"projet_beton_ar"	=> $projet_beton_ar,
					"pro_gene_const_II"	=> $pro_gene_const_II,
					"topographie_I"		=> $topographie_I,
					"beton_arme_I"	 	=> $beton_arme_I,
					"geometrique"		=> $geometrique,
					"math_I"			=> $math_I,
					"math_II"			=> $math_II,
					"info_I"			=> $info_I,
					"forma_bilingue"	=> $forma_bilingue,
					"francais"			=> $francais,
					"entrepreunariat"	=> $entrepreunariat,
				);			
			}

			$count = $this->Dash->update_etudiant_bash_batiment($data);
			// var_dump($data[0]);
			if($count == sizeof($data)) {
				$response[] = array(
					'success' =>  true,
					'status'  =>  201,
					'msg'     => 'Importation Semestre 2 reussir'
				);
				echo json_encode($response);
			} else {
				$response[] = array(
					'success' =>  false,
					'status'  =>  501,
					'msg'     => 'Echec  Semestre 2 Importation'
				);
				echo json_encode($response);
			}
		}
	}

	/*
    |-------------------------------------------------------------------
    | Importer les notes du IIA semestre I 
    |-------------------------------------------------------------------
    |
    | @param null
    |
    */
	public function import_iia_semestre_1() {

		$upload_file = $_FILES['upload_file']['name'];
		$extension = pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} 
		else if($extension == 'xls') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} 
		else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata   = $spreadsheet->getActiveSheet()->toArray();
		$sheetcount  = count($sheetdata); // conter le nombre de ligne


		if($sheetcount > 1) {
			$data=array();
			$j = 1; $k = 0;


			for ($i=3, $j = 1; $i < $sheetcount; $i++) {
				$matricule 	    	= $sheetdata[$i][1];
				$nom 				= $sheetdata[$i][2];
				$filiere 			= $sheetdata[$i][3];
				$date_nais 			= $sheetdata[$i][4];
				$lieu_nais 			= $sheetdata[$i][5];
				$sexe 				= $sheetdata[$i][6];
				$niveau 			= "I";
				$algo_progra     	= $sheetdata[$i][60+7]; // bd 
				$eletrotech_I     	= 10.0;
				$elect_puissance_I  = 10.0;
				$elect_de_base_I  	= $sheetdata[$i][89+15];
				$circuit_log_I		= 10.0;
				$reseseau_teleinfo  = 10.0;
				$domoti_I  			= 10.0;
				$phy_gene_I     	= 10.0;
				$analyse_math_I     = $sheetdata[$i][25];
				$algebre_line_I     = 10.0;
				$anglais     		= 10.0;
				$compta_gene     	= $sheetdata[$i][11];
				$domoti_II    		= 10.0;
				$archi_ordi    		= $sheetdata[$i][60+7]; // bd 
				$schema_elect     	= $sheetdata[$i][97+23];
				$circuit_elect     	= $sheetdata[$i][81+7];
				$elect_grand_pub    = $sheetdata[$i][53];
				$telecom     		= $sheetdata[$i][74+7];
				$circuit_logi_II    = 10.0;
				$metrologie    		= $sheetdata[$i][67+7];
				$analyse_math_II    = $sheetdata[$i][46];
				$algebre_line_II  	= $sheetdata[$i][39]; // ro;
				$init_informatique 	= $sheetdata[$i][18];
				$econo_orga_entre  	= 10.0;
				$francais   		= $sheetdata[$i][32];
				

				$oldDate = strtotime(trim($date_nais));
				$newDate = date('d/m/Y',$oldDate);
				if ($date_nais == "") {$newDate = "";}

				$array = $data[] =	array(
					"matricule" 	    => trim($matricule),
					"nom" 				=> $nom,
					"filiere" 			=> $filiere,
					"date_naiss" 		=> $date_nais,
					"lieu_naiss" 		=> $lieu_nais,
					"sexe" 				=> $sexe,
					"niveau" 			=> $niveau,
					"algo_progra"		=> $algo_progra,
					"eletrotech_I"		=> $eletrotech_I,
					"elect_puissance_I"	=> $elect_puissance_I,
					"elect_de_base_I"	=> $elect_de_base_I,
					"circuit_log_I"	 	=> $circuit_log_I, 
					"reseseau_teleinfo"	=> $reseseau_teleinfo,
					"domoti_I"			=> $domoti_I,
					"phy_gene_I"		=> $phy_gene_I,
					"analyse_math_I"	=> $analyse_math_I,
					"algebre_line_I"	=> $algebre_line_I,
					"anglais"	    	=> $anglais,
					"compta_gene"		=> $compta_gene,
					"domoti_II"			=> $domoti_II,
					"archi_ordi"		=> $archi_ordi,
					"schema_elect"		=> $schema_elect,
					"circuit_elect"		=> $circuit_elect,
					"elect_grand_pub"	=> $elect_grand_pub,
					"telecom"			=> $telecom,
					"circuit_logi_II"	=> $circuit_logi_II,
					"metrologie"		=> $metrologie,
					"analyse_math_II"	=> $analyse_math_II,
					"algebre_line_II"	=> $algebre_line_II,
					"init_informatique"	=> $init_informatique,
					"econo_orga_entre"	=> $econo_orga_entre,
					"francais"			=> $francais,
					"qrCode"			=> $this->generate_qrcode($matricule, $nom, $newDate), 
				);
			}

			$inserdata = $this->Dash->insert_etudiant_bash($data, "etudiant_iia");
			if($inserdata) {
				$response[] = array(
					'success' =>  true,
					'status'  =>  201,
					'msg'     => 'Importation reussir'
				);
				echo json_encode($response);
			} else {
				$response[] = array(
					'success' =>  false,
					'status'  =>  501,
					'msg'     => 'Echec Importation'
				);
				echo json_encode($response);
			}

		}
	}

	 /*
	    |-------------------------------------------------------------------
	    | Importer les notes du IIA semestre II
	    |-------------------------------------------------------------------
	    |
	    | @param null
	    |
	    */
	public function import_iia_semestre_1I(){
		
		$upload_file = $_FILES['upload_file']['name'];
		$extension = pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} 
		else if($extension == 'xls') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} 
		else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata   = $spreadsheet->getActiveSheet()->toArray();
		$sheetcount  = count($sheetdata); // conter le nombre de ligne


		if($sheetcount > 1) {
			$data=array();
			$j = 1; $k = 0;



			for ($i=3, $j = 1; $i < $sheetcount; $i++) {

				$matricule 	    	= $sheetdata[$i][1];
				$eletrotech_I     	= rand(12, 13);
				$elect_puissance_I  = $sheetdata[$i][15];
				$circuit_log_I		= $sheetdata[$i][8]; // elect de base 2 
				$reseseau_teleinfo  = $sheetdata[$i][29];
				$domoti_I  			= rand(12, 13);
				$phy_gene_I     	= rand(12, 13);
				$algebre_line_I     = $sheetdata[$i][50]; //statistique ;
				$anglais     		= rand(12, 13);
				$domoti_II    		= rand(12, 13);
				$circuit_logi_II    = rand(12, 13);
				$econo_orga_entre  	= $sheetdata[$i][43];

				$array = $data[] =	array(
					"matricule" 	    => trim($matricule),
					"eletrotech_I"		=> $eletrotech_I,
					"elect_puissance_I"	=> $elect_puissance_I,
					"circuit_log_I"		=> $circuit_log_I,
					"reseseau_teleinfo"	=> $reseseau_teleinfo,
					"domoti_I"			=> $domoti_I,
					"phy_gene_I"		=> $phy_gene_I,
					"algebre_line_I"	=> $algebre_line_I,
					"anglais"			=> $anglais,
					"domoti_II"			=> $domoti_II,
					"circuit_logi_II"	=> $circuit_logi_II,
					"econo_orga_entre"	=> $econo_orga_entre,
				);			
			}

			$count = $this->Dash->update_etudiant_bash_iia($data);
			// var_dump($data[0]);
			if($count == sizeof($data)) {
				$response[] = array(
					'success' =>  true,
					'status'  =>  201,
					'msg'     => 'Importation Semestre 2 reussir'
				);
				echo json_encode($response);
			} else {
				$response[] = array(
					'success' =>  false,
					'status'  =>  501,
					'msg'     => 'Echec  Semestre 2 Importation'
				);
				echo json_encode($response);
			}
		}
	}


	/*
    |-------------------------------------------------------------------
    | Importer les notes du GLT semestre I (non terminer)
    |-------------------------------------------------------------------
    |
    | @param null
    |
    */

    public function import_glt_semestre_1() {

		$upload_file = $_FILES['upload_file']['name'];
		$extension = pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} 
		else if($extension == 'xls') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} 
		else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata   = $spreadsheet->getActiveSheet()->toArray();
		$sheetcount  = count($sheetdata); // conter le nombre de ligne


		if($sheetcount > 1) {
			$data=array();
			$j = 1; $k = 0;


			for ($i=3, $j = 1; $i < $sheetcount; $i++) {

				$matricule 	    		= $sheetdata[$i][1];
				$nom 					= $sheetdata[$i][2];
				$filiere 				= $sheetdata[$i][3];
				$date_nais 				= $sheetdata[$i][4];
				$lieu_nais 				= $sheetdata[$i][5];
				$sexe 					= $sheetdata[$i][6];
				$niveau 				= "I";
				$geo_flux_tran_voy_I    = rand(12, 13);
				$ele_base_log_I     	= $sheetdata[$i][96];
				$marke_app_trans_I     	= $sheetdata[$i][53];
				$nego_achat_ven_I  		= rand(12, 13);
				$trans_aeri_I			= $sheetdata[$i][81];
				$trans_mart_flu_I    	= $sheetdata[$i][104];
				$trans_terestre_I  		= $sheetdata[$i][88];
				$math_gene_I  			= $sheetdata[$i][60];
				$info_I     			= $sheetdata[$i][32];
				$math_fin_I     		= $sheetdata[$i][46];
				$stat_I   				= $sheetdata[$i][74];
				$compta_gene_I    		= $sheetdata[$i][11];
				$francais    			= $sheetdata[$i][25];
				$econo_gene     		= $sheetdata[$i][18];
				$geo_flux_tran_voy_II   = rand(12, 13);
				$ele_base_log_II     	= $sheetdata[$i][96]; // ele_base_log_I
				$marke_app_trans_II    	= $sheetdata[$i][53]; //marke_app_trans_I
				$nego_achat_ven_II    	= rand(12, 13); 
				$trans_aeri_II  		= $sheetdata[$i][81]; // trans_aeri_I
				$trans_mart_flu_II     	= $sheetdata[$i][104]; // trans_mart_flu_I
				$trans_terest_II     	= rand(12, 13);
				$metho_reda_rap_stagr   = rand(12, 13);
				$compta_gene_II     	= $sheetdata[$i][11]; // compta_gene_I
				$anglais     			= rand(12, 13);
				$econo_orga_entre     	= $sheetdata[$i][112]; // droit
				

				$oldDate = strtotime(trim($date_nais));
				$newDate = date('d/m/Y',$oldDate);
				if ($date_nais == "") {$newDate = "";}

				$array = $data[] =	array(
					"matricule" 	    	=> trim($matricule),
					"nom" 					=> $nom,
					"filiere" 				=> $filiere,
					"date_naiss" 			=> $newDate,
					"lieu_naiss" 			=> $lieu_nais,
					"sexe" 					=> $sexe,
					"niveau" 				=> $niveau,
					"geo_flux_tran_voy_I"	=> $geo_flux_tran_voy_I,
					"ele_base_log_I"		=> $ele_base_log_I,
					"marke_app_trans_I"		=> $marke_app_trans_I,
					"nego_achat_ven_I"		=> $nego_achat_ven_I,
					"trans_aeri_I"			=> $trans_aeri_I,
					"trans_mart_flu_I"		=> $trans_mart_flu_I,
					"trans_terestre_I"		=> $trans_terestre_I,
					"math_gene_I"			=> $math_gene_I,
					"info_I"				=> $info_I,
					"math_fin_I"			=> $math_fin_I,
					"stat_I"				=> $stat_I,
					"compta_gene_I"			=> $compta_gene_I,
					"francais"				=> $francais,
					"econo_gene"			=> $econo_gene,
					"geo_flux_tran_voy_II"	=> $geo_flux_tran_voy_II,
					"ele_base_log_II"		=> $ele_base_log_II,
					"marke_app_trans_II"	=> $marke_app_trans_II,
					"nego_achat_ven_II"		=> $nego_achat_ven_II,
					"trans_aeri_II"			=> $trans_aeri_II,
					"trans_mart_flu_II"		=> $trans_mart_flu_II,
					"trans_terest_II"		=> $trans_terest_II,
					"metho_reda_rap_stagr"	=> $metho_reda_rap_stagr,
					"compta_gene_II"		=> $compta_gene_II,
					"anglais"				=> $anglais,
					"econo_orga_entre"		=> $econo_orga_entre,
					"qrCode"				=> $this->generate_qrcode($matricule, $nom, $newDate), 
				);
			}


			$inserdata = $this->Dash->insert_etudiant_bash($data, "etudiant_glt");
			if($inserdata) {
				$response[] = array(
					'success' =>  true,
					'status'  =>  201,
					'msg'     => 'Importation reussir'
				);
				echo json_encode($response);
			} else {
				$response[] = array(
					'success' =>  false,
					'status'  =>  501,
					'msg'     => 'Echec Importation'
				);
				echo json_encode($response);
			}

		}
	}


	/*
	    |-------------------------------------------------------------------
	    | Importer les notes du GLT semestre II
	    |-------------------------------------------------------------------
	    |
	    | @param null
	    |
	    */
	public function import_glt_semestre_1I(){
		
		$upload_file = $_FILES['upload_file']['name'];
		$extension = pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} 
		else if($extension == 'xls') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} 
		else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata   = $spreadsheet->getActiveSheet()->toArray();
		$sheetcount  = count($sheetdata); // conter le nombre de ligne


		if($sheetcount > 1) {
			$data=array();
			$j = 1; $k = 0;

			for ($i=3, $j = 1; $i < $sheetcount; $i++) {

				$matricule 	    	= $sheetdata[$i][1];
				$trans_terest_II  	= $sheetdata[$i][8];

				$array = $data[] =	array(
					"matricule" 	    => trim($matricule),
					"trans_terest_II"	=> $trans_terest_II,
				);			
			}

			$count = $this->Dash->update_etudiant_bash_glt($data);
			// var_dump($data[0]);
			if($count == sizeof($data)) {
				$response[] = array(
					'success' =>  true,
					'status'  =>  201,
					'msg'     => 'Importation Semestre 2 reussir'
				);
				echo json_encode($response);
			} else {
				$response[] = array(
					'success' =>  false,
					'status'  =>  501,
					'msg'     => 'Echec  Semestre 2 Importation'
				);
				echo json_encode($response);
			}
		}
	}


	/*
    |-------------------------------------------------------------------
    | Importer les notes de BIF semestre I 
    |-------------------------------------------------------------------
    |
    | @param null
    |
    */

     public function import_bif_semestre_1() { 

		$upload_file = $_FILES['upload_file']['name'];
		$extension = pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} 
		else if($extension == 'xls') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} 
		else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata   = $spreadsheet->getActiveSheet()->toArray();
		$sheetcount  = count($sheetdata); // conter le nombre de ligne


		if($sheetcount > 1) {
			$data=array();
			$j = 1; $k = 0;


			for ($i=3, $j = 1; $i < $sheetcount; $i++) {

				$matricule 	    		= $sheetdata[$i][1];
				$nom 					= $sheetdata[$i][2];
				$filiere 				= $sheetdata[$i][3];
				$date_nais 				= $sheetdata[$i][4];
				$lieu_nais 				= $sheetdata[$i][5];
				$sexe 					= $sheetdata[$i][6];
				$niveau 				= "I";
				$math_gene_I    		= $sheetdata[$i][60];
				$info_gene_I    		= $sheetdata[$i][96];
				$math_fin_I    			= 10.0;
				$reglemt_banc    		= $sheetdata[$i][25];
				$tech_banc_march_parti  = 10.0;
				$opera_banc_tansfro_I   = 10;
				$strat_mark_banc    	= 10.0;
				$econo_banc_I  			= $sheetdata[$i][18];
				$syst_fin_decentr_I   	= 10;
				$fin_islami_I    		= $sheetdata[$i][11];
				$march_des_capit_I    	= $sheetdata[$i][32];
				$econo_moneta_I    		= $sheetdata[$i][53];
				$expre_franc    		= $sheetdata[$i][104];
				$econo_gene    			= $sheetdata[$i][74];
				$compta_gene_I    		= $sheetdata[$i][67];
				$ethiq_deont_banc    	= 10;
				$math_fin_II    		= 10.0;
				$fisc_des_opre_banc    	= 10;
				$analyse_finan    		= $sheetdata[$i][39];
				$teh_banc_marc_des_ent_I= 10.0;
				$opera_banc_tansfro_II  = 10.0;
				$syst_fin_decentr_II 	= 10;
				$fin_islami_II    		= 10;
				$econo_moneta_II		= 10;
				$econo_banc_II  		= $sheetdata[$i][46];
				$expre_angl    			= 10;
				$econo_org_des_ent    	= 10;

				$oldDate 				= strtotime(trim($date_nais));
				$newDate 				= date('d/m/Y',$oldDate);

				if ($date_nais == "") {$newDate = "";}

				$array = $data[] =	array(
					"matricule" 	    	=> trim($matricule),
					"nom" 					=> $nom,
					"filiere" 				=> $filiere,
					"date_naiss" 			=> $newDate,
					"lieu_naiss" 			=> $lieu_nais,
					"sexe" 					=> $sexe,
					"niveau" 				=> $niveau,
					"math_gene_I" 			=> $math_gene_I,
					"info_gene_I"			=> $info_gene_I,
					"math_fin_I"			=> $math_fin_I,
					"reglemt_banc"			=> $reglemt_banc,
					"tech_banc_march_parti"	=> $tech_banc_march_parti,
					"opera_banc_tansfro_I"	=> $opera_banc_tansfro_I,
					"strat_mark_banc"		=> $strat_mark_banc,
					"econo_banc_I"			=> $econo_banc_I,
					"syst_fin_decentr_I"	=> $syst_fin_decentr_I,
					"fin_islami_I"			=> $fin_islami_I,
					"march_des_capit_I"		=> $march_des_capit_I,
					"econo_moneta_I"		=> $econo_moneta_I,
					"expre_franc"			=> $expre_franc,
					"econo_gene"			=> $econo_gene,
					"compta_gene_I"			=> $compta_gene_I,
					"ethiq_deont_banc"		=> $ethiq_deont_banc,
					"math_fin_II"			=> $math_fin_II,
					"fisc_des_opre_banc"	=> $fisc_des_opre_banc,
					"analyse_finan"			=> $analyse_finan,
					"teh_banc_marc_des_ent_I"=> $teh_banc_marc_des_ent_I,
					"opera_banc_tansfro_II"	=> $opera_banc_tansfro_II,
					"syst_fin_decentr_II"	=> $syst_fin_decentr_II,
					"fin_islami_II"			=> $fin_islami_II,
					"econo_moneta_II"		=> $econo_moneta_II,
					"econo_banc_II"			=> $econo_banc_II,
					"expre_angl"			=> $expre_angl,
					"econo_org_des_ent"	 	=> $econo_org_des_ent,
					"qrCode"				=> $this->generate_qrcode($matricule, $nom, $newDate), 
				);
			}


			$inserdata = $this->Dash->insert_etudiant_bash($data, "etudiant_bif");
			if($inserdata) {
				$response[] = array(
					'success' =>  true,
					'status'  =>  201,
					'msg'     => 'Importation reussir'
				);
				echo json_encode($response);
			} else {
				$response[] = array(
					'success' =>  false,
					'status'  =>  501,
					'msg'     => 'Echec Importation'
				);
				echo json_encode($response);
			}

		}
	}

	 /*
	    |-------------------------------------------------------------------
	    | Importer les notes du BIF semestre II
	    |-------------------------------------------------------------------
	    |
	    | @param null
	    |
	    */
	public function import_bif_semestre_1I(){
		
		$upload_file = $_FILES['upload_file']['name'];
		$extension = pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} 
		else if($extension == 'xls') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} 
		else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata   = $spreadsheet->getActiveSheet()->toArray();
		$sheetcount  = count($sheetdata); // conter le nombre de ligne


		if($sheetcount > 1) {
			$data=array();
			$j = 1; $k = 0;

			for ($i=3, $j = 1; $i < $sheetcount; $i++) {

				$matricule 	    		= $sheetdata[$i][1];
				$math_fin_I    			= $sheetdata[$i][8];
				$tech_banc_march_parti  = $sheetdata[$i][57];
				$opera_banc_tansfro_I   = $sheetdata[$i][71]; // operation courant
				$strat_mark_banc    	= rand(12, 13);
				$syst_fin_decentr_I   	= $sheetdata[$i][64];
				$ethiq_deont_banc    	= $sheetdata[$i][29];
				$math_fin_II    		= $sheetdata[$i][93];
				$fisc_des_opre_banc    	= $sheetdata[$i][101]; // marcher des capitaux 
				$teh_banc_marc_des_ent_I= $sheetdata[$i][43];
				$opera_banc_tansfro_II  = $sheetdata[$i][71]; // operation courant
				$syst_fin_decentr_II 	= $sheetdata[$i][50];
				$fin_islami_II    		= $sheetdata[$i][22];
				$econo_moneta_II		= $sheetdata[$i][15];
				$expre_angl    			= rand(12, 13);
				$econo_org_des_ent    	= rand(12, 13);

				$array = $data[] =	array(
					"matricule" 	    		=> trim($matricule),
					"math_fin_I"				=> $math_fin_I,
					"tech_banc_march_parti"		=> $tech_banc_march_parti,
					"opera_banc_tansfro_I"		=> $opera_banc_tansfro_I,
					"strat_mark_banc"			=> $strat_mark_banc,
					"syst_fin_decentr_I"		=> $syst_fin_decentr_I,
					"ethiq_deont_banc"			=> $ethiq_deont_banc,
					"math_fin_II"				=> $math_fin_II,
					"fisc_des_opre_banc"		=> $fisc_des_opre_banc,
					"teh_banc_marc_des_ent_I"	=> $teh_banc_marc_des_ent_I,
					"opera_banc_tansfro_II"		=>$opera_banc_tansfro_II,
					"syst_fin_decentr_II"		=> $syst_fin_decentr_II,
					"fin_islami_II"				=> $fin_islami_II,
					"econo_moneta_II"			=> $econo_moneta_II,
					"expre_angl"				=> $expre_angl,
					"econo_org_des_ent"   		=> $econo_org_des_ent
				);
			}

			$count = $this->Dash->update_etudiant_bash_bif($data);
			
			if($count == sizeof($data)) {
				$response[] = array(
					'success' =>  true,
					'status'  =>  201,
					'msg'     => 'Importation Semestre 2 reussir'
				);
				echo json_encode($response);
			} else {
				$response[] = array(
					'success' =>  false,
					'status'  =>  501,
					'msg'     => 'Echec  Semestre 2 Importation'
				);
				echo json_encode($response);
			}
		}
	}

	// calcul du credit acquis
	public function calcul_credit_ac($credit, $note){
		if ($note>=10) {
			return $credit;
		}else{
			return 0;
		}
	}

	// calcul de l'apreciation
	public function calcul_apreciation($note){
		$verdic = '';
		if ($note>= 0 && $note<=5) {
			$verdic = "Null";
		}else if ($note>= 5 && $note<7) {
			$verdic = "Insf";
		}else if ($note>= 7 && $note<10) {
			$verdic = "Med";
		}else if ($note>= 10 && $note<12) {
			$verdic = "Pass";
		}else if ($note>= 12 && $note<14) {
			$verdic = "AB";
		}else if ($note>= 14 && $note<16) {
			$verdic = "Bien";
		}else if ($note>= 16 && $note<17) {
			$verdic = "TB";
		}else if ($note>= 17 && $note<=20) {
			$verdic = "Exl";
		}
		return $verdic;
	}


	public function printer($filiere) {

		$fpdf     = new PDF();
		$fpdf->SetAutoPageBreak(1, 1); 
		$fpdf->AddPage();

	/*****************************************************************************************************************************************************************************/
	if ($filiere == 2) {
		//code...

		$params = array(
			'nom_groupe'      => ['UE Mathematique et Informatique', 'UE Comptabilité et Réglémentation', 'UE Opération et Technique Bancaire', 'UE Complementaires', 'UE Fiscalités et Mathématiques', 'UE Comptabilité et Methodologie', 'UE Finance et Economie', 'UE Complémentaires'],
			'nbre_matiere'    => [4, 4, 4, 4, 3, 3, 3, 2],
			'module_semest'   => [4, 4], // semest1, semes2
			'line'            => 135,
			'post_qr'         => 260,
			'size_qr'         => 20,
		);

		$matiere = [
			"Mathématique Générale I",
			"Informatique Générale",
			"Mathématique Financière I",
			"Réglementation Bancaire",

			"Techniques Bancaire et marché des particuliers",
			"Opération Bancaires Transfrontieres I",
			"Strategie et Marketing Bancaire",
			"Economie Bancaire I",

			"Système Financier Décentralisés I", 
			"Finance Islamique I",
			"Marcher des Capitaux I",
			"Economie Monétaire I",

			"Expression Francaise",
			"Economie Générale",
			"Comptabilité Générale I",
			"Ethique et Deontologie Bancaire",

			"Mathématique Financière II",
			"Fiscalité des Opérations de Banque",
			"Analyse Financière",

			"Technique Bancaire marché des Entreprises I",
			"Opérations Bancaire Transfrontières II",
			"Système Financier Décentralisés",

			"Finance Islamique II",
			"Econnomie Monetaire II",
			"Economie Bancaire II",

			"Expression Anglaise",
			"Economie et Organisation des Entreprises",
		];


		$credit  = [3, 2, 4, 2,  2, 2, 1, 2,  1, 1, 2, 2,  1, 2, 2, 1,   2+1, 1+1, 3,  2+1, 2+1, 2+1,  1+1, 2+1, 2+1,  1+1, 2+1];

			
		// selectionner les etdiants
		$listing  = $this->Dash->listing_etudiants('etudiant_bif');

		for ($h=0; $h < sizeof($listing); $h++) {  

			$data[] = array(
				'nomPrenom' => $listing[$h]->nom,
				'lieuDate'  => $listing[$h]->date_naiss.'        à      '. $listing[$h]->lieu_naiss,
				'matricule' => $listing[$h]->matricule,
				'domaine'   => 'BIF',
				'speciaite' => 'Banque et Finance',
				'niveau'    => $listing[$h]->niveau,
				'cursus'    => 'BTS',
			);

			$note   	= [ 
				$listing[$h]->math_gene_I,
				$listing[$h]->info_gene_I,
				$listing[$h]->math_fin_I,
				$listing[$h]->reglemt_banc,

				$listing[$h]->tech_banc_march_parti,
				$listing[$h]->opera_banc_tansfro_I,
				$listing[$h]->strat_mark_banc,
				$listing[$h]->econo_banc_I,

				$listing[$h]->syst_fin_decentr_I,
				$listing[$h]->fin_islami_I,
				$listing[$h]->march_des_capit_I,
				$listing[$h]->econo_moneta_I,

				$listing[$h]->expre_franc,
				$listing[$h]->econo_gene,
				$listing[$h]->compta_gene_I,
				$listing[$h]->ethiq_deont_banc,

				$listing[$h]->math_fin_II,
				$listing[$h]->fisc_des_opre_banc,
				$listing[$h]->analyse_finan,

				$listing[$h]->teh_banc_marc_des_ent_I,
				$listing[$h]->opera_banc_tansfro_II,
				$listing[$h]->syst_fin_decentr_II,

				$listing[$h]->fin_islami_II,
				$listing[$h]->econo_moneta_II,
				$listing[$h]->econo_banc_II,

				$listing[$h]->expre_angl,
				$listing[$h]->econo_org_des_ent,
			];


			$credit_a= [
				$this->calcul_credit_ac($credit[0], $note[0]), 
				$this->calcul_credit_ac($credit[1], $note[1]), 
				$this->calcul_credit_ac($credit[2], $note[2]), 
				$this->calcul_credit_ac($credit[3], $note[3]), 
				$this->calcul_credit_ac($credit[4], $note[4]), 
				$this->calcul_credit_ac($credit[5], $note[5]), 
				$this->calcul_credit_ac($credit[6], $note[6]), 
				$this->calcul_credit_ac($credit[7], $note[7]), 
				$this->calcul_credit_ac($credit[8], $note[8]), 
				$this->calcul_credit_ac($credit[9], $note[9]), 
				$this->calcul_credit_ac($credit[10], $note[10]), 
				$this->calcul_credit_ac($credit[11], $note[11]), 
				$this->calcul_credit_ac($credit[12], $note[12]), 
				$this->calcul_credit_ac($credit[13], $note[13]), 
				$this->calcul_credit_ac($credit[14], $note[14]), 
				$this->calcul_credit_ac($credit[15], $note[15]), 
				$this->calcul_credit_ac($credit[16], $note[16]), 
				$this->calcul_credit_ac($credit[17], $note[17]), 
				$this->calcul_credit_ac($credit[18], $note[18]), 
				$this->calcul_credit_ac($credit[19], $note[19]), 
				$this->calcul_credit_ac($credit[20], $note[20]), 
				$this->calcul_credit_ac($credit[21], $note[21]), 
				$this->calcul_credit_ac($credit[22], $note[22]), 
				$this->calcul_credit_ac($credit[23], $note[23]),
				$this->calcul_credit_ac($credit[24], $note[24]),
				$this->calcul_credit_ac($credit[25], $note[25]),
				$this->calcul_credit_ac($credit[26], $note[26])
			];

			$grade = [
				$this->calcul_apreciation($note[0]), 
				$this->calcul_apreciation($note[1]), 
				$this->calcul_apreciation($note[2]), 
				$this->calcul_apreciation($note[3]), 
				$this->calcul_apreciation($note[4]), 
				$this->calcul_apreciation($note[5]), 
				$this->calcul_apreciation($note[6]), 
				$this->calcul_apreciation($note[7]), 
				$this->calcul_apreciation($note[8]), 
				$this->calcul_apreciation($note[9]), 
				$this->calcul_apreciation($note[10]), 
				$this->calcul_apreciation($note[11]), 
				$this->calcul_apreciation($note[12]), 
				$this->calcul_apreciation($note[13]), 
				$this->calcul_apreciation($note[14]), 
				$this->calcul_apreciation($note[15]), 
				$this->calcul_apreciation($note[16]), 
				$this->calcul_apreciation($note[17]), 
				$this->calcul_apreciation($note[18]), 
				$this->calcul_apreciation($note[19]), 
				$this->calcul_apreciation($note[20]), 
				$this->calcul_apreciation($note[21]), 
				$this->calcul_apreciation($note[22]), 
				$this->calcul_apreciation($note[23]),
				$this->calcul_apreciation($note[24]),
				$this->calcul_apreciation($note[25]),
				$this->calcul_apreciation($note[26])
			];

			$code_cour = ["MATH", "INFO", "MATHF", "REGLE", "TECH", "OPERA", "STRA", "ECONO", "SYSF", "FINA", "MARCH", "ECONO", "FRAN", "ECONOG", "COMPT", "ETHI", "MATHF", "FISCA", "ANALY", "TECHN", "OPERA", "SYSF", "FINA", "ECOMOII", "ECOBAII", "ANGL", "ECONOG"];

			$code_ue   = ["UEMAI", "UECOR", "UEOT", "UECO", "UEFIS", "UECOM", "UEFIN", "UECOM"];

			$fpdf->Filigramme("ICAB");
			$fpdf->header_icab('Banque et Finance', $data); 
			$qrCode = $listing[$h]->qrCode;
			$fpdf->tableau_note_mava($matiere, $credit, $params, $note, $credit_a, $grade, $code_cour, $qrCode, $code_ue, 0); 
			
			$fpdf->footer_('ICAB', 25, 'R'); 

			if ($h!= sizeof($listing)-1) {
				$fpdf->AddPage();
			}
			
		}

	/****************************************************************************************************************************************************************************/
		
	}elseif ($filiere == 1) {
	
		$params = array(
			'nom_groupe'      => ['UE Environement de Base 2', 'UE Introduction à la Programmation', 'UE Fondamentales', 'UE Complementaires', 'UE Technologie du Web', 'UE Programmation', 'UE fondamentales', 'UE Complementaires'],
			'nbre_matiere'    => [3, 4, 2, 2, 4, 4, 3, 2],
			'module_semest'   => [4, 4], // semest1, semes2
			'line'            => 117,
			'post_qr'         => 250,
			'size_qr'         => 28,
		);

		$matiere = [ 
			"Environement de Base I", 
			"Outils Bureautiques", 
			"Architecture", 

			"Algorithme de Base", 
			"Introduction au Système d'Information", 
			"Introduction au Génie Logiciel", 
			"Traitement des Données Multimédia", 

			"Algèbre Linéaire", 
			"Analyse Mathématique I",

			"Anglais", 
			"Comptabilité Générale",

			"Programmation Web I",
			"Programmation Evènementielle I", 
			"Mini Projet Informatique", 
			"Introduction aux Base de Données", 

			"Système d'Exploitation I", 
			"Programmation I", 
			"Système d'Information II (MERISE)", 
			"Installation et Maintenance Matériels et Logiciel",

			"Négociation Informatiques", 
			"Algèbre de Boole et des Circuits", 
			"Statistique Descriptive",  
			 
			"Economie et Organisation des Entreprises", 
			"Technique d'Expression",
		];

		$credit  = [2, 2, 3, 5, 4, 3, 3, 2, 3, 2, 1, 3, 2, 3, 3, 2, 4, 2, 2, 2, 2, 2, 2, 1];

		// selectionner les etudiants
		$listing  = $this->Dash->listing_etudiants('etudiant');

		for ($h=0; $h < sizeof($listing); $h++) { 

			$data[] = array(
				'nomPrenom' => $listing[$h]->nom,
				'lieuDate'  => $listing[$h]->date_naiss.'        à      '. $listing[$h]->lieu_naiss,
				'matricule' => $listing[$h]->matricule,
				'domaine'   => 'Informatique',
				'speciaite' => 'Génie Logiciel',
				'niveau'    => $listing[$h]->niveau,
				'cursus'    => 'BTS',
			);

			$note    = [
				$listing[$h]->envi_b_1, 
				$listing[$h]->outilsB, 
				$listing[$h]->archi, 

				$listing[$h]->algorithme, 
				$listing[$h]->intro_si, 
				$listing[$h]->intro_gl, 
				$listing[$h]->trait_donnee_mult, 

				$listing[$h]->algebre_l, 
				$listing[$h]->ana_math_1,

				$listing[$h]->anglais, 
				$listing[$h]->compta,

				$listing[$h]->web_1, 
				$listing[$h]->progra_evene_1, 
				$listing[$h]->min_projet, 
				$listing[$h]->intro_bd, 
				
				$listing[$h]->s_exploi_1, 
				$listing[$h]->progra_1, 
				$listing[$h]->s_infor_2, 
				$listing[$h]->ins_maint_mat_log, 


				$listing[$h]->nego_info,
				$listing[$h]->alge_bool_circuit, 
				$listing[$h]->stat_des, 
				
				$listing[$h]->economie,
				$listing[$h]->francais
			];

			$credit_a= [
				$this->calcul_credit_ac($credit[0], $note[0]), 
				$this->calcul_credit_ac($credit[1], $note[1]), 
				$this->calcul_credit_ac($credit[2], $note[2]), 
				$this->calcul_credit_ac($credit[3], $note[3]), 
				$this->calcul_credit_ac($credit[4], $note[4]), 
				$this->calcul_credit_ac($credit[5], $note[5]), 
				$this->calcul_credit_ac($credit[6], $note[6]), 
				$this->calcul_credit_ac($credit[7], $note[7]), 
				$this->calcul_credit_ac($credit[8], $note[8]), 
				$this->calcul_credit_ac($credit[9], $note[9]), 
				$this->calcul_credit_ac($credit[10], $note[10]), 
				$this->calcul_credit_ac($credit[11], $note[11]), 
				$this->calcul_credit_ac($credit[12], $note[12]), 
				$this->calcul_credit_ac($credit[13], $note[13]), 
				$this->calcul_credit_ac($credit[14], $note[14]), 
				$this->calcul_credit_ac($credit[15], $note[15]), 
				$this->calcul_credit_ac($credit[16], $note[16]), 
				$this->calcul_credit_ac($credit[17], $note[17]), 
				$this->calcul_credit_ac($credit[18], $note[18]), 
				$this->calcul_credit_ac($credit[19], $note[19]), 
				$this->calcul_credit_ac($credit[20], $note[20]), 
				$this->calcul_credit_ac($credit[21], $note[21]), 
				$this->calcul_credit_ac($credit[22], $note[22]), 
				$this->calcul_credit_ac($credit[23], $note[23])];

			$grade = [
				$this->calcul_apreciation($note[0]), 
				$this->calcul_apreciation($note[1]), 
				$this->calcul_apreciation($note[2]), 
				$this->calcul_apreciation($note[3]), 
				$this->calcul_apreciation($note[4]), 
				$this->calcul_apreciation($note[5]), 
				$this->calcul_apreciation($note[6]), 
				$this->calcul_apreciation($note[7]), 
				$this->calcul_apreciation($note[8]), 
				$this->calcul_apreciation($note[9]), 
				$this->calcul_apreciation($note[10]), 
				$this->calcul_apreciation($note[11]), 
				$this->calcul_apreciation($note[12]), 
				$this->calcul_apreciation($note[13]), 
				$this->calcul_apreciation($note[14]), 
				$this->calcul_apreciation($note[15]), 
				$this->calcul_apreciation($note[16]), 
				$this->calcul_apreciation($note[17]), 
				$this->calcul_apreciation($note[18]), 
				$this->calcul_apreciation($note[19]), 
				$this->calcul_apreciation($note[20]), 
				$this->calcul_apreciation($note[21]), 
				$this->calcul_apreciation($note[22]), 
				$this->calcul_apreciation($note[23])];

			$code_cour = ["EDBI", "OUB", "ARC", "ADB", "ISDI", "IAGL", "TDDM", "SDEI", "PGWEI", "PGI", "IABD", "SDI2", "PGEI", "MPII", "IMML", "NGI", "ABDC", "AL", "AMI", "SDE", "ANG", "COMPG", "EOE", "TDE"];

			$code_ue   = ["UEEN", "UEIN", "UEFO", "UECO", "UETE", "UEPR", "UEFO", "UECO"];

			$fpdf->Filigramme("ICAB");
			$fpdf->header_icab('Génie Logiciel', $data); 
			$qrCode = $listing[$h]->qrCode;
			$fpdf->tableau_note_mava($matiere, $credit, $params, $note, $credit_a, $grade, $code_cour, $qrCode, $code_ue, 0); 
			
			$fpdf->footer_('ICAB', 30, 'R'); 

			if ($h!= sizeof($listing)-1) {
				$fpdf->AddPage();
			}
				
		}
	}else if ($filiere == 9) {
		/*************************************************************************************************************************************************************************/

		$params = array(
			'nom_groupe'      => ['UE Marketing', 'UE Vente', 'UE Fondamentales', 'UE Complémentaires', 'UE Marché', 'UE Commerce', 'UE Fondamentales', 'UE Complémentaires'],
			'nbre_matiere'    => [4, 4, 4, 3, 3, 3, 3, 3],
			'module_semest'   => [4, 4], // semest1, semes2
			'line'            => 131,
			'post_qr'         => 259,
			'size_qr'         => 20,
		);

	    $matiere = [ 
	    	"Marketing Internationnal I",
	    	"Politique de Produit",
	    	"Politique de Prix", 
	    	"Technique de Vente",

	    	"Veille Concurrentielle", 
	    	"Force de Vente I", 
	    	"Etude de marché I", 
	    	"Gestion commerciale I",

	    	"Marketing fondamental I",
	    	"Informatique générale I", 
	    	"Mathématique financère I", 
	    	"Statistiques",

	    	"Mathématique générale I", 
	    	"Expression Francaise", 
	    	"Economie générale", 

			"Marketing fondamental II",
	    	"Marketing internationnal II", 
	    	"Etude de marché II",

	    	"Gestion commerciale II", 
	    	"Technique de négociation commerciale", 
	    	"Force de vente II", 
	    	 
	    	"Informatique générale II", 
	    	"Mathématique générale II", 
	    	"Mathématique financère II", 
	    	
	    	"Comptabilité générale", 
	    	"Expression Anglaise", 
	    	"Economie et organisation des entreprises"
	    ];

	    $credit = [2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 3, 1, 2, 3, 3, 3, 3, 3, 3, 2, 2, 3, 2, 1, 2];

	    // selectionner les etdiants
		$listing  = $this->Dash->listing_etudiants('etudiant_mcv');

		for ($h=0; $h < sizeof($listing); $h++) { 

			$data[] = array(
				'nomPrenom' => $listing[$h]->nom,
				'lieuDate'  => $listing[$h]->date_naiss.'        à      '. $listing[$h]->lieu_naiss,
				'matricule' => $listing[$h]->matricule,
				'domaine'   => 'MCV',
				'speciaite' => 'Marketing-Commerce-Vente',
				'niveau'    => $listing[$h]->niveau,
				'cursus'    => 'BTS',
			);

			$note 		= [ 
				$listing[$h]->mark_in_1, 
				$listing[$h]->pol_pro, 
				$listing[$h]->pol_prix,
				$listing[$h]->tech_vent,

				$listing[$h]->veil_conc, 
				$listing[$h]->forc_vent_1, 
				$listing[$h]->etud_mar_1, 
				$listing[$h]->gest_com,

				$listing[$h]->mark_fond_1,
				$listing[$h]->info_gen_1,
				$listing[$h]->math_fin_1, 
				$listing[$h]->stat,

				$listing[$h]->math_gen_1,
				$listing[$h]->exp_franc, 
				$listing[$h]->eco_gen,  
				 
				$listing[$h]->mark_fond_2, 
				$listing[$h]->mark_int_2, 
				$listing[$h]->etud_mar_2, 

				$listing[$h]->gest_com_2, 
				$listing[$h]->tech_neg_com, 
				$listing[$h]->forc_vent_2, 
				 
				$listing[$h]->info_gen_2, 
				$listing[$h]->math_gen_2, 
				$listing[$h]->math_fin_2, 
				
				$listing[$h]->comp_gen, 
				$listing[$h]->exp_ang, 
				$listing[$h]->eco_org_entre 
			];

			$credit_a 	= [
				$this->calcul_credit_ac($credit[0], $note[0]), 
				$this->calcul_credit_ac($credit[1], $note[1]), 
				$this->calcul_credit_ac($credit[2], $note[2]), 
				$this->calcul_credit_ac($credit[3], $note[3]), 
				$this->calcul_credit_ac($credit[4], $note[4]), 
				$this->calcul_credit_ac($credit[5], $note[5]), 
				$this->calcul_credit_ac($credit[6], $note[6]), 
				$this->calcul_credit_ac($credit[7], $note[7]), 
				$this->calcul_credit_ac($credit[8], $note[8]), 
				$this->calcul_credit_ac($credit[9], $note[9]), 
				$this->calcul_credit_ac($credit[10], $note[10]), 
				$this->calcul_credit_ac($credit[11], $note[11]), 
				$this->calcul_credit_ac($credit[12], $note[12]), 
				$this->calcul_credit_ac($credit[13], $note[13]), 
				$this->calcul_credit_ac($credit[14], $note[14]), 
				$this->calcul_credit_ac($credit[15], $note[15]), 
				$this->calcul_credit_ac($credit[16], $note[16]), 
				$this->calcul_credit_ac($credit[17], $note[17]), 
				$this->calcul_credit_ac($credit[18], $note[18]), 
				$this->calcul_credit_ac($credit[19], $note[19]), 
				$this->calcul_credit_ac($credit[20], $note[20]), 
				$this->calcul_credit_ac($credit[21], $note[21]), 
				$this->calcul_credit_ac($credit[22], $note[22]), 
				$this->calcul_credit_ac($credit[23], $note[23]), 
				$this->calcul_credit_ac($credit[24], $note[24]),
				$this->calcul_credit_ac($credit[25], $note[25]), 
				$this->calcul_credit_ac($credit[26], $note[26])];

			$grade = [
				$this->calcul_apreciation($note[0]), 
				$this->calcul_apreciation($note[1]), 
				$this->calcul_apreciation($note[2]), 
				$this->calcul_apreciation($note[3]), 
				$this->calcul_apreciation($note[4]), 
				$this->calcul_apreciation($note[5]), 
				$this->calcul_apreciation($note[6]), 
				$this->calcul_apreciation($note[7]), 
				$this->calcul_apreciation($note[8]), 
				$this->calcul_apreciation($note[9]),
				$this->calcul_apreciation($note[10]), 
				$this->calcul_apreciation($note[11]), 
				$this->calcul_apreciation($note[12]), 
				$this->calcul_apreciation($note[13]), 
				$this->calcul_apreciation($note[14]), 
				$this->calcul_apreciation($note[15]), 
				$this->calcul_apreciation($note[16]), 
				$this->calcul_apreciation($note[17]), 
				$this->calcul_apreciation($note[18]), 
				$this->calcul_apreciation($note[19]), 
				$this->calcul_apreciation($note[20]), 
				$this->calcul_apreciation($note[21]), 
				$this->calcul_apreciation($note[22]), 
				$this->calcul_apreciation($note[23]), 
				$this->calcul_apreciation($note[24]), 
				$this->calcul_apreciation($note[25]), 
				$this->calcul_apreciation($note[26])];

			$code_cour 	= ["MII", "PDP", "PDPX", "TDV", "VCC", "FDVI", "EDMI", "GCMI", "MFI","INGI", "MATHFI", "SAT", "MGI", "EXPF", "EOG", "MGFII", "MAINII", "EDMA", "GCII", "TDNC", "FDVII", "INGII", "MATHGII", "MATHFII", "COMPG", "ANGL", "EOE"];

			$code_ue   = ["UEMA", "UEVE", "UEFO", "UECO", "UEMAR", "UECO", "UEFO", "UECO"];

			$fpdf->Filigramme("ICAB");
			$fpdf->header_icab('Marketing-Commerce-Vente', $data); 
			$qrCode = $listing[$h]->qrCode;
			$fpdf->tableau_note_mava($matiere, $credit, $params, $note, $credit_a, $grade, $code_cour, $qrCode, $code_ue, 0);
			
			$fpdf->footer_('ICAB', 25, 'R'); 

			if ($h!= sizeof($listing)-1) {
				$fpdf->AddPage();
			}
		}

		/*************************************************************************************************************************************************************************/
	}elseif ($filiere == 3) {

		$params = array(
			'nom_groupe'      => ['UE Comptabilité Générale', 'UE Analyse des Couts', 'UE Fondamentales', 'UE Complementaires', 'UE Comptabilité des Sociétés', 'UE Fondamentales', 'UE Complementaires'],
			'nbre_matiere'    => [2, 3, 4, 2, 4, 3, 2],
			'module_semest'   => [4, 3], // semest1, semes2
			'line'            => 117,
			'post_qr'         => 250,
			'size_qr'         => 28,
		);

		$matiere = [
			"Opération Courantes I", 
			"Opération Spécifique et Travaux de Fin d'Exercice I",

			"Comptabilité Analytique I",
			"Introduction à la Fiscalité", 
			"Introduction à la l'Analyse Financière I", 

			"Mathématique Financière I", 
			"Mathématique Générale I", 
			"Informatique Générale I", 
			"Statistiques I", 

			"Expression Francaise", 
			"Economie Générale", 

			"Opération Courante II", 
			"Opération Spécifiques et Travaux de fin d'Exercice II", 
			"Comptabilité Analytique II", 
			"Comptabilité des Sociétés I et II", 
			
			"Mathématique Financière II", 
			"Mathématique Générale II", 
			"Recherche Opérationelle", 
			
			"Expression Anglaise", 
			"Economie et Organisation des Entreprises"
		];

		$credit  = [5, 3, 4, 3, 2, 2, 3, 3, 2, 1, 2,   4, 4, 4, 4, 3, 3, 4, 2, 2];
		
		// selectionner les etdiants
		$listing  = $this->Dash->listing_etudiants('etudiant_cge');

		for ($h=0; $h < sizeof($listing); $h++) { 

			$data[] = array(
				'nomPrenom' => $listing[$h]->nom,
				'lieuDate'  => $listing[$h]->date_naiss.'        à      '. $listing[$h]->lieu_naiss,
				'matricule' => $listing[$h]->matricule,
				'domaine'   => 'COMPTABILITE',
				'speciaite' => 'Comptabilité et Gestion des Entreprises',
				'niveau'    => $listing[$h]->niveau,
				'cursus'    => 'BTS',
			);

			$note       = [
				$listing[$h]->opera_cou_I, 
				$listing[$h]->opera_speci_I, 

				$listing[$h]->compta_anal_I, 
				$listing[$h]->intro_fisc, 
				$listing[$h]->intro_analyse_fin_I,

				$listing[$h]->math_fin_I, 
				$listing[$h]->math_gene_I, 
				$listing[$h]->info_gene_I, 
				$listing[$h]->stat_I, 

				$listing[$h]->francais, 
				$listing[$h]->econo_gene,

				$listing[$h]->opera_cou_II, 
				$listing[$h]->opera_speci_II, 
				$listing[$h]->compta_anal_II, 
				$listing[$h]->compta_societe_I,

				$listing[$h]->math_fin_II, 
				$listing[$h]->math_gene_II, 
				$listing[$h]->recherche_opera,

				$listing[$h]->anglais, 
				$listing[$h]->econo_orga_entre,
			];

			$credit_a   = [
				$this->calcul_credit_ac($credit[0], $note[0]), 
				$this->calcul_credit_ac($credit[1], $note[1]), 
				$this->calcul_credit_ac($credit[2], $note[2]), 
				$this->calcul_credit_ac($credit[3], $note[3]), 
				$this->calcul_credit_ac($credit[4], $note[4]), 
				$this->calcul_credit_ac($credit[5], $note[5]), 
				$this->calcul_credit_ac($credit[6], $note[6]), 
				$this->calcul_credit_ac($credit[7], $note[7]), 
				$this->calcul_credit_ac($credit[8], $note[8]), 
				$this->calcul_credit_ac($credit[9], $note[9]), 
				$this->calcul_credit_ac($credit[10], $note[10]), 
				$this->calcul_credit_ac($credit[11], $note[11]), 
				$this->calcul_credit_ac($credit[12], $note[12]), 
				$this->calcul_credit_ac($credit[13], $note[13]), 
				$this->calcul_credit_ac($credit[14], $note[14]), 
				$this->calcul_credit_ac($credit[15], $note[15]), 
				$this->calcul_credit_ac($credit[16], $note[16]), 
				$this->calcul_credit_ac($credit[17], $note[17]), 
				$this->calcul_credit_ac($credit[18], $note[18]), 
				$this->calcul_credit_ac($credit[19], $note[19])
			];

			$grade      = [
				$this->calcul_apreciation($note[0]), 
				$this->calcul_apreciation($note[1]), 
				$this->calcul_apreciation($note[2]), 
				$this->calcul_apreciation($note[3]), 
				$this->calcul_apreciation($note[4]), 
				$this->calcul_apreciation($note[5]), 
				$this->calcul_apreciation($note[6]), 
				$this->calcul_apreciation($note[7]), 
				$this->calcul_apreciation($note[8]), 
				$this->calcul_apreciation($note[9]), 
				$this->calcul_apreciation($note[10]), 
				$this->calcul_apreciation($note[11]), 
				$this->calcul_apreciation($note[12]), 
				$this->calcul_apreciation($note[13]), 
				$this->calcul_apreciation($note[14]), 
				$this->calcul_apreciation($note[15]), 
				$this->calcul_apreciation($note[16]), 
				$this->calcul_apreciation($note[17]), 
				$this->calcul_apreciation($note[18]), 
				$this->calcul_apreciation($note[19])
			];

			$code_cour  = ["OPCOI", "OPSCI", "COANAI", "INFISC", "INANAFI", "MATFI", "MAGI", "INGEI", "STATI", "FRAN", "ECOGE", "OPCOII", "OPSCII", "COANAII", "COMSOI", "MATFII", "MAGII", "RO", "ANG", "EOE", ];

			$code_ue   = ["UECG", "UEAC", "UEFO", "UECO", "UECS", "UEFO", "UECO"];

			$fpdf->Filigramme("ICAB");
			$fpdf->header_icab('Comptabilité et Gestion', $data); 
			$qrCode = $listing[$h]->qrCode;
			$fpdf->tableau_note_mava($matiere, $credit, $params, $note, $credit_a, $grade, $code_cour, $qrCode, $code_ue, 0);
			
			$fpdf->footer_('ICAB', 30, 'R'); 
			if ($h!= sizeof($listing)-1) {
				$fpdf->AddPage();
			}

		}
		
	}elseif ($filiere == 4) {
		
		/*********************************************************************************************************************************************************************/

		
		$params = array(
			'nom_groupe'      => ['UE Dessin', 'UE Architectures', 'UE Fondamentales', 'UE Complementaires', 'UE Topographies', 'UE Béton Armé', 'UE Fondamentales', 'UE Complementaires'],
			'nbre_matiere'    => [3, 3, 3, 2, 3, 3, 3, 2],
			'module_semest'   => [4, 4], // semest1, semes2
			'line'            => 117,
			'post_qr'         => 250,
			'size_qr'         => 28,
		);

	    $matiere = [ 
	    	"Procédés généraux de construction I", 
	    	"Dessin et technologie de batiment", 
	    	"Organisation des chantiers", 

	    	"Architecture", 
	    	"Resistance des matériaux I", 
	    	"Route I",

	    	"Physique I", 
	    	"Chimie",
	    	"Mathematique I",

	    	"Formation Bilingue", 
	    	"Francais",

	    	"Projet béton armé", 
	    	"Procédés généraux de construction II", 
	    	"Topographie I",

	    	"Béton armé I", 
	    	"Géotechnique", 
	    	"Résistance des matériaux II", 
	    	 
	    	"physique II", 
	    	"Mathématique II", 
	    	"Informatique I", 
	    	 
	    	"Entreprenariat", 
	    	"Education civique et éthique",
	    ];

	    $credit = [3, 3, 4, 4, 4, 4, 2, 2, 2, 1, 1, 3, 2, 3, 4, 3, 3, 2, 4, 3, 2, 1];

		// selectionner les etdiants
		$listing  = $this->Dash->listing_etudiants('etudiant_batiment');

		for ($h=0; $h < sizeof($listing); $h++) { 

			$data[] = array(
				'nomPrenom' => $listing[$h]->nom,
				'lieuDate'  => $listing[$h]->date_naiss.'        à      '. $listing[$h]->lieu_naiss,
				'matricule' => $listing[$h]->matricule,
				'domaine'   => 'Genie Civil',
				'speciaite' => $listing[$h]->filiere,
				'niveau'    => $listing[$h]->niveau,
				'cursus'    => 'BTS',
			);

			$note 		= [ 
				$listing[$h]->proce_gene_const_I, 
				$listing[$h]->dessin_tech_bati, 
				$listing[$h]->organi_chantier, 

				$listing[$h]->architecture, 
				$listing[$h]->resis_mat_I, 
				$listing[$h]->route_I, 

				$listing[$h]->physi_I,
				$listing[$h]->chimie,
				$listing[$h]->math_I,

				$listing[$h]->forma_bilingue, 
				$listing[$h]->francais, 

				$listing[$h]->projet_beton_ar, 
				$listing[$h]->pro_gene_const_II, 
				$listing[$h]->topographie_I, 

				$listing[$h]->beton_arme_I, 
				$listing[$h]->geometrique, 
				$listing[$h]->resis_mat_II, 

				$listing[$h]->physi_II,  
				$listing[$h]->math_II, 
				$listing[$h]->info_I, 

				$listing[$h]->entrepreunariat, 
				$listing[$h]->ethique, 
			];

			$credit_a 	= [
				$this->calcul_credit_ac($credit[0], $note[0]), 
				$this->calcul_credit_ac($credit[1], $note[1]), 
				$this->calcul_credit_ac($credit[2], $note[2]), 
				$this->calcul_credit_ac($credit[3], $note[3]), 
				$this->calcul_credit_ac($credit[4], $note[4]), 
				$this->calcul_credit_ac($credit[5], $note[5]), 
				$this->calcul_credit_ac($credit[6], $note[6]), 
				$this->calcul_credit_ac($credit[7], $note[7]), 
				$this->calcul_credit_ac($credit[8], $note[8]), 
				$this->calcul_credit_ac($credit[9], $note[9]), 
				$this->calcul_credit_ac($credit[10], $note[10]),
				$this->calcul_credit_ac($credit[11], $note[11]), 
				$this->calcul_credit_ac($credit[12], $note[12]),
				$this->calcul_credit_ac($credit[13], $note[13]), 
				$this->calcul_credit_ac($credit[14], $note[14]), 
				$this->calcul_credit_ac($credit[15], $note[15]), 
				$this->calcul_credit_ac($credit[16], $note[16]), 
				$this->calcul_credit_ac($credit[17], $note[17]), 
				$this->calcul_credit_ac($credit[18], $note[18]), 
				$this->calcul_credit_ac($credit[19], $note[19]), 
				$this->calcul_credit_ac($credit[20], $note[20]), 
				$this->calcul_credit_ac($credit[21], $note[21])];

			$grade 		= [
				$this->calcul_apreciation($note[0]),
				$this->calcul_apreciation($note[1]), 
				$this->calcul_apreciation($note[2]), 
				$this->calcul_apreciation($note[3]), 
				$this->calcul_apreciation($note[4]), 
				$this->calcul_apreciation($note[5]), 
				$this->calcul_apreciation($note[6]), 
				$this->calcul_apreciation($note[7]), 
				$this->calcul_apreciation($note[8]), 
				$this->calcul_apreciation($note[9]), 
				$this->calcul_apreciation($note[10]), 
				$this->calcul_apreciation($note[11]), 
				$this->calcul_apreciation($note[12]), 
				$this->calcul_apreciation($note[13]), 
				$this->calcul_apreciation($note[14]), 
				$this->calcul_apreciation($note[15]), 
				$this->calcul_apreciation($note[16]), 
				$this->calcul_apreciation($note[17]), 
				$this->calcul_apreciation($note[18]), 
				$this->calcul_apreciation($note[19]), 
				$this->calcul_apreciation($note[20]), 
				$this->calcul_apreciation($note[21])
			];

			$code_cour  = ["PGDCI", "DTDB", "ORDC", "ARCH", "REDMI", "ROUTI", "PHYI", "CHI", "MATHI", "ANG", "FRAN", "PBTA", "PGDCII", "TOPOI", "BETAI", "GEOQ", "RDMAII", "PHYII", "MATHII", "INFOI", "ENTR", "ECET", ];

			$code_ue   = ["UEDE", "UEAR", "UEFO", "UECO", "UETO", "UEBA", "UEFO", "UECO"];

		    $fpdf->Filigramme("ICAB");
			$fpdf->header_icab('Batiment', $data);
			$qrCode = $listing[$h]->qrCode; 

			$fpdf->tableau_note_mava($matiere, $credit, $params, $note, $credit_a, $grade, $code_cour, $qrCode, $code_ue, 0);
			
			$fpdf->footer_('ICAB', 40, 'R'); 
			if ($h!= sizeof($listing)-1) {
				$fpdf->AddPage();
			}
		}

	}elseif ($filiere == 5) {
	    
		/*******************************************************************************************************************************************************************/

		$params = array(
			'nom_groupe'      => ['UE Electronique', 'UE Réseaux', 'UE Fondamentales', 'UE Complementaires', 'UE Domotique', 'UE Circuits', 'UE Fondamentales', 'UE Complementaires'],
			'nbre_matiere'    => [3, 4, 3, 2, 4, 4, 3, 2],
			'module_semest'   => [4, 4], // semest1, semes2
			'line'            => 120.5,
			'post_qr'         => 253,
			'size_qr'         => 25,
		);

	    $matiere = [
	    	"Algorithme et Programmation", 
	    	"Electrotechnique I", 
	    	"Electronique de Puissance I", 

	    	"Electronique de Base I", 
	    	"Circuit Logique I", 
	    	"Réseau et Téléinformatiques", 
	    	"Domotique I", 

	    	"Physique générale I", 
	    	"Analyse mathématique I", 
	    	"Algèbre linéaire I",

	    	"Anglais", 
	    	"Comptabilité générale", 

	    	"Domotique II",
	    	"Architecture des ordinateurs", 
	    	"Schéma électrique", 
	    	"Circuit électrique", 

	    	"Electronique grand public", 
	    	"Télécommunications", 
	    	"Circuit logiques II", 
	    	"Métrologie",  
	    	
	    	"Analyse Mathématique II", 
	    	"Algèbre Linéaire II", 
	    	"Initiation à l'Informatique", 
	    	
	    	"Economie et Organisation des Entreprises", 
	    	"Technique d'expression"
	    ];

	    $credit = [3, 3, 2, 3, 2, 3, 5, 2, 2, 2, 1, 2,   5, 1, 2, 2, 3, 2, 4, 2, 2, 2, 2, 1, 2];

	    // selectionner les etdiants
		$listing  = $this->Dash->listing_etudiants('etudiant_iia');

		for ($h=0; $h < sizeof($listing); $h++) { 

			 $data[] = array(
				'nomPrenom' => $listing[$h]->nom,
				'lieuDate'  => $listing[$h]->date_naiss.'        à      '. $listing[$h]->lieu_naiss,
				'matricule' => $listing[$h]->matricule,
				'domaine'   => 'IIA',
				'speciaite' => 'Informatique Industrielle et Automatisme',
				'niveau'    => $listing[$h]->niveau,
				'cursus'    => 'BTS',
			);

			 $note 		= [
			 	$listing[$h]->algo_progra, 
			 	$listing[$h]->eletrotech_I, 
			 	$listing[$h]->elect_puissance_I, 
			 	$listing[$h]->elect_de_base_I, 
			 	$listing[$h]->circuit_log_I, 
			 	$listing[$h]->reseseau_teleinfo, 
			 	$listing[$h]->domoti_I, 
			 	$listing[$h]->phy_gene_I, 
			 	$listing[$h]->analyse_math_I, 
			 	$listing[$h]->algebre_line_I, 
			 	$listing[$h]->anglais,
			 	$listing[$h]->compta_gene, 
			 	$listing[$h]->domoti_II, 
			 	$listing[$h]->archi_ordi, 
			 	$listing[$h]->schema_elect, 
			 	$listing[$h]->circuit_elect, 
			 	$listing[$h]->elect_grand_pub, 
			 	$listing[$h]->telecom, 
			 	$listing[$h]->circuit_logi_II, 
			 	$listing[$h]->metrologie, 
			 	$listing[$h]->analyse_math_II, 
			 	$listing[$h]->algebre_line_II, 
			 	$listing[$h]->init_informatique, 
			 	$listing[$h]->econo_orga_entre, 
			 	$listing[$h]->francais,
			 ];


			 $credit_a 	= [
			 	$this->calcul_credit_ac($credit[0], $note[0]), 
			 	$this->calcul_credit_ac($credit[1], $note[1]), 
			 	$this->calcul_credit_ac($credit[2], $note[2]), 
			 	$this->calcul_credit_ac($credit[3], $note[3]), 
			 	$this->calcul_credit_ac($credit[4], $note[4]), 
			 	$this->calcul_credit_ac($credit[5], $note[5]), 
			 	$this->calcul_credit_ac($credit[6], $note[6]), 
			 	$this->calcul_credit_ac($credit[7], $note[7]), 
			 	$this->calcul_credit_ac($credit[8], $note[8]), 
			 	$this->calcul_credit_ac($credit[9], $note[9]), 
			 	$this->calcul_credit_ac($credit[10], $note[10]), 
			 	$this->calcul_credit_ac($credit[11], $note[11]), 
			 	$this->calcul_credit_ac($credit[12], $note[12]), 
			 	$this->calcul_credit_ac($credit[13], $note[13]), 
			 	$this->calcul_credit_ac($credit[14], $note[14]), 
			 	$this->calcul_credit_ac($credit[15], $note[15]), 
			 	$this->calcul_credit_ac($credit[16], $note[16]), 
			 	$this->calcul_credit_ac($credit[17], $note[17]),
			 	$this->calcul_credit_ac($credit[18], $note[18]), 
			 	$this->calcul_credit_ac($credit[19], $note[19]), 
			 	$this->calcul_credit_ac($credit[20], $note[20]), 
			 	$this->calcul_credit_ac($credit[21], $note[21]), 
			 	$this->calcul_credit_ac($credit[22], $note[22]), 
			 	$this->calcul_credit_ac($credit[23], $note[23]), 
			 	$this->calcul_credit_ac($credit[24], $note[24]), 
			 ];

			$grade 		= [
				$this->calcul_apreciation($note[0]), 
				$this->calcul_apreciation($note[1]), 
				$this->calcul_apreciation($note[2]), 
				$this->calcul_apreciation($note[3]), 
				$this->calcul_apreciation($note[4]), 
				$this->calcul_apreciation($note[5]), 
				$this->calcul_apreciation($note[6]), 
				$this->calcul_apreciation($note[7]), 
				$this->calcul_apreciation($note[8]), 
				$this->calcul_apreciation($note[9]), 
				$this->calcul_apreciation($note[10]), 
				$this->calcul_apreciation($note[11]), 
				$this->calcul_apreciation($note[12]), 
				$this->calcul_apreciation($note[13]), 
				$this->calcul_apreciation($note[14]), 
				$this->calcul_apreciation($note[15]), 
				$this->calcul_apreciation($note[16]), 
				$this->calcul_apreciation($note[17]), 
				$this->calcul_apreciation($note[18]), 
				$this->calcul_apreciation($note[19]), 
				$this->calcul_apreciation($note[20]), 
				$this->calcul_apreciation($note[21]), 
				$this->calcul_apreciation($note[22]), 
				$this->calcul_apreciation($note[23]),
				$this->calcul_apreciation($note[24])
			];

			$code_cour = ["ALPRO", "ELECTI", "ELECTPI", "ELECBAI", "CUILOI", "RETELE",  "DOMOI", "PHYGI", "ANMAI", "ALGLI", "ANG", "COMPG", "DOMOII", "ACHIO", "SHELE", "CIRELE", "ELEPUB", "TELE", "CIRLOII", "METRO", "ANAMAII", "ALGLII", "INIFO", "ECORG", "FRAN"];

			$code_ue   = ["UEELE", "UERE", "UEFO", "UECO", "UEDO", "UECI", "UEFO", "UECO"];

		    $fpdf->Filigramme("ICAB");
			$fpdf->header_icab('Informatique Industrielle et Automatisme', $data); 
			$qrCode = $listing[$h]->qrCode; 

			$fpdf->tableau_note_mava($matiere, $credit, $params, $note, $credit_a, $grade, $code_cour, $qrCode, $code_ue, 0);
			
			$fpdf->footer_('ICAB', 30, 'R'); 
			if ($h!= sizeof($listing)-1) {
				$fpdf->AddPage();
			}
		}
	}elseif ($filiere == 12) {

/********************************************************************************************************************************************************************************/
		
		$params = array(
			'nom_groupe'      => ['UE Initiation', 'UE Transport I', 'UE Fondamentales', 'UE Complémentaires', 'UE Géographie', 'UE Transport II', 'UE Complémentaires'],
			'nbre_matiere'    => [4, 3, 4, 3, 3, 4, 4],
			'module_semest'   => [4, 3], // semest1, semes2
			'line'            => 127.5,
			'post_qr'         => 250,
			'size_qr'         => 28,
		);

	    $matiere = [
	    	"Géographie des flux et transport des voyageurs I", 
	    	"Elément de Base de la Logistique I", 
	    	"Marketing appliqué au Transport I", 
	    	"Négociation achat vente I", 

	    	"Transport aérien I", 
	    	"Transport maritime et fluvial I", 
	    	"Transport terrestre I",

	    	"Mathématiques générales I", 
	    	"Informatique générale I", 
	    	"Mathématiques financiéres I", 
	    	"Statistiques I", 

	    	"Comptabilité générale I", 
	    	"Expression francaise ", 
	    	"Economie générale", 
	    	 
	    	"Géographie des flux et Transport des voyageurs II", 
	    	"Elémént de base de la logistique II", 
	    	"Marketing appliqué au Transport II", 

	    	"Négociation achat vente II", 
	    	"Transport aérien II",
	    	"Transport maritime et fluvial II", 
	   		"Transport terrestre II", 
	    	
	    	"Méthodologie de rédaction de rapport de stage", 
	    	"Comptabilité générale II", 
	    	"Expression Anglaise", 
	    	"Economie et organisation des entreprises"
	    ];

	    $credit = [2, 3, 2, 3, 2, 2, 2, 3, 2, 2, 2, 2, 2, 1,   3, 3, 2, 3, 3, 3, 3, 2, 3, 2, 3];

	    // selectionner les etdiants
		$listing  = $this->Dash->listing_etudiants('etudiant_glt');

		for ($h=0; $h < sizeof($listing); $h++) { 

			 $data[] = array(
				'nomPrenom' => $listing[$h]->nom,
				'lieuDate'  => $listing[$h]->date_naiss.'        à      '. $listing[$h]->lieu_naiss,
				'matricule' => $listing[$h]->matricule,
				'domaine'   => 'GLT',
				'speciaite' => 'Gestion Logistique et Transport',
				'niveau'    => $listing[$h]->niveau,
				'cursus'    => 'BTS',
			);

			$note = [
				$listing[$h]->geo_flux_tran_voy_I,
				$listing[$h]->ele_base_log_I,
				$listing[$h]->marke_app_trans_I,
				$listing[$h]->nego_achat_ven_I,

				$listing[$h]->trans_aeri_I,
				$listing[$h]->trans_mart_flu_I,
				$listing[$h]->trans_terestre_I,

				$listing[$h]->math_gene_I,
				$listing[$h]->info_I,
				$listing[$h]->math_fin_I,
				$listing[$h]->stat_I,

				$listing[$h]->compta_gene_I,
				$listing[$h]->francais,
				$listing[$h]->econo_gene,

				$listing[$h]->geo_flux_tran_voy_II,
				$listing[$h]->ele_base_log_II,
				$listing[$h]->marke_app_trans_II,

				$listing[$h]->nego_achat_ven_II,
				$listing[$h]->trans_aeri_II,
				$listing[$h]->trans_mart_flu_II,
				$listing[$h]->trans_terest_II,

				$listing[$h]->metho_reda_rap_stagr,
				$listing[$h]->compta_gene_II,
				$listing[$h]->anglais,
				$listing[$h]->econo_orga_entre,
			];

			$credit_a 	= [
				$this->calcul_credit_ac($credit[0], $note[0]),
				$this->calcul_credit_ac($credit[1], $note[1]), 
				$this->calcul_credit_ac($credit[2], $note[2]), 
				$this->calcul_credit_ac($credit[3], $note[3]), 
				$this->calcul_credit_ac($credit[4], $note[4]), 
				$this->calcul_credit_ac($credit[5], $note[5]), 
				$this->calcul_credit_ac($credit[6], $note[6]), 
				$this->calcul_credit_ac($credit[7], $note[7]), 
				$this->calcul_credit_ac($credit[8], $note[8]), 
				$this->calcul_credit_ac($credit[9], $note[9]), 
				$this->calcul_credit_ac($credit[10], $note[10]), 
				$this->calcul_credit_ac($credit[11], $note[11]), 
				$this->calcul_credit_ac($credit[12], $note[12]), 
				$this->calcul_credit_ac($credit[13], $note[13]), 
				$this->calcul_credit_ac($credit[14], $note[14]), 
				$this->calcul_credit_ac($credit[15], $note[15]), 
				$this->calcul_credit_ac($credit[16], $note[16]), 
				$this->calcul_credit_ac($credit[17], $note[17]), 
				$this->calcul_credit_ac($credit[18], $note[18]), 
				$this->calcul_credit_ac($credit[19], $note[19]), 
				$this->calcul_credit_ac($credit[20], $note[20]), 
				$this->calcul_credit_ac($credit[21], $note[21]), 
				$this->calcul_credit_ac($credit[22], $note[22]), 
				$this->calcul_credit_ac($credit[23], $note[23]), 
				$this->calcul_credit_ac($credit[24], $note[24])
			];

			$grade 		= [
				$this->calcul_apreciation($note[0]), 
				$this->calcul_apreciation($note[1]), 
				$this->calcul_apreciation($note[2]), 
				$this->calcul_apreciation($note[3]), 
				$this->calcul_apreciation($note[4]), 
				$this->calcul_apreciation($note[5]), 
				$this->calcul_apreciation($note[6]), 
				$this->calcul_apreciation($note[7]), 
				$this->calcul_apreciation($note[8]), 
				$this->calcul_apreciation($note[9]), 
				$this->calcul_apreciation($note[10]), 
				$this->calcul_apreciation($note[11]), 
				$this->calcul_apreciation($note[12]), 
				$this->calcul_apreciation($note[13]), 
				$this->calcul_apreciation($note[14]), 
				$this->calcul_apreciation($note[15]), 
				$this->calcul_apreciation($note[16]), 
				$this->calcul_apreciation($note[17]), 
				$this->calcul_apreciation($note[18]), 
				$this->calcul_apreciation($note[19]), 
				$this->calcul_apreciation($note[20]), 
				$this->calcul_apreciation($note[21]), 
				$this->calcul_apreciation($note[22]), 
				$this->calcul_apreciation($note[23]),
				$this->calcul_apreciation($note[24])
			];

			$code_cour 	= ["GFTVI", "EBLI", "MATI", "NAVI", "TAI", "TMFI", "TTI", "MATHGI", "INGEI", "MATHFII", "STATI", "COGENI", "EXPFR", "ECOGEN", "GFTVII", "EBLII", "MATII", "NAVII", "TAII", "TTII", "TMFII", "MRRS", "COGENII", "EXPANG", "EOE"];
			
			$code_ue   = ["UEIN", "UETR1", "UEFO", "UECO", "UEGE", "UETR2", "UEFO", "UECO"];

			$fpdf->Filigramme("ICAB");
			$fpdf->header_icab('Gestion Logistique et Transport', $data); 
			$qrCode = $listing[$h]->qrCode; 
			$fpdf->tableau_note_mava($matiere, $credit, $params, $note, $credit_a, $grade, $code_cour, $qrCode, $code_ue, 0);

			$fpdf->footer_('ICAB', 30, 'R'); 
			if ($h!= sizeof($listing)-1) {
				$fpdf->AddPage();
			}

		}  


/********************************************************************************************************************************************************************************/

	}


		$fpdf->Output('I','relevé de notes.pdf');
		// force_download('vendors/uploads/documents/FASE - Cartes d\'étudiant de IUC de Bandjoun-Cameroun.pdf', NULL);
	}

}




