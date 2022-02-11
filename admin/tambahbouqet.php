<h1>Tambah Bouqet</h1>


<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>nama</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<!-- <div class="form-group">
 		<label>kategori</label>
 		<select class-"form-control" name="kategori">
 			<option value="">Pilih</option>
 			<option value="small">Small</option>
 			<option value="medium">Medium</option>
 			<option value="large">Large</option>
 			<option value="pop">Pop Up Card</option>
 		</select>
 	</div> -->
	<div class="form-group">
		<label>harga</label>
		<input type="number" class="form-control" name="harga">
	</div>
	<div class="form-group">
		<label>berat (gr)</label>
		<input type="number" class="form-control" name="berat">
	</div>
	<div class="form-group">
		<label>deskripsi</label>
		<textarea class="form-control" name="deskripsi" row="10"></textarea>
	</div>
	<div class="form-group">
		<label>stok</label>
		<input type="number" class="form-control" name="stok">
	</div>
	<div class="form-group">
		<label>foto</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<button class="btn btn-primary" name="save">simpan</button>
</form>
<?php 
if (isset($_POST['save']))
{
	$nama = $_FILES['foto']['name'];
	$lokasi =$_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasi, "../foto_bouqet/".$nama);
	$koneksi->query("INSERT INTO bouqet
		(nama_produk,harga_produk,berat_produk,foto_bouqet,deskripsi_produk,stok_produk)
			VALUES ('$_POST[nama]','$_POST[harga]','$_POST[berat]','$nama','$_POST[deskripsi]','$_POST[stok]')");
	// $koneksi->query("INSERT INTO bouqet
	// 	(nama_produk,kategori,harga_produk,berat_produk,foto_bouqet,deskripsi_produk,stok_produk)
	// 		VALUES ('$_POST[nama]','$_POST[kategori]','$_POST[harga]','$_POST[berat]','$nama','$_POST[deskripsi]','$_POST[stok]')");
	echo "<div class='alert alert-info'>Data Tersimpan</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=bouqet'>";
}
 ?>