<nav id="sidebar">
    <h4><b>Welcome,<br><?php echo $this->session->userdata('nama') ?></b></h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo site_url('site/home') ?>">Menu Utama</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo site_url('site/customers') ?>">Data Pelanggan</a>
        </li>
        <?php if ($this->session->userdata('jabatan') != 'kasir') { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('site/parts') ?>">Data Suku Cadang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('site/services') ?>">Data Layanan Jasa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('site/mechanics') ?>">Data Mekanik</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('site/transactions') ?>">Data Histori Transkasi</a>
            </li>
            <?php if ($this->session->userdata('jabatan') == 'manajer') { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('site/buat_laporan') ?>">Buat Laporan</a>
                </li>
            <?php } ?>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('process/logout') ?>">Keluar</a>
        </li>
    </ul>
</nav>
