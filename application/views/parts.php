<div class="col-md">
	<h1><b>Tabel Suku Cadang</b></h1>		
	<div class="mt-3">
		<table class="table table-bordered table-hover table-sm">
			<thead class="thead-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">ID</th>
					<th scope="col">Nama</th>
					<th scope="col">Harga</th>
					<th scope="col">Stok</th>
					<th scope="col">Pilihan</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<form class="form-inline" action="<?php echo site_url('process/insert_part') ?>" method="POST">
						<td></td>
						<td></td>
						<td>
							<input class="form-control form-control-sm mt-1" type="text" placeholder="Nama" name="nama">
						</td>
						<td>
							<input class="form-control form-control-sm mt-1" type="number" placeholder="Harga" name="harga">
						</td>
						<td></td>
						<td>
							<input type="submit" class="btn btn-primary btn-sm mt-1" value="Tambah">
						</td>
					</form>
				</tr>
				<?php
				$i = 1;
				foreach($part as $row) { ?>
					<tr>
						<th scope="row"><?php echo $i++ ?></th>
						<td class="text-uppercase"><?php echo $row->id ?></td>
						<td><?php echo $row->nama ?></td>
						<td><?php echo $row->harga ?></td>
						<td><?php echo $row->stok ?></td>
						<td>
							<a class="btn btn-sm btn-success" title="Rincian Stok" href=""><i class="fas fa-list-ol"></i></a>
							<a class="btn btn-sm btn-primary" title="Ubah "href=""><i class="fas fa-edit"></i></a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
