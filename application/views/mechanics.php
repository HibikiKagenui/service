<div class="col-md">
	<h1><b>Tabel Data Mekanik</b></h1>
	<div class="mt-3">
        <table class="table table-bordered table-hover table-sm">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No Tlp</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Gaji</th>
                    <th scope="col">Jml Service</th>
                    <th scope="col">Pilihan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form action="<?php echo site_url('process/insert_mechanic')?>" method="post">
                        <th scope="row"></th>
                        <td></td>
                        <td>
                            <input class="form-control form-control-sm" type="text" name="nama">
                        </td>
                        <td>
                            <textarea class="form-control form-control-sm" type="text" name="alamat"></textarea>
                        </td>
                        <td>
                            <input class="form-control form-control-sm" type="text" name="no_kontak">
                        </td>
                        <td>
                            <select class="form-control form-control-sm" name="gender">
                                <option value="L">L</option>
                                <option value="P">P</option>
                            </select>
                        </td>
                        <td>
                            <input class="form-control form-control-sm" type="number" name="gaji">
                        </td>
                        <td></td>
                        <td><input class="btn btn-sm btn-primary" type="submit" value="Tambah"></td>
                    </form>
                </tr>
                <?php
                $i = 1;
                if($mechanic != null) {
                    foreach ($mechanic as $row) { ?>
                        <tr>
                            <th scope="row"><?php echo $i++ ?></th>
                            <td><?php echo $row->id ?></td>
                            <td><?php echo $row->nama ?></td>
                            <td><?php echo $row->alamat ?></td>
                            <td><?php echo $row->no_kontak ?></td>
                            <td><?php echo $row->gender ?></td>
                            <td><?php echo $row->gaji ?></td>
                            <td><?php echo $row->jumlah_servis ?></td>
                            <td><a href="" class="btn btn-sm btn-primary" title="Ubah"><i class="fas fa-edit"></i></a></td>
                        </tr>
                    <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>

