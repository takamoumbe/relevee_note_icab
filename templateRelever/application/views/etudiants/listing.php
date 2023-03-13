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
                  LISTE DES ETUDIANTS
                </span>
                <div class="card-body">
                  <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                    <thead>
                      <tr class="text-uppercase">
                        <th class="d-none">Photo</th>
                        <th>Photo</th>
                        <th>MATRICULE</th>
                        <th>NOMS</th>
                        <th>spécialité</th>
                        <th>Contact</th>
                        <th class="col-md-1">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $i = 1;
                      foreach ($liste_etudiant_actif as $key => $value):;
                        ?>
                        <tr>
                          <td>
                            <img class="rounded-circle" src="<?php echo $value->avatar; ?>" width="50"  height="50">
                          </td>
                          <td class="d-none"><?php echo $value->id ?></td>
                          <td><?php echo $value->matricule ?></td>
                          <td><?php echo $value->nom." ".$value->prenom ?></td>
                          <td><?php echo $value->filiere.' '.$value->niveau ?></td>
                          <td><?php echo number_format($value->contact_etudiant) ?></td>
                          <td class="col-md-1">
                            <a href="#" type="button" class="btn btn-link btn-sm bg-transparent tooltips mr-3 text-dark modifier" style="text-decoration: none;">
                              <i class="ti-pencil-alt text-success"></i>
                            </a>
                            <a href="#" type="button" class="btn btn-link btn-sm bg-transparent tooltips mr-3 text-dark supprimer" style="text-decoration: none;">
                              <i class="ti-trash text-danger"></i>
                            </a>
                            <a href="#" type="button" class="btn btn-link btn-sm bg-transparent tooltips mr-3 text-dark consulter" style="text-decoration: none;">
                              <i class="ti-eye text-primary"></i>
                            </a>
                          </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                      </tbody>
                    </table>
                    <button class="mt-3 btn btn-primary serif text-white fw-bold" id="toggle">Etudiant Inactifs</button>
                  </div>
                </div> 
              </div>
            </div>

            <div class="col-md-12 grid-margin stretch-card mt-4" id="third" style="display: none;">
              <div class="card shadow">
                <span class="alert alert-secondary rounded-0 text-center text-dark" style="font-size: 1.4rem; font-family: serif;">
                  LISTE DES ETUDIANTS INACTIFS
                </span>
                <div class="card-body">
                  <table id="example1" class="table table-striped table-bordered text-center" style="width:100%">
                    <thead>
                      <tr class="text-uppercase">
                        <th class="d-none">Photo</th>
                        <th>Photo</th>
                        <th>MATRICULE</th>
                        <th>NOMS</th>
                        <th>spécialité</th>
                        <th>Contact</th>
                        <th class="col-md-1">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $i = 1;
                      foreach ($liste_etudiant_inactif as $key => $value):;
                        ?>
                        <tr>
                          <td>
                            <img class="rounded-circle" src="<?php echo $value->avatar; ?>" width="50"  height="50">
                          </td>
                          <td class="d-none"><?php echo $value->id ?></td>
                          <td><?php echo $value->matricule ?></td>
                          <td><?php echo $value->nom." ".$value->prenom ?></td>
                          <td><?php echo $value->filiere.' '.$value->niveau ?></td>
                          <td><?php echo number_format($value->contact_etudiant) ?></td>
                          <td class="col-md-1">
                            <a href="#" type="button" class="btn btn-link btn-sm bg-transparent tooltips mr-3 text-dark retablir" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                              <i class="ti-reload text-primary"></i>
                            </a>
                          </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                      </tbody>
                    </table>
                    
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
    </div>

    <script>
      $('.supprimer').click(function () {
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function () {
          return $(this).text();
        }).get();
        console.log(data[1], data[3]);
        var id_individus = data[1];
        var individus = data[3];
        swal({
          type:'warning',
          backdrop:true,
          allowOutsideClick: false,
          title: 'Delete ?',
          text: "Voulez vous supprimer l'étudiant "+individus+" ?",
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
            var redirectURL = "<?php echo base_url('Supprimer_Etudiant') ?>";
            swal({
              backdrop:true,
              allowEscapeKey: false,
              allowOutsideClick: false,
              type: 'success',
              title: 'Félicitation !',
              text: individus+" a bien été supprimé",
              confirmButtonText: "Continuer ",
            }).then(function() {
              window.location = redirectURL+'/'+id_individus;
            });
          }else{
            swal({
              backdrop:true,
              allowOutsideClick: false,
              type: 'error',
              title: 'Désolé !',
              text: "Impossible de supprimer "+individus,
              confirmButtonText: "Continuer ",
              timer: 15000,
            })
          }
        })
      });
    </script>

    <script>
      $('.retablir').click(function () {
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function () {
          return $(this).text();
        }).get();
        console.log(data[1], data[3]);
        var id_individus = data[1];
        var individus = data[3];
        swal({
          type:'question',
          backdrop:true,
          allowOutsideClick: false,
          title: 'Rehabilitate ?',
          text: "Voulez vous réhabiliter "+individus+" ?",
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
            var redirectURL = "<?php echo base_url('Retablir_Etudiant') ?>";
            swal({
              backdrop:true,
              allowEscapeKey: false,
              allowOutsideClick: false,
              type: 'success',
              title: 'Félicitation !',
              text: individus+" a bien été réhabiliter",
              confirmButtonText: "Continuer ",
            }).then(function() {
              window.location = redirectURL+'/'+id_individus;
            });
          }else{
            swal({
              backdrop:true,
              allowOutsideClick: false,
              type: 'error',
              title: 'Désolé !',
              text: "Impossible de réhabiliter "+individus,
              confirmButtonText: "Continuer ",
              timer: 15000,
            })
          }
        })
      });
    </script>

    <script>
      $('.modifier').click(function () {
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function () {
          return $(this).text();
        }).get();
        console.log(data[1], data[3]);
        var id_individus = data[1];
        var individus = data[3];
        swal({
          type:'question',
          backdrop:true,
          allowOutsideClick: false,
          title: 'Update !',
          text: "Voulez vous modifier l'étudiant "+individus+" ?",
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
              }, 1000)
            })
          },
        }).then(function (email) {
          if (email.value) {
            var redirectURL = "<?php echo base_url('Upgrate_Etudiant') ?>";
            window.location = redirectURL+'/'+id_individus;
          }else{
            swal({
              backdrop:true,
              allowOutsideClick: false,
              type: 'error',
              title: 'Désolé !',
              text: "Impossible de modifier "+individus,
              confirmButtonText: "Continuer ",
              timer: 30000,
            })
          }
        })
      });
    </script>
    
    <script>
      $('.consulter').click(function () {
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function () {
          return $(this).text();
        }).get();
        console.log(data[1], data[3]);
        var id_individus = data[1];
        var individus = data[3];
        swal({
          type:'question',
          backdrop:true,
          allowOutsideClick: false,
          title: 'Consulting ?',
          text: "Consulter les données de l'étudiant "+individus+" ?",
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
              }, 1000)
            })
          },
        }).then(function (email) {
          if (email.value) {
            var redirectURL = "<?php echo base_url('Epier_Etudiant') ?>";
            window.location = redirectURL+'/'+id_individus;
          }else{
            swal({
              backdrop:true,
              allowOutsideClick: false,
              type: 'error',
              title: 'Désolé !',
              text: "Impossible de consulter les données de cet étudiant.",
              confirmButtonText: "Continuer ",
              timer: 30000,
            })
          }
        })
      });
    </script>
  </body>
</html>

