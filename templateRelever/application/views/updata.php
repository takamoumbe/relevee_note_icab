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
                    <form class="forms-sample" action="<?php echo base_url() ?>Save">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputName1">Matricule</label>
                                <input type="text" class="form-control" placeholder="matricule étudiant..." name="matricule" autocomplete="off" required/>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputName1">Nom(s)</label>
                                <input type="text" class="form-control" placeholder="nom étudiant..." minlength="3" maxlength="30" name="nom" autocomplete="off" required/>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputName1">Date Naissance</label>
                                <input type="date" class="form-control" placeholder="matricule étudiant..." name="date_nais" autocomplete="off" required/>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputName1">Lieu Naissance</label>
                                <input type="text" class="form-control" placeholder="Lieu naissance étudiant..." minlength="3" maxlength="30" name="lieu_nais" autocomplete="off" required/>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleSelectGender">Sexe</label>
                                <select class="form-control bg-white text-dark" name="sexe" style="line-height: 2.2;">
                                    <option value="M">Masculin</option>
                                    <option value="F">Feminin</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputName1"> Contact</label>
                                <input type="text" class="form-control" placeholder="Ex: 657807309" name="contact" maxlength="9" minlength="9" autocomplete="off" required/>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputName1"> Filière</label>
                                <input type="text" class="form-control" placeholder="Filière étudiant..." name="filiere" autocomplete="off" required/>
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
                                <label for="exampleInputName1"> Tuteur</label>
                                <input type="text" class="form-control" placeholder="Tuteur étudiant..." minlength="3" maxlength="30"  name="tuteur" autocomplete="off"/>
                            </div>

                            <div class="form-group col-md-5">
                                <label>Photo</label>
                                <input type="file" name="img" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Sélectionnez la photo...">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary text-white" type="button"  style="line-height: 1.2;"><b>Upload</b></button>
                                    </span>
                                </div>
                            </div> 
                            <div class="form-group col-md-1">
                                <label>Image</label>
                                <img class="rounded-circle" src="<?php echo $value->avatar; ?>" width="50"  height="50">
                            </div> 

                            <hr>
                        </div>
                        <button type="submit" class="shadow btn btn-primary me-2 text-white"><i class="ti-save-alt mr-2"></i>&nbsp;&nbsp;<span class="ml-2">Enegister</span></button>
                        <button class="btn btn-light shadow" type="reset"><i class="ti-reload mr-2"></i>&nbsp;&nbsp;<span class="ml-2">Réinitialisé</span></button>
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
  

</body>

</html>

