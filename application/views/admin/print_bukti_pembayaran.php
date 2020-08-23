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
<center>
    <h3>Laporan Pembayaran Akad</h3>
    <!-- <h3 style="margin-top:-40px; margin-bottom: -2px;"></h3> -->
</center>
<table border="1">
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


<center>
    <h3>Invoice</h3>
</center>
<table border="1" style="margin-top: 5px;">
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

<center>

    <h3>Sub Invoice</h3>
</center>
<table border="1" style="margin-top: 5px;">
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