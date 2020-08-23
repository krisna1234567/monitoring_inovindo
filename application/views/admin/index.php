<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion pb-0" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center"
    href="<?= base_url('index.php/admin'); ?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Admin</div>
  </a>
  <!-- Divider -->

  <hr class="sidebar-divider">
 
  <li class="nav-item">
    <a class="nav-link pb-0" href="<?= base_url('index.php/admin/list_order'); ?>">
      <i class="fas fa-fw fa-file-invoice"></i>
      <span>Order</span></a>
  </li>
  <!-- Heading -->
  <hr class="sidebar-divider">

  <li class="nav-item">
    <a class="nav-link pb-0" href="<?=base_url('index.php/admin/list_perusahaan'); ?>">
      <i class="fas fa-fw fa-users"></i>
      <span>List Pelanggan</span></a>
  </li>
  <hr class="sidebar-divider">
  <!-- <div class="sidebar-heading">
    Rekening
  </div> -->
  <li class="nav-item">
    <a class="nav-link pb-0" href="<?=base_url('index.php/admin/list_atm'); ?>">
      <i class="fas fa-fw fa-file-invoice"></i>
      <span>Rekening</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">
  <li class="nav-item">
    <a class="nav-link pb-0" href="<?= base_url('index.php/auth/logout'); ?>">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Logout</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>

      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">




        <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= ucfirst($user['nama_user']); ?></span>
            <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="<?= base_url('index.php/admin/profile'); ?>">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </a>

            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= base_url('index.php/auth/logout'); ?>" data-toggle="modal"
              data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>

      </ul>

    </nav>
    <!-- End of Topbar -->

    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

      <div class="row">

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Akad Masuk</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $masuk; ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-comments fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Akad Berjalan</div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $mulai; ?> Invoice</div>
                    </div>

                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Akad Selesai</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $selesai; ?> Invoice</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-sign-out-alt fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>

      <div class="row">
        <div class="col-md-12">
          <?php
                foreach($data as $data){
                    $tgl[] = bulan_indo($data->tgl_invoice);
                    // rupiah($data['total_invoice']+$data['total_sub_invoice']);
                   $jum=$data->total_invoice + $data->total_sub_invoice;
                   $jumlah[]= $jum;
                    
                }
                // var_dump($jumlah); die;
            ?>
          <center><h1 class="h3 mb-4 text-gray-800">Grafik Laporan Pendapatan Per Hari</h1></center>
          <canvas id="canvas" width="1000" height="280"></canvas>

        
        </div>

      </div>
      <hr>
      <br>
      <br>
      <div class="row">
        <div class="col-md-12">
          <?php
                foreach($data2 as $data){
                    $tgl2[] = bulan_indo2($data->tgl_invoice);
                    // rupiah($data['total_invoice']+$data['total_sub_invoice']);
                   $jum2=$data->total_invoice + $data->total_sub_invoice;
                    //  $jum3 = rupiah($jum2);
                   $jumlah2[]=$jum2;
                    
                }
                // var_dump($jumlah2); die;
            ?>
          <center><h1 class="h3 mb-4 text-gray-800">Grafik Laporan Pendapatan Per bulan</h1></center>
          <canvas id="canvas2" width="1000" height="280"></canvas>

        </div>

      </div>


      <!-- Content Row -->


    </div>
    <!-- /.container-fluid -->

  </div>

   <!--Load chart js-->
   <script>

var lineChartData = {
  labels: <?php echo json_encode($tgl);?>,
  datasets: [
    {
      label: 'Pendapatan Perhari',
      fillColor: "rgba(100,141,188,0.9)",
      strokeColor: "rgba(60,141,188,0.8)",
      pointColor: "#3b8bba",
      pointStrokeColor: "#fff",
      pointHighlightFill: "#fff",
      pointHighlightStroke: "rgba(152,235,239,1)",
      data: <?php echo json_encode($jumlah);?>
     }

 ]
  
}

var ctx =document.getElementById("canvas").getContext("2d");

var myNewChart = new Chart(ctx, {
type: "line",
data : lineChartData,
});

// perbulan
var lineChartData2 = {
  labels: <?php echo json_encode($tgl2);?>,
  datasets: [
    {
      label: 'Pendapatan Perbulan',
      fillColor: "rgba(60,141,188,0.9)",
      strokeColor: "rgba(60,141,188,0.8)",
      pointColor: "#3b8bba",
      pointStrokeColor: "#fff",
      pointHighlightFill: "#fff",
      pointHighlightStroke: "rgba(152,235,239,1)",
      data: <?php echo json_encode($jumlah2);?>
     }

 ]
  
}

var ctx2 =document.getElementById("canvas2").getContext("2d");

var myNewChart = new Chart(ctx2, {
type: "line",
data : lineChartData2,
});

</script>
  <!-- End of Main Content -->