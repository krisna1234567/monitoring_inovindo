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

    th {
        text-align: center;
    }

    td {
        color: black;
    }
</style>
<center>
    <h4>LAPORAN KEUANGAN</h4>

</center>
<table border="1">
    <thead>
        <tr>
           
            <th>Bulan/Tahun</th>
            <th>Total Pendapatan</th>
            <th>Pemasukan</th>
            <th>Sisa Cadangan</th>

        </tr>
    </thead>
    <tbody>
        <?php 
           
            $total_kes=0;
            $total_kes2=0;
            $sisa=0;
            $total_pendapatan=0;
            $total_pemasukan=0;
            $total_sisa=0;
        ?>
        <?php foreach($laporan_keuangan as $lpr){ ?>
        <tr>
            <?php $total_pendapatan = $lpr['total_invoice']+ $lpr['total_sub_invoice'];
                $total_pemasukan = $lpr['total_pemasukan_invoice'] + $lpr['total_pemasukan_sub_invoice'];
                $sisa = $total_pendapatan - $total_pemasukan;
              
              ?>
          
            <td><?= bulan_indo2($lpr['tgl_invoice']); ?></td>
            <td><?= rupiah($total_pendapatan); ?></td>
            </td>
            <td><?=  rupiah($total_pemasukan); ?>
            </td>
            <td><?= rupiah($sisa); ?> </td>

            <?php 
                $total_kes += $total_pendapatan;
                $total_kes2 += $total_pemasukan; 
                $total_sisa += $sisa;
            ?>
        </tr>
        <?php  } ?>
        <tr>
            
            <td>Jumlah</td>
            <td><?= rupiah($total_kes);  ?> </td>
            <td><?= rupiah($total_kes2);  ?> </td>
            <td> <?= rupiah($total_sisa);  ?> </td>
            
         </tr> 

    </tbody>
</table>