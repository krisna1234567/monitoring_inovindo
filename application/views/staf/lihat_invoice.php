<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion pb-0" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        href="<?= base_url('index.php/staf'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Staf Akta</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
       Akad
    </div>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('index.php/staf/list_order'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Pengerjaan Akad</span></a>
    </li>

    <div class="sidebar-heading">
     
    </div>
    <!-- Nav Item - Dashboard -->
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('index.php/staf/list_invoice_all'); ?>">
            <i class="fas fa-fw fa-file-invoice"></i>
            <span>Monitoring Akad</span></a>
    </li>

    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('index.php/auth/logout'); ?>">
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
                        <a class="dropdown-item" href="<?= base_url('index.php/staf/profile'); ?>">
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

            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <h3>Detail Akad</h3>
                        <tbody>
                            <?php foreach($invoices as $inv) : ?>
                            <tr>
                                <th scope="row">Nomor Invoice</th>
                                <td>: <?= $inv['no_invoice'];  ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal Akad</th>
                                <td>: <?= longdate_indo($inv['tgl_invoice']); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Perusahaan/Umum</th>
                                <td>: <?= $inv['jns_order1'];  ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Nasabah</th>
                                <td>: <?= $inv['nasabah'];  ?></td>
                            </tr>
                                                      
                            <tr>
                                <th scope="row">Jenis Akad</th>
                                <td>: <?= $inv['id_order'];  ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Deadline Akad</th>
                                <td>: <?= longdate_indo($inv['deadline_akta']); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Status</th>
                                <td>: <?php if($inv['status_invoice'] == 0 ){
                                       echo 'Mulai Akad';
                                    }elseif($inv['status_invoice'] == 1 ){
                                        echo 'Proses Kirim Invoice & Sub Invoice';
                                    }elseif($inv['status_invoice'] == 2 ){
                                        echo 'Invoice & Sub Invoice Selesai dibukukan';
                                    }
                                    elseif($inv['status_invoice'] == 3 ){
                                        echo 'Proses Pengerjaan';
                                    }elseif($inv['status_invoice'] == 3 ){
                                        echo 'Finish Pengerjaan';
                                    }
                                    else{
                                        echo 'Selesai';
                                    }
                                    ?></td>
                            </tr>
                            <?php endforeach; ?>
                            
                        </tbody>
                    </table>
                  
                </div>

            </div>

            <!-- Content Row -->


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->