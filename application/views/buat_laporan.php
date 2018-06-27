<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 24-Jun-18
 * Time: 12:01 PM
 */
?>
<div id="content" class="container-fluid">
    <h3><b>Buat Laporan</b></h3>
    <hr>
    <form action="<?php echo site_url('process/laporan')?>" method="get" class="form-inline" target="_blank">
        <div class="form-group mr-2">
            <label for="month">Bulan:</label>
            <select type="number" name="month" id="month" class="form-control ml-2">
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
        </div>
        <div class="form-group mr-2">
            <label for="year">Tahun:</label>
            <input type="number" min="2010" name="year" id="year" class="form-control ml-2" value="<?php echo date('Y') ?>">
        </div>
        <input type="submit" class="btn btn-primary" value="Buat laporan">
    </form>
</div>
