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

            <form class="user" method="POST" action="<?= base_url('index.php/keuangan/proses_bukukan_semua_sub'); ?>">

                <center>
                    <table class=" table table-bordered" style="width: 70%;">
                        <center>
                            <h3>Detail Invoice</h3>
                        </center>
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Biaya</th>
                                <th scope="col">Keterangan</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            <?php foreach($bukukan_semua_sub as $book) { ?>
                            <tr>
                                <td><?= $no; ?> </td>
                                <td style="width: 65%;"> <?= $book['nama_lap_sub_invoice']; ?></td>
                                <td><?= rupiah($book['biaya_lap_sub_invoice']); ?></td>
                                <td><?= $book['ket_lap_sub_invoice']; ?></td>

                            </tr>
                            <?php $no++; } ?>

                        </tbody>
                    </table>
                </center>
                <div class="form-group row">
                    <input type="text" class="form-control form-control-user" hidden id="id_invoice" name="id_invoice"
                        value="<?= $book['id_invoice']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1" style="margin-left: 8px;">No Rekening</label>
                    <select class="form-control" id="id_rekening" name="id_rekening" required>
                        <option disabled>-Pilih No. Rekening-</option>
                        <?php foreach($banks as $bank) : ?>
                        <option value="<?= $bank['id_rekening']; ?>"><?= $bank['no_rekening']; ?>
                            (<?= $bank['nama_nasabah']; ?>) </option>
                        <?php endforeach; ?>
                    </select>

                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Keterangan</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan"
                        rows="3"></textarea>
                </div>

                <div class="form-group row">
                    <input type="text" class="form-control form-control-user" hidden id="biaya" name="biaya"
                        value="<?= $t_lap_sub_inv; ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Proses</button>
                </div>
            </form>
        </div>
    </div>