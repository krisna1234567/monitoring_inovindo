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
            <h1 class="h3 mb-2 text-gray-800 text-center">Edit Produk Pesanan</h1>

            <!-- table -->

            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">No Surat</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Konsumen</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No. Telpon</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($detail as $inv) { ?>
                    <tr>
                        <td> <?= $inv['no_invoice']; ?></td>
                        <td> <?= longdate_indo($inv['tgl_invoice']); ?></td>
                        <td> <?= $inv['jns_order1']; ?></td>
                        <td> <?= $inv['alamat']; ?></td>
                        <td> <?= $inv['tlp']; ?></td>
                      
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
                    <form action="<?php echo base_url('index.php/admin/update_invoice/'.$inv['id_invoice']);?>" method="post"
                        id="SimpanData2">
                        <div class="box-body">
                            <span>
                                <h3>Edit Produk Pesanan</h3>
                               
                            </span>
                            <table class="table table-bordered" id="tableLoop">
                                <thead>
                                    <tr>
                                       
                                        <th>Produk</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th><button class="btn btn-success btn-block" id="BarisBaru2"><i
                                                    class="fa fa-edit">Edit</button></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                 foreach($invoice as $inv1) : 
                                
                                 ?>
                                    <tr>
                                        <!-- <td><?= $count;?> </td> -->
                                        <td><textarea name="nama[]"
                                                class="form-control"><?= $inv1['nama_lap_invoice'];?></textarea>
                                        </td>
                                        <td><textarea name="keterangan[]"
                                                class="form-control"><?= $inv1['ket_lap_invoice'];?></textarea>
                                        </td>
                                       
                                        <td><input type="text" class="form-control" name="biaya[]"
                                                value="<?=$inv1['biaya_lap_invoice']; ?>"></td>
                                        <input type="text" hidden class="form-control" name="id[]"
                                            value="<?= $inv1['id_lap_invoice']; ?>">
                                        <input type="text" hidden class="form-control" name="id_invoice"
                                            value=" <?= $inv['id_invoice']; ?>">
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
         

        </div>
    </div>