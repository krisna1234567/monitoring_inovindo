<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion pb-0" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center"
    href="<?= base_url('index.php/keuangan'); ?>">
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

                <!-- Nav Item - Alerts -->
              

                        <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span
                            class="mr-2 d-none d-lg-inline text-gray-600 small"><?= ucfirst($user['nama_user']); ?></span>
                        <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('index.php/keuangan/profile'); ?>">
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


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800 text-center">MONITORING AKAD</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                    <?= $this->session->flashdata('input_invoice'); ?>
                    <?= $this->session->flashdata('input_sub_invoice'); ?>
                    <?= $this->session->flashdata('kirim'); ?>
                    <?= $this->session->flashdata('finish'); ?>
                    <?= $this->session->flashdata('update_invoice'); ?>
                    <?= $this->session->flashdata('update_sub_invoice'); ?>
                        <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No Invoice</th>
                                    <th>Tanggal Akad</th>
                                    <th>Petugas</th>
                                    <th>Jenis Akad</th>
                                    <th>Perusahaan/Umum</th>
                                    <th>Nasabah</th>
                                    <th>Deadline Akad</th>
                                    <th>Status</th>
                                    <th>Time Monitoring</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No Invoice</th>
                                    <th>Tanggal Akad</th>
                                    <th>Petugas</th>
                                    <th>Jenis Akad</th>
                                    <th>Perusahaan/Umum</th>
                                    <th>Nasabah</th>
                                    <th>Deadline Akad</th>
                                    <th>Status</th>
                                    <th>Time Monitoring</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>

                                <?php foreach($invoices as $inv) { ?>
                                <tr>

                                <?php
                                         date_default_timezone_set('Asia/Jakarta');
                                         $awal = strtotime($inv['tgl_invoice']);
                                         $today = date("Y-m-d");
                                         $now = strtotime($today);
                                         $interval_deadline = $now-$awal;
                                         $selisih1 = floor($interval_deadline/(60*60*24));
                                         // echo $awal;

                                         if($inv['status_invoice'] == 3 && $selisih1< 15){
                                             $color = "style='background-color:green; color:white;'";
                                            }elseif($inv['status_invoice'] == 4 && $selisih1>= 0){
                                                $color = "style='background-color: orange; color:black; '";
                                            }elseif($inv['status_invoice'] == 3 && $selisih1>=15 && $selisih1<30 ){
                                                $color = "style='background-color:yellow; color:black;'";
                                            }elseif($inv['status_invoice'] == 3 && $selisih1>=30 ){
                                                $color = "style='background-color:red; color:black;'";
                                            }else{
                                            $color = "style='background-color:none;'";
                                         }
                                        ?>

                                    <td><?= $inv['no_invoice']; ?></td>
                                    <td><?= longdate_indo($inv['tgl_invoice']); ?></td>
                                    <td><?php if($inv['id_user']==0){
                                        echo 'Belum ada petugas';
                                    }else{
                                        echo   $inv['nama_user']; 
                                    } ?>
                                   </td>
                                    <td><?= $inv['id_order']; ?></td>
                                    <td><?= $inv['jns_order1']; ?></td>
                                    <td><?= $inv['nasabah']; ?></td>
                                    <td><?php if($inv['status_invoice'] == 0){
                                        echo '-';
                                    }elseif($inv['status_invoice'] == 1){
                                        echo '-';
                                    }else{
                                        echo longdate_indo($inv['deadline_akta']); 
                                    } ?>
                                    </td>
                                    
                                    <td <?= $color; ?> ><?php if($inv['status_invoice'] == 0 ){
                                       echo 'Mulai Akad';
                                    }elseif($inv['status_invoice'] == 1 ){
                                        echo 'Proses Kirim Invoice & Sub Invoice';
                                    }elseif($inv['status_invoice'] == 2 ){
                                        echo 'Invoice & Sub Invoice Selesai dibukukan';
                                    }
                                    elseif($inv['status_invoice'] == 3 ){
                                        echo 'Proses Pengerjaan';
                                    }elseif($inv['status_invoice'] == 4 ){
                                        echo 'Finish Pengerjaan';
                                    }
                                    elseif($inv['status_invoice'] == 5 ){
                                        echo 'Selesai';
                                    }else{
                                        echo '-';
                                    }
                                    ?></td>
                                    <td>
                                    <?php  
                                    if($inv['status_invoice'] == 0){
                                        echo '-';
                                    }elseif($inv['status_invoice'] == 1){
                                        echo '-';
                                    }elseif($inv['status_invoice'] == 2){
                                        echo 'Clear';
                                    }elseif($inv['status_invoice'] == 4){
                                        echo 'Clear';
                                    }elseif($inv['status_invoice'] == 5){
                                        echo 'Clear';
                                    }
                                    else {   
                                        if($selisih1<15){
                                            echo $selisih1.' Hari Berjalan';
                                        }elseif($selisih1>=15 && $selisih1 <30){
                                            echo $selisih1.' Hari Berjalan';
                                        }else{
                                            echo $selisih1.' Hari Berjalan';
                                        }
                                     }
                                        ?>    
                                    </td>
                                    <td>
                                    <?php if($inv['status_invoice'] == 2){
                                        ?>
                                        <a href="<?= base_url()."index.php/keuangan/finish_invoice1/".$inv['id_invoice'];?>"
                                            class="badge badge-danger">Finish</a>
                                    <?php }else{
                                        ?>
                                             <a href="<?= base_url()."index.php/keuangan/view_invoice/".$inv['id_invoice'];?>"
                                            class="badge badge-success">View</a>
                                   <?php } ?>                 
                                        

                                    </td>
                                </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

        