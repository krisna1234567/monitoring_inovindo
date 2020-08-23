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
                    <fieldset color="black">
                        <form class="user" method="POST" action="<?= base_url('index.php/staf/proses_detail'); ?>">
                            <h3>Form Edit Invoice Order</h3>
                            <div class="form-group mt-4">
                                
                                <input type="text" class="form-control form-control-user" id="id_invoice"
                                    name="id_invoice" placeholder="Nomor Invoice" value="<?=$id_invoice; ?>" hidden>
                                <?= form_error('id_invoice','<small class="text-danger pl-3">','</small>'); ?>
                            </div>
                            <div class="form-group mt-4">
                                <label for="exampleInputEmail1">Nomor Invoice</label>
                                <input type="text" class="form-control form-control-user" id="no_invoice"
                                    name="no_invoice" placeholder="Nomor Invoice" value="<?=$no_invoice; ?>" readonly>
                                <?= form_error('no_invoice','<small class="text-danger pl-3">','</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="exampleInputEmail1">Tanggal Invoice</label>
                                    <input type="date" class="form-control form-control-user" id="tgl" name="tgl"
                                        placeholder="Tanggal Masuk Order" value="<?= $tgl_invoice; ?>" readonly>
                                    <?= form_error('tgl','<small class="text-danger pl-3">','</small>'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1" style="margin-left: 8px;">Petugas</label>

                                <input type="text" class="form-control form-control-user" id="staf" name="staf" readonly
                                    <?php  foreach($users as $user) : ?> <?php if($user['id_user'] == $id_user) {?>
                                    value="<?= $user['nama_user']; ?>"> <?php } ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" style="margin-left: 8px;">Jenis Akad</label>

                                <input type="text" class="form-control form-control-user" id="jns_order"
                                    name="jns_order" readonly <?php  foreach($orders as $order) : ?>
                                    <?php if($order['id_order'] == $id_order) { ?> value="<?= $order['jns_order']; ?>">
                                <?php } ?>
                                <?php endforeach; ?>

                            </div>
                            <hr>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1" style="margin-left: 8px;">Perusahaan / Umum </label><br>
                               
                                <div class="form-check form-check-inline">
                                    <input onclick="document.getElementById('inlineRadio2').disabled = false;
                                    document.getElementById('jns_order1').disabled = false;
                                    document.getElementById('input_radio1').disabled = true;" class="detail"
                                        type="radio" name="jns_order1" id="inlineRadio2" value="berbeda">
                                    <label class="form-check-label" for="inlineRadio2"> Perusahaan</label>
                                </div>
                                <div class="form-check form-check-inline ml-2">
                                    <input onclick="document.getElementById('inlineRadio1').disabled = false;
                                    document.getElementById('inlineRadio2').disabled = false;
                                    document.getElementById('jns_order1').disabled = true;" class="detail" type="radio"
                                        name="jns_order1" id="inlineRadio1"  value="Umum" 
                                        <?php if($jns_order1 == 'Pribadi'){ echo 'checked';} ?> >
                                    
                                    <label class="form-check-label" for="inlineRadio1"> Umum</label>
                                </div>
                                <div id="form-input">
                                    <select class="form-control" id="jns_order1" name="jns_order1">
                                        <option>-Pilih Perusahaan-</option> 
                                        <?php  foreach($perusahaan as $prsh) : ?>
                                        <option <?php if($prsh['nama_perusahaan'] == $jns_order1) { echo 'selected ="selected"'; }?>
                                            value="<?= $prsh['nama_perusahaan']; ?>"><?= $prsh['nama_perusahaan']; ?> </option>
                                        <?php endforeach; ?>
                                       
                                       
                                    </select>


                                </div>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Nasabah</label>
                                <input type="text" class="form-control form-control-user" id="nasabah" name="nasabah"
                                    placeholder="Nama Nasabah">
                                <?= form_error('nasabah','<small class="text-danger pl-3">','</small>'); ?>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="status" name="status"
                                        placeholder="Tanggal Masuk Order" value="<?= $status_invoice; ?>" hidden>
                                    <?= form_error('status','<small class="text-danger pl-3">','</small>'); ?>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </fieldset>
                </div>

            </div>

            <!-- Content Row -->


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->