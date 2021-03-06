<div id="content" class="container-fluid">
    <h3><b>Tabel Suku Cadang</b></h3>
    <hr>
    <div class="mt-3">
        <table class="table table-bordered table-hover table-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Nama</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
                <?php if ($this->session->userdata('jabatan') == 'admin') { ?>
                    <th scope="col">Pilihan</th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php if ($this->session->userdata('jabatan') == 'admin') { ?>
                <form class="form-inline" action="<?php echo site_url('process/insert_part') ?>" method="POST">
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <input class="form-control form-control-sm" type="text" placeholder="Nama" name="nama">
                        </td>
                        <td>
                            <input class="form-control form-control-sm" type="number" min="0" placeholder="Harga"
                                   name="harga">
                        </td>
                        <td></td>
                        <td>
                            <input type="submit" class="btn btn-primary btn-sm" value="Tambah">
                        </td>
                    </tr>
                </form>
            <?php } ?>
            <?php
            $i = 1;
            if ($part != null) {
                foreach ($part as $row) { ?>
                    <tr>
                        <th scope="row"><?php echo $i++ ?></th>
                        <td class="text-uppercase"><?php echo $row->id ?></td>
                        <td><?php echo $row->nama ?></td>
                        <td class="text-right"><?php echo $row->harga ?></td>
                        <td class="text-right"><?php echo $row->stok ?></td>
                        <?php if ($this->session->userdata('jabatan') == 'admin') { ?>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-sm btn-success" title="Rincian Stok"
                                       href="<?php echo site_url('site/part_details?id=' . $row->id) ?>"><i
                                                class="fas fa-list"></i></a>
                                    <a class="btn btn-sm btn-primary" title="Ubah "
                                       href="<?php echo site_url('site/update_part?id=' . $row->id) ?>"><i
                                                class="fas fa-edit"></i></a>
                                </div>
                            </td>
                        <?php } ?>
                    </tr>
                <?php }
            } ?>
            </tbody>
        </table>
    </div>
</div>