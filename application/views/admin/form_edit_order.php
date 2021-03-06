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

        <form class="user" method="POST" action="<?= base_url('index.php/admin/proses_edit'); ?>"
            style="width: 400px; margin: auto;" !important>
            <h3>Form Edit Akad</h3>
            <div class="form-group mt-4">
                <input type="text" class="form-control form-control-user" id="id_invoice" name="id_invoice"
                    placeholder="Nomor Invoice" value="<?=$id_invoice; ?>" hidden required>
                <?= form_error('id_invoice','<small class="text-danger pl-3">','</small>'); ?>
            </div>
            <div class="form-group mt-4">
                <label for="exampleInputEmail1">Nomor Invoice</label>
                <input type="text" class="form-control form-control-user" id="no_invoice" name="no_invoice"
                    placeholder="Nomor Invoice" value="<?=$no_invoice; ?>" required>
                <?= form_error('no_invoice','<small class="text-danger pl-3">','</small>'); ?>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="exampleInputEmail1">Tanggal Akad</label>
                    <input type="date" class="form-control form-control-user" id="tgl" name="tgl"
                        value="<?=$tgl_invoice; ?>" required>
                    <?= form_error('tgl','<small class="text-danger pl-3">','</small>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1" style="margin-left: 8px;">Konsumen</label><br>
               
                    <select class="form-control" id="jns_order1" name="jns_order1">
                        <option>-Pilih Konsumen-</option>
                        <?php  foreach($perusahaan as $prsh) : ?>
                        <option <?php if($prsh['nama_perusahaan'] == $jns_order1) { echo 'selected ="selected"'; }?>
                            value="<?= $prsh['nama_perusahaan']; ?>"><?= $prsh['nama_perusahaan']; ?> </option>
                        <?php endforeach; ?>
                    </select>


              
            </div>
            

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>

    </div>