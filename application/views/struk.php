<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 26-Jun-18
 * Time: 12:04 AM
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 24-Jun-18
 * Time: 10:49 AM
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title>STRUK</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width = device-width, initial-scale=1, shrink-to-fit=no">
    <title>LAPORAN PENJUALAN</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <style>
        * {
            font-size: 11pt;
            font-family: 'Consolas';
        }

        img {
            -webkit-filter: grayscale(100%);
            filter: grayscale(100%);
        }
    </style>
</head>
<body onload="window.print()">
<div id="content" class="container-fluid">
    <img src="<?php echo site_url('assets/img/logo.png') ?>" class="d-inline-block align-top" alt="Logo">
    <hr>
    <h3>Detail Transaksi</h3>
    <div>
        <div class="row">
            <div class="form-group col-md-6">
                <label class="font-weight-bold" for="id">ID Transaksi</label>
                <p><?php echo $transaction[0]->id ?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="font-weight-bold" for="xid_customer">ID Customer</label>
                <p><?php echo $transaction[0]->xid_customer ?></p>
            </div>
            <?php if ($transaction[0]->hanya_pembelian == 0) { ?>
                <div class="form-group col-md-3">
                    <label class="font-weight-bold" for="jenis_kendaraan">Jenis Kendaraan</label>
                    <p class="text-capitalize"><?php echo $transaction[0]->jenis_kendaraan ?></p>
                </div>
                <div class="form-group col-md-3">
                    <label class="font-weight-bold" for="nomor_polisi">Nomor Polisi</label>
                    <p class="text-uppercase"><?php echo $transaction[0]->nomor_polisi ?></p>
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold" for="keluhan">Keluhan</label>
                    <p><?php echo $transaction[0]->keluhan ?></p>
                </div>
            <?php } ?>
            <div class="form-group col-md-3">
                <label class="font-weight-bold" for="waktu_mulai">Waktu Mulai</label>
                <p><?php echo $transaction[0]->waktu_mulai ?></p>
            </div>
            <div class="form-group col-md-3">
                <label class="font-weight-bold" for="kasir">Waktu Selesai</label>
                <p><?php echo $transaction[0]->waktu_selesai ?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="font-weight-bold" for="keterangan">Keterangan</label>
                <p><?php if ($transaction[0]->keterangan != '') echo $transaction[0]->keterangan; else echo '-' ?></p>
            </div>
        </div>
    </div>
    <div class="my-3">
        <div class="p-2">
            <h6 class="font-weight-bold">Parts</h6>
            <?php if ($part_details != null) { ?>
                <hr>
                <table class="table table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID Parts</th>
                        <th scope="col">Nama Parts</th>
                        <th scope="col">Serial Num</th>
                        <th scope="col">Harga</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;
                    foreach ($part_details as $row) { ?>
                        <tr>
                            <th scope="row"><?php echo $i++ ?></th>
                            <td><?php echo $row->xid_part ?></td>
                            <td><?php echo $row->nama ?></td>
                            <td><?php echo $row->part_serial_num ?></td>
                            <td class="text-right"><?php echo number_format($row->harga, 2, ',', '.') ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="text-right container-fluid">
                    <table align="right">
                        <tr>
                            <td><b>Subtotal</b></td>
                            <td>:</td>
                            <td><?php echo 'Rp ' . number_format($part_subtotal, 2, ',', '.') ?></td>
                        </tr>
                    </table>
                </div>
            <?php } else { ?>
                <p>(tidak ada)</p>
            <?php } ?>
        </div>
        <?php if ($transaction[0]->hanya_pembelian == 0) { ?>
            <div class="p-2">
                <h6 class="font-weight-bold">Service</h6>
                <?php if ($service_details != null) { ?>
                    <hr>
                    <table class="table table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID Service</th>
                            <th scope="col">Nama Service</th>
                            <th scope="col">ID Mekanik</th>
                            <th scope="col">Nama Mekanik</th>
                            <th scope="col">Biaya</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;
                        foreach ($service_details as $row) { ?>
                            <tr>
                                <th scope="row"><?php echo $i++ ?></th>
                                <td><?php echo $row->xid_service ?></td>
                                <td><?php echo $row->nama_service ?></td>
                                <td><?php echo $row->xid_mechanic ?></td>
                                <td><?php echo $row->mechanic ?></td>
                                <td class="text-right"><?php echo number_format($row->biaya, 2, ',', '.') ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="text-right container-fluid">
                        <table align="right">
                            <tr>
                                <td><b>Subtotal</b></td>
                                <td>:</td>
                                <td><?php echo 'Rp ' . number_format($service_subtotal, 2, ',', '.') ?></td>
                            </tr>
                        </table>
                    </div>
                <?php } else { ?>
                    <p>(tidak ada)</p>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <hr>
    <div class="text-right">
        <table align="right">
            <tbody>
            <tr>
                <td><b>Subotal Pembelian</b></td>
                <td>:</td>
                <td><?php echo number_format($part_subtotal, 2, ',', '.') ?></td>
            </tr>
            <tr>
                <td><b>Subtotal Servis</b></td>
                <td>:</td>
                <td><?php echo number_format($service_subtotal, 2, ',', '.') ?></td>
            </tr>
            <tr>
                <td><b>Total</b></td>
                <td>:</td>
                <td><?php echo 'Rp ' . number_format($transaction[0]->total, 2, ',', '.') ?></td>
            </tr>
            <tr>
                <td><b>Dibayar</b></td>
                <td>:</td>
                <td><?php echo 'Rp ' . number_format($transaction[0]->dibayar, 2, ',', '.') ?></td>
            </tr>
            </tbody>
        </table>
    </div>
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