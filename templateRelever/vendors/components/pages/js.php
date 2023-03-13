<!-- jQuery -->
<script src="<?php echo base_url() ?>vendors/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() ?>vendors/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- sweet alert -->
<script src="<?php echo base_url() ?>vendors/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url() ?>vendors/plugins/sweetalert2/jquery.sweet-alert.init.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>vendors/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url() ?>vendors/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url() ?>vendors/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url() ?>vendors/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url() ?>vendors/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url() ?>vendors/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url() ?>vendors/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>vendors/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url() ?>vendors/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url() ?>vendors/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url() ?>vendors/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>vendors/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>vendors/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url() ?>vendors/dist/js/pages/dashboard.js"></script>

<script type="text/javascript">
  let pseudo = localStorage.getItem('login');
  $("#personal").html(pseudo);

   function choixImportation(filiere, num){
        
       let url = $('meta[name=app-url]').attr("content") + "/Printer/"+num+"";

        swal({
          type:'warning',
          backdrop:true,
          allowOutsideClick: false,
          title: 'Traitement !',
          text: "Produire les Relevés de "+filiere+" I (Semestre I && 2)",
          showCancelButton: true,
          confirmButtonText: "J'accepte",
          showLoaderOnConfirm: true,
          cancelButtonText: 'Annuler',
          cancelButtonColor: '#d57171',
          preConfirm: function (email) {
            return new Promise(function (resolve, reject) {
              setTimeout(function () {
                window.location.href = url;
              }, 300)
            })
            window.location.href = "";
          },
        })
    }

    $('#genieLogiciel').click(function () {
      choixImportation('Génie Logiciel', 1);
    });

    $('#banque').click(function () {
      choixImportation('Banque et Institution', 2);
    });

    $('#comptabilite').click(function () {
      choixImportation('Comptabilité', 3);
    });

    $('#genieCivil').click(function () {
      choixImportation('Génie Civil', 4);
    });

    $('#informatique').click(function () {
      choixImportation('Informatique Industrielle', 5);
    });

    $('#maintenanceAuto').click(function () {
      choixImportation('Maintenance Automobile', 6);
    });

    $('#maintenanceSys').click(function () {
      choixImportation('Maintenance des Systèmes Informatiques', 7);
    });

     $('#agronomie').click(function () {
      choixImportation('Agronomie', 8);
    });

    $('#mcv').click(function () {
      choixImportation('Marketing Commerce Vente', 9);
    });

    $('#glt').click(function () {
      choixImportation('Gestion logistique et transport', 12);
    });


    // importation des releves
     $('#from_import').on('submit', function(e) {
      event.preventDefault();
      var formData = new FormData(this);
      let url  = $('meta[name=app-url]').attr("content") + "/Import_excel";

       swal({
          type:'warning',
          backdrop:true,
          allowOutsideClick: false,
          title: 'Traitement !',
          text: "Importer ce fichier ?",
          showCancelButton: true,
          confirmButtonText: "J'accepte",
          showLoaderOnConfirm: true,
          cancelButtonText: 'Annuler',
          cancelButtonColor: '#d57171',
          preConfirm: function (email) {
            return new Promise(function (resolve, reject) {
              setTimeout(function () {
                $.ajax({
                  url: url,
                  type: "POST",
                  cache: false,
                  data: formData,
                  processData: false,
                  contentType: false,
                  dataType: "JSON",
                  success: function(data) { 
                      resolve();
                      if (data[0].success == true) {

                         setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Success !', text: 'Félicitation importation reussir', type: 'success', confirmButtonColor: '#4fa7f3', timer: 10000})}, 500);
                      }else{

                         setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Echec !', text: 'Echec d\'importation', type: 'error', confirmButtonColor: '#4fa7f3', timer: 10000})}, 500);
                      } 
                  },
                  error: function(data) {
                    console.log(data.responseJSON);
                    resolve();
                    setTimeout(function () {swal({backdrop:true, allowOutsideClick: false, title: 'Echec !', text: 'Echec d\'importation', type: 'error', confirmButtonColor: '#4fa7f3', timer: 10000})}, 500);
                  }
              });

              }, 200)
            })
            window.location.href = "";
          },
        })
    });
</script>