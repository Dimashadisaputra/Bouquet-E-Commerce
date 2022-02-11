<h2>Data Pembayaran</h2>

<?php 
$id_pembelian = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$detail = $ambil->fetch_assoc();

 ?>

 <div class="row">
 	<div class="col-md-6">
 		<table class="table">
 			<tr>
 				<th>Nama</th>
 				<td><?php echo $detail['nama'] ?></td>
 			</tr>
 			<tr>
 				<th>Bank</th>
 				<td><?php echo $detail['bank'] ?></td>
 			</tr>
 			<tr>
 				<th>Jumlah</th>
 				<td>Rp. <?php echo number_format($detail['jumlah']) ?></td>
 			</tr>
 		</table>
 	</div>
 	<div class="col-md-6">
 		<img src="../bukti_pembayaran/<?php echo $detail['bukti'] ?>" alt="" class="img-responsive">
 	</div>
 </div>

 <form method="post">
 	<div class="form-group">
 		<label>NO Resi</label>
 		<input type="text" class="form-control" name="resi">
 	</div>
 	<div class="form-group">
 		<label>Status</label>
 		<select class-"form-control" name="status">
 			<option value="">Pilih</option>
 			<option value="lunas">Lunas</option>
 			<option value="barang dikemas">Barang Dikemas</option>
 			<option value="barang dikirim">Barang Dikirim</option>
 		</select>
 	</div>
 	<button class="btn btn-primary" name="proses">Proses</button>
 </form>

 <?php 
 if (isset($_POST["proses"]))
 {
 	$resi = $_POST["resi"];
 	$status = $_POST["status"];
 	$koneksi->query("UPDATE pembelian SET resi_pengiriman='$resi', status_pembelian='$status'
 		WHERE id_pembelian='$id_pembelian'");

 	echo "<script>alert('Data Pembelian diperbarui');</script>";
 	echo "<script>location='index.php?halaman=pembelian';</script>";
 }
  ?>

