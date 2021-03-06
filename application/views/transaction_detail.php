<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 24-Jun-18
 * Time: 10:49 AM
 */
?>
<div id="content" class="container-fluid">
    <a href="<?php echo site_url('site/transactions') ?>" class="btn btn-primary">
        <span class="fas fa-chevron-left"></span> Kembali
    </a>
    <hr>
    <h3>
        Detail Transaksi |
        <?php
        switch ($transaction[0]->status) {
            case 'done':
                echo '<span class="text-success">Done</span>';
                break;
            case 'pending':
                echo '<span class="text-warning">Pending</span>';
                break;
            case 'canceled':
                echo '<span class="text-danger">Canceled</span>';
                break;
            case 'waiting approval':
                echo '<span class="text-info">Waiting Approval</span>';
                break;
        }
        ?>
    </h3>
    <div>
        <div class="row">
            <div class="form-group col-md-6">
                <label class="font-weight-bold" for="id">ID Transaksi</label>
                <p><?php echo $transaction[0]->id ?></p>
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
            <?php } ?>
            <div class="form-group col-md-6">
                <label class="font-weight-bold" for="xid_customer">ID Customer</label>
                <p><?php echo $transaction[0]->xid_customer ?></p>
            </div>
            <?php if ($transaction[0]->hanya_pembelian == 0) { ?>
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
            <div class="form-group col-md-3">
                <label class="font-weight-bold" for="subtotal">Total</label>
                <p><?php echo 'Rp ' . number_format($transaction[0]->total, 2, ',', '.') ?></p>
            </div>
            <div class="form-group col-md-3">
                <label class="font-weight-bold" for="dibayar">Bayar</label>
                <p><?php echo 'Rp ' . number_format($transaction[0]->dibayar, 2, ',', '.') ?></p>
            </div>
            <div class="col-md-6"></div>
            <div class="form-group col-md-6">
                <label class="font-weight-bold" for="keterangan">Keterangan</label>
                <p><?php if ($transaction[0]->keterangan != '') echo $transaction[0]->keterangan; else echo '-' ?></p>
            </div>
        </div>
    </div>
    <div class="my-3 card">
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
</div>
