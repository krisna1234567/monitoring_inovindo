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
            <h1 class="h3 mb-2 text-gray-800">Pengeluaran</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahorder" role="button">Tambah</button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <?= $this->session->flashdata('sukses'); ?>
                        <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                          
                            <thead>
                                <tr>
                                    <th>Tanggal Pengeluaran</th>
                                    <th>Nama Pengeluaran</th>
                                    <th>Nominal</th>
                                    <th>Keterangan</th>
                                    <th>Petugas Keuangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Tanggal Pengeluaran</th>
                                    <th>Nama Pengeluaran</th>
                                    <th>Nominal</th>
                                    <th>Keterangan</th>
                                    <th>Petugas Keuangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                             
                               <?php foreach($pengeluaran as $pngln) { ?>
                                <tr>
                                  
                                    <td><?= longdate_indo($pngln['tgl_pengeluaran']); ?></td>
                                    <td><?= $pngln['nama_list_pengeluaran'] ?></td>
                                    <td><?= rupiah($pngln['biaya_pengeluaran']); ?></td>
                                    <td><?= $pngln['ket_pengeluaran']; ?></td>
                                    <td><?= $pngln['nama_user']; ?> </td>
                                    <td>  
                                        <a href="<?= base_url()."index.php/keuangan/edit_pengeluaran/".$pngln['id_pengeluaran'];?>"
                                            class="badge badge-warning">Edit</a>  
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

    
    <!-- Modal tambah data -->
    <div class="modal fade" id="tambahorder" tabindex="-1" role="dialog" aria-labelledby="tambahorderLabel"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content mt-4 ml-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahorderLabel">Tambah Pengeluaran Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="user" method="POST" action="<?= base_url('index.php/keuangan/tambah_pengeluaran'); ?>" style="width: 400px; margin: auto;" !important>
                <div class="form-group">
                        <label for="exampleFormControlSelect1" style="margin-left: 8px;">Pengeluaran</label>
                        <select class="form-control" id="nama" name="nama" required>
                            <option>-Pilih Pengeluaran-</option>
                            <?php foreach($list_pengeluaran as $plg) : ?>
                            <option value="<?= $plg['id_list_pengeluaran']; ?>"><?= $plg['nama_list_pengeluaran']; ?> </option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                    <div class="form-group row">
                       
                        <label for="exampleFormControlSelect1" style="margin-left: 8px;">Tanggal</label>
                            <input type="date" class="form-control form-control-user" id="tgl"
                                name="tgl" placeholder="Tanggal Pengeluaran" required>
                       
                    </div>
                    <div class="form-group row">
                        
                        <label for="exampleFormControlSelect1" style="margin-left: 8px;">Nominal</label>
                            <input type="text" class="form-control form-control-user" id="biaya"
                                name="biaya"required>
                        
                    </div>
                    <div class="form-group row">
                        
                        <label for="exampleFormControlSelect1" style="margin-left: 8px;">Keterangan</label>
                            <textarea class="form-control" id="keterangan"
                                name="keterangan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1" style="margin-left: 8px;">Petugas Keuangan</label>
                        <select class="form-control" id="petugas" name="petugas" required>
                            <option>-Pilih Petugas-</option>
                            <?php foreach($users as $user) : ?>
                            <option value="<?= $user['id_user']; ?>"><?= $user['nama_user']; ?> </option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>

</script>