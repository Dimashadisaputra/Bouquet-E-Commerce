<h1>tambah pelanggan</h1>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>nama</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<div class="form-group">
		<label>email</label>
		<input type="text" class="form-control" name="email">
	</div>
	<div class="form-group">
		<label>password</label>
		<input type="password" class="form-control" name="password">
	</div>
	<div class="form-group">
		<label>no.telepon</label>
		<input type="number" class="form-control" name="telepon">
	</div>
	<button class="btn btn-primary" name="save">simpan</button>
</form>

<?php 
if (isset($_POST['save']))
{
	$nama = $_FILES['foto']['name'];
	$lokasi =$_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasi, "../foto_produk/".$nama);
	$koneksi->query("INSERT INTO pelanggan
		(nama_pelanggan,email_pelanggan,password_pelanggan,telepon_pelanggan)
			VALUES ('$_POST[nama]','$_POST[email]','$_POST[password]','$_POST[telepon]')");
	echo "<div class='alert alert-info'>Data Tersimpan</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
}
 ?>