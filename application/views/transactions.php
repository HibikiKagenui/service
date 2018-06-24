<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 18-Jun-18
 * Time: 9:25 PM
 */
?>
<div class="col-md">
    <h3><b>Tabel Data Histori Transaksi</b></h3>
    <hr>
    <div class="mt-3">
        <table class="table table-bordered table-hover table-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID Transaksi</th>
                <th scope="col">ID Pelanggan</th>
                <th scope="col">Jenis Kendaraan</th>
                <th scope="col">Nomor Polisi</th>
                <th scope="col">Keluhan</th>
                <th scope="col">Mulai</th>
                <th scope="col">Selesai</th>
                <th scope="col">Total</th>
                <th scope="col">Dibayar</th>
                <th scope="col">Status</th>
                <th scope="col">Pilihan</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            if ($transaction != null) {
                foreach ($transaction as $row) { ?>
                    <tr>
                        <th scope="row"><?php echo $i++ ?></th>
                        <td class="text-uppercase"><?php echo $row->id ?></td>
                        <td class="text-uppercase"><?php echo $row->xid_customer ?></td>
                        <td class="text-capitalize"><?php echo $row->jenis_kendaraan ?></td>
                        <td><?php echo $row->nomor_polisi ?></td>
                        <td><?php echo $row->keluhan ?></td>
                        <td><?php echo $row->waktu_mulai ?></td>
                        <td><?php echo $row->waktu_selesai ?></td>
                        <td><?php echo $row->total ?></td>
                        <td><?php echo $row->dibayar ?></td>
                        <td class="text-uppercase"><?php echo $row->status ?></td>
                        <td>
                            <a class="btn btn-sm btn-success" title="Rincian" href="<?php echo site_url('transactions/detail?id=' . $row->id) ?>"><i class="fas fa-list-ol"></i></a>
                        </td>
                    </tr>
                <?php }
            } ?>
            </tbody>
        </table>
    </div>
</div>
