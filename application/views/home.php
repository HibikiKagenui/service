<div class="col-md">
	<h1><b>Tabel Pelanggan</b></h1>
	<div class="mt-3">
		<table class="table table-bordered table-hover table-sm">
			<thead class="thead-dark">
				<tr>
					<!-- <th scope="col">#</th> -->
					<th scope="col">ID</th>
					<th scope="col">Nama</th>
					<th scope="col">No. KTP</th>
					<th scope="col">Alamat</th>
					<th scope="col">No. Tlp</th>
					<th scope="col">Gender</th>
					<th scope="col">Pilihan</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<form class="form-inline" action="<?php echo site_url('process/insert_customer') ?>" method="POST">
						<td></td>
						<td>
							<input class="form-control form-control-sm" type="text" placeholder="Nama Lengkap" name="nama">
						</td>
						<td>
							<input class="form-control form-control-sm" type="text" placeholder="Nomor KTP" name="no_ktp">
						</td>
						<td>
							<textarea class="form-control form-control-sm" type="text" placeholder="Alamat" name="alamat"></textarea>
						</td>
						<td>
							<input class="form-control form-control-sm" type="text" placeholder="Nomor Telpon" name="no_kontak">
						</td>
						<td>
							<select class="form-control form-control-sm" name="gender">
								<option value="L">L</option>
								<option value="P">P</option>
							</select>
						</td>
						<td>
							<input type="submit" class="btn btn-primary btn-sm" value="Tambah">
						</td>
					</form>
				</tr>
				<?php
				$i = 1;
				foreach($customer as $row) { ?>
					<tr>
						<!-- <th scope="row"><?php echo $i++ ?></th> -->
						<td class="text-uppercase"><?php echo $row->id ?></td>
						<td><?php echo $row->nama ?></td>
						<td><?php echo $row->no_ktp ?></td>
						<td><?php echo $row->alamat ?></td>
						<td><?php echo $row->no_kontak ?></td>
						<td><?php echo $row->gender ?></td>
						<td>
							<a class="btn btn-sm btn-success" title="Transaksi Baru" href="<?php echo site_url('process/new_transaction?id='.$row->id) ?>"><i class="fas fa-shopping-cart"></i></a>
							<a class="btn btn-sm btn-primary" title="Ubah" href=""><i class="fas fa-edit"></i></a>
							<!-- <a class="btn btn-danger" href=""><i class="fas fa-trash-alt"></i></a> -->
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
