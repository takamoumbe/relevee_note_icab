<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Acceuil</title>
  <!-- Include css -->
    <?php include '../../components/css.php'; ?>
  <!-- Include css -->

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
    <?php include '../../components/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    <?php include '../../components/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashbord</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashbord</a></li>
              <li class="breadcrumb-item active">Dashbord v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
             <a href="">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>1</h3>

                    <p>Génie Logiciel</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person"></i>
                  </div>
                </div>
              </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
             <a href="">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>2</h3>

                    <p>Banque et institution</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person"></i>
                  </div>
                </div>
              </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>3</h3>

                  <p>Comptabilité</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
              </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>4</h3>

                  <p>Génie Civil</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
              </div>
            </a>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>5</h3>

                  <p>Informatique industrielle</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
              </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>6</h3>

                  <p>Maintenace Automobile</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
              </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>7</h3>

                  <p>Maintenance des systèmes industrielle</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
              </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>8</h3>

                  <p>Agronomie</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
              </div>
            </a>
          </div>
          <!-- ./col -->
        </div>

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
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
</body>
</html>
