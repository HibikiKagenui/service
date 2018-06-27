<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 18-Jun-18
 * Time: 9:25 PM
 */
?>
<div id="content" class="container-fluid">
    <h3><b>Tabel Data Histori Transaksi</b></h3>
    <hr>
    <div class="mt-3">
        <table class="table table-bordered table-hover table-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID Transaksi</th>
                <th scope="col">ID Pelanggan</th>
                <th scope="col">Hanya Pembelian?</th>
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
                        <td><?php if ($row->hanya_pembelian == 1) echo 'Ya'; else echo 'Tidak' ?></td>
                        <td><?php echo $row->waktu_mulai ?></td>
                        <td><?php echo $row->waktu_selesai ?></td>
                        <td class="text-right"><?php echo $row->total ?></td>
                        <td class="text-right"><?php echo $row->dibayar ?></td>
                        <!--                        <td class="text-right">-->
                        <?php //echo 'Rp ' . number_format($row->total,2,',','.') ?><!--</td>-->
                        <!--                        <td class="text-right">-->
                        <?php //echo 'Rp ' . number_format($row->dibayar,2,',','.') ?><!--</td>-->
                        <td class="text-uppercase">
                            <?php
                            switch ($row->status) {
                                case 'done':
                                    echo '<span class="text-success">Done</span>';
                                    break;
                                case 'pending':
                                    echo '<span class="text-warning">PENDING</span>';
                                    break;
                                case 'canceled':
                                    echo '<span class="text-danger">CANCELED</span>';
                                    break;
                                case 'waiting approval':
                                    echo '<span class="text-info">WAITING APPROVAL</span>';
                                    break;
                            }
                            ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-sm btn-success" title="Rincian"
                                   href="<?php echo site_url('transactions/detail?id=' . $row->id) ?>"><span
                                            class="fas fa-list"></span></a>
                                <?php if ($row->status == 'done' || $row->status == 'waiting approval') { ?>
                                    <a class="btn btn-sm btn-light" title="Cetak struk"
                                       href="<?php echo site_url('transactions/struk?id=' . $row->id) ?>"
                                       target="_blank"><i
                                                class="fas fa-print"></i></a>
                                    <?php if ($this->session->userdata('jabatan') == 'kasir') { ?>
                                        <?php if ($row->status == 'done') { ?>
                                            <a class="btn btn-sm btn-danger" title="Ajukan pembatalan"
                                               href="<?php echo site_url('transactions/cancelation?id=' . $row->id) ?>"
                                               target="_blank"><i
                                                        class="fas fa-undo"></i></a>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                <?php }
            } ?>
            </tbody>
        </table>
    </div>
</div>
