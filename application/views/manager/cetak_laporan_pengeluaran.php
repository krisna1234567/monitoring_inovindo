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
    }
</style>
<center>
    <h3>LAPORAN PENGELUARAN</h3>
    <h3 style="margin-top:-40px; margin-bottom: -2px;"><?= ucwords($ket); ?></h3>
</center>
<table border="1">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Biaya</th>
            <th>Keterangan</th>
            <th>Petugas</th>
        </tr>
    </thead>

    <tbody>
        <?php $no=1; ?>
        <?php foreach($pengeluaran as $pngln) { ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?= $pngln['nama_list_pengeluaran'] ?></td>
            <td><?= longdate_indo($pngln['tgl_pengeluaran']); ?></td>
            <td><?= rupiah($pngln['biaya_pengeluaran']); ?></td>
            <td><?= $pngln['ket_pengeluaran']; ?></td>
            <td><?= $pngln['nama_user']; ?> </td>

        </tr>

        <?php $no++; } ?>
        <tr>
            <td colspan="3">Total</td>
            <td style="text-align: right;"> <?= rupiah($biaya);  ?> </td>

            <td colspan="2"></td>




        </tr>
    </tbody>
</table>