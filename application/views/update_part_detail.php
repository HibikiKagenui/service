<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 22-Jun-18
 * Time: 9:37 PM
 */
?>
<div class="col-md">
    <div id="back-button"></div>
    <hr>
    <h2><b>Ubah Data Suku Cadang <?php echo $result[0]->xid_part ?></b></h2>
    <h4>Nomor Seri <?php echo $result[0]->part_serial_num ?></h4>
    <hr>
    <form method="post" action="<?php echo site_url('process/update_part_detail') ?>">
        <input type="text" name="id" value="<?php echo $result[0]->id ?>" hidden>
        <input type="text" name="xid_part" value="<?php echo $result[0]->xid_part ?>" hidden>
        <div class="form-group row">
            <label class="col-md-2 col-form-label" for="part_serial_num">Nomor Seri</label>
            <div class="col-md">
                <input type="text" class="form-control" id="part_serial_num" name="part_serial_num"
                       value="<?php echo $result[0]->part_serial_num ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label" for="alamat">Status</label>
            <div class="col-md">
                <select name="status" id="status" class="form-control">
                    <option value="available">Available</option>
                    <option value="booked">Booked</option>
                    <option value="broken">Broken</option>
                    <option value="sold">Sold</option>
                </select>
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary btn-lg">Ubah</button>
        </div>
    </form>
</div>
