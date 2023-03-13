<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = 'welcome/_404';
$route['translate_uri_dashes'] = FALSE;

/************************************************************************************************/

$route['InsertAdmin']           = 'welcome/insertAdmin'; 


$route['Connexion'] 			= 'welcome/index';
$route['Login']         		= 'welcome/authentification';
$route['Home'] 					= 'welcome/dashboard';
$route['Relever']				= 'welcome/relever';




$route['Printer/(:num)']   			= 'PhpSpreesheet/printer/$1'; // imprimer les relever par niveau




 


$route['Nouveau_Etudiant']   			= 'Etudiants/nouveau_etudiant';
$route['Enregister_Etudiant'] 			= 'Etudiants/enregistrer_etudiant';
$route['Liste_Etudiant']   				= 'Etudiants/liste_etudiant';
$route['Supprimer_Etudiant/(:num)'] 	= 'Etudiants/supprimer_etudiant/$1';
$route['Retablir_Etudiant/(:num)'] 		= 'Etudiants/retablir_etudiant/$1';
$route['Upgrate_Etudiant/(:num)'] 		= 'Etudiants/upgrate_etudiant/$1';
$route['Epier_Etudiant/(:num)'] 		= 'Etudiants/consulter_donnees_etudiant/$1';
$route['Modifier_Etudiant'] 			= 'Etudiants/modifier_etudiant';


 


$route['Nouveau_Model']   				= 'Cartes/nouveau_model';
$route['Enregister_Model'] 				= 'Cartes/enregistrer_model_carte'; 
$route['Liste_Model']   				= 'Etudiants/liste_etudiant';



// import_gl_semestre_1
// import_gl_semestre_2

// import_mcv_semestre_1
// import_mcv_semestre_2

// import_cge_semestre_1
// import_cge_semestre_2

// import_batiment_semestre_1
// import_batiment_semestre_2

// import_iia_semestre_1
// import_iia_semestre_1I

// import_glt_semestre_1
// import_glt_semestre_1I

// import_bif_semestre_1
// import_bif_semestre_1I

$route['Import_excel']   				= 'PhpSpreesheet/import_batiment_semestre_2';

