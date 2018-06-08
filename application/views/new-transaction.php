<div class="mx-3 col">
    <h2>Transaksi Baru</h2>
    <form action="<?php echo site_url('transactions/finish') ?>" method="post">
        <div class="form-group row">
            <label class="col-md-2 col-form-label" for="id">ID Transaksi</label>
            <div class="col-md-10">
                <input type="text" class="form-control form-control-sm text-uppercase" name="id" id="id" value="<?php echo $id ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label" for="xid_customer">ID Customer</label>
            <div class="col-md-10">
                <input type="text" class="form-control form-control-sm text-uppercase" name="xid_customer" id="xid_customer" value="<?php echo $xid_customer ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label" for="xid_customer">Nama Kasir</label>
            <div class="col-md-10">
                <input type="text" class="form-control form-control-sm" name="kasir" id="kasir" value="<?php echo $this->session->userdata('nama') ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label" for="xid_customer">Waktu</label>
            <div class="col-md-10">
                <input type="text" class="form-control form-control-sm" name="waktu" id="waktu" value="<?php echo $this->session->userdata('waktu') ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label" for="jenis_kendaraan">Jenis Kendaraan</label>
            <div class="col-md-10">
                <select class="form-control form-control-sm" name="jenis_kendaraan" id="jenis_kendaraan">
                    <option value="mobil">Mobil</option>
                    <option value="motor">Motor</option>
                    <option value="truk">Truk</option>
                </select>
            </div>
        </div>
        <div class="text-right">
            <input type="submit" class="btn btn-danger" name="action" value="Batal">
            <input type="submit" class="btn btn-success" name="action" value="Selesai">    
        </div>
    </form>
    <div class="my-3 card">
        <div class="p-2">
            <h5>Parts</h5>
            <form class="form-inline" action="<?php echo site_url('transactions/insert_part') ?>" method="post">
                <input type="text" class="form-control form-control-sm mr-2" placeholder="ID Parts" name="id">
                <input type="number" class="form-control form-control-sm mr-2" min="0" placeholder="Qty" name="jumlah">
                <input type="submit" class="btn btn-primary" value="Tambah">
            </form>
            <?php if ($parts != null) { ?>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID Parts</th>
                            <th scope="col">Serial Num</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($parts as $row) { ?>
                            <tr>
                                <th scope="row"><?php echo $i++ ?></th>
                                <td><?php echo $row->id ?></td>
                                <td><?php echo $row->part_serial_num ?></td>
                                <td><?php echo $row->jumlah_terbayar ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
        <div class="p-2">
            <h5>Service</h5>
            <form class="form-inline" action="<?php echo site_url('transactions/insert_service') ?>" method="post">
                <input type="text" class="form-control form-control-sm mr-2" placeholder="ID Service" name="id">
                <input type="text" class="form-control form-control-sm mr-2" placeholder="Mekanik" name="mechanic">
                <input type="submit" class="btn btn-primary" value="Tambah">
            </form>
            <?php if ($services != null) { ?>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID Service</th>
                            <th scope="col">ID Mekanik</th>
                            <th scope="col">Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($services as $row) { ?>
                            <tr>
                                <th scope="row"><?php echo $i++ ?></th>
                                <td><?php echo $row->xid_service ?></td>
                                <td><?php echo $row->xid_mechanic ?></td>
                                <td><?php echo $row->jumlah_terbayar ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</div>