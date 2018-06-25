<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 22-Jun-18
 * Time: 9:21 PM
 */
?>
<div id="content" class="container-fluid">
    <div id="back-button"></div>
    <hr>
    <h3><b>Tabel Detail Barang ID <?php echo $id ?></b></h3>
    <hr>
    <div class="mt-3">
        <table class="table table-bordered table-hover table-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nomor Seri</th>
                <th scope="col">Status</th>
                <th scope="col">Pilihan</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <form class="form-inline" action="<?php echo site_url('process/insert_part_detail') ?>" method="POST">
                    <input type="text" name="xid_part" value="<?php echo $id ?>" hidden>
                    <td></td>
                    <td>
                        <input class="form-control form-control-sm" type="text" placeholder="Nomor Seri" name="part_serial_num">
                    </td>
                    <td>
                        <select name="status" class="form-control form-control-sm">
                            <option value="null" hidden>Status</option>
                            <option value="available">Available</option>
                            <option value="booked">Booked</option>
                            <option value="broken">Broken</option>
                            <option value="sold">Sold</option>
                        </select>
                    </td>
                    <td>
                        <input type="submit" class="btn btn-primary btn-sm" value="Tambah">
                    </td>
                </form>
            </tr>
            <?php
            $i = 1;
            if ($part != null) {
                foreach($part as $row) { ?>
                    <tr>
                        <th scope="row"><?php echo $i++ ?></th>
                        <td><?php echo $row->part_serial_num ?></td>
                        <td><?php echo $row->status ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" title="Ubah "href="<?php echo site_url('site/update_part_detail?id=' . $row->id) ?>"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                <?php }
            } ?>
            </tbody>
        </table>
    </div>
</div>

