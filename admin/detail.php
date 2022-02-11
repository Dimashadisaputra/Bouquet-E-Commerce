<h1>detail</h1>
<?php 
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian='$_GET[id]'");
	$detail = $ambil->fetch_assoc();
	 ?>

	 
	 

	 <div class="row">
	 	<div class="col-md-4">
	 		<h3>Pembelian</h3>
	 		<p>
	 			tanggal : <?php echo $detail['tanggal_pembelian']; ?><br>
	 			total : Rp.<?php echo number_format($detail['total_pembelian']); ?> <br>
	 			Status : <?php echo $detail["status_pembelian"]; ?>
	 		</p>
	 	</div>
	 	<div class="col-md-4">
	 		<h3>Pelanggan</h3>
	 		<strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
			 <p>
			 	<?php echo $detail['telepon_pelanggan']; ?><br>
			 	<?php echo $detail['email_pelanggan']; ?>
			 </p>
	 	</div>
	 	<div class="col-md-4">
	 		<h3>Pengiriman</h3>
	 		<strong><?php echo $detail['nama_kota']; ?></strong> <br>
	 		<p>
	 			Tarif: Rp.<?php echo number_format($detail['tarif']); ?><br>
			 	Alamat: <?php echo $detail['alamat_pengiriman']; ?>
			</p>
	 	</div>
	 </div>

	 <table class="table table-bordered">
	<thead>
		<tr>
			<th>no</th>
			<th>nama produk</th>
			<th>harga</th>
			<th>jumlah</th>
			<th>subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
          <?php $b=$koneksi->query("SELECT * FROM pembelian_produk JOIN bouqet ON 
          pembelian_produk.id_produk=bouqet.id_produk
          WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
          <?php while($c=$b->fetch_assoc()){ ?>
		<td><?php echo $nomor; ?></td>
          <td><?php echo $c['nama_produk']; ?></td>
          <td>Rp.<?php echo number_format($c['harga_produk']); ?></td>
          <td><?php echo $c['jumlah']; ?></td>
          <td>
              Rp.<?php echo number_format($c['harga_produk']*$c['jumlah']); ?>
          </td>
	</tbody>
	<?php $nomor++; ?>
     <?php } ?>
</table>