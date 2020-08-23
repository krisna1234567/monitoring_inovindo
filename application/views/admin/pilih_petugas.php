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
        <table class="table ml-4">
            <center>
                <h3 style="margin-left:30px;">Detail Akad</h3>
            </center>
            <?= $this->session->flashdata('finish'); ?>
            <?= $this->session->flashdata('kirim'); ?>
            <thead>
                <tr>
                    <th scope="col">No Invoice</th>
                    <th scope="col">Tanggal Akad</th>
                    <th scope="col">Perusahaan</th>
                    <th scope="col">Nasabah</th>
                    <th scope="col">Jenis Invoice</th>
                    <th scope="col">Petugas</th>
                    <th scope="col">Status</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach($invoice as $inv) { ?>
                <tr>
                    <td> <?= $inv['no_invoice']; ?></td>
                    <td> <?= longdate_indo($inv['tgl_invoice']); ?></td>
                    <td> <?= $inv['jns_order1']; ?></td>
                    <td> <?= $inv['nasabah']; ?></td>
                    <td> <?= $inv['id_order']; ?></td>
                    <td> <?php if($inv['id_user']==0){
                                        echo 'Belum ada petugas';
                                    }else{
                                        echo   $inv['nama_user']; 
                                    } ?></td>
                    <td><?php if($inv['status_invoice'] == 0 ){
                                       echo 'Mulai Akad';
                                    }elseif($inv['status_invoice'] == 1 ){
                                        echo 'Proses Kirim Invoice & Sub Invoice';
                                    }elseif($inv['status_invoice'] == 2 ){
                                        echo 'Proses Pengerjaan';
                                    }elseif($inv['status_invoice'] == 3 ){
                                        echo 'Finish Pengerjaan';
                                    }
                                    else{
                                        echo 'Selesai';
                                    }
                                    ?>
                    </td>

                    <?php } ?>
                </tr>
            </tbody>
        </table>
        <form class="user" method="POST" action="<?= base_url('index.php/keuangan/proses_mulai_invoice'); ?>"
            style="width: 400px; margin: auto;" !important>
            <div class="form-group mt-4">
                <input type="text" class="form-control form-control-user" id="id_invoice" hidden name="id_invoice"
                    value="<?= $inv['id_invoice']; ?>" required>
                <?= form_error('id_invoice','<small class="text-danger pl-3">','</small>'); ?>
            </div>

            <div class="form-group mt-4">
                <select class="form-control" id="id_user" name="id_user">
                    <option>-Pilih Petugas-</option>
                    <?php  foreach($users as $prsh) : ?>
                    <option value="<?= $prsh['id_user']; ?>"><?= $prsh['nama_user']; ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="modal-footer">
                      
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
    </div>
    </form>
       