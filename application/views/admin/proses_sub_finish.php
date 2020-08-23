<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion pb-0" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center"
    href="<?= base_url('index.php/keuangan'); ?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Keuangan</div>
  </a>
  <!-- Divider -->

  <hr class="sidebar-divider">
  <!-- <div class="sidebar-heading">
    Akad
  </div> -->
  <li class="nav-item">
    <a class="nav-link collapsed pb-0" href="#" data-toggle="collapse" data-target="#collapseTree" aria-expanded="true"
      aria-controls="collapseTree">
      <i class="fas fa-fw fa-wallet"></i>
      <span>Akad</span>
    </a>
    <div id="collapseTree" class="collapse" aria-labelledby="headingTree" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
        <a class="collapse-item" href="<?= base_url('index.php/keuangan/list_order');?>">Mulai Akad</a>
        <a class="collapse-item" href="<?= base_url('index.php/keuangan/list_jns_order');?>">Jenis Akad</a>
      </div>
    </div>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Nav Item - Pages Collapse Menu -->
  <!-- <div class="sidebar-heading">
    Monitoring Akad
  </div> -->
  <li class="nav-item">
    <a class="nav-link pb-0" href="<?= base_url('index.php/keuangan/list_invoice_all'); ?>">
      <i class="fas fa-fw fa-file-invoice"></i>
      <span>Monitoring Akad</span></a>
  </li>
  <!-- Heading -->
  <hr class="sidebar-divider">
  <!-- <div class="sidebar-heading">
    List Pengeluaran
  </div> -->
  <li class="nav-item">
    <a class="nav-link pb-0" href="<?=base_url('index.php/keuangan/list_pengeluaran_add'); ?>">
      <i class="fas fa-fw fa-file-invoice-dollar"></i>
      <span>List Pengeluaran</span></a>
  </li>

  <hr class="sidebar-divider">
  <!-- <div class="sidebar-heading">
    Pengeluaran
  </div> -->
  <li class="nav-item">
    <a class="nav-link pb-0" href="<?=base_url('index.php/keuangan/list_pengeluaran'); ?>">
      <i class="fas fa-fw fa-money-check-alt"></i>
      <span>Pengeluaran</span></a>
  </li>

  <hr class="sidebar-divider">
  <!-- <div class="sidebar-heading">
    Report
  </div> -->
  <li class="nav-item">
    <a class="nav-link collapsed pb-0" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fas fa-fw fa-dollar-sign"></i>
      <span>Report</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
        <a class="collapse-item" href="<?= base_url('index.php/keuangan/laporan_pendapatan');?>">Total Pendapatan</a>
        <a class="collapse-item" href="<?= base_url('index.php/keuangan/laporan');?>">Pemasukan</a>
        <a class="collapse-item" href="<?= base_url('index.php/keuangan/laporan_keuangan');?>">Keuangan</a>
        <a class="collapse-item" href="<?= base_url('index.php/keuangan/pengeluaran');?>">Pengeluaran</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider">
  <!-- <div class="sidebar-heading">
    Perusahaan
  </div> -->
  <li class="nav-item">
    <a class="nav-link pb-0" href="<?=base_url('index.php/keuangan/list_perusahaan'); ?>">
      <i class="fas fa-fw fa-users"></i>
      <span>List Perusahaan</span></a>
  </li>
  <hr class="sidebar-divider">
  <!-- <div class="sidebar-heading">
    Rekening
  </div> -->
<li class="nav-item">
  <a class="nav-link pb-0" href="<?=base_url('index.php/keuangan/list_atm'); ?>">
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

            <form class="user" method="POST" action="<?= base_url('index.php/keuangan/proses_finish_sub'); ?>">

                <center>
                    <table class=" table table-bordered" style="width: 70%;">
                        <center>
                            <h3>Detail Sub Invoice</h3>
                        </center>
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Biaya</th>
                                <th scope="col">Keterangan</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            <?php foreach($t_lap_sub_invoice as $tlsi) { ?>
                            <tr>
                               
                                <td style="width: 65%;"><?= $tlsi['nama_lap_sub_invoice']; ?></td>
                                <td><?= rupiah($tlsi['biaya_lap_sub_invoice']); ?></td>
                                <td><?= $tlsi['ket_lap_sub_invoice']; ?></td>


                            </tr>
                            <?php  } ?>

                        </tbody>
                    </table>
                </center>
                <hr>
                <h1 class="h3 mb-2 text-gray-800">Pilih Bank</h1>
                <input type="text" class="form-control form-control-user" hidden id="id_lap_sub_invoice"
                                    name="id_lap_sub_invoice" value="<?= $tlsi['id_lap_sub_invoice']; ?>">

                <div class="form-group mt-4">
                    <input type="text" class="form-control form-control-user" hidden id="id_invoice" name="id_invoice"
                        value="<?= $id_invoice; ?>">
                </div>
                <div class="form-group mt-4">
                    <input type="text" class="form-control form-control-user" hidden id="tgl_invoice" name="tgl_invoice"
                        value="<?= $tgl_invoice; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1" style="margin-left: 8px;">No Rekening</label>
                    <select class="form-control" id="id_rekening" name="id_rekening" required>
                        <option disabled>-Pilih No. Rekening-</option>
                        <?php foreach($banks as $bank) : ?>
                        <option value="<?= $bank['id_rekening']; ?>"><?= $bank['nama_bank']; ?>-<?= $bank['no_rekening'];?>-<?= $bank['nama_nasabah'];?>
                           </option>
                        <?php endforeach; ?>
                    </select>

                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Keterangan</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan"
                        rows="3"></textarea>
                </div>
                <div class="form-group row">

                    <input type="text" class="form-control form-control-user" hidden  id="biaya"
                        name="biaya" value="<?= $tlsi['biaya_lap_sub_invoice']; ?>">

                </div>

            
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Proses Finish</button>
                </div>
            </form>
        </div>
    </div>