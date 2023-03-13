
 <!-- sweet alert -->
<script src="<?php echo base_url() ?>vendors/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url() ?>vendors/plugins/sweetalert2/jquery.sweet-alert.init.js"></script>
<!-- jQuery -->
<script src="<?php echo base_url() ?>vendors/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>vendors/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>vendors/dist/js/adminlte.min.js"></script>


<script type="text/javascript">
  
  localStorage.clear();

   $('#from_login').on('submit', function(e) {
      event.preventDefault();
      var formData = new FormData(this);
      let url  = $('meta[name=app-url]').attr("content") + "/Login";
      let url2 = $('meta[name=app-url]').attr("content") + "/Home";

      $.ajax({
          url: url,
          type: "POST",
          cache: false,
          data: formData,
          processData: false,
          contentType: false,
          dataType: "JSON",
          success: function(data) { 

              if (data[0].success == true) {
                $("#password1").val("");
                $("#login").val("");

                  // stockage des kokies
                  localStorage.setItem('id_user', data[0].id);
                  localStorage.setItem('login', data[0].login);
                  localStorage.setItem('password', data[0].password);
                  localStorage.setItem('authorization', 'azerty123ytreza'); 
                  localStorage.setItem('connected', "true");
                  
                  window.location.href = url2;
              
                  $("#success").html(data[0].msg);
                  $("#success").show();
                  $("#errors").hide();
              }else{
                  $("#errors").html(data[0].msg);
                  $("#errors").show();
                  $("#success").hide();
              } 
          },
          error: function(data) {
              console.log(data.responseJSON);
              $("#errors").html('Oousp Quelque chose a mal fonctionner');
              $("#errors").show();
              $("#success").hide();
          }
      });
  });
</script>