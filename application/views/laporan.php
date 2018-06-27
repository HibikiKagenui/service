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
            <td>Rentang Waktu</td>
            <td>: <?php
                if (isset($month)) {
                    switch ($month) {
                        case 1:
                            echo 'Januari';
                            break;
                        case 2:
                            echo 'Februari';
                            break;
                        case 3:
                            echo 'Maret';
                            break;
                        case 4:
                            echo 'April';
                            break;
                        case 5:
                            echo 'Mei';
                            break;
                        case 6:
                            echo 'Juni';
                            break;
                        case 7:
                            echo 'Juli';
                            break;
                        case 8:
                            echo 'Agustus';
                            break;
                        case 9:
                            echo 'September';
                            break;
                        case 10:
                            echo 'Oktober';
                            break;
                        case 11:
                            echo 'November';
                            break;
                        case 12:
                            echo 'Desember';
                            break;
                    }
                    echo ' ';
                }
                echo $year
                ?></td>
        </tr>
        <tr>
            <td>Dibuat pada</td>
            <td>: <?php echo $creation_time ?></td>
        </tr>
    </table>
    <br>
    <h5>Tabel Transaksi Keseluruhan</h5>
    <table border="1" cellpadding="3">
        <thead>
        <tr>
            <th>No.</th>
            <th>ID Transaksi</th>
            <th>ID Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>Kasir</th>
            <th>Hanya Pembelian</th>
            <th>Keluhan</th>
            <th>Tanggal Selesai</th>
            <th>Status</th>
            <th>Keterangan</th>
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
                    <td><?php echo $row->username_kasir ?></td>
                    <td><?php if ($row->hanya_pembelian == 1) echo 'Ya'; else echo 'Tidak'; ?></td>
                    <td><?php echo $row->keluhan ?></td>
                    <td><?php echo $row->waktu_selesai ?></td>
                    <td><?php echo $row->status ?></td>
                    <td><?php echo $row->keterangan ?></td>
                    <td class="text-right"><?php echo $row->subtotal_pembelian ?></td>
                    <td class="text-right"><?php echo $row->subtotal_servis ?></td>
                    <td class="text-right"><?php echo number_format($row->total, 2, ',', '.') ?></td>
                    <td class="text-right"><?php echo number_format($row->dibayar, 2, ',', '.') ?></td>
                </tr>
            <?php }
        } ?>
        </tbody>
    </table>
    <br>
    <h5>Tabel Transaksi Penjualan</h5>
    <table border="1" cellpadding="3">
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
                    <td class="text-right"><?php echo number_format($row->harga, 2, ',', '.') ?></td>
                </tr>
            <?php }
        } ?>
        </tbody>
    </table>
    <br>
    <h5>Tabel Transaksi Servis</h5>
    <table border="1" cellpadding="3">
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
                    <td class="text-right"><?php echo number_format($row->biaya, 2, ',', '.') ?></td>
                </tr>
            <?php }
        } ?>
        </tbody>
    </table>
    <br>
    <h5>Tabel Catatan Stok Suku Cadang</h5>
    <table border="1" cellpadding="3">
        <thead>
        <tr>
            <th>No.</th>
            <th>ID Part</th>
            <th>Nomor Seri</th>
            <th>Waktu</th>
            <th>Keterangan</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($part_detail_log != null) {
            $i = 1;
            foreach ($part_detail_log as $row) { ?>
                <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $row->xid_part ?></td>
                    <td><?php echo $row->part_serial_num ?></td>
                    <td><?php echo $row->waktu ?></td>
                    <td><?php echo $row->keterangan ?></td>
                </tr>
            <?php }
        } ?>
        </tbody>
    </table>
    <br>
    <h5>Tabel Data Pengajuan Pembatalan Transaksi</h5>
    <table border="1" cellpadding="3">
        <thead>
        <tr>
            <th>No.</th>
            <th>ID Transaksi</th>
            <th>Kasir</th>
            <th>Alasan</th>
            <th>Status</th>
            <th>Waktu Pengajuan</th>
            <th>Waktu Acc</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($transaction_cancelations != null) {
            $i = 1;
            foreach ($transaction_cancelations as $row) { ?>
                <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $row->xid_transaction ?></td>
                    <td><?php echo $row->username_kasir ?></td>
                    <td><?php echo $row->alasan ?></td>
                    <td><?php echo $row->status?></td>
                    <td><?php echo $row->submission_time ?></td>
                    <td><?php echo $row->accepted_time ?></td>
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