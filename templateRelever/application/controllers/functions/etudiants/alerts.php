<?php  

	function enregistrement_etudiant_echoue($nom_etudiant) {
		$result = "<script type='text/javascript'>setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Echec  !', text: 'Impossible d\'Enregistrer l\'étudiant ".$nom_etudiant."', type: 'error', confirmButtonColor: '#4fa7f3', timer: 30000})}, 500);</script>";
		return $result;
	}

	function enregistrement_etudiant_reussie($nom_etudiant) {
		$result =  "<script type='text/javascript'>setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Félicitation !', text: 'l\'étudiant ".$nom_etudiant." a été enregistrer avec success !', type: 'success', confirmButtonColor: '#4fa7f3', timer: 10000})}, 500);</script>";
        return $result;
	}  

	function modification_etudiant_echoue($nom_etudiant) {
		$result = "<script type='text/javascript'>setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Echec  !', text: 'Impossible d\'Enregistrer l\'étudiant ".$nom_etudiant."', type: 'error', confirmButtonColor: '#4fa7f3', timer: 30000})}, 500);</script>";
		return $result;
	}

	function modification_etudiant_reussie($nom_etudiant) {
		$result =  "<script type='text/javascript'>setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Félicitation !', text: 'l\'étudiant ".$nom_etudiant." a été enregistrer avec success !', type: 'success', confirmButtonColor: '#4fa7f3', timer: 10000})}, 500);</script>";
        return $result;
	}

	function importation_etudiant_reussie() {
		$result =  "<script type='text/javascript'>setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Félicitation !', text: 'l\'importation des étudiants a été un success !', type: 'success', confirmButtonColor: '#4fa7f3', timer: 10000})}, 500);</script>";
        return $result;
	}  

	function importation_etudiant_echouer() {
		$result =  "<script type='text/javascript'>setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Failed !', text: 'Erreur durant survenue l\'importation des étudiants !', type: 'error', confirmButtonColor: '#4fa7f3', timer: 10000})}, 500);</script>";
        return $result;
	}  

	function exportation_etudiant_reussie() {
		$result =  "<script type='text/javascript'>setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Félicitation !', text: 'l\'exportation des étudiants a été un success !', type: 'success', confirmButtonColor: '#4fa7f3', timer: 10000})}, 500);</script>";
        return $result;
	}  

	function exportation_etudiant_echouer() {
		$result =  "<script type='text/javascript'>setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Failed !', text: 'Erreur durant survenue l\'exportation des étudiants !', type: 'success', confirmButtonColor: '#4fa7f3', timer: 10000})}, 500);</script>";
        return $result;
	}  

?>


<?php  
	function Extraire_specialite($filiere, $niveau){
		$files = explode(('('), $filiere);
		$file = $files[1];
		$files = explode((')'), $file);
		$filieres = $files[0].$niveau;
		return $filieres;
	}
?>