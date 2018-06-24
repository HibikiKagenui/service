<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 17-Jun-18
 * Time: 7:52 PM
 */
?>
<div class="col-md">
    <div id="back-button"></div>
    <hr>
    <h1><b>Ubah Data Suku Cadang ID <?php echo $result[0]->id ?></b></h1>
    <form method="post" action="<?php echo site_url('process/update_part') ?>">
        <input type="text" name="id" value="<?php echo $result[0]->id ?>" hidden>
        <input type="number" name="stok" value="<?php echo $result[0]->stok ?>" hidden>
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="nama">Nama</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="nama" name="nama"
                       value="<?php echo $result[0]->nama ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="harga">Harga</label>
            <div class="col-md-8">
                <input type="number" class="form-control" id="harga" name="harga"
                       value="<?php echo $result[0]->harga?>">
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Ubah</button>
        </div>
    </form>
</div>
