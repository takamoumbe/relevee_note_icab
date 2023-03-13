<?php  

	function authentification_refusee() {
		$result = "<script type='text/javascript'>setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Echec  !', text: 'Désolé pour vous mais votre authentification à échoué', type: 'error', confirmButtonColor: '#4fa7f3', timer: 30000})}, 500);</script>";
        return $result;
	}

	function authentification_accordee() {
		$result =  "<script type='text/javascript'>setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Félicitation !', text: 'Good votre session a été initialisée avec success !', type: 'success', confirmButtonColor: '#4fa7f3', timer: 10000})}, 500);</script>";
        return $result;
	}

	function autorisations_refusee() {
		$result = "<script type='text/javascript'>setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Désolé  !', text: 'Désolé mais vos autorisations sont non définies', type: 'warning', confirmButtonColor: '#4fa7f3', timer: 30000})}, 500);</script>";
        return $result;
	}


	
    function date_count(){
        $firstDate ="2022-03-26"; 
        $secondDate = date('Y-m-d');
        $dateDifference = abs(strtotime($secondDate) - strtotime($firstDate));

        $years  = floor($dateDifference / (365 * 60 * 60 * 24));
        $months = floor(($dateDifference - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days   = floor(($dateDifference - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 *24) / (60 * 60 * 24));

        $result = ($years * 365) + ($months*30) + $days." days";
        return $result;
    }
?>