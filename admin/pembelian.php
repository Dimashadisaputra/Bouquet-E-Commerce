<h1>Data Pembelian</h1>

<table class="table table-success table-striped">
	<thead>
		<tr>
			<th>no</th>
			<th>nama pelanggan</th>
			<th>tanggal</th>
			<th>Status pembelian</th>
			<th>total</th>
			<th>aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.
		id_pelanggan=pelanggan.id_pelanggan"); ?>
		<?php while($pecah = $ambil->fetch_assoc()) { ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_pelanggan']; ?></td>
			<td><?php echo $pecah['tanggal_pembelian']; ?></td>
			<td><?php echo $pecah['status_pembelian']; ?></td>
			<td><?php echo $pecah['total_pembelian']; ?></td>
			<td>
				<a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-info">detail</a>
				<?php if ($pecah['status_pembelian']!=="pending"): ?>
				<a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-success">Lihat Pembayaran</a>
			<?php endif ?>
			</td>
		</tr>
		<?php $nomor++ ?>
		<?php } ?>
	</tbody>
</table>