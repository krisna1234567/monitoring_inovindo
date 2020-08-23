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
            <h1 class="h3 mb-2 text-gray-800 text-center">Invoice dan Sub Invoice</h1>

            <!-- table -->

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No Invoice</th>
                        <th scope="col">Tanggal Akad</th>
                        <th scope="col">Petugas</th>
                        <th scope="col">Jenis Akad</th>
                        <th scope="col">Perusahaan/Umum</th>
                        <th scope="col">Nasabah</th>
                        <th scope="col">Deadline Akad</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($detail as $inv) { ?>
                    <?php
                      date_default_timezone_set('Asia/Jakarta');
                                         $awal = strtotime($inv['tgl_invoice']);
                                         $today = date("Y-m-d");
                                         $now = strtotime($today);
                                         $interval_deadline = $now-$awal;
                                         $selisih1 = floor($interval_deadline/(60*60*24));
                      ?>
                    <tr>
                        <td> <?= $inv['no_invoice']; ?></td>
                        <td> <?= longdate_indo($inv['tgl_invoice']); ?></td>
                        <td> 
                        <?php if($inv['id_user']==0){
                            echo 'Belum ada petugas';
                            }else{
                            echo   $inv['nama_user']; 
                            } ?>
                        </td>
                        <td> <?= $inv['id_order']; ?></td>
                        <td> <?= $inv['jns_order1']; ?></td>
                        <td> <?= $inv['nasabah']; ?></td>
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
                        </td>
                        <td> <?php if($inv['status_invoice'] == 0 ){
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
                                    ?>
                                    
                        </td>

                    </tr>
                    <?php } ?>

                </tbody>
            </table>


            <div class="col-md-12">
                <div id="notif"></div>

            </div>
            <!-- invoce -->
            <div class="col-md-12" style="margin:10px">
                <div class="box box-solid">
                    <form action="<?php echo base_url('index.php/keuangan/update_invoice')?>" method="post"
                        id="SimpanData2">
                        <div class="box-body">
                            <div class="row">
                            <h4>Invoice</h4>
                            <a class="btn btn-primary mb-1 ml-2"
                                    href="<?= base_url()."index.php/keuangan/cetak_invoice/".$inv['id_invoice'];?>"
                                    role="button">Print</a>
                            </div>
                            <table class="table table-bordered" id="tableLoop">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Invoice</th>
                                        <th>Biaya Invoice</th>
                                        <th>Keterangan Invoice</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count =0;
                                 foreach($invoice as $inv1) : 
                                 $count++;
                                 ?>
                                    <tr>
                                        <td><?= $count;?> </td>
                                        <td><?= $inv1['nama_lap_invoice'];?>
                                        </td>
                                        <td><?= rupiah($inv1['biaya_lap_invoice']); ?></td>
                                        <td><?= $inv1['ket_lap_invoice']; ?></td>
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sub Invoice -->
            <div class="col-md-12" style="margin:10px">
                <div class="box box-solid">
                    <form action="<?php echo base_url('index.php/keuangan/update_sub_invoice')?>" method="post"
                        id="SimpanData2">
                        <div class="box-body">
                             <div class="row">
                            <h4>Sub invoice</h4>
                            <a class="btn btn-primary mb-1 ml-2"
                                    href="<?= base_url()."index.php/keuangan/cetak_sub_invoice/".$inv['id_invoice'];?>"
                                    role="button">Print</a>
                            </div>
                            <table class="table table-bordered" id="tableLoop2">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Sub Invoice</th>
                                        <th>Biaya Sub Invoice</th>
                                        <th>Keterangan Sub Invoice</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count =0;
                                 foreach($invoices_sub as $inv1) : 
                                 $count++;
                                 ?>
                                    <tr>
                                        <td><?= $count;?> </td>
                                        <td><?= $inv1['nama_lap_sub_invoice'];?>
                                        </td>
                                        <td><?= rupiah($inv1['biaya_lap_sub_invoice']); ?></td>
                                        <td><?= $inv1['ket_lap_sub_invoice']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

            <table class="table table-bordered"  width="50%" cellspacing="0" style ="margin-top:20px">
              
              <?= $this->session->flashdata('sukses'); ?>
              <thead>
              <div class="row mb-4">
                <h4>Laporan pembayaran akad</h4>
                <a class="btn btn-primary mb-1 ml-2"
                                    href="<?= base_url()."index.php/keuangan/print_bukti_pembayaran/".$inv['id_invoice'];?>"
                                    role="button">Lihat</a>
            </div>
              <div class="row">
                <h4>Berita acara</h4>
              <a class="nav-link pb-0" href="<?= base_url('index.php/keuangan/export_word/'.$inv['id_invoice']); ?>">
            <i class="fas fa-fw fa-file-invoice"></i>
            <span>Export to word</span></a>
            </div>
                  <tr>
                      <th>Isi Berita Acara</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
             
              <tbody>

                  <?php foreach($berita as $inv) { ?>
                  <tr>
                      <?php $t= 150;  ?>
                      <td><?= substr($inv['berita'],0,$t).'......';?></td>
                     
                      <td>
                          <a href="<?= base_url()."index.php/keuangan/view_berita/".$inv['id_invoice'];?>"
                              class="badge badge-warning">View</a>
                          <a href="<?= base_url()."index.php/keuangan/print_berita/".$inv['id_invoice'];?>"
                              class="badge badge-danger">Print</a>
                      </td>
                  </tr>
                  <?php } ?>
              </tbody>
          </table>
                      
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>