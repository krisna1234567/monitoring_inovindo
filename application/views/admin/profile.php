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

        <form class="user" method="POST" action="<?= base_url('index.php/keuangan/proses_edit_profile'); ?>"
            style="width: 400px; margin: auto;" !important>
            <h3>Profile</h3>
            <?= $this->session->flashdata('sukses'); ?>
            <?= $this->session->flashdata('gagal'); ?>
            <div class="form-group mt-4">
                <input type="text" class="form-control form-control-user" id="id_user" name="id_user"
                    placeholder="Nomor Invoice" value="<?=$id_user; ?>" hidden>
                <?= form_error('id_user','<small class="text-danger pl-3">','</small>'); ?>
            </div>
            <div class="form-group mt-4">
                <input type="text" class="form-control form-control-user" id="status" name="status"
                    placeholder="Nomor Invoice" value="<?=$status; ?>" hidden>
                <?= form_error('status','<small class="text-danger pl-3">','</small>'); ?>
            </div>
            <div class="form-group mt-4">
                <input type="text" class="form-control form-control-user" id="role" name="role"
                    placeholder="Nomor Invoice" value="<?=$id_role; ?>" hidden>
                <?= form_error('role','<small class="text-danger pl-3">','</small>'); ?>
            </div>
            <div class="form-group mt-4">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" class="form-control form-control-user" id="username" name="username"
                    value="<?=$username; ?>" required readonly>
                <?= form_error('username','<small class="text-danger pl-3">','</small>'); ?>
            </div>
            <div class="form-group mt-4">
                <label for="exampleInputEmail1">Nama User</label>
                <input type="text" class="form-control form-control-user" id="nama_user" name="nama_user"
                    value="<?=$nama_user; ?>" required>
                <?= form_error('nama_user','<small class="text-danger pl-3">','</small>'); ?>
            </div>
            <div class="form-group mt-4">
                <label for="exampleInputEmail1">No Hp</label>
                <input type="text" class="form-control form-control-user" id="hp" name="hp"
                    value="<?=$hp; ?>" required>
                <?= form_error('hp','<small class="text-danger pl-3">','</small>'); ?>
            </div>
            <div class="form-group mt-4">
                <label for="exampleInputEmail1">Email</label>
                <input type="text" class="form-control form-control-user" id="email" name="email" value="<?=$email; ?>"
                    required>
                <?= form_error('email','<small class="text-danger pl-3">','</small>'); ?>
            </div>
            <hr>
            <center>Silahkan Ubah Password Kalau Password Ingin Dirubah</center>

            <div class="form-group mt-4">
                <label for="exampleInputEmail1"></label>
                <input type="password" class="form-control form-control-user" id="pass1" name="pass1"
                    placeholder="Masukan Password Baru">
                <?= form_error('pass1','<small class="text-danger pl-3">','</small>'); ?>
            </div>

            <div class="form-group mt-4">
                <label for="exampleInputEmail1"></label>
                <input type="password" class="form-control form-control-user" id="pass2" name="pass2"
                    placeholder="Ulangi Password">
                <?= form_error('pass2','<small class="text-danger pl-3">','</small>'); ?>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>

    </div>