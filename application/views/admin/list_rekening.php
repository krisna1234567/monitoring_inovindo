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
            <h1 class="h3 mb-2 text-gray-800">Rekening</h1>

            <!-- DataTales Example -->
             <!-- DataTales Example -->
             <div class="card shadow mb-4">
                <div class="card-header py-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahorder" role="button">Tambah</button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <?= $this->session->userdata('sukses'); ?>
                        <?= $this->session->userdata('error'); ?>
                        <?= $this->session->userdata('berhasil'); ?>
                        <?= $this->session->userdata('gagal'); ?>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nomor Rekening</th>
                                    <th>Nama Bank</th>
                                    <th>Nasabah</th>
                                    <th>Aksi</th>
                                   
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nomor Rekening</th>
                                    <th>Nama Bank</th>
                                    <th>Nasabah</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                
                                <?php foreach($rekening as $rek){ ?>
                                <tr>
                                  
                                    <td><?= $rek['no_rekening'] ?></td>
                                    <td><?= $rek['nama_bank'] ?></td>
                                    <td><?= $rek['nama_nasabah'] ?></td>
                                    
                                    <td>
                                        <a href="<?= base_url()."index.php/keuangan/edit_atm/".$rek['id_rekening'];?>"
                                            class="badge badge-success">Ubah</a>
                                       
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
                    <h5 class="modal-title" id="tambahorderLabel">Tambah Rekening Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="user" method="POST" action="<?= base_url('index.php/keuangan/tambah_rekening'); ?>" style="width: 400px; margin: auto;" !important>
                <div class="form-group row">
                        <label for="exampleFormControlSelect1" style="margin-left: 8px;">Nomor Rekening</label>
                            <input type="text" class="form-control form-control-user" id="nomor"
                                name="nomor" required>
                            <?= form_error('nomor','<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <label for="exampleFormControlSelect1" style="margin-left: 8px;">Nama Bank</label>
                            <input type="text" class="form-control form-control-user" id="nama_bank"
                                name="nama_bank" required>
                            <?= form_error('nama_bank','<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <label for="exampleFormControlSelect1" style="margin-left: 8px;">Nama Nasabah</label>
                            <input type="text" class="form-control form-control-user" id="nasabah"
                                name="nasabah" required>
                            <?= form_error('nasabah','<small class="text-danger pl-3">','</small>'); ?>
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