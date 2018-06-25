<script type="text/javascript">
    $(document).ready(function () {
        function formatState(data) {
            if (!data.id) {
                return data.text;
            }

            return $(
                '<span>' + data.id + '<br><b>' + data.nama + '</b></span>'
            );
        }

        function formatSelection(data) {
            if (!data.id) {
                return data.text;
            }

            return data.id;
        }

        function matchCustom(params, data) {
            // If there are no search terms, return all of the data
            if ($.trim(params.term) === '') {
                return data;
            }

            // Do not display the item if there is no 'text' property
            if (typeof data.id === 'undefined') {
                return null;
            }
            if (typeof data.nama === 'undefined') {
                return null;
            }

            // `params.term` should be the term that is used for searching
            // `data.text` is the text that is displayed for the data object
            if (data.id.toLowerCase().indexOf(params.term) > -1 || data.nama.toLowerCase().indexOf(params.term) > -1) {
                var modifiedData = $.extend({}, data, true);
                return modifiedData;
            }

            // Return `null` if the term should not be displayed
            return null;
        }

        $("#id_part").select2({
            data: <?php echo json_encode($parts) ?>,
            placeholder: 'Pilih suku cadang',
            closeOnSelect: true,
            templateResult: formatState,
            templateSelection: formatSelection,
            matcher: matchCustom
        });

        $("#id_service").select2({
            data: <?php echo json_encode($services) ?>,
            placeholder: 'Pilih layanan jasa',
            closeOnSelect: true,
            templateResult: formatState,
            templateSelection: formatSelection,
            matcher: matchCustom
        });

        $("#id_mechanic").select2({
            data: <?php echo json_encode($mechanics) ?>,
            placeholder: 'Pilih mekanik',
            closeOnSelect: true,
            templateResult: formatState,
            templateSelection: formatSelection,
            matcher: matchCustom
        });
    })
</script>
<div class="col-md">
    <h3>Transaksi Baru</h3>
    <hr>
    <form action="<?php echo site_url('transactions/finish') ?>" method="post">
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
                <label class="font-weight-bold" for="kasir">Nama Kasir</label>
                <input type="text" class="form-control form-control-sm" name="kasir" id="kasir"
                       value="<?php echo $this->session->userdata('nama') ?>" disabled>
            </div>
            <div class="form-group col-md-3">
                <label class="font-weight-bold" for="subtotal">Total</label>
                <input type="text" class="form-control form-control-sm" name="subtotal" id="subtotal"
                       value="<?php echo $transaction[0]->total ?>" disabled>
            </div>
            <div class="form-group col-md-3">
                <label class="font-weight-bold" for="dibayar">Bayar</label>
                <input type="text" class="form-control form-control-sm" name="dibayar" id="dibayar" value="0" required>
            </div>
        </div>
        <div class="text-right">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancel">Batal</button>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#finish">Selesai</button>
        </div>
        <!-- Modal -->
        <div class="modal" id="cancel" role="dialog" aria-labelledby="cancelLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelLabel">Batalkan transaksi?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Semua perubahan yang dilakukan transaksi ini akan hilang
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <input type="submit" class="btn btn-danger" name="action" value="Batal">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="finish" role="dialog" aria-labelledby="finishLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="finishLabel">Selesaikan transaksi?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Pastikan data transaksi sudah benar
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <input type="submit" class="btn btn-success" name="action" value="Selesai">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="my-3 card">
        <div class="p-2">
            <h6 class="font-weight-bold">Parts</h6>
            <form class="form-inline" action="<?php echo site_url('transactions/insert_part') ?>" method="post">
                <select class="form-control form-control-sm" name="id_part" id="id_part" style="width: 500px;" required>
                    <option></option>
                </select>
                <input type="number" class="form-control form-control-sm mr-2" min="0" placeholder="Qty" name="jumlah"
                       value="1" required>
                <input type="submit" class="btn btn-primary btn-sm" value="Tambah">
            </form>
            <?php if ($part_details != null) { ?>
                <hr>
                <table class="table table-sm">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID Parts</th>
                        <th scope="col">Nama Parts</th>
                        <th scope="col">Serial Num</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Pilihan</th>
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
                            <td>
                                <a href="<?php echo site_url('transactions/delete_part?id=' . $row->id) ?>"
                                   class="btn btn-danger"><span class="fas fa-trash-alt"></span></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <hr>
            <?php } ?>
        </div>
        <?php if (!$this->session->userdata('purchaseOnly')) { ?>
            <div class="p-2">
                <h6 class="font-weight-bold">Service</h6>
                <form class="form-inline" action="<?php echo site_url('transactions/insert_service') ?>" method="post">
                    <select class="form-control" name="id_service" id="id_service" style="width: 500px;">
                        <option></option>
                    </select>
                    <select class="form-control" name="id_mechanic" id="id_mechanic" style="width: 500px;">
                        <option></option>
                    </select>
                    <input type="submit" class="btn btn-primary btn-sm" value="Tambah">
                </form>
                <?php if ($service_details != null) { ?>
                    <hr>
                    <table class="table table-sm">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID Service</th>
                            <th scope="col">Nama Service</th>
                            <th scope="col">ID Mekanik</th>
                            <th scope="col">Nama Mekanik</th>
                            <th scope="col">Biaya</th>
                            <th scope="col">Pilihan</th>
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
                                <td>
                                    <a href="<?php echo site_url('transactions/delete_service?id=' . $row->id) ?>"
                                       class="btn btn-danger"><span class="fas fa-trash-alt"></span></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <hr>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>