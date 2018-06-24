<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 24-Jun-18
 * Time: 9:19 PM
 */
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width = device-width, initial-scale=1, shrink-to-fit=no">
    <title>LAPORAN PENJUALAN</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <style>
        * {
            font-size: 11pt;
            font-family: 'Times New Roman';
        }
    </style>
</head>
<body onload="window.print()">
<div class="">
    <h3 class="text-center">Laporan Transaksi Penjualan dan Servis Auto-Correct</h3>
    <table>
        <tr>
            <td>Bulan dan tahun</td>
            <td>: <?php echo $month . '-' . $year ?></td>
        </tr>
        <tr>
            <td>Dibuat pada</td>
            <td>: <?php echo $creation_time ?></td>
        </tr>
    </table>
    <br>
    <h5>Tabel Transaksi Keseluruhan</h5>
    <table border="1">
        <thead>
        <tr>
            <th>No.</th>
            <th>ID Transaksi</th>
            <th>ID Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>Hanya Pembelian</th>
            <th>Tanggal Selesai</th>
            <th>Subtotal Jasa Servis</th>
            <th>Subtotal Penjualan Suku Cadang</th>
            <th>TOTAL</th>
            <th>DIBAYAR</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($master != null) {
            $i = 1;
            foreach ($master as $row) { ?>
                <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $row->id ?></td>
                    <td><?php echo $row->id_pelanggan ?></td>
                    <td><?php echo $row->nama_pelanggan ?></td>
                    <td><?php if ($row->hanya_pembelian == 1) echo 'Ya'; else echo 'Tidak'; ?></td>
                    <td><?php echo $row->waktu_selesai ?></td>
                    <td><?php echo $row->subtotal_pembelian ?></td>
                    <td><?php echo $row->subtotal_servis ?></td>
                    <td><?php echo 'Rp ' . number_format($row->total,2,',','.') ?></td>
                    <td><?php echo 'Rp ' . number_format($row->dibayar,2,',','.') ?></td>
                </tr>
            <?php }
        } ?>
        </tbody>
    </table>
    <br>
    <h5>Tabel Transaksi Penjualan</h5>
    <table border="1">
        <thead>
        <tr>
            <th>No.</th>
            <th>ID Transaksi</th>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Nomor Seri</th>
            <th>HARGA</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($part_details != null) {
            $i = 1;
            foreach ($part_details as $row) { ?>
                <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $row->xid_transaction ?></td>
                    <td><?php echo $row->xid_part ?></td>
                    <td><?php echo $row->nama ?></td>
                    <td><?php echo $row->part_serial_num ?></td>
                    <td><?php echo 'Rp ' . number_format($row->harga,2,',','.') ?></td>
                </tr>
            <?php }
        } ?>
        </tbody>
    </table>
    <br>
    <h5>Tabel Transaksi Servis</h5>
    <table border="1">
        <thead>
        <tr>
            <th>No.</th>
            <th>ID Transaksi</th>
            <th>ID Servis</th>
            <th>Nama Servis</th>
            <th>ID Mekanik</th>
            <th>Nama Mekanik</th>
            <th>BIAYA</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($service_details != null) {
            $i = 1;
            foreach ($service_details as $row) { ?>
                <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $row->xid_transaction ?></td>
                    <td><?php echo $row->xid_service ?></td>
                    <td><?php echo $row->nama_servis ?></td>
                    <td><?php echo $row->xid_mechanic ?></td>
                    <td><?php echo $row->nama_mekanik ?></td>
                    <td><?php echo 'Rp ' . number_format($row->biaya,2,',','.') ?></td>
                </tr>
            <?php }
        } ?>
        </tbody>
    </table>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
</body>
</html>