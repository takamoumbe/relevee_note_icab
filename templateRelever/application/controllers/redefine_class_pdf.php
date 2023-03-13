<?php 
	
	class PDF extends FPDF{
		
		/*----------------------------------------------------------------
		* TEMPLATE RELEVER NIVEAU I AGRONOMIE 
		*
		*----------------------------------------------------------------*/


		// entete sous tutel de icab agronomie 
		public function header_icab($filiere, $data){
			$postx = 4;
			$posty = 4;

			//$this->Image("./photos/fond.jpeg", $postx-2,$posty-2 ,206,293); image de fond
			/*--------------- left --------------*/
			$this->SetFont('times', 'I','9');
			$this->SetXY($postx,$posty+1);
			$this->Cell(86,5,utf8_decode('REPUBLIQUE DU CAMEROUN'),0,0,'C');
			$this->SetXY($postx,$posty+5);
			$this->Cell(86,5,utf8_decode('Paix - Travail - Patrie'),0,0,'C');
			// $this->SetXY($postx,$posty+1+8);
			// $this->Cell(86,5,utf8_decode('INSTITUT CATHOLIQUE DE BAFOUSSAM'),0,0,'C');
			/*--------------*/
			$this->Image('./photos/logoIcab.png', $postx+92,$posty-1,22,22);
			/*--------------*/
			/*--------------- rigth --------------*/
			$this->SetFont('times', 'I','9');
			$this->SetXY($postx+120,$posty+1);
			$this->Cell(86,5,utf8_decode('REPUBLIC OF CAMEROUN'),0,0,'C');
			$this->SetXY($postx+120,$posty+5);
			$this->Cell(86,5,utf8_decode('Peace - Work - Fatherland'),0,0,'C');
			// $this->SetXY($postx+120,$posty+1+8);
			// $this->Cell(86,5,utf8_decode('CATHOLIC INSTITUTE OF BAFOUSSAM'),0,0,'C');
			/*---------------*/
			$this->SetXY($postx+60,$posty+23);
			$this->SetFont('times', 'B','11');
			$this->Cell(86,5,utf8_decode('INSTITUT CATHOLIQUE DE BAFOUSSAM (ICAB)'),0,0,'C');
			$this->SetFont('times', 'I','8');
			$this->SetXY($postx+60,$posty+28);
	        $this->SetTextcolor(132, 38, 134);
			$this->Cell(86,5,utf8_decode('ETALISSEMENT D\'ENSEIGNEMENT SUPERIEUR DU DIOCESE DE BAFOUSSAM '),0,0,'C');
			$this->SetXY($postx+60,$posty+32);
	        $this->SetTextcolor(0, 0, 0);
			$this->Cell(86,5,utf8_decode('AUT: N 15/05584/L/MINESUP/DDES/ESUP/SDA/MM 05/06/15 '),0,0,'C');
			$this->SetXY($postx+60,$posty+36);
			$this->Cell(86,5,utf8_decode(' BP: 210 Bafoussam, Tél. 651 08 10 18 / 697 43 30 43'),0,0,'C');
			$this->SetXY($postx+60+13,$posty+40);
	        $this->SetTextcolor(67, 76, 200);
			$this->Cell(86,5,utf8_decode(' www.icabaf.cm'),0,0,'L');
			/*----------------*/
			$this->SetDrawColor(67, 76, 200);
			$this->Line(79, 48, 96, 48);
			$this->SetDrawColor(33, 165, 224);
			$this->Line(108, 48, 136, 48);
			/*----------------*/
			$this->SetTextcolor(0, 0, 0);
			$this->SetXY($postx+60+32,$posty+40);
			$this->Cell(86,5,utf8_decode(' E-Mail:'),0,0,'L');
	        $this->SetTextcolor(33, 165, 224);
	        $this->SetXY($postx+60+30+12,$posty+40);
	        $this->Cell(86,5,utf8_decode(' unicathobaf@yahoo.com'),0,0,'L');
			$this->SetTextcolor(0, 0, 0);
			$this->SetFont('times', 'B','9');
			// $this->Cell(86,5,utf8_decode('Cycle d\'étude en '.$filiere),0,0,'C');
			/*---------------*/
			$this->SetXY($postx+10,$posty+45);
			$this->SetFont('times', 'B','9');
			$this->Cell(86,5,utf8_decode('RELEVE DE NOTE ANNUEL / TRANSCRIPTIF N° ID'),0,0,'C');
			$this->SetXY($postx+70,$posty+45);
			$this->SetFont('times', 'I','9');
			$this->Cell(86,5,utf8_decode('/ICAB'),0,0,'C');
			$this->SetXY($postx+100,$posty+45);
			$this->Cell(86,5,utf8_decode('/ANNEE '.(date("Y")-2).' - '.date("Y")-1),0,0,'C');
			/*---------------*/
			$equilibre = 56;
			$margL = 0;
			$margR = 0;
			$this->SetDrawColor(0, 0, 0);
	        $this->Line($margL+12, $equilibre, $margR+198, $equilibre);
	        $this->Line($margL+12, $equilibre+5, $margR+198, $equilibre+5);
	        $this->Line($margL+12, $equilibre+5+5, $margR+198, $equilibre+5+5);
	        $this->Line($margL+12, $equilibre+5+5+5, $margR+198, $equilibre+5+5+5);
	        $this->Line($margL+12, $equilibre+5+5+5+5, $margR+198, $equilibre+5+5+5+5);
	        /*--------left------------*/
	        $index = sizeof($data)-1;
	        $this->SetTextcolor(34, 66, 124);
	        $this->SetXY($postx+11,$posty+45+8);
			$this->SetFont('Arial', 'B','8');
			$this->Cell(55,5,utf8_decode('Nom et Prénom(s): '),0,0,'L');
	        $this->SetTextcolor(0, 0, 0);
	        $this->SetXY($postx+45,$posty+45+8);
			$this->Cell(55,5,utf8_decode($data[$index]['nomPrenom']),0,0,'L');
			$this->SetXY($postx+11,$posty+45+8+5);
			$this->SetTextcolor(34, 66, 124);
			$this->Cell(55,5,utf8_decode('Né(e) le: '),0,0,'L');
			$this->SetTextcolor(0, 0, 0);
			$this->SetXY($postx+45,$posty+45+8+5);
			$this->Cell(48.5,5,utf8_decode(strtoupper($data[$index]['lieuDate']) ),0,0,'L');
			$this->SetXY($postx+11,$posty+45+8+5+5);
			$this->SetTextcolor(34, 66, 124);
			$this->Cell(55.8,5,utf8_decode('Matricule: '),0,0,'L');
			$this->SetTextcolor(0, 0, 0);
			$this->SetXY($postx+45,$posty+45+8+5+5);
			$this->Cell(48.5,5,utf8_decode($data[$index]['matricule']),0,0,'L');
			$this->SetXY($postx+11,$posty+45+8+5+5+5);
			$this->SetTextcolor(34, 66, 124);
			$this->Cell(55.8,5,utf8_decode('Année Academique: '),0,0,'L');
			$this->SetTextcolor(0, 0, 0);
			$this->SetXY($postx+45,$posty+45+8+5+5+5);
			$this->Cell(48.5,5,utf8_decode((date("Y")-2).' - '.date("Y")-1),0,0,'L');
	        /*--------right------------*/
	        $this->SetTextcolor(34, 66, 124);
	        $this->SetXY($postx+120,$posty+45+8);
			$this->SetFont('Arial', 'B','8');
			$this->Cell(55,5,utf8_decode('Domaine: '),0,0,'L');
	        $this->SetTextcolor(0, 0, 0);
	        $this->SetXY($postx+140,$posty+45+8);
			$this->Cell(55,5,utf8_decode($data[$index]['domaine']),0,0,'L');
			$this->SetXY($postx+120,$posty+45+8+5);
			$this->SetTextcolor(34, 66, 124);
			$this->Cell(55,5,utf8_decode('Specialité: '),0,0,'L');
			$this->SetTextcolor(0, 0, 0);
			$this->SetXY($postx+140,$posty+45+8+5);
			$this->Cell(48.5,5,utf8_decode($data[$index]['speciaite']),0,0,'L');
			$this->SetXY($postx+120,$posty+45+8+5+5);
			$this->SetTextcolor(34, 66, 124);
			$this->Cell(55.8,5,utf8_decode('Cursus: '),0,0,'L');
			$this->SetTextcolor(0, 0, 0);
			$this->SetXY($postx+140,$posty+45+8+5+5);
			$this->Cell(48.5,5,utf8_decode($data[0]['cursus']),0,0,'L');
			$this->SetXY($postx+120,$posty+45+8+5+5+5);
			$this->SetTextcolor(34, 66, 124);
			$this->Cell(55.8,5,utf8_decode('Niveau: '),0,0,'L');
			$this->SetTextcolor(0, 0, 0);
			$this->SetXY($postx+140,$posty+45+8+5+5+5);
			$this->Cell(48.5,5,utf8_decode($data[$index]['niveau']),0,0,'L');

			/*--------------*/
			$this->SetXY($postx+11,$posty+45+8+28);
			$this->Cell(55,5,utf8_decode("Vu le procès-verbal du jury en date du: .. ... ... ... ... ... ... ... ... ... ... ... ... ... ... "),0,0,'L');

			/*---------------*/
			$this->SetFont('times', '','8');
		}

		

		 var $angle = 0;

        function Rotate($angle,$x=-1,$y=-1) {
            if($x == -1){
                $x = $this->x;
            }

            if($y == -1){
                $y=$this->y;
            }

            if($this->angle!=0){
                $this->_out('Q');
            }

            $this->angle = $angle;

            if($angle!=0)
            {
                $angle*=M_PI/180;
                $c=cos($angle);
                $s=sin($angle);
                $cx=$x*$this->k;
                $cy=($this->h-$y)*$this->k;
                $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
            }
        }

        function _endpage() {
            if($this->angle!=0)
            {
                $this->angle=0;
                $this->_out('Q');
            }
            parent::_endpage();
        }

        function RotatedText($x, $y, $filigrame, $angle){
            $this->Rotate($angle, $x, $y);
            $this->Text($x, $y, $filigrame);
            $this->Rotate(0);
        }

        function Filigramme($filigrame){
            $this->SetTextColor(172,230,255);
            $this->SetFont('Times', 'I', 45);
            $positionY = 55;
            $positionX = 29;
            $this->RotatedText( $positionX,  $positionY, $filigrame, 50);
            $positionY = 40;
            $positionX = 160;
            for ($i=0; $i < 4; $i++) { 
            	$this->RotatedText( $positionX,  $positionY, $filigrame, 50);
            	$positionY = $positionY + 60;
           		$positionX = $positionX - 45;
            }

            $positionY = 190;
            $positionX = 185;
            for ($i=0; $i < 3; $i++) { 
            	$this->RotatedText( $positionX,  $positionY, $filigrame, 50);
            	$positionY = $positionY + 80;
           		$positionX = $positionX - 55;
            }

            

            $this->SetTextColor(0,0,0);
        }

        function footer_($etabli, $y, $orientation) {
            $this->SetXY(10,-21);
            $this->SetFont('Times', 'I' ,7);
            $this->SetXY(10,-15);
            $this->SetFont('Times', 'B' ,7);
            $this->Cell(0,10,utf8_decode("Il n'est délivré qu'un seul exemplaire de relevé de notes. Le titulaire peut établir et faire certifier des copies conformes " ),0,0,'C');
            if ($orientation == 'C') {
            	$this->SetXY(10,-($y));
            }else{
            	$this->SetXY(10,-($y+10));
            }
            $this->Cell(0,10,utf8_decode("Fait à Bafoussam, le: ............................................ " ),0,0,$orientation);
	         $this->SetXY(10,-$y);
	         $this->Cell(0,10,utf8_decode("Directeur ICAB " ),0,0,'R');
            $this->SetXY(10,-$y);
            $this->Cell(0,10,utf8_decode("DAAC " ),0,0,'L');

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

		/*----------------------------------------------------------------
		* FONCTION POUR MODULER
		* return: le tableau de note
		*----------------------------------------------------------------*/

		public function module_note($note, $credit, $credit_acqui){

			if (sizeof($note) != sizeof($credit) || sizeof($note) != sizeof($credit_acqui)) {
				return null;
			}else{
				
				$mote_crediter = 0; $somme_credit = 0;
				for ($i=0; $i < sizeof($note); $i++) { 

					if ($note[$i]>=8) {

						$mote_crediter = $mote_crediter + ($note[$i]*$credit[$i]);

						$somme_credit = $somme_credit + $credit[$i];

					}else if ($note[$i]<8) {

						$data[] =	array(
							'notes_moduler'         => $note,
							'credit_moduler'        => $credit,
							'credit_acqui_moduler'  => $credit_acqui,
						);
						return $data;
					}
					
				}
				// calcul moyenne
				$moyenne = $mote_crediter/$somme_credit;
				if ($moyenne>=10) {
					// donner le credit aux notes inferieure a 10
					for ($j=0; $j < sizeof($note); $j++) { 
						if ($credit_acqui[$j]==0) {
							$credit_acqui[$j] = $credit[$j];
						}
					}
				}
			}

			$data[] =	array(
				'notes_moduler'         => $note,
				'credit_moduler'        => $credit,
				'credit_acqui_moduler'  => $credit_acqui,
			);
			return $data;
		}

		/*----------------------------------------------------------------
		* TEMPLATE RELEVER NIVEAU I
		*
		*----------------------------------------------------------------*/
		public function tableau_note_mava($matiere, $credit, $params, $note, $credit_a, $grade, $code_cour, $qrCode, $code_ue, $reduction){

			$postx = 4;
			$posty = 4;
			$equilibre = 56;
			$margL = 0;
			$margR = 0;

			$this->SetDrawColor(255, 203, 164);
			$addE = 37;
			$addEV = $margR+60;
			for ($i=0; $i < 20; $i++) { 
				 $this->Line($margL+12, $equilibre+$addE, $addEV, $equilibre+$addE);
				 $addE = $addE+0.3;
				 $addEV = $addEV + 0.5;
			}	
	        $this->SetXY($postx+11,$posty+45+8+28+9);
			$this->Cell(55.8,5,utf8_decode(' Semestre LMD 1 30 Crédits '),0,0,'L');

			/*-------------------*/ // entete
			$this->SetXY($postx+8,$posty+45+8+28+9+5);
			$this->SetFillColor(255, 203, 164);
			$this->SetDrawColor(0, 0, 0);
			$this->Cell(18,5,utf8_decode('Code UE '),1,1,'C', true);
			$this->SetXY($postx+8+18,$posty+45+8+28+9+5);
			$this->Cell(18,5,utf8_decode('Code Cours '),1,1,'C', true);
			$this->SetXY($postx+8+18+18,$posty+45+8+28+9+5);
			$this->Cell(50+20,5,utf8_decode('Intitulé de l\'unité d\'enseignement/cours '),1,1,'C', true);
			$this->SetXY($postx+8+18+18+50+5+14,$posty+45+8+28+9+5);
			$this->Cell(10,5,utf8_decode('Crédits '),1,1,'C', true);
			$this->SetXY($postx+8+18+18+50+15+14,$posty+45+8+28+9+5);
			$this->Cell(13,5,utf8_decode('Note/20 '),1,1,'C', true);
			$this->SetXY($postx+8+18+18+50+15+13+14,$posty+45+8+28+9+5);
			$this->Cell(9,5,utf8_decode('PQ/4'),1,1,'C', true);
			$this->SetXY($postx+8+18+18+50+15+13+18+14-9,$posty+45+8+28+9+5);
			$this->Cell(14,5,utf8_decode('Crédit Ac.'),1,1,'C', true);
			$this->SetXY($postx+8+18+18+50+15+13+18+17+11-9,$posty+45+8+28+9+5);
			$this->Cell(12,5,utf8_decode('Grade'),1,1,'C', true);
			$this->SetXY($postx+8+18+18+50+15+13+18+17+20-7,$posty+45+8+28+9+5);
			$this->Cell(24,5,utf8_decode('Session'),1,1,'C', true);
			
			/*--------------------*/
			$decalage = $posty+45+8+28+9+5+5;
			

			$this->SetFont('times', '','8');
			$this->SetXY($postx+8,$decalage);
			$this->SetFillColor(247, 247, 247);
			$this->SetDrawColor(0, 0, 0);
			$this->Cell(186,4,utf8_decode(' LMD semester I'),1,1,'L', true);

			/*----------- MODULES && MATIERES ---------*/
			$dataModule = $params['nom_groupe'];
			$dataMatiere= $params['nbre_matiere'];
			$dataSemest = $params['module_semest'];
			$nbr_mod    = sizeof($dataModule);

			/*------1)----- BOUCLE  ------> MDULE ---------*/
			$num_mat  = 0; $num_credit = 0;
			$credit_semestre1 = 0; $note_semestre1 = 0;
			/*---------------------------------------------*/
			for ($m=0; $m < sizeof($dataModule); $m++) { 
				/*
				-
				-
				-*/
				if ($m==0) {
					$decalage = $decalage+4;
				}else{
					$decalage = $decalage+3.5;
				}
				
				/*------2)----- BOUCLE   ---------*/
				$credit_t = 0; $sum_note=0; $sum_credit_acqui=0; $nbre_module=0; $note_m = array(); $credit_m = array(); $credit_acqui_m = array();
 				for ($i=0; $i < $dataMatiere[$m]; $i++) { 
					$credit_t = $credit_t + $credit[$num_credit];
					$sum_note = $sum_note + $note[$num_credit]; 

					// contruire les information pour la modulation
					$note_m[$i]           = $note[$num_credit]; 
					$credit_m[$i]         = $credit[$num_credit]; 
					$credit_acqui_m[$i]   = $credit_a[$num_credit];

					$nbre_module++;
					$num_credit++;
				}

				//moluder la note du groupe
				$data_moduler   = $this->module_note($note_m, $credit_m, $credit_acqui_m);
				$note_moduler   = $data_moduler[0]['notes_moduler'];
				$credit_moduler = $data_moduler[0]['credit_moduler'];
				$credit_acqui_moduler = $data_moduler[0]['credit_acqui_moduler'];
				//---------
				for ($e=0; $e < sizeof($credit_acqui_moduler); $e++) { 
					$sum_credit_acqui = $sum_credit_acqui + $credit_acqui_moduler[$e];
				}

				$credit_semestre1 = $credit_semestre1+$sum_credit_acqui;
				$note_semestre1   = $note_semestre1 + ($sum_note/$nbre_module);
				
				/*-------------------*/ 
				$this->SetXY($postx+8,$decalage);
				$this->SetFillColor(223, 145, 92);
				$this->SetDrawColor(0, 0, 0);
				$this->Cell(18,3.5,utf8_decode('UE '),1,1,'C', true);
				$this->SetXY($postx+8+18,$decalage);
				$this->Cell(18,3.5,utf8_decode($code_ue[$m].'1_'.$credit_t),1,1,'C', true);
				$this->SetXY($postx+8+18+18,$decalage);
				$this->Cell(50+20,3.5,utf8_decode($dataModule[$m].'  ('.$credit_t.' Crédits) '),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+5+14,$decalage);
				$this->Cell(10,3.5,utf8_decode($credit_t),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+14,$decalage);
				$this->Cell(13,3.5,utf8_decode(round($sum_note/$nbre_module, 2)),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+13+14,$decalage);
				$this->Cell(9,3.5,utf8_decode(round(($sum_note/$nbre_module)/4, 2)),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+13+18+14-9,$decalage);
				$this->Cell(14,3.5,utf8_decode($sum_credit_acqui),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+13+18+17+11-9,$decalage);
				$this->Cell(12,3.5,utf8_decode($this->calcul_apreciation(($sum_note/$nbre_module))),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+13+18+17+20-7,$decalage);
				$this->Cell(24,3.5,utf8_decode(''),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+5+14,$decalage);
				$this->Cell(10,3.5,utf8_decode($credit_t),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+14,$decalage);
				$this->Cell(13,3.5,utf8_decode(round($sum_note/$nbre_module, 2)),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+13+14,$decalage);
				$this->Cell(9,3.5,utf8_decode(round(($sum_note/$nbre_module)/4, 2)),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+13+18+14-9,$decalage);
				$this->Cell(14,3.5,utf8_decode($sum_credit_acqui),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+13+18+17+11-9,$decalage);
				$this->Cell(12,3.5,utf8_decode($this->calcul_apreciation(($sum_note/$nbre_module))),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+13+18+17+20-7,$decalage);
				$this->Cell(24,3.5,utf8_decode(''),1,1,'C', true);
				
				$decalage = $decalage+3.5;
				$compt_credit_mod = 0;

				for ($j=0; $j < $dataMatiere[$m]; $j++) { 
					$this->SetFont('times', '','8');
					$this->SetXY($postx+8,$decalage);
					$this->SetFillColor(247, 247, 247);
					$this->SetDrawColor(255, 255, 255);
					$this->Cell(18,3.5,utf8_decode(' '),1,1,'C', true);
					$this->SetDrawColor(0, 0, 0);
					$this->SetXY($postx+8+18,$decalage);
					$this->Cell(18,3.5,utf8_decode($code_cour[$num_mat].'1'.$credit[$num_mat]),1,1,'L', true);
					$this->SetXY($postx+8+18+18,$decalage);
					$this->Cell(50+20,3.5,utf8_decode($matiere[$num_mat]),1,1,'L', true);
					$this->SetXY($postx+8+18+18+50+5+14,$decalage);
					$this->Cell(10,3.5,utf8_decode($credit[$num_mat]),1,1,'C', true);
					$this->SetXY($postx+8+18+18+50+15+14,$decalage);
					$this->Cell(13,3.5,utf8_decode($note_moduler[$compt_credit_mod]),1,1,'C', true);
					$this->SetXY($postx+8+18+18+50+15+13+14,$decalage);
					$this->Cell(9,3.5,utf8_decode($note_moduler[$compt_credit_mod]/5),1,1,'C', true);
					$this->SetXY($postx+8+18+18+50+15+13+18+14-9,$decalage);
					$this->Cell(14,3.5,utf8_decode($credit_acqui_moduler[$compt_credit_mod]),1,1,'C', true);
					$this->SetXY($postx+8+18+18+50+15+13+18+17+11-9,$decalage);
					$this->Cell(12,3.5,utf8_decode($grade[$num_mat]),1,1,'C', true);
					$this->SetXY($postx+8+18+18+50+15+13+18+17+20-7,$decalage);
					$this->Cell(24,3.5,utf8_decode('Fevrier 2022'),1,1,'C', true);

					$compt_credit_mod++;
					$num_mat++;
					if ($j != $dataMatiere[$m]-1) {
						$decalage = $decalage+3.5;
					}
					
				}



				if ($m == $dataSemest[0]-1) {
					break;
				}


				/*---------SEMESTRE II----------*/


			}

			$decalage = $decalage+3.5;
			/*-------------------*/
			$this->SetFont('times', 'B','8');
			$this->SetXY($postx+8,$decalage);
			$this->SetFillColor(172,230,255);
			$this->SetDrawColor(0, 0, 0);
			$this->Cell(90+16,5,utf8_decode('Total des acquis du semestre 1: '),1,1,'L', true);
			$this->SetXY($postx+8+18+18+50+5+14,$decalage);
			$this->Cell(10,5,utf8_decode(' 30 '),1,1,'C', true);
			$this->SetXY($postx+8+18+18+50+5+14+10,$decalage);
			$this->Cell(13,5,utf8_decode(round($note_semestre1/$dataSemest[0], 2)),1,1,'C', true);
			$this->SetXY($postx+8+18+18+50+15+13+14,$decalage);
			$this->Cell(9,5,utf8_decode(round(($note_semestre1/$dataSemest[0])/5, 2)),1,1,'C', true);
			$this->SetXY($postx+8+18+18+50+15+13+18+14-9,$decalage);
			$this->Cell(14,5,utf8_decode($credit_semestre1),1,1,'C', true);
			$this->SetXY($postx+8+18+18+50+15+13+18+17+11-9,$decalage);
			$this->Cell(12,5,utf8_decode($this->calcul_apreciation($note_semestre1/$dataSemest[0])),1,1,'C', true);		
			$this->SetXY($postx+8+18+18+50+15+13+18+17+20-7,$decalage);
			$this->Cell(24,5,utf8_decode(''),1,1,'C', true);
			
			
			$decalage = $decalage+3.5;
			/*--------------------*/
			$this->SetDrawColor(255, 203, 164);
			$addE = $params['line'];
			$addEV = $margR+60;
			for ($i=0; $i < 20; $i++) { 
				 $this->Line($margL+12, $equilibre+$addE, $addEV, $equilibre+$addE);
				 $addE = $addE+0.3;
				 $addEV = $addEV + 0.5;
			}	
			$this->SetFont('times', '','8');
	        $this->SetXY($postx+11,$decalage+10);
			$this->Cell(55.8,5,utf8_decode('Semestre LMD 2 30 Crédits'),0,0,'L');

			$decalage = $decalage+15;
			$this->SetFont('times', '','8');
			$this->SetXY($postx+8,$decalage);
			$this->SetFillColor(247, 247, 247);
			$this->SetDrawColor(0, 0, 0);
			$this->Cell(186,4,utf8_decode(' LMD semester II'),1,1,'L', true);

			

			/*------1)----- BOUCLE  ------> MDULE ---------*/
			$num_mat2 = $num_mat; $num_credit2 = $num_credit;
			$credit_semestre2 = 0; $note_semestre2 = 0;
			/*---------------------------------------------*/
			for ($m2=$m+1; $m2 < sizeof($dataModule); $m2++) { 
				/*
				-
				-
				-*/

				/*------3)----- BOUCLE   ---------*/
				$credit_t2 = 0; $sum_note2=0; $sum_credit_acqui2=0; $nbre_module2=0; $note_m = array(); $credit_m = array(); $credit_acqui_m = array();
				for ($i=0; $i < $dataMatiere[$m2]; $i++) { 
					$credit_t2 = $credit_t2 + $credit[$num_credit2];
					$sum_note2 = $sum_note2 + $note[$num_credit2]; 

					// contruire les information pour la modulation
					$note_m[$i]           = $note[$num_credit2]; 
					$credit_m[$i]         = $credit[$num_credit2]; 
					$credit_acqui_m[$i]   = $credit_a[$num_credit2];

					$nbre_module2++;
					$num_credit2++;
				}

				//moluder la note du groupe
				$data_moduler   = $this->module_note($note_m, $credit_m, $credit_acqui_m);
				$note_moduler   = $data_moduler[0]['notes_moduler'];
				$credit_moduler = $data_moduler[0]['credit_moduler'];
				$credit_acqui_moduler = $data_moduler[0]['credit_acqui_moduler'];
				//---------
				for ($e=0; $e < sizeof($credit_acqui_moduler); $e++) { 
					$sum_credit_acqui2 = $sum_credit_acqui2 + $credit_acqui_moduler[$e];
				}

				$credit_semestre2 = $credit_semestre2+$sum_credit_acqui2;
				$note_semestre2   = $note_semestre2 + ($sum_note2/$nbre_module2);

				$decalage = $decalage+3.5;

				/*-------------------*/ 
				$this->SetXY($postx+8,$decalage);
				$this->SetFillColor(223, 145, 92);
				$this->SetDrawColor(0, 0, 0);
				$this->Cell(18,3.5,utf8_decode('UE '),1,1,'C', true);
				$this->SetXY($postx+8+18,$decalage);
				$this->Cell(18,3.5,utf8_decode($code_ue[$m2].'1_'.$credit_t2),1,1,'C', true);
				$this->SetXY($postx+8+18+18,$decalage);
				$this->Cell(50+20,3.5,utf8_decode($dataModule[$m2].'  ('.$credit_t2.' Crédits) '),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+5+14,$decalage);
				$this->Cell(10,3.5,utf8_decode($credit_t2),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+14,$decalage);
				$this->Cell(13,3.5,utf8_decode(round($sum_note2/$nbre_module2, 2)),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+13+14,$decalage);
				$this->Cell(9,3.5,utf8_decode(round(($sum_note2/$nbre_module2)/4, 2)),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+13+18+14-9,$decalage);
				$this->Cell(14,3.5,utf8_decode($sum_credit_acqui2),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+13+18+17+11-9,$decalage);
				$this->Cell(12,3.5,utf8_decode($this->calcul_apreciation(($sum_note2/$nbre_module2))),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+13+18+17+20-7,$decalage);
				$this->Cell(24,3.5,utf8_decode(''),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+5+14,$decalage);
				$this->Cell(10,3.5,utf8_decode($credit_t2),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+14,$decalage);
				$this->Cell(13,3.5,utf8_decode(round($sum_note2/$nbre_module2, 2)),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+13+14,$decalage);
				$this->Cell(9,3.5,utf8_decode(round(($sum_note2/$nbre_module2)/4, 2)),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+13+18+14-9,$decalage);
				$this->Cell(14,3.5,utf8_decode($sum_credit_acqui2),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+13+18+17+11-9,$decalage);
				$this->Cell(12,3.5,utf8_decode($this->calcul_apreciation(($sum_note2/$nbre_module2))),1,1,'C', true);
				$this->SetXY($postx+8+18+18+50+15+13+18+17+20-7,$decalage);
				$this->Cell(24,3.5,utf8_decode(''),1,1,'C', true);

				$decalage = $decalage+3.5;
				$compt_credit_mod = 0;

				for ($e=0; $e < $dataMatiere[$m2]; $e++) { 
					$this->SetFont('times', '','8');
					$this->SetXY($postx+8,$decalage);
					$this->SetFillColor(247, 247, 247);
					$this->SetDrawColor(255, 255, 255);
					$this->Cell(18,3.5,utf8_decode(' '),1,1,'C', true);
					$this->SetDrawColor(0, 0, 0);
					$this->SetXY($postx+8+18,$decalage);
					$this->Cell(18,3.5,utf8_decode($code_cour[$num_mat2].'1'.$credit[$num_mat2]),1,1,'L', true);
					$this->SetXY($postx+8+18+18,$decalage);
					$this->Cell(50+20,3.5,utf8_decode($matiere[$num_mat2]),1,1,'L', true);
					$this->SetXY($postx+8+18+18+50+5+14,$decalage);
					$this->Cell(10,3.5,utf8_decode($credit[$num_mat2]),1,1,'C', true);
					$this->SetXY($postx+8+18+18+50+15+14,$decalage);
					$this->Cell(13,3.5,utf8_decode($note_moduler[$compt_credit_mod]),1,1,'C', true);
					$this->SetXY($postx+8+18+18+50+15+13+14,$decalage);
					$this->Cell(9,3.5,utf8_decode($note[$num_mat2]/5),1,1,'C', true);
					$this->SetXY($postx+8+18+18+50+15+13+18+14-9,$decalage);
					$this->Cell(14,3.5,utf8_decode($credit_acqui_moduler[$compt_credit_mod]),1,1,'C', true);
					$this->SetXY($postx+8+18+18+50+15+13+18+17+11-9,$decalage);
					$this->Cell(12,3.5,utf8_decode($grade[$num_mat2]),1,1,'C', true);
					$this->SetXY($postx+8+18+18+50+15+13+18+17+20-7,$decalage);
					$this->Cell(24,3.5,utf8_decode('Juillet 2022'),1,1,'C', true);

					$num_mat2++;
					$compt_credit_mod++;
					if ($e != $dataMatiere[$m2]-1) {
						$decalage = $decalage+3.5;
					}
					
				}

			}

			$decalage = $decalage+3.5;
			/*-------------------*/
			$this->SetFont('times', 'B','8');
			$this->SetXY($postx+8,$decalage);
			$this->SetFillColor(172,230,255);
			$this->SetDrawColor(0, 0, 0);
			$this->Cell(90+16,5,utf8_decode('Total des acquis du semestre 2: '),1,1,'L', true);
			$this->SetXY($postx+8+18+18+50+5+14,$decalage);
			$this->Cell(10,5,utf8_decode('30 '),1,1,'C', true);
			$this->SetXY($postx+8+18+18+50+5+14+10,$decalage);
			$this->Cell(13,5,utf8_decode(round($note_semestre2/$dataSemest[1], 2)),1,1,'C', true);
			$this->SetXY($postx+8+18+18+50+15+13+14,$decalage);
			$this->Cell(9,5,utf8_decode(round(($note_semestre2/$dataSemest[1])/5, 2)),1,1,'C', true);
			$this->SetXY($postx+8+18+18+50+15+13+18+14-9,$decalage);
			$this->Cell(14,5,utf8_decode($credit_semestre2),1,1,'C', true);
			$this->SetXY($postx+8+18+18+50+15+13+18+17+11-9,$decalage);
			$this->Cell(12,5,utf8_decode($this->calcul_apreciation($note_semestre2/$dataSemest[1])),1,1,'C', true);		
			$this->SetXY($postx+8+18+18+50+15+13+18+17+20-7,$decalage);
			$this->Cell(24,5,utf8_decode(''),1,1,'C', true);

			/*-------------------*/
			$decalage = $decalage+5;
			$this->SetFont('times', 'B','8');
			$this->SetXY($postx+8,$decalage);
			$this->SetFillColor(9, 154, 218);
			$this->SetDrawColor(0, 0, 0);
			$this->Cell(90+16,5,utf8_decode('Total/Moyenne Annuelle: '),1,1,'L', true);
			$this->SetXY($postx+8+18+18+50+5+14,$decalage);
			$this->Cell(10,5,utf8_decode('60 '),1,1,'C', true);
			$this->SetXY($postx+8+18+18+50+5+14+10,$decalage);
			$this->Cell(13,5,utf8_decode(round((($note_semestre1/$dataSemest[0])+($note_semestre2/$dataSemest[1]))/2, 2)),1,1,'C', true);
			$this->SetXY($postx+8+18+18+50+15+13+14,$decalage);
			$this->Cell(9,5,utf8_decode(round(((($note_semestre1/$dataSemest[0])+($note_semestre2/$dataSemest[1]))/2)/5, 2)),1,1,'C', true);
			$this->SetXY($postx+8+18+18+50+15+13+18+14-9,$decalage);
			$this->Cell(14,5,utf8_decode($credit_semestre2+$credit_semestre1),1,1,'C', true);
			$this->SetXY($postx+8+18+18+50+15+13+18+17+11-9,$decalage);
			$this->Cell(12,5,utf8_decode($this->calcul_apreciation(round((($note_semestre1/$dataSemest[0])+($note_semestre2/$dataSemest[1]))/2, 2))),1,1,'C', true);		
			$this->SetXY($postx+8+18+18+50+15+13+18+17+20-7,$decalage);
			$this->Cell(24,5,utf8_decode(''),1,1,'C', true);


			/*--------------*/
			$this->Image($qrCode, $postx+88,$posty+$params['post_qr'],$params['size_qr'],$params['size_qr']);
			/*--------------*/
		}

	}
	
	
 ?>