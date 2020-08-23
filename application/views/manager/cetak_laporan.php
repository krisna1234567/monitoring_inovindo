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
        text-align: left;
        table-layout: fixed;
        font-size: 14px;
    }

    th {
        text-align: center;
    }

    td {
        color: black;
    }
</style>
<center>
    <h3>LAPORAN PENDAPATAN INVOICE DAN SUB INVOICE KESELURUHAN</h3>
    <!-- <h3 style="margin-top:-40px; margin-bottom: -2px;"><?= ucwords($ket); ?></h3> -->
</center>
<table border="1">
    <thead>
        <tr>
            <th rowspan="3">No.</th>
            <th rowspan="3">Tanggal Akad</th>
            <th rowspan="3">No Invoice</th>
            <th colspan="2" class="text-center">Nasabah</th>
            <th colspan="2" class="text-center">Nilai </th>
            <th rowspan="3">Jumlah</th>
            <!-- <th colspan="3" class="text-center" style="border: 1px solid black;">Detail</th> -->

        </tr>
        <tr>
            <th rowspan="2">Jenis</th>
            <th rowspan="2">Nama Nasabah</th>
            <th rowspan="2">Invoice</th>
            <th rowspan="2">Sub Invoice</th>
     
        </tr>
        <tr>
            <!-- <th>Jumlah</th>
            <th>Keterangan</th> -->
        </tr>
    </thead>
    <tbody>
        <?php $no=1; ?>
        <?php  $total_invoice=0; 
                $total_sub_invoice =0;
        ?>
        <?php foreach($laporan_pendapatan as $lpr){ ?>
        <tr>
            <td><?= $no; ?></td>
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
            <td><?= rupiah($lpr['total_sub_invoice']); ?></td>
            <td><?=  rupiah($lpr['total_invoice']+$lpr['total_sub_invoice']); ?></td>
            <?php 
                $total_invoice += $lpr['total_invoice'];
                $total_sub_invoice += $lpr['total_sub_invoice'];
            ?>       
        </tr>
        <?php $no++; } ?>
        <tr>
            <td colspan="5">Jumlah</td>
            <td style="text-align: left;"> <?= rupiah($total_invoice);  ?> </td>
            <td style="text-align: left;"> <?= rupiah($total_sub_invoice);  ?> </td>
            <td style="text-align: left;"> <?= rupiah($total_invoice + $total_sub_invoice);  ?> </td>
            
         </tr> 
    </tbody>
</table>