<script type="text/javascript">
    $(document).ready(function () {
        function formatStateParts(data) {
            if (!data.id) {
                return data.text;
            }

            return $(
                '<span>' + data.id + '<br><b>' + data.nama + '</b><br>Stok: ' + data.stok + '</span>'
            );
        }

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
            templateResult: formatStateParts,
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
            <label class="font-weight-bold" for="kasir">Nama Kasir</label>
            <p><?php echo $this->session->userdata('nama'); ?></p>
        </div>
    </div>
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
                            <td class="text-right"><?php echo number_format($row->harga, 2, ',', '.') ?></td>
                            <td>
                                <a href="<?php echo site_url('transactions/delete_part?id=' . $row->id) ?>"
                                   class="btn btn-danger btn-sm"><span class="fas fa-trash-alt"></span></a>
                            </td>
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
                                <td class="text-right"><?php echo number_format($row->biaya, 2, ',', '.') ?></td>
                                <td>
                                    <a href="<?php echo site_url('transactions/delete_service?id=' . $row->id) ?>"
                                       class="btn btn-danger btn-sm"><span class="fas fa-trash-alt"></span></a>
                                </td>
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
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <hr>
    <form action="<?php echo site_url('transactions/finish') ?>" method="post">
        <div class="row">
            <div class="col-md-6"></div>
            <div class="form-group col-md-2">
                <label class="font-weight-bold" for="subtotal">Total</label>
                <p><?php echo 'Rp ' . number_format($transaction[0]->total, 2, ',', '.') ?></p>
            </div>
            <div class="form-group col-md-2">
                <label class="font-weight-bold" for="dibayar">Bayar</label>
                <input type="text" class="form-control form-control-sm" name="dibayar" id="dibayar" value="0" required>
            </div>
            <div class="col-md-2 m-auto">
                <div class="text-right">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancel">Batal
                    </button>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#finish">Selesai
                    </button>
                </div>
            </div>
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
                        <div class="form-group">
                            <label class="font-weight-bold" for="keterangan">Keterangan <span class="text-danger">(wajib diisi)</span></label>
                            <input type="text" class="form-control form-control-sm" name="keterangan" id="keterangan">
                        </div>
                        <b>Peringatan: Semua perubahan yang dilakukan transaksi ini akan hilang</b>
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
</div>