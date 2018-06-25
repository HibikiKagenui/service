<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 24-Jun-18
 * Time: 10:49 AM
 */
?>
<div id="content" class="container-fluid">
    <div id="back-button"></div>
    <hr>
    <h3>Transaksi</h3>
    <div>
        <div class="row">
            <div class="form-group col-md-6">
                <label class="font-weight-bold" for="id">ID Transaksi</label>
                <input type="text" class="form-control form-control-sm text-uppercase" name="id" id="id"
                       value="<?php echo $transaction[0]->id ?>" disabled>
            </div>
            <div class="form-group col-md-3">
                <label class="font-weight-bold" for="jenis_kendaraan">Jenis Kendaraan</label>
                <input type="text" class="form-control form-control-sm text-capitalize" name="jenis_kendaraan"
                       id="jenis_kendaraan" value="<?php echo $transaction[0]->jenis_kendaraan ?>" disabled>
            </div>
            <div class="form-group col-md-3">
                <label class="font-weight-bold" for="nomor_polisi">Nomor Polisi</label>
                <input type="text" class="form-control form-control-sm" name="nomor_polisi" id="nomor_polisi"
                       value="<?php echo $transaction[0]->nomor_polisi ?>" disabled>
            </div>
            <div class="form-group col-md-6">
                <label class="font-weight-bold" for="xid_customer">ID Customer</label>
                <input type="text" class="form-control form-control-sm text-uppercase" name="xid_customer"
                       id="xid_customer" value="<?php echo $transaction[0]->xid_customer ?>" disabled>
            </div>
            <div class="form-group col-md-6">
                <label class="font-weight-bold" for="keluhan">Keluhan</label>
                <input type="text" class="form-control form-control-sm" name="keluhan" id="keluhan"
                       value="<?php echo $transaction[0]->keluhan ?>" disabled>
            </div>
            <div class="form-group col-md-3">
                <label class="font-weight-bold" for="waktu_mulai">Waktu Mulai</label>
                <input type="text" class="form-control form-control-sm" name="waktu_mulai" id="waktu_mulai"
                       value="<?php echo $transaction[0]->waktu_mulai ?>" disabled>
            </div>
            <div class="form-group col-md-3">
                <label class="font-weight-bold" for="kasir">Waktu Selesai</label>
                <input type="text" class="form-control form-control-sm" name="kasir" id="kasir"
                       value="<?php echo $transaction[0]->waktu_selesai ?>" disabled>
            </div>
            <div class="form-group col-md-3">
                <label class="font-weight-bold" for="subtotal">Total</label>
                <input type="text" class="form-control form-control-sm" name="subtotal" id="subtotal"
                       value="<?php echo $transaction[0]->total ?>" disabled>
            </div>
            <div class="form-group col-md-3">
                <label class="font-weight-bold" for="dibayar">Bayar</label>
                <input type="text" class="form-control form-control-sm" name="dibayar" id="dibayar"
                       value="<?php echo $transaction[0]->dibayar ?>" disabled>
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
                            <td><?php echo $row->harga ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <hr>
            <?php } else { ?>
                <p>(kosong)</p>
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
                                <td><?php echo $row->biaya ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <hr>
                <?php } else { ?>
                    <p>(kosong)</p>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>
