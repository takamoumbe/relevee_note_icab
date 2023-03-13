<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Advanced form elements</title>

 <!-- Include css -->
    <?php include '../../components/css.php'; ?>
  <!-- Include css -->

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
    <?php include '../../components/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include '../../components/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Production des Relevés de Notes <?php echo date("Y") ?></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Importer un fichier Excel</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form>
                  <div class="form-group">
                    <!-- <label for="customFile">Custom File</label> -->

                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" required>
                      <label class="custom-file-label" for="customFile">Choisir un fichier </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-info">Importer</button>
                    <button type="reset" class="btn btn-default">Annuler</button>
                    </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <!-- include footer -->
      <?php include '../../components/footer.php'; ?>
  <!-- include footer -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- include js -->
    <?php include '../../components/js.php'; ?>
<!-- include js -->

<!-- Page specific script -->
</body>
</html>
