<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion pb-0" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        href="<?= base_url('index.php/admin'); ?>">
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
            <h1 class="h3 mb-2 text-gray-800">Pesanan</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahorder"
                        role="button">Tambah</button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <?= $this->session->flashdata('sukses'); ?>
                        <?= $this->session->flashdata('message'); ?>
                        <?= $this->session->flashdata('input_invoice'); ?>
                        <?= $this->session->flashdata('input_sub_invoice'); ?>
                        <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No Surat</th>
                                    <th>Tanggal</th>
                                    <th>Konsumen</th>
                                    <th>Alamat</th>
                                    <th>No. Telpon</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No Surat</th>
                                    <th>Tanggal</th>
                                    <th>Konsumen</th>
                                    <th>Alamat</th>
                                    <th>No. Telpon</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>

                                <?php foreach($invoices as $inv) { ?>
                                <tr>

                                    <td><?= $inv['no_invoice'] ?></td>
                                    <td><?= longdate_indo($inv['tgl_invoice']); ?></td>
                                    <td><?=  $inv['jns_order1']; ?></td>
                                    <td><?= $inv['alamat']; ?></td>
                                    <td><?= $inv['tlp']; ?></td>
                                    <td><?php if($inv['status_invoice'] == 0 ){
                                       echo 'Pesanan Masuk';
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

                                        <?php if($inv['status_invoice'] == 0 ){
                                      ?>
                                        <a href="<?= base_url()."index.php/admin/edit_invoice/".$inv['id_invoice'];?>"
                                            class="badge badge-primary">Edit</a>
                                        <a href="<?= base_url()."index.php/admin/view_order/".$inv['id_invoice'];?>"
                                            class="badge badge-success">Detail Pesanan</a>

                                        <?php
                                    }elseif($inv['status_invoice'] == 3){
                                        ?>
                                        <a href="<?= base_url()."index.php/admin/view_order/".$inv['id_invoice'];?>"
                                            class="badge badge-success">Detail Pesanan</a>
                                        <?php }elseif($inv['status_invoice'] == 2){
                                        ?>
                                        <a href="<?= base_url()."index.php/admin/view_order/".$inv['id_invoice'];?>"
                                            class="badge badge-success">Detail Pesanan</a>
                                        <?php }elseif($inv['status_invoice'] == 4){
                                        ?>
                                        <a href="<?= base_url()."index.php/admin/view_invoice/".$inv['id_invoice'];?>"
                                            class="badge badge-warning">View</a>
                                        <a href="<?= base_url()."index.php/admin/view_order/".$inv['id_invoice'];?>"
                                            class="badge badge-success">Detail Pesanan</a>
                                        <?php }elseif($inv['status_invoice'] == 5){
                                        echo '-';
                                                   
                                     }else{
                                        ?>
                                        <a href="<?= base_url()."index.php/admin/edit_invoice/".$inv['id_invoice'];?>"
                                            class="badge badge-primary">Edit</a>
                                        <a href="<?= base_url()."index.php/admin/view_order/".$inv['id_invoice'];?>"
                                            class="badge badge-success">Detail Pesanan</a>
                                        <a href="<?= base_url()."index.php/admin/mulai_invoice/".$inv['id_invoice'];?>"
                                            class="badge badge-danger">Submit</a>

                                        <?php } ?>




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
</div>
</div>


<!-- End of Main Content -->


<!-- Modal tambah data -->
<div class="modal fade" id="tambahorder" tabindex="-1" role="dialog" aria-labelledby="tambahorderLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content mt-4 ml-4">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahorderLabel">Tambah Pesanan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="user" method="POST" action="<?= base_url('index.php/admin/tambah_invoice'); ?>"
                style="width: 400px; margin: auto;" !important>
                <div class="form-group mt-4">
                    <input type="text" class="form-control form-control-user" id="no_invoice" name="no_invoice"
                        placeholder="Nomor Surat" required>
                    <?= form_error('no_invoice','<small class="text-danger pl-3">','</small>'); ?>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="exampleFormControlSelect1" style="margin-left: 8px;">Tanggal</label>
                        <input type="date" class="form-control form-control-user" id="tgl" name="tgl"
                            placeholder="Tanggal Masuk Order" required>
                        <?= form_error('tgl','<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1" style="margin-left: 8px;">Konsumen</label><br>
                    <select class="form-control" id="konsumen" name="konsumen">
                        <option>-Pilih Konsumen-</option>
                        <?php  foreach($perusahaan as $prsh) : ?>
                        <option><?= $prsh['nama_perusahaan']; ?> </option>
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
</div>