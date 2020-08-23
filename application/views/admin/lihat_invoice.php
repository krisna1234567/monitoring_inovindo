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
            <h1 class="h3 mb-2 text-gray-800 text-center">Invoice dan Sub Invoice</h1>

            <!-- table -->

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No Invoice</th>
                        <th scope="col">Tanggal Akad</th>
                        <!-- <th scope="col">Petugas</th> -->
                        <th scope="col">Jenis Invoice</th>
                        <th scope="col">Perusahaan/Umum</th>
                        <th scope="col">Nasabah</th>
                        <!-- <th scope="col">Deadline Akad</th> -->
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($invoices_sub as $inv) { ?>
                    <tr>
                        <td> <?= $inv['no_invoice']; ?></td>
                        <td> <?= longdate_indo($inv['tgl_invoice']); ?></td>
                        <td> <?= $inv['id_order']; ?></td>
                        <td> <?= $inv['jns_order1']; ?></td>
                        <td> <?= $inv['nasabah']; ?></td>

                        <td> <?php if($inv['status_invoice'] == 0 ){
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

                    </tr>
                    <?php } ?>

                </tbody>
            </table>


            <div class="col-md-12">
                <div id="notif"></div>

            </div>
            <!-- invoce -->
            <div class="col-md-12" style="margin:10px">
                <div class="box box-solid">
                    <div class="box-body">
                        <!-- <blockquote>
                                <p><b>Keterangan</b></p>
                                <small><cite title="Source Title">Input yg ditanda bintang merah(<span
                                            style="color:red;"></span>)harus diisi </cite> </small>
                            </blockquote> -->
                        <div class="row">
                            <h3>Invoice</h3>
                            <div class="col-md-10">
                                <a class="btn btn-primary mb-1 ml-2"
                                    href="<?= base_url()."index.php/keuangan/cetak_invoice/".$inv['id_invoice'];?>"
                                    role="button">Print</a>
                            </div>
                            <div class="col-md-2" style="margin-left: 1150px; margin-top: -50px;">
                                <!-- <a class="btn btn-danger mb-1 ml-2"
                                    href="<?= base_url()."index.php/keuangan/pembayaran_invoice/".$inv['id_invoice'];?>"
                                    role="button" style="margin-left:-300px;">Lihat Bukti Pembayaran</a> -->
                                <?= $this->session->flashdata('gagal'); ?>
                                <?= $this->session->flashdata('input_invoice'); ?>
                            </div>

                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Biaya</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">Ket</th>
                                    <th scope="col">Aksi</th>
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
                                    <td> <?php if($lpi['status']==1){
                                        echo 'Sudah dibukukan';
                                    } else{ ?>
                                        <a href="<?= base_url()."index.php/keuangan/finish_invoice/".$inv['id_invoice'].'/'.$lpi['id_lap_invoice'].'/'.$inv['tgl_invoice'];?>"
                                            class="badge badge-danger">Dibukukan</a>
                                    </td>
                                    <?php } ?>
                                </tr>
                                <?php $no++; } ?>

                            </tbody>
                        </table>

                    </div>
                </div>

                <!-- Sub Invoice -->
                <div class="col-md-12" style="margin:10px">
                    <div class="box box-solid">

                        <div class="box-body">
                            <!-- <blockquote>
                                <p><b>Keterangan</b></p>
                                <small><cite title="Source Title">Input yg ditanda bintang merah(<span
                                            style="color:red;"></span>)harus diisi </cite> </small>
                            </blockquote> -->
                            <div class="row">
                                <h3>Sub Invoice</h3>
                                <a class="btn btn-primary mb-1 ml-2"
                                    href="<?= base_url()."index.php/keuangan/cetak_sub_invoice/".$inv['id_invoice'];?>"
                                    role="button">Print</a>
                                <!-- <a class="btn btn-danger mb-1 ml-2"
                                    href="<?= base_url()."index.php/keuangan/pembayaran_sub_invoice/".$inv['id_invoice'];?>"
                                    role="button">Lihat Bukti Pembayaran</a> -->
                                <?= $this->session->flashdata('gagal1'); ?>
                                <?= $this->session->flashdata('input_sub_invoice'); ?>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Biaya Titipan</th>
                                        <th scope="col">Nilai</th>
                                        <th scope="col">Ket</th>
                                        <th scope="col">Aksi</th>
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
                                        <td>
                                            <?php if( $lpsi['status']== 1){
                                            echo 'Sudah dibukukan';
                                        }else{ ?>
                                            <a href="<?= base_url()."index.php/keuangan/finish_sub_invoice/".$inv['id_invoice'].'/'.$lpsi['id_lap_sub_invoice'].'/'.$inv['tgl_invoice'];?>"
                                                class="badge badge-danger">Dibukukan</a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php $no++; } ?>

                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- javascript invoice -->
    <script>
        $(document).ready(function () {
            for (B = 1; B <= 1; B++) {
                BarisBaru();
            }
            $('#BarisBaru').click(function (e) {
                e.preventDefault();
                BarisBaru();
            });
            $("tableLoop tbody").find('input[type=text]').filter(':visible:first').focus();
        });

        function BarisBaru() {
            $(document).ready(function () {
                $("[data-toggle='tooltip']").tooltip();
            });
            // var Nomor = $("#tableLoop tbody tr").length + 1;

            var Baris = '<tr>';
            // Baris += '<td class="text-center">' + Nomor + '</td>';
            Baris += '<td>';
            Baris += '<textarea type="text" name="nama[]" required class="form-control "></textarea>';
            Baris += '</td>';
            Baris += '<td>';
            Baris += '<input type="text" name="biaya[]" id="rupiah" required class="form-control biaya">';
            Baris += '</td>';
            Baris += '<td>';
            Baris += '<input type="text" name="keterangan[]" class="form-control keterangan">';
            Baris += '</td>';
            Baris += '<td class="text-center">';

            Baris += '</td>';
            Baris += '</tr>';

            $("#tableLoop tbody").append(Baris);
            $("tableLoop tbody tr").each(function () {
                $(this).find('td:nth-child(2) input').focus();
            });
        }


        $(document).on('click', '#HapusBaris', function (e) {
            e.preventDefault();
            var Nomor = 1;
            $(this).parent().parent().remove();
            $('tableLoop tbody tr').each(function () {
                $(this).find('td:nth-child(1)').html(Nomor);
                Nomor++;
            });
        });
        $(document).ready(function () {
            $('#SimpanData').submit(function (e) {
                e.preventDefault();
                biodata();
            });
        });

        function biodata() {
            $.ajax({
                url: $("#SimpanData").attr('action'),
                type: 'post',
                cache: false,
                dataType: "json",
                data: $("#SimpanData").serialize(),
                success: function (data) {
                    if (data.success == true) {
                        $('.id_invoice').val('');
                        $('.nama').val('');
                        $('.biaya').val('');
                        $('.keterangan').val('');
                        $('#notif').fadeIn(800, function () {
                            $("#notif").html(data.notif).fadeOut(5000).delay(800);
                        });

                    } else {
                        $('#notif').html('<div class="alert alert-danger">Data Gagal disimpan');

                    }
                },
                error: function (error) {
                    alert(error);
                }
            });
        }
    </script>

    <!-- javascript sub invoice -->
    <script>
        $(document).ready(function () {
            for (B = 1; B <= 1; B++) {
                BarisBaru2();
            }
            $('#BarisBaru2').click(function (e) {
                e.preventDefault();
                BarisBaru2();
            });
            $("tableLoop2 tbody").find('input[type=text]').filter(':visible:first').focus();
        });

        function BarisBaru2() {
            $(document).ready(function () {
                $("[data-toggle='tooltip']").tooltip();
            });
            // var Nomor = $("#tableLoop2 tbody tr").length + 1;

            var Baris = '<tr>';
            // Baris += '<td class="text-center">' + Nomor + '</td>';
            Baris += '<td>';
            Baris += '<textarea type="text" name="nama[]" required class="form-control"></textarea>';
            Baris += '</td>';
            Baris += '<td>';
            Baris += '<input type="text" name="biaya[]" required class="form-control biaya">';
            Baris += '</td>';
            Baris += '<td>';
            Baris += '<input type="text" name="keterangan[]" class="form-control keterangan">';
            Baris += '</td>';
            Baris += '<td class="text-center">';

            Baris += '</td>';
            Baris += '</tr>';

            $("#tableLoop2 tbody").append(Baris);
            $("tableLoop2 tbody tr").each(function () {
                $(this).find('td:nth-child(2) input').focus();
            });
        }

        $(document).on('click', '#HapusBaris', function (e) {
            e.preventDefault();
            var Nomor = 1;
            $(this).parent().parent().remove();
            $('tableLoop2 tbody tr').each(function () {
                $(this).find('td:nth-child(1)').html(Nomor);
                Nomor++;
            });
        });
        $(document).ready(function () {
            $('#SimpanData2').submit(function (e) {
                e.preventDefault();
                biodata();
            });
        });

        function biodata() {
            $.ajax({
                url: $("#SimpanData2").attr('action'),
                type: 'post',
                cache: false,
                dataType: "json",
                data: $("#SimpanData2").serialize(),
                success: function (data) {
                    if (data.success == true) {
                        $('.id_invoice').val('');
                        $('.nama').val('');
                        $('.biaya').val('');
                        $('.keterangan').val('');
                        $('#notif').fadeIn(800, function () {
                            $("#notif").html(data.notif).fadeOut(5000).delay(800);
                        });

                    } else {
                        $('#notif').html('<div class="alert alert-danger">Data Gagal disimpan');

                    }
                },
                error: function (error) {
                    alert(error);
                }
            });
        }
    </script>