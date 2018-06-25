<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 17-Jun-18
 * Time: 8:28 PM
 */
?>
<div id="content" class="container-fluid">
    <div id="back-button"></div>
    <hr>
    <h1><b>Ubah Data Mekanik ID <?php echo $result[0]->id ?></b></h1>
    <form method="post" action="<?php echo site_url('process/update_mechanic') ?>">
        <input type="text" name="id" value="<?php echo $result[0]->id ?>" hidden>
        <input type="number" name="jumlah_servis" value="<?php echo $result[0]->jumlah_servis ?>" hidden>
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="nama">Nama</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="nama" name="nama"
                       value="<?php echo $result[0]->nama ?>">
            </div>
        </div>
         <div class="form-group row">
            <label class="col-md-3 col-form-label" for="alamat">Alamat</label>
            <div class="col-md-8">
                <textarea class="form-control" id="alamat" name="alamat"><?php echo $result[0]->alamat ?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="no_kontak">Nomor Kontak</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="no_kontak" name="no_kontak"
                       value="<?php echo $result[0]->no_kontak ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="gender">Gender</label>
            <div class="col-md-8">
                <select class="form-control" id="gender" name="gender">
                    <?php if ($result[0]->gender == 'L') { ?>
                        <option value="L">L</option>
                        <option value="P">P</option>
                    <?php } else { ?>
                        <option value="P">P</option>
                        <option value="L">L</option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="gaji">Gaji</label>
            <div class="col-md-8">
                <input type="number" class="form-control" id="gaji" name="gaji"
                       value="<?php echo $result[0]->gaji ?>">
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Ubah</button>
        </div>
    </form>
</div>
