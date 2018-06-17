<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 09-Jun-18
 * Time: 2:40 PM
 */
?>
<div class="col-md">
    <h1><b>Menu Utama</b></h1>
    <hr>
    <div>
        <h3><b>Buat Transaksi Baru</b></h3>
        <form action="<?php echo site_url('process/new_transaction') ?>" method="post">
            <div class="form-group row">
                <label for="id" class="col-md-2 col-form-label">ID Pelanggan</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="id" id="id" placeholder="ID Pelanggan">
                </div>
            </div>
            <div class="form-group row">
                <label for="jenis_kendaraan" class="col-md-2 col-form-label">Jenis Kendaraan</label>
                <div class="col-md-10">
                    <select class="form-control" name="jenis_kendaraan" id="jenis_kendaraan">
                        <option value="null" hidden></option>
                        <option value="mobil">Mobil</option>
                        <option value="motor">Motor</option>
                        <option value="truk">Truk</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="nomor_polisi" class="col-md-2 col-form-label">Nomor Polisi</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="nomor_polisi" id="nomor_polisi" placeholder="Nomor Polisi">
                </div>
            </div>
            <div class="form-group row">
                <label for="keluhan" class="col-md-2 col-form-label">Keluhan</label>
                <div class="col-md-10">
                    <textarea name="keluhan" id="keluhan" rows="2" class="form-control" placeholder="Keluhan"></textarea>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-lg btn-success">Buat</button>
            </div>
        </form>
    </div>
</div>
<!--<script>-->
<!--    $(function () {-->
<!--        //const id = --><?php ////echo json_encode($customer_id) ?><!--//;-->
<!--        const id = [-->
<!--            "ActionScript",-->
<!--            "AppleScript",-->
<!--            "Asp",-->
<!--            "BASIC",-->
<!--            "C",-->
<!--            "C++",-->
<!--            "Clojure",-->
<!--            "COBOL",-->
<!--            "ColdFusion",-->
<!--            "Erlang",-->
<!--            "Fortran",-->
<!--            "Groovy",-->
<!--            "Haskell",-->
<!--            "Java",-->
<!--            "JavaScript",-->
<!--            "Lisp",-->
<!--            "Perl",-->
<!--            "PHP",-->
<!--            "Python",-->
<!--            "Ruby",-->
<!--            "Scala",-->
<!--            "Scheme"-->
<!--        ];-->
<!--        -->
<!--        $("#auto").autocomplete({-->
<!--            source: id-->
<!--        });-->
<!--    });-->
<!-- </script>-->
