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
        <div class="row">
            <form class=" user" method="POST" action="<?= base_url('index.php/keuangan/cari_laporan_pemasukan'); ?>"
                style="width: 800px; margin:auto; " !important>
                <center>
                    <h4>LAPORAN PEMASUKAN INVOICE DAN SUB INVOICE</h4>
                </center>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="exampleInputEmail1">Dari</label>
                        <input type="date" class="form-control form-control-user" id="awal" name="awal" required>
                        <?= form_error('awal','<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="exampleInputEmail1">Sampai</label>
                        <input type="date" class="form-control form-control-user" id="akhir" name="akhir" required>
                        <?= form_error('akhir','<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Cari</button>
                <a class="btn btn-danger" href="<?= base_url()."index.php/keuangan/print_all_laporan"?>" role="button"
                   >Cetak Keseluruhan</a>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="display nowrap table table-bordered" style="width:100%; border: 1;">
                <div class="row">
                        <a class="nav-link pb-0"
                            href="<?= base_url('index.php/keuangan/export_word_laporan');?>">
                            <i class="fas fa-fw fa-file-invoice"></i>
                            <span>Export to word</span></a>
                            <a class="nav-link pb-0"
                            href="<?= base_url('index.php/keuangan/export_excell_laporan');?>">
                            <i class="fas fa-fw fa-file-invoice"></i>
                            <span>Export to excell</span></a>
                    </div>
                    <thead>
                        <tr>
                            <th rowspan="3">Tanggal Finish Akad</th>
                            <th rowspan="3">No Invoice</th>
                            <th colspan="2" class="text-center">Nasabah</th>
                            <th colspan="4" class="text-center">Nilai </th>


                        </tr>
                        <tr>
                            <th rowspan="2">Jenis</th>
                            <th rowspan="2">Nama Nasabah</th>
                           
                            <th rowspan="2">Invoice</th>
                           
                            <th rowspan="2">Sub Invoice</th>
                            <th>Jumlah</th>
                            <!-- <th>Keterangan</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($laporan_all as $lpr){ ?>
                        <tr>
                            <td><?= longdate_indo($lpr['tgl_invoice']); ?></td>
                            <td><?= $lpr['no_invoice']; ?></td>
                            <td><?php $t= 35; if($lpr['jns_order1']=='Umum') {
                                echo 'Umum';
                            }else{
                              echo 'Perusahaan :'.$lpr['jns_order1'];
                            }
                                ?>
                            </td>
                            <td><?= $lpr['nasabah']; ?></td>
                            <td><?= rupiah($lpr['total_invoice']); ?></td>
                           
                            </td>
                           
                            <td><?= rupiah($lpr['total_sub_invoice']); ?></td>
                            
                            </td>
                            <td><?=  rupiah($lpr['total_invoice']+$lpr['total_sub_invoice']); ?>
                            </td>
                           

                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>