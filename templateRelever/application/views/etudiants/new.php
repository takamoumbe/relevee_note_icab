<?php 
include "vendors/plugins/include/head.php";
// if ($this->session->flashdata('message')) {
//   echo $this->session->flashdata('message');
// } 
?>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include "vendors/plugins/include/header.php" ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include "vendors/plugins/include/nav.php" ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="font-weight-bold mb-0">Umbrella Dashboard</h4>
                </div>
                <div>
                  <button type="button" class="btn btn-primary btn-icon-text btn-rounded text-white">
                    <i class="ti-calendar btn-icon-prepend"></i> <span><?php echo date('d-m-Y') ?></span>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card shadow">
                <span class="alert alert-secondary rounded-0 text-center text-dark" style="font-size: 1.4rem; font-family: serif;">
                    AJOUTER UN ETUDIANT
                </span>
                <div class="card-body">
                    <form class="forms-sample" method="POST" enctype="multipart/form-data" action="<?php echo base_url() ?>Enregister_Etudiant">
                        <?php echo form_open('form'); ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <span class="text-right text-danger float-end font-serif">
                                    <?php echo form_error('matricule'); ?>
                                </span>
                                <label for="exampleInputName1">Matricule</label>
                                <input type="text" class="form-control" placeholder="matricule ??tudiant..." name="matricule" autocomplete="off" value="<?php echo set_value('matricule'); ?>"/>
                            </div>

                            <div class="form-group col-md-6">
                                <span class="float-end text-danger">
                                    <?php echo form_error('sexe') ?>
                                </span>
                                <label for="exampleSelectGender">Sexe</label>
                                <select class="form-control bg-white text-dark" name="sexe" style="line-height: 2.2;">
                                    <option value="M">Masculin</option>
                                    <option value="F">Feminin</option>
                                </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <span class="text-right text-danger float-end font-serif">
                                    <?php echo form_error('nom'); ?>
                                </span>
                                <label for="exampleInputName1">Nom(s)</label>
                                <input type="text" class="form-control" placeholder="nom ??tudiant..." minlength="3" maxlength="30" name="nom" autocomplete="off"  value="<?php echo set_value('nom'); ?>"/>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <span class="text-right text-danger float-end font-serif">
                                    <?php echo form_error('prenom'); ?>
                                </span>
                                <label for="exampleInputName1">Pr??nom(s)</label>
                                <input type="text" class="form-control" placeholder="nom ??tudiant..." minlength="3" maxlength="30" name="prenom" autocomplete="off" value="<?php echo set_value('prenom'); ?>"/>
                            </div>
                             
                            <div class="form-group col-md-6">
                                <span class="text-right text-danger float-end font-serif">
                                    <?php echo form_error('date_naiss'); ?>
                                </span>
                                <label for="exampleInputName1">Date Naissance</label>
                                <input type="date" class="form-control" placeholder="matricule ??tudiant..." name="date_naiss" autocomplete="off"  value="<?php echo set_value('date_naiss'); ?>"/>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <span class="text-right text-danger float-end font-serif">
                                    <?php echo form_error('lieu_naiss'); ?>
                                </span>
                                <label for="exampleInputName1">Lieu Naissance</label>
                                <input type="text" class="form-control" placeholder="Lieu naissance ??tudiant..." minlength="3" maxlength="30" name="lieu_naiss" autocomplete="off"  value="<?php echo set_value('lieu_naiss'); ?>"/>
                            </div>

                            <div class="form-group col-md-6 autocomplete">
                                <span class="text-right text-danger float-end font-serif">
                                    <?php echo form_error('filiere'); ?>
                                </span>
                                <label for="exampleInputName1"> Fili??re</label>
                                <input id="myInput" type="text" class="form-control" placeholder="Fili??re ??tudiant..." name="filiere" autocomplete="off"  value="<?php echo set_value('filiere'); ?>"/>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputName1"> Niveau</label>
                                <select class="form-control bg-white text-dark" name="niveau" style="line-height: 2.2;">
                                    <option value="1">BTS I / Licence I</option>
                                    <option value="2">BTS II / Licence II</option>
                                    <option value="3">Licence III</option>
                                    <option value="4">Master I</option>
                                    <option value="5">Master II</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <span class="text-right text-danger float-end font-serif">
                                    <?php echo form_error('contact'); ?>
                                </span>
                                <label for="exampleInputName1"> Contact</label>
                                <input type="text" class="form-control" placeholder="Ex: 657807309" name="contact" maxlength="9" minlength="9" autocomplete="off"  value="<?php echo set_value('contact'); ?>"/>
                            </div>

                            <div class="form-group col-md-6">
                                <span class="text-right text-danger float-end font-serif">
                                    <?php echo form_error('tuteur'); ?>
                                </span>
                                <label for="exampleInputName1"> Tuteur</label>
                                <input type="text" class="form-control" placeholder="Tuteur ??tudiant..." minlength="3" maxlength="30"  name="tuteur" autocomplete="off"  value="<?php echo set_value('tuteur'); ?>"/>
                            </div>

                            <div class="form-group col-md-12">
                                <span class="text-right text-danger float-end font-serif">
                                    <?php echo form_error('image_name'); ?>
                                </span>
                                <label>Photo</label>
                                <input type="file" name="image_name" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="S??lectionnez la photo correspondante ?? l'??tudiant....">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary text-white" type="button"  style="line-height: 1.2;"><b>Upload</b></button>
                                    </span>
                                </div>
                            </div> 
                            <hr>
                        </div>
                        <button type="submit" class="shadow btn btn-primary me-2 text-white">
                            <i class="ti-save-alt mr-2"></i>
                            <span class="mx-2">Enregistrer</span>
                        </button>
                        <button class="btn btn-light shadow-lg" type="reset">
                            <i class="ti-reload mr-2"></i>
                            <span class="mx-2">R??initialis??</span>
                        </button>
                    </form>
                </div>
              </div>
            </div> 
          </div>
        </div>
        <?php include "vendors/plugins/include/footer.php" ?>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <?php include "vendors/plugins/include/js.php" ?>
  <script>
    var countries = [
        "Banque et Institution Financi??re (BIF)",
        "Production Animale (AGRO PA)",
        "Production V??g??tale (AGRO PV)",
        "G??nie Logiciel (GL)",
        "Comptabilit?? Control Audit (CCA)",
        "Comptabilit?? Gestion des Entreprises (CGE)",
        "G??nie Civil (GC)",
        "G??nie Civil Batiments (GC Bat)",
        "G??nie Logistic et Transport (GLT)",
        "Maintenance apr??s Vente Automobile (MAVA)",
        "Marqueting Commerce Vente (MCV)",
        "G??nie Civil Travaux Public (GC TP)",
        "Concepteur D??v??loppeur des r??seaux Informatique (CDRI)",
        "Informatique Industrielle et Automatisme (IIA)",
        "Algeria"
    ];
    autocomplete(document.getElementById("myInput"), countries);
  </script>

</body>

</html>

