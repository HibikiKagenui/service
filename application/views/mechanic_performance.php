<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 24-Jun-18
 * Time: 6:15 PM
 */
?>
<div class="col-md">
    <a href="<?php echo site_url('site/mechanics')?>" class="btn btn-primary">
        <span class="fas fa-chevron-left"></span> Kembali
    </a>
    <hr>
    <h3><b>Kinerja Mekanik di Tahun <?php echo $year ?></b></h3>
    <hr>
    <div class="container">
        <form action="<?php echo site_url('mechanics/performance')?>" method="get" class="form-inline">
            <input type="text" name="id" value="<?php echo $id ?>" hidden>
            <div class="form-group">
                <label for="year">Pilih tahun: </label>
                <input type="number" min="2010" name="year" id="year" class="form-control ml-2" value="<?php echo $year ?>">
            </div>
            <input type="submit" class="btn btn-primary ml-2" value="Muat ulang">
        </form>
        <canvas id="myChart" height="100px"></canvas>
    </div>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: <?php echo json_encode($bulan) ?>,
                datasets: [{
                    label: "Jumlah servis",
                    // backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: <?php echo json_encode($jumlah) ?>,
                }]
            },

            // Configuration options go here
            options: {
                elements: {
                    line: {
                        tension: 0
                    }
                }
            }
        });
    </script>
</div>