<?php 
    function login_lost(){
        $result = "<script type='text/javascript'>setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Echec !', text: 'Désolé mais vos infos sont abscentes ou incorrectes !', type: 'error', confirmButtonColor: '#4fa7f3', timer: 60000})}, 200);</script>";
        return $result;
    }

    function save_good(){
        $result = "<script type='text/javascript'>setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Félicitations !', text: 'L'étudiant à été inséré avec succès.', type: 'success', confirmButtonColor: '#4fa7f3', timer: 30000})}, 500);</script>";
        return $result;
    }

    function import_lost(){
        $result = "<script type='text/javascript'>setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Echec !', text: 'Désolé mais L'importation a échouée !', type: 'error', confirmButtonColor: '#4fa7f3', timer: 60000})}, 200);</script>";
        return $result;
    }

    function import_good(){
        $result = "<script type='text/javascript'>setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Félicitations !', text: 'L'importation à été éffectuée avec succès.', type: 'success', confirmButtonColor: '#4fa7f3', timer: 30000})}, 500);</script>";
        return $result;
    }

    function login_win(){
        $result =  "<script type='text/javascript'>setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Félicitation !', text: 'Good votre session a été initialisée avec success !', type: 'success', confirmButtonColor: '#4fa7f3', timer: 10000})}, 500);</script>";
        return $result;
    }

    function destoy_session(){
        $result =  "<script type='text/javascript'>setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Destroy !', text: 'Désolé mais il semblerait que votre session a expirée', type: 'warning', confirmButtonColor: '#4fa7f3', timer: 10000})}, 500);</script>";
        return $result;
    }

    function save_lost(){
        $result = "<script type='text/javascript'>setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Echec !', text: 'Echec d\'enregistrement de l\'étudiant !', type: 'error', confirmButtonColor: '#4fa7f3', timer: 60000})}, 200);</script>";
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

    function carte_scolaire(){
        $fpdf->SetAutoPageBreak(1, 1); 
        $postx = 9; $x = $postx; $posty = 3; $y = $posty; $j = 1;
        $listing  = $this->Dash->liste_etudiant_actif();
        foreach ($listing as $prod) {
            $name = strlen($prod->nom);
            $name1 = $prod->nom;
            if ($name <= 18) {
                $name1 = $name1;
            } 
            else {
                $rest = '';
                for ($i = 0; $i <= 25 ; $i++) { 
                    if (strlen($name) < 25) {
                        $rest = $name1;
                    }
                    else{
                        $rest = $rest.$name1[$i];                   
                    }
                }
            }
            if ($j % 10 == 1) {
                $fpdf->AddPage();
                $postx =  $x;
                $posty =  $y;
            } elseif ($j % 5 == 1) {
                $posty = $y;
                $postx +=10+95;
            } else{
                $posty += 55+3;
            }
            $path = "./plugins/images/GC1/".$prod->numero.".jpg";
            $prod->nom = $prod->nom.' '.$prod->prenom;
            $name = $prod->nom;
            $lenght_name = strlen($prod->nom);
            if ($lenght_name <= 21) {
                $prod->nom = $name;
            } else {
                for ($i=0; $i < 21; $i++) { 
                    $prod->nom = $prod->nom.$name[$i];
                }
            }

            $fpdf->Image('vendors/plugins/images/models/verso.jpg', $postx,$posty ,95,55);
            $fpdf->Image('vendors/plugins/images/models/logo.png', $postx+2+5,$posty+2,6,6);
            $fpdf->Image('vendors/plugins/images/models/logo.png', $postx+83,$posty+2,6,6);
            $fpdf->SetFont('times', '','8');
            $fpdf->SetXY($postx,$posty+2);
            $fpdf->Cell(95,5,utf8_decode('REPUBLIQUE DU CAMEROUN'),0,0,'C');
            $fpdf->SetXY($postx,$posty+5);
            $fpdf->Cell(95,5,utf8_decode('Paix - Travail - Patrie'),0,0,'C');
            $fpdf->SetFont('times', 'B','11');
            $fpdf->SetXY($postx,$posty+11);
            $fpdf->Cell(95+5,5,utf8_decode("CARTE D ' ETUDIANT"),0,0,'C');
            $fpdf->Image('vendors/plugins/images/models/cadre.png', $postx+2+5,$posty+19-1,20,28);
            $fpdf->Image($prod->photo, $postx+3+5,$posty+20-1,18.2,26.2);
            $fpdf->Image($prod->qrcode, $postx+12.3,$posty+40-1,10.5,10.5);
            $fpdf->SetFont('times', '','8');
            $fpdf->SetXY($postx+25+5,$posty+17-1);
            $fpdf->Cell(95,6,utf8_decode("Matricule :   ".strtoupper($prod->matricule)),0,0,'L');
            $fpdf->SetXY($postx+25+5,$posty+21.5-1);
            $fpdf->Cell(95,6,utf8_decode("Nom(s)     :    ".strtoupper($prod->nom)),0,0,'L');
            $fpdf->SetXY($postx+25+5,$posty+26-1);
            $fpdf->Cell(95,6,utf8_decode("Sexe         :    ".strtoupper($prod->sexe)),0,0,'L');
            $fpdf->SetXY($postx+25+5,$posty+30.5-1);
            $fpdf->Cell(95,6,utf8_decode("Filière      :    ".strtoupper($prod->filiere)."            Niveau  :       ".$prod->niveau),0,0,'L');
            $fpdf->SetXY($postx+25+5,$posty+35-1);
            $fpdf->Cell(95,6,utf8_decode("Né(e)        :    ".$prod->date_naiss."      à        ".$prod->lieu_naiss),0,0,'L');
            $fpdf->SetXY($postx+25+5,$posty+39.5-1);
            $fpdf->Cell(95,6,utf8_decode("Contact    :    ".$prod->contact),0,0,'L');
            $fpdf->SetXY($postx+25+5,$posty+44-1);
            $fpdf->Cell(95,6,utf8_decode("Tuteur      :    ".strtoupper($prod->tuteur)),0,0,'L');
            $fpdf->SetXY($postx+23+5,$posty+49.3-1);
            $fpdf->Cell(61,0,utf8_decode(''),1,1,'C');
            $fpdf->SetFont('times', '','9');
            $fpdf->SetXY($postx+24+5,$posty+49.8-1);
            $fpdf->Cell(95,6,utf8_decode("INSTITUT CATHOLIQUE DE BAFOUSSAM"),0,0,'L');
            $fpdf->SetFont('times', '','7');
            $fpdf->SetXY($postx+2+5,$posty+50.5-1);
            $fpdf->Cell(60,6,utf8_decode("Année : ".date('Y')."/".(date('Y')+1)),0,0,'L');
            $j++;
        }

        $fpdf->SetAutoPageBreak(1, 1); 
        $postx = 5; $x = $postx; $posty = 3; $y = $posty; $j = 1;

        for ($j = 1; $j <=10 ; $j++) { 
            if ($j % 10 == 1) {
                $fpdf->AddPage();
                $postx =  $x;
                $posty =  $y;
            } elseif ($j % 5 == 1) {
                $posty = $y;
                $postx +=10+95;
            } else{
                $posty += 55+3;
            }

            $fpdf->Image('vendors/plugins/images/models/recto.jpg', $postx,$posty ,95,55);
            $fpdf->Image('vendors/plugins/images/models/logo.png', $postx+44,$posty+5,7,7);
            $fpdf->Image('vendors/plugins/images/models/cameroun.png', $postx+18-10,$posty+14,7,7);
            $fpdf->Image('vendors/plugins/images/models/cameroun.png', $postx+44+27+9,$posty+14,7,7);
            $fpdf->SetFont('times', '','7');
            $fpdf->SetXY($postx,$posty+2);
            $fpdf->Cell(44,5,utf8_decode("REPUBLIQUE DU CAMEROUN"),0,0,'C');
            $fpdf->SetXY($postx+44+7,$posty+2);
            $fpdf->Cell(44,5,utf8_decode("REPUBLIC OF CAMEROON"),0,0,'C');
            $fpdf->SetFont('times', 'i','7');
            $fpdf->SetXY($postx,$posty+6);
            $fpdf->Cell(44,5,utf8_decode("Paix - Travail - Patrie"),0,0,'C');
            $fpdf->SetXY($postx+44+7,$posty+6);
            $fpdf->Cell(44,5,utf8_decode("Peace - Work - Fatherland"),0,0,'C');
            $fpdf->SetFont('times', 'B','10');
            $fpdf->SetXY($postx,$posty+15);
            $fpdf->Cell(95,5,utf8_decode("CARTE D ' ETUDIANT"),0,0,'C');
            $fpdf->SetFont('times', 'B','8');

            $fpdf->SetXY($postx,$posty+23);
            $fpdf->Cell(95,5,utf8_decode("Diocèse de Bafoussam"),0,0,'C');
            $fpdf->SetFont('times', 'B','8');
            $fpdf->SetXY($postx,$posty+27);
            $fpdf->Cell(95,5,utf8_decode("INSTITUT CATHOLIQUE DE BAFOUSSAM"),0,0,'C');
            $fpdf->SetFont('times', 'BI','4');
            $fpdf->SetXY($postx,$posty+33);
            $fpdf->Cell(95,5,utf8_decode("ETABLISSEMENT D'ENSEIGNEMENT SUPERIEUR AUTORISE PAR LE MINESUP"),0,0,'C');
            $fpdf->SetFont('times', 'I','5');
            $fpdf->SetXY($postx,$posty+35);
            $fpdf->Cell(95,5,utf8_decode("AUT : N° 15 / 05584 / MINESUP/ DDE 056/06/15"),0,0,'C');
            $fpdf->Image('vendors/plugins/images/models/footer.jpeg', $postx,$posty+41,95,14);
        }
    }

    function photo_examen(){
        $postx = 18.5; 
        $x = $postx; 
        $posty = 2.5; 
        $y = $posty;
        $photo  = $this->Dash->listing_photo();
        $tab = count($photo);

        for ($i=0, $tab1=($tab-1); $i < ($tab/2); $i++, $tab1--) { 
            for ($j=1; $j < 8 ; $j++) { 
                if(($j>=1) && ($j<=4)){
                    $fpdf->Image($photo[$i]->photo, $postx,$posty ,40,40);
                    $postx = $x;
                    $posty +=40+4.3;
                    if ($j==4) {
                        $postx += 40+12.5;
                        $posty = $y;
                    }
                }
                if (($j>=4) && ($j<=7)) {
                    $fpdf->Image($photo[$tab1]->photo, $postx,$posty ,40,40);
                    $posty +=40+4.3;
                    if($j==7){
                        $fpdf->AddPage();
                        $postx = $x;
                        $posty = $y;
                    }
                }
            }
        }
    }

    function fiche_decharge_carte(){
        $fpdf->Head();
        $fpdf->Headers();
        $fpdf->SetAutoPageBreak(1, 1);
        $i = 1; $post = 63;
        $fpdf->SetFont('times', '','8');
        foreach ($listing as $key) {
            $rest = '';
            $key->nom = $key->nom.' '.$key->prenom;
            $name = $key->nom;
            for ($i = 0; $i <= 25 ; $i++) { 
                if (strlen($key->nom) < 25) {
                    $key->nom = $key->nom;
                }
                else{
                    $key->nom = $rest.$name[$i];                   
                }
            }
            $fpdf->SetXY(10,$post);
            $fpdf->Cell(12,6,utf8_decode($i),1,0,'C');
            $fpdf->SetXY(22,$post);
            $fpdf->Cell(70,6,utf8_decode(' '.$key->nom),1,0,'L');
            $fpdf->SetXY(92,$post);
            $fpdf->Cell(30,6,utf8_decode($key->filiere.' '.$key->niveau),1,0,'C');
            $fpdf->SetXY(122,$post);
            $fpdf->Cell(40,6,utf8_decode(''),1,0,'C');
            $fpdf->SetXY(162,$post);
            $fpdf->Cell(37,6,utf8_decode(''),1,0,'C');

            if ($post >= 278) {
                $post = 63;
                $fpdf->Head();
                $fpdf->Headers();
                $fpdf->SetFont('times', '','8');
                $fpdf->SetXY(10,$post);
                $fpdf->Cell(12,6,utf8_decode($i),1,0,'C');
                $fpdf->SetXY(22,$post);
                $fpdf->Cell(70,6,utf8_decode(' '.$fpdf->shift_name($key->nom)),1,0,'L');
                $fpdf->SetXY(92,$post);
                $fpdf->Cell(30,6,utf8_decode(strtoupper($key->filiere.' '.$key->niveau)),1,0,'C');
                $fpdf->SetXY(122,$post);
                $fpdf->Cell(40,6,utf8_decode(''),1,0,'C');
                $fpdf->SetXY(162,$post);
                $fpdf->Cell(37,6,utf8_decode(''),1,0,'C');
            }
            $i++; $post += 6;
        }
        $fpdf->pied();
    }
?>