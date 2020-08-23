<style>
    hr {
        background-color: none;
        border-top: 3px solid black;
    }

    h1 {
        font-size: 40px;
        margin-top: 1px;
    }

    .content {
        margin-top: -800px;
        margin-left: 30px;
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
<div class="content">
    <center>
        <h3><u><b>BERITA ACARA</b></u></h3>
    </center>
    <br>
    <p><?= $berita; ?></p>
</div>
<div class="footer" style="margin-top: -500px;">
    <p style="text-align: center;">Jakarta, <?= bulan_indo(date("Y-m-d")).'.'; ?><br>

    </p>
</div>
<br>
<br>
<div class="row" style="margin-left: 25;">
    <center>
        <table width="100%">
            <tr>
                <td>
                    Yang Menerima,
                </td>
                <td>
                    Yang Menyerahkan,

                </td>
            </tr>
            <tr>
                <td></td>
                <td> Kantor Notaris</td>
            </tr>
            <tr>
                <td>
                    <?php 
                        if($jns_order1 =='Umum'){
                            echo $nasabah;
                        }
                        else{
                            echo  $jns_order1.'-'.'Nasabah : '. $nasabah ;
                        }
                    ?>
                </td>
                <td>
                    ABRAHAM YAZDI MARTIN SH, M.Kn
                </td>
            </tr>
        </table>
    </center>

</div>