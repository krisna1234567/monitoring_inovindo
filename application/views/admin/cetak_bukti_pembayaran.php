<style>
    table {
        width: 100%;
        font-size: 12pt;
        margin-top: 20px;
    }

    table,
    th,
    td {
        border-collapse: collapse;
        text-align: center;
        table-layout: fixed;
        font-size: 14px;
    }

    td {
        color: black;
        text-align: left;
    }
</style>
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
        <a class="nav-link collapsed pb-0" href="#" data-toggle="collapse" data-target="#collapseTree"
            aria-expanded="true" aria-controls="collapseTree">
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


            <center>
                <h3>Laporan Pembayaran Akad</h3>
                <!-- <h3 style="margin-top:-40px; margin-bottom: -2px;"></h3> -->
            </center>
            <div class="row">
                <a class="nav-link pb-0" href="<?= base_url('index.php/keuangan/export_word_bukti_laporan/'.$id_invoice);?>">
                    <i class="fas fa-fw fa-file-invoice"></i>
                    <span>Export to word</span></a>
                <a class="nav-link pb-0" href="<?= base_url('index.php/keuangan/export_excell_bukti_laporan/'.$id_invoice);?>">
                    <i class="fas fa-fw fa-file-invoice"></i>
                    <span>Export to excell</span></a>
                <a class="btn btn-primary"
                    href="<?= base_url()."index.php/keuangan/print_bukti_pembayaran_out/$id_invoice"?>"
                    role="button">Print</a>
            </div>
            <table class="table table-bordered" border="1">
                <thead>
                    <tr>
                        <th rowspan="2">No Invoice</th>
                        <th rowspan="2">Tanggal Akad</th>
                        <th rowspan="2">Jenis Invoice</th>
                        <th colspan="2" class="text-center">Nasabah</th>


                    </tr>
                    <tr>
                        <th rowspan="1">Jenis</th>
                        <th rowspan="1">Nama Nasabah</th>
                </thead>

                <tbody>
                    <?php foreach($invoices_sub as $inv) { ?>
                    <tr>
                        <td> <?= $inv['no_invoice']; ?></td>
                        <td> <?= longdate_indo($inv['tgl_invoice']); ?></td>
                        <td> <?= $inv['id_order']; ?></td>
                        <td><?php $t= 35; if($inv['jns_order1']=='Umum') {
                echo 'Umum';
            }else{
              echo 'Perusahaan : '.$inv['jns_order1'];
            }
                ?></td>
                        <td> <?= $inv['nasabah']; ?></td>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>



            <h3>Invoice</h3>
            <table class="table table-bordered" id="example" border="1" style="margin-top: 5px;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Biaya</th>
                        <th>Nilai</th>
                        <th>Ket.</th>
                        <th>Tgl dibukukan</th>
                        <th>Rekening</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no=1; ?>
                    <?php foreach($lap_invoice as $lpi) { ?>
                    <tr>

                        <th scope="row"><?= $no; ?></th>
                        <td style="width: 52%;"><?= $lpi['nama_lap_invoice']; ?></td>
                        <td><?= rupiah($lpi['biaya_lap_invoice']); ?></td>
                        <td><?= $lpi['ket_lap_invoice']; ?></td>
                        <td><?= longdate_indo($lpi['tgl_pemasukan']); ?></td>
                        <td><?php foreach($banks as $rek){ 
                                if($rek['id_rekening']== $lpi['id_rekening']){
                                    echo $rek['nama_nasabah'];
                                }else{
                                    echo '';
                                }
                            }
                            ?>
                        </td>

                    </tr>
                    <?php $no++; } ?>
                    <tr>
                        <td rowspan="2"></td>
                        <td colspan="1"><b>JUMLAH</b></td>
                        <td style="text-align:left;">
                            <?=rupiah($t_inv2); ?> </td>
                        <td colspan="3"></td>
                    </tr>


                </tbody>
            </table>



            <h3>Sub Invoice</h3>

            <table class="table table-bordered" id="example" border="1" style="margin-top: 5px;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Biaya Titipan</th>
                        <th>Nilai</th>
                        <th>Ket.</th>
                        <th>Tanggal dibukukan</th>
                        <th>Rekening</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no=1; ?>
                    <?php foreach($lap_sub_invoice as $lpsi) { ?>
                    <tr>
                        <th scope="row"><?= $no; ?></th>
                        <td style="width: 52%;"><?= $lpsi['nama_lap_sub_invoice']; ?></td>
                        <td><?= rupiah($lpsi['biaya_lap_sub_invoice']); ?></td>
                        <td><?= $lpsi['ket_lap_sub_invoice']; ?></td>
                        <td><?= longdate_indo($lpsi['tgl_pemasukan']); ?></td>
                        <td><?php foreach($banks as $rek){ 
                                            if($rek['id_rekening']== $lpsi['id_rekening']){
                                                echo $rek['nama_nasabah'];
                                            }else{
                                                echo '';
                                            }
                                        }
                                        ?></td>

                    </tr>
                    <?php $no++; } ?>
                    <tr>
                        <td rowspan="2"></td>
                        <td colspan="1"><b>JUMLAH</b></td>
                        <td style="text-align: left;">
                            <?=rupiah($t_inv_sub); ?> </td>
                        <td colspan="3"></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>