<h1>Data Bouqet</h1>

<table class="table table-success table-striped">
	<thead>
		<tr>
			<th>no</th>
			<th>nama</th>
			<!-- <th>kategori</th> -->
			<th>harga</th>
			<th>berat</th>
			<th>foto</th>
			<th>stok</th>
			<th>aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM bouqet"); ?>
		<?php while($pecah = $ambil->fetch_assoc()) { ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			<!-- <td><?php echo $pecah['kategori']; ?></td> -->
			<td><?php echo $pecah['harga_produk']; ?></td>
			<td><?php echo $pecah['berat_produk']; ?></td>
			<td>
				<img src="../foto_bouqet/<?php echo $pecah['foto_bouqet']; ?>" width="100">
			</td>
			<td><?php echo $pecah['stok_produk']; ?></td>
			<td>
				<a href="index.php?halaman=hapusbouqet&id=<?php echo $pecah['id_produk']; ?>" class="btn-danger btn">hapus</a>
				<a href="index.php?halaman=ubahbouqet&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-warning">ubah</a>
			</td>
		</tr>
		<?php $nomor++ ?>
		<?php } ?>
	</tbody>
</table>

<a href="index.php?halaman=tambahbouqet" class="btn btn-primary">Tambah Data</a>