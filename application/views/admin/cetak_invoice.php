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
<div class="content" style="margin-left: 30px; margin-top: -120px;">
    <center style="margin-left: -80px;">
        <h3><u><b>INVOICE</b></u></h3>
        <b style="font-weight: 600;"> <?= 'No. '.$no_invoice; ?></b>
    </center>
    <table cellpadding="7" style="font-weight: bold; margin-top: 10px; ">
        <tr>
            <td>Kepada</td>
            <td id="titik">:</td>
            <td><?php if($jns_order1 =='Umum'){
                echo '-';
            }else{
                    echo $jns_order1;
                }
             ?></td>
        </tr>
        <tr>
            <td>Nasabah</td>
            <td id="titik">:</td>
            <td><?= $nasabah; ?></td>
        </tr>
        <tr>
            <td>Dari</td>
            <td id="titik">:</td>
            <td> <?= $nama_notaris; ?></td>
        </tr>

    </table>




    <table border="1" style="width: 90%;">
        <thead>
            <tr>
                <th>NO</th>
                <th style="width: 55%; text-align: center;">BIAYA</th>
                <th style="width: 30%; text-align: center;">NILAI</th>
                <th>KET</th>

            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($invoice as $inv){ ?>
            <tr>
                <td><?= $no; ?></td>
                <td>
                    <?= $inv['nama_lap_invoice']; ?>
                </td>
                <td style="text-align: right;">
                   <?= rupiah($inv['biaya_lap_invoice']); ?>
                </td>
                <td><?= $inv['ket_lap_invoice']; ?></td>
            </tr>
            <?php $no++; } ?>
            <tr>
                <td rowspan="2"></td>
                <td colspan="1"><b>JUMLAH</b></td>
                <td style="text-align: right;">
                <b style="margin-left: 70px;"><?=rupiah($t_inv2); ?> </b>

                <td colspan="1"></td>
            </tr>
</div>

</tr>
<tr>
    <td colspan="3"><b>Terbilang =<i> <?= ucfirst(terbilang($t_inv2)).' rupiah'; ?></i> </b></td>

</tr>
</tbody>
</table>
<br>
<br>
</div>
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

    <p>Note :
    <ol>
        <li> Mohon Pembayaran ditransfer ke rekening -</br></li>
        <li> Bukti transfer mohon di fax ke nomor.021-29912268 </li>
    </ol>
    </p>
</div>