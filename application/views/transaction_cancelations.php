<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 26-Jun-18
 * Time: 12:18 PM
 */
?>
<div id="content" class="container-fluid">
    <h3><b>Tabel Data Pengajuan Pembatalan Transaksi</b></h3>
    <hr>
    <div class="mt-3">
        <table class="table table-bordered table-hover table-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID Transaksi</th>
                <th scope="col">Kasir</th>
                <th scope="col">Alasan</th>
                <th scope="col">Waktu Pengajuan</th>
                <th scope="col">Waktu Acc</th>
                <th scope="col">Status</th>
                <th scope="col">Pilihan</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            if ($transaction_cancelations != null) {
                foreach ($transaction_cancelations as $row) { ?>
                    <tr>
                        <th scope="row"><?php echo $i++ ?></th>
                        <td class="text-uppercase"><?php echo $row->xid_transaction ?></td>
                        <td><?php echo $row->username_kasir ?></td>
                        <td><?php echo $row->alasan ?></td>
                        <td><?php echo $row->submission_time ?></td>
                        <td><?php echo $row->accepted_time ?></td>
                        <td class="text-uppercase">
                            <?php
                            switch ($row->status) {
                                case 'approved':
                                    echo '<span class="text-success">APPROVED</span>';
                                    break;
                                case 'rejected':
                                    echo '<span class="text-danger">REJECTED</span>';
                                    break;
                                case 'waiting':
                                    echo '<span class="text-info">WAITING APPROVAL</span>';
                                    break;
                            }
                            ?>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary" title="Rincian"
                               href="<?php echo site_url('transactions/acc_cancelation?id=' . $row->id) ?>"
                               target="_blank">Acc</a>
                        </td>
                    </tr>
                <?php }
            } ?>
            </tbody>
        </table>
    </div>
</div>

