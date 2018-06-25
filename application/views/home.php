<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 09-Jun-18
 * Time: 2:40 PM
 */
?>
<script type="text/javascript">
    $(document).ready(function () {
        function formatState(data) {
            if (!data.id) {
                return data.text;
            }

            return $(
                '<span>' + data.id + '<br><b>' + data.nama + '</b> | ' + data.no_ktp + '</span>'
            );
        }

        function formatSelection(data) {
            if (!data.id) {
                return data.text;
            }

            return data.id;
        }

        function matchCustom(params, data) {
            // If there are no search terms, return all of the data
            if ($.trim(params.term) === '') {
                return data;
            }

            // Do not display the item if there is no 'text' property
            if (typeof data.id === 'undefined') {
                return null;
            }
            if (typeof data.nama === 'undefined') {
                return null;
            }
            if (typeof data.no_ktp === 'undefined') {
                return null;
            }

            // `params.term` should be the term that is used for searching
            // `data.text` is the text that is displayed for the data object
            if (data.id.toLowerCase().indexOf(params.term) > -1 || data.nama.toLowerCase().indexOf(params.term) > -1 || data.no_ktp.toLowerCase().indexOf(params.term) > -1) {
                var modifiedData = $.extend({}, data, true);
                return modifiedData;
            }

            // Return `null` if the term should not be displayed
            return null;
        }

        $("#id").select2({
            data: <?php echo json_encode($customers) ?>,
            placeholder: 'Pilih pelanggan',
            closeOnSelect: true,
            templateResult: formatState,
            templateSelection: formatSelection,
            matcher: matchCustom
        });

        $('#jenis_kendaraan').select2({
            placeholder: 'Pilih kendaraan'
        });
    })
</script>
<div id="content" class="container-fluid">
    <h3><b>Menu Utama</b></h3>
    <hr>
    <h4><b>Buat Transaksi Baru</b></h4>
    <div class="row">
        <div class="col-md-7">
            <form action="<?php echo site_url('process/new_transaction') ?>" method="post">
                <div class="form-check text-right my-2">
                    <input type="checkbox" class="form-check-input" name="awanama" id="awanama" value="true"
                           onclick="onChecked(this)">
                    <label class="form-check-label" for="awanama">Hanya pembelian</label>
                </div>
                <div class="form-group row">
                    <label for="id" class="col-md-3 col-form-label">Pelanggan</label>
                    <div class="col-md">
                        <select class="form-control" name="id" id="id">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis_kendaraan" class="col-md-3 col-form-label">Jenis Kendaraan</label>
                    <div class="col-md">
                        <select class="form-control" name="jenis_kendaraan" id="jenis_kendaraan">
                            <option></option>
                            <option value="mobil">Mobil</option>
                            <option value="motor">Motor</option>
                            <option value="truk">Truk</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nomor_polisi" class="col-md-3 col-form-label">Nomor Polisi</label>
                    <div class="col-md">
                        <input type="text" class="form-control" name="nomor_polisi" id="nomor_polisi"
                               placeholder="Nomor Polisi">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keluhan" class="col-md-3 col-form-label">Keluhan</label>
                    <div class="col-md">
                    <textarea name="keluhan" id="keluhan" rows="2" class="form-control"
                              placeholder="Keluhan"></textarea>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-success">Buat</button>
                </div>
            </form>
        </div>
        <div class="col-md">
            <div style="text-align:center;padding:1em 0;"><h2><a style="text-decoration:none;"
                                                                 href="https://www.zeitverschiebung.net/en/city/1650357"><span
                                style="color:gray;">Current local time in</span><br/>Bandung, Indonesia</a></h2>
                <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=large&timezone=Asia%2FJakarta"
                        width="100%" height="140" frameborder="0" seamless></iframe>
            </div>
        </div>
    </div>
    <hr>
</div>
