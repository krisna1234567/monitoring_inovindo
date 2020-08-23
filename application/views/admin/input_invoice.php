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
            <h1 class="h3 mb-2 text-gray-800 text-center">Tambah Produk Pesanan</h1>

            <!-- table -->

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No Surat</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Konsumen</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No. Telpon</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($invoices_sub as $inv) { ?>
                    <tr>
                        <td> <?= $inv['no_invoice']; ?></td>
                        <td> <?= longdate_indo($inv['tgl_invoice']); ?></td>
                        <td> <?= $inv['jns_order1']; ?></td>
                        <td> <?= $inv['alamat']; ?></td>
                        <td> <?= $inv['tlp']; ?></td>

                        <td> <?php if($inv['status_invoice'] == 0 ){
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
                    <form action="<?php echo base_url('index.php/admin/proses_input_invoice/'.$inv['id_invoice']);?>"
                        method="post" id="SimpanData">
                        <div class="box-body">
                            <!-- <blockquote>
                                <p><b>Keterangan</b></p>
                                <small><cite title="Source Title">Input yg ditanda bintang merah(<span
                                            style="color:red;"></span>)harus diisi </cite> </small>
                            </blockquote> -->
                            <div class="row">
                                <h3>Tambah Produk Pesanan</h3>
                                <a class="btn btn-primary mb-1 ml-2"
                                    href="<?= base_url()."index.php/admin/cetak_invoice/".$inv['id_invoice'];?>"
                                    role="button">Print</a>
                                <!-- <a class="btn btn-danger mb-1 ml-2"
                                    href="<?= base_url()."index.php/admin/dibukukan_semua/".$inv['id_invoice'];?>"
                                    role="button">Dibukukan Keseluruhan</a> -->

                                <a class="nav-link pb-0"
                                    href="<?= base_url("index.php/admin/export_word_laporan_invoice1/".$inv['id_invoice']);?>">
                                    <i class="fas fa-fw fa-file-invoice"></i>
                                    <span>Export to word</span></a>
                                <a class="nav-link pb-0"
                                    href="<?= base_url("index.php/admin/export_excell_laporan_invoice1/".$inv['id_invoice']);?>">
                                    <i class="fas fa-fw fa-file-invoice"></i>
                                    <span>Export to excell</span></a>


                            </div>
                            <?= $this->session->flashdata('gagal'); ?>
                            <?= $this->session->flashdata('finish'); ?>
                            <?= $this->session->flashdata('input_invoice'); ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Harga</th>
                                        <!-- <th scope="col">Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; ?>
                                    <?php foreach($lap_invoice as $lpi) { ?>
                                    <tr>

                                        <th scope="row"><?= $no; ?></th>
                                        <td style="width: 52%;"><?= $lpi['nama_lap_invoice']; ?></td>
                                        <td><?= $lpi['ket_lap_invoice']; ?></td>
                                        <td><?= rupiah($lpi['biaya_lap_invoice']); ?></td>
                                        
                                    </tr>
                                    <?php $no++; } ?>
                                    <tr>
                                        <td colspan="3"><b>Jumlah</b>
                                        <td><?= rupiah($t_inv);  ?></td>
                                        </td>
                                        <td colspan="2">

                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <br>
                            <table class="table table-bordered" id="tableLoop">
                                <thead>
                                    <tr>

                                        <th>Produk</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th><button class="btn btn-success btn-block" id="BarisBaru"><i
                                                    class="fa fa-plus">New</button></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="text" hidden name="id_invoice" id="id_invoice"
                                        value=" <?= $inv['id_invoice']; ?>">
                                    <input type="text" hidden name="tgl_invoice" id="tgl_invoice"
                                        value=" <?= $inv['tgl_invoice']; ?>">
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer">
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Simpan</button>
                                <!-- <button type="reset" class="btn btn-primary">Batal</button> -->
                            </div>
                        </div>
                    </form>
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
            Baris += '<textarea type="text" name="keterangan[]" class="form-control keterangan"></textarea>';
            Baris += '</td>';
            Baris += '<td>';
            Baris += '<input type="text" name="biaya[]" id="rupiah" required class="form-control biaya">';
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