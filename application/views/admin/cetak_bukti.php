<style>
    table {
        width: 90%;
        font-size: 12pt;
        margin-top: 20px;
    }

    table,
    th,
    td {
        border-collapse: collapse;
        text-align: left;
        table-layout: fixed;
        font-size: 16px;


    }

    td {
        color: black;
        word-wrap: break-word;

    }

    h1 {
        font-size: 40px;
        margin-top: 1px;
    }

    hr {
        background-color: none;
        border-top: 3px solid black;
    }

    #nilai {
        text-align: right;
        float: right;
    }

    .footer {
        margin-left: 30px;
        /* margin-top: 230px; */
        position: fixed;
        top: 520px;
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

        <div class="container-fluid">
            <!-- Page Heading -->
            <form action="<?= base_url("index.php/keuangan/proses_cetak_bukti/".$id_invoice); ?>" method="post">
                <p>Isi Berita Acara</p>
                <input type="text" name="id_invoice" hidden value="<?= $id_invoice; ?>">
                <p>
                    <textarea name="berita" class="texteditor"></textarea>
                </p>
                <p><button type="submit">Simpan</button></p>
            </form>

            <table class="table table-bordered" width="100%" cellspacing="0" style="margin-top:20px">

                <?= $this->session->flashdata('sukses'); ?>
                <thead>
                    <div class="row">
                        <h3>Berita Acara</h3>
                        <a class="nav-link pb-0"
                            href="<?= base_url('index.php/keuangan/export_word/'.$id_invoice);?>">
                            <i class="fas fa-fw fa-file-invoice"></i>
                            <span>Export to word</span></a>
                    </div>
                    <tr>
                        <th>No Invoice</th>
                        <th>Tanggal Akad</th>
                        <th>Petugas</th>
                        <th>Jenis Invoice</th>
                        <th>Perusahaan/Umum</th>
                        <th>Nasabah</th>
                        <th>Deadline Akad</th>
                        <th>Status</th>
                        <th>Berita Acara</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach($invoice as $inv) { ?>
                    <tr>
                        <td><?= $inv['no_invoice']; ?></td>
                        <td><?= longdate_indo($inv['tgl_invoice']); ?></td>
                        <td><?php if($inv['id_user']==0){
                                        echo 'Belum ada petugas';
                                    }else{
                                        echo   $inv['nama_user']; 
                                    } ?>
                        </td>
                        <td><?= $inv['id_order']; ?></td>
                        <td><?= $inv['jns_order1']; ?></td>
                        <td><?= $inv['nasabah']; ?></td>
                        <td><?php if($inv['status_invoice'] == 0){
                                        echo '-';
                                    }elseif($inv['status_invoice'] == 1){
                                        echo '-';
                                    }else{
                                        echo longdate_indo($inv['deadline_akta']); 
                                    } ?>
                        </td>
                        <td>
                            <?php if($inv['status_invoice'] == 0 ){
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
                        <td>
                        <?php foreach($berita as $brt){ 
                                if($brt['berita']== null){
                                    echo "Belum ada berita acara";
                                }else{
                                ?>
                                    <a href="<?= base_url()."index.php/keuangan/edit_berita/".$inv['id_invoice'];?>"
                                    class="badge badge-primary">Edit</a>
                                <a href="<?= base_url()."index.php/keuangan/view_berita/".$inv['id_invoice'];?>"
                                    class="badge badge-warning">View</a>
                                <a href="<?= base_url()."index.php/keuangan/print_berita/".$inv['id_invoice'];?>"
                                    class="badge badge-danger">Print</a>
                                   
                               <?php } ?>
                           <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>



















    <!-- 
<center>
    <h2 style="letter-spacing: 5px; font-size: 22px;">NOTARIS DI JAKARTA</h2>
    <h1 style="margin-bottom: -90px;!important">ABRAHAM YAZDI MARTIN, SH, M.Kn</h1>
    <div class="alamat">
        <span>Kawasan Rasuna Epicentrum, Rasuna Office Park 3 Blok UO-06, Jl. HR.
            Rasuna
            Said,
            Jakarta Selatan 12960
            Telp. : (021) 29912188, 29912189 Fax : (021) 29912268, Email : originalbram@yahoo.com
        </span>
    </div>
    <hr>
</center>

<div class="footer">
    <p style="margin-top: 75px; padding: 2px;">Jakarta, <?= bulan_indo(date("Y-m-d")); ?><br>
        <?= $nama_notaris; ?>
    </p>

    <br>
    <br>
    <br>
    <div>
        <h4><b><u>STEFANI YULIANI, SH.</u></b></h4>
        <p style="margin-top: -20px;">Accounting</p>
    </div>
</div> -->