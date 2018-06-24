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
    <h1><b>Ubah Data Pelanggan ID <?php echo $result[0]->id ?></b></h1>
    <form method="post" action="<?php echo site_url('process/update_customer') ?>">
        <input type="text" name="id" value="<?php echo $result[0]->id ?>" hidden>
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="nama">Nama</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="nama" name="nama"
                       value="<?php echo $result[0]->nama ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="no_ktp">Nomor KTP</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="no_ktp" name="no_ktp"
                       value="<?php echo $result[0]->no_ktp ?>">
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
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Ubah</button>
        </div>
    </form>
</div>
