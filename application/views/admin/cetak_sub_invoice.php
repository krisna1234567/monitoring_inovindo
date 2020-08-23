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

    }

    h1 {
        font-size: 40px;
        margin-top: 1px;
    }

    hr {
        background-color: none;
        border-top: 3px solid black;
    }

    .footer {
        margin-left: 30px;
        margin-top: 10px;
        position: fixed;
        top: 800px;
    }
</style>
<center>
    <h2 style="letter-spacing: 5px; font-size: 22px;">NOTARIS DI JAKARTA</h2>
    <h1 style="margin-bottom: -50px;!important">ABRAHAM YAZDI MARTIN, SH, M.Kn</h1>
    <div class="alamat">
        <span>Kawasan Rasuna Epicentrum, Rasuna Office Park 3 Blok UO-06, Jl. HR.
            Rasuna
            Said,
            Jakarta Selatan 12960
            Telp. :(021) 29912188, 29912189 Fax : (021) 29912268, Email : originalbram@yahoo.com
        </span>
    </div>
    <hr>
</center>
<div class="content" style="margin-left: 30px; margin-top: -400px;">

    <center style="margin-left: -80px;">
        <h3 style="margin-top: -5px;"><u><b>SUB INVOICE</b></u></h3>
        <b style="font-weight: 600;"> <?= 'No. '.$no_invoice; ?></b>
    </center>
    <table cellpadding="7" style="font-weight: bold; margin-top: -2px; margin-bottom: -10px; ">
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
                <th style="text-align: center;">NO</th>
                <th style="width: 60%; text-align: center;">BIAYA TITIPAN</th>
                <th style="width: 30%; text-align: center;">NILAI</th>
                <th style="text-align: center;">KET</th>

            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($sub_invoice as $s_inv){ ?>
            <tr>
                <td><?= $no; ?></td>
                <td>
                    <?= $s_inv['nama_lap_sub_invoice']; ?>
                </td>
                <td style="text-align: right;">

                   
                       <?= rupiah($s_inv['biaya_lap_sub_invoice']); ?>
                    </div>
                </td>
                <td><?= $s_inv['ket_lap_sub_invoice']; ?></td>
            </tr>
            <?php $no++; } ?>
            <tr>
                <td rowspan="2"></td>
                <td colspan="1"><b>JUMLAH</b></td>
                <td style="text-align: right;">
                   
                        <b style="margin-left: 70px;"><?=rupiah($t_sub_inv2); ?> </b>
                <td colspan="1"></td>

            </tr>
            <tr>
                <td colspan="3"><b>Terbilang =<i> <?= ucfirst(terbilang($t_sub_inv2)).' rupiah'; ?></i> </b></td>

            </tr>
        </tbody>
    </table>
    <br>
    <br>
</div>
<div class="footer">
    <p style="margin-top: 10px;">Jakarta, <?= bulan_indo(date("Y-m-d")); ?><br>
        <?= $nama_notaris; ?>
    </p>
    <br>
    <br>
    <br>
    <div>
        <h4><b><u>STEFANI YULIANI, SH.</u></b></h4>
        <p style="margin-top: -5px;">Accounting</p>
    </div>

</div>