<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 17-Jun-18
 * Time: 8:28 PM
 */
?>
<div class="col-md">
    <h1><b>Ubah Data Layanan ID <?php echo $result[0]->id ?></b></h1>
    <form method="post" action="<?php echo site_url('process/update_service') ?>">
        <input type="text" name="id" value="<?php echo $result[0]->id ?>" hidden>
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="nama">Nama</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="nama" name="nama"
                       value="<?php echo $result[0]->nama ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="biaya">Biaya</label>
            <div class="col-md-8">
                <input type="number" class="form-control" id="biaya" name="biaya"
                       value="<?php echo $result[0]->biaya?>">
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Ubah</button>
        </div>
    </form>
</div>

