<?php 
include "vendors/plugins/include/head.php";
if ($this->session->flashdata('message')) {
  echo $this->session->flashdata('message');
} 
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
                  <h4 class="font-weight-bold mb-0">Impressions de cartes des etudiants ICAB</h4>
                </div>
                <div>
                  <button type="button" class="btn btn-primary btn-icon-text btn-rounded text-white shadow">
                    <i class="ti-calendar btn-icon-prepend"></i> <span><?php echo date('d-m-Y') ?></span>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="row"> 
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="">
                      <form method="post" action="<?php echo base_url('Import_excel');?>" enctype="multipart/form-data">
                       <div class="row">
                        <div class="form-group col-md-5 bg-transparent">
                          <label>Importer les Listes Excel</label>
                          <input type="file" name="upload_file" class="file-upload-default">
                          <div class="input-group col-xs-12 shadow  bg-transparent">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Liste au format excel des étudiants...">
                            <span class="input-group-append  bg-transparent">
                              <button class="file-upload-browse btn btn-primary text-white" type="button"  style="line-height: 1.2;">
                                <b>
                                  <i class=" ti-import"></i>&nbsp;Import
                                </b>
                              </button>
                              <button type="submit" id="btn-importation" class="btn btn-primary  col-xm-12 shadow btn-icon-text text-white">
                               <b><i class="ti-save-alt btn-icon-prepend"></i> Saving</b>
                             </button>
                              </span>
                            </div>
                          </div>
                          <div class="form-group col-md-7">
                            <label>Opérations</label>
                            <div class=" col-xs-12">
                              <a type="button" id="exportation" class="btn btn-primary col-xm-12 shadow btn-icon-text text-white">
                                <b><i class="ti-export btn-icon-prepend"></i> Excel</b>
                              </a> 
                              <a id="print-card" class="btn btn-primary col-xm-12 shadow btn-icon-text text-white ml-2">
                                <b><i class="ti-id-badge btn-icon-prepend"></i> Produire Cartes</b>
                              </a>
                              <a type="button" id="" class="btn btn-primary col-xm-12 shadow btn-icon-text text-white ml-2">
                                <b><i class="ti-save-alt btn-icon-prepend"></i> Export DB</b>
                              </a>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>    
            </div>
             <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left"><b>total Etudiants</b></p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <?php $i = 1; 
                    foreach ($count_etudiants as $etudiants) : ;
                      foreach ($count_etudiant_actif as $etudiants_actif) : ;
                        foreach ($count_etudiant_inactif as $etudiants_inactif) : ;
                          ?>
                        <?php endforeach ?>
                      <?php endforeach ?>
                    <?php endforeach ?>
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?php echo $etudiants; ?></h3>
                    <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
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
    $('#exportation').click(function () {
      swal({
        type:'warning',
        backdrop:true,
        allowOutsideClick: false,
        title: 'Exportation !',
        text: "Etes vous sur de vouloir exporter cette liste ?",
        showCancelButton: true,
        confirmButtonText: "J'accepte",
        showLoaderOnConfirm: true,
        cancelButtonText: 'Annuler',
        cancelButtonColor: '#d57171',
        preConfirm: function (email) {
          return new Promise(function (resolve, reject) {
            setTimeout(function () {
              if (email === 'taken@example.com') {
                reject('This email is already taken.')
              } else {
                resolve()
              }
            }, 3000)
          })
        },
      }).then(function (email) {
        if (email.value) {
          var redirectURL = "<?php echo base_url('Export_excel') ?>";
          swal({
            backdrop:true,
            allowEscapeKey: false,
            allowOutsideClick: false,
            type: 'success',
            title: 'Félicitation !',
            text: 'Liste des étudiants exorter avec success !',
            confirmButtonText: "Continuer ",
          }).then(function() {
            window.location = redirectURL;
          });
        }else{
          swal({
            backdrop:true,
            allowOutsideClick: false,
            type: 'error',
            title: 'Désolé !',
            text: 'Echec lors de l\'exportation !',
            confirmButtonText: "Continuer ",
            timer: 15000,
          })
        }
      })
    });
  </script>

  <script>
    $('#print-card').click(function () {
      swal({
        type:'warning',
        backdrop:true,
        allowOutsideClick: false,
        title: 'Print !',
        text: "Etes vous sur de vouloir générer les cartes d\'étudiants ?",
        showCancelButton: true,
        confirmButtonText: "J'accepte",
        showLoaderOnConfirm: true,
        cancelButtonText: 'Annuler',
        cancelButtonColor: '#d57171',
        preConfirm: function (email) {
          return new Promise(function (resolve, reject) {
            setTimeout(function () {
              if (email === 'taken@example.com') {
                reject('This email is already taken.')
              } else {
                resolve()
              }
            }, 300)
          })
        },
      }).then(function (email) {
        if (email.value) {
          var redirectURL = "<?php echo base_url('Print_cart') ?>";
          swal({
            backdrop:true,
            allowEscapeKey: false,
            allowOutsideClick: false,
            type: 'success',
            title: 'Félicitation !',
            text: ' cartes d\'étudiants ont été générés avec success !',
            confirmButtonText: "Continuer ",
          }).then(function() {
            window.location = redirectURL;
          });
        }else{
          swal({
            backdrop:true,
            allowOutsideClick: false,
            type: 'error',
            title: 'Désolé !',
            text: 'Echec lors de la génération des cartes d\'étudiants !',
            confirmButtonText: "Continuer ",
            timer: 15000,
          })
        }
      })
    });
  </script>

  <script>
    $("#btn-importation").on('click', function (e) {
      e.preventDefault();
      var form = $(this).parents('form');
      swal({
        type:'warning',
        backdrop:true,
        allowOutsideClick: false,
        title: 'Saving !',
        text: "Etes vous sur de vouloir importer cette liste ?",
        showCancelButton: true,
        confirmButtonText: "J'accepte",
        showLoaderOnConfirm: true,
        cancelButtonText: 'Annuler',
        cancelButtonColor: '#d57171',
        preConfirm: function (email) {
          return new Promise(function (resolve, reject) {
            setTimeout(function () {
              if (email === 'taken@example.com') {
                reject('This email is already taken.')
              } else {
                resolve()
              }
            }, 300)
          })
        },
      }).then(function (email) {
        if (email.value) {
          var redirectURL = "<?php echo base_url('Exit') ?>";
          swal({
            backdrop:true,
            allowEscapeKey: false,
            allowOutsideClick: false,
            type: 'success',
            title: 'Félicitation !',
            text: 'Liste des étudiants encours d\'importation !',
            confirmButtonText: "Continuer ",
          }).then(function() {
            form.submit();
          });
        }else{
          swal({
            backdrop:true,
            allowOutsideClick: false,
            type: 'error',
            title: 'Désolé !',
            text: 'Echec lors de l\'importation de la liste des étudiants !',
            confirmButtonText: "Continuer ",
            timer: 15000,
          })
        }
      })
    })
  </script>
</body>

</html>

