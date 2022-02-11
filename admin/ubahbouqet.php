<h1>ubah produk</h1>
<?php 
$ambil=$koneksi->query("SELECT * FROM bouqet WHERE id_produk='$_GET[id]'");
$pecah= $ambil->fetch_assoc();

 ?>

 <form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>nama</label>
		<input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_produk']; ?>">
	</div>
	<!-- <div class="form-group">
 		<label>kategori</label>
 		<select class-"form-control" name="kategori">
 			<option value="<?php echo $pecah['kategori']; ?>">Pilih</option>
 			<option value="small">Small</option>
 			<option value="medium">Medium</option>
 			<option value="large">Large</option>
 			<option value="pop">Pop Up Card</option>
 		</select>
 	</div> -->
	<div class="form-group">
		<label>harga</label>
		<input type="number" name="harga" class="form-control" value="<?php echo $pecah['harga_produk']; ?>">
	</div>
	<div class="form-group">
		<label>berat</label>
		<input type="number" name="berat" vclass="form-control" value="<?php echo $pecah['berat_produk']; ?>">
	</div>
	<div class="form-group">
		<img src="../foto_bouqet/<?php echo $pecah['foto_bouqet']; ?>" width="200">
	</div>
	<div class="form-group">
		<label>Ganti Foto</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<div class="form-group">
		<label>deskripsi</label>
		<textarea name="deskripsi" class="form-control" rows="10"><?php echo $pecah['deskripsi_produk']; ?></textarea>
	</div>
	<div class="form-group">
		<label>stok</label>
		<input type="number" name="stok" class="form-control" value="<?php echo $pecah['stok_produk']; ?>">
	</div>
	<button class="btn btn-primary" name="ubah">simpan</button>
</form>

<?php 
if (isset($_POST['ubah']))
{
	$namafoto=$_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];

	if (!empty($lokasifoto))
	{
		move_uploaded_file($lokasifoto, "../foto_bouqet/$namafoto");

		$koneksi->query("UPDATE bouqet SET nama_produk='$_POST[nama]',
			harga_produk='$_POST[harga]',berat_produk='$_POST[berat]',
			foto_bouqet='$namafoto',deskripsi_produk='$_POST[deskripsi]'
			,stok_produk='$_POST[stok]'
			 WHERE id_produk='$_GET[id]'");
	}
	else
	{
		$koneksi->query("UPDATE bouqet SET nama_produk='$_POST[nama]',
			harga_produk='$_POST[harga]',berat_produk='$_POST[berat]'
			,deskripsi_produk='$_POST[deskripsi]',stok_produk='$_POST[stok]' WHERE id_produk='$_GET[id]'");
	}
	
	echo "<script>alert('data produk telah diubah');</script>";
	echo "<script>location='index.php?halaman=bouqet';</script>";
}
 ?>

<!-- if (isset($_POST['ubah']))
{
	$namafoto=$_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];

	if (!empty($lokasifoto))
	{
		move_uploaded_file($lokasifoto, "../foto_bouqet/$namafoto");

		$koneksi->query("UPDATE bouqet SET nama_produk='$_POST[nama]',kategori='$_POST[kategori]',
			harga_produk='$_POST[harga]',berat_produk='$_POST[berat]',
			foto_bouqet='$namafoto',deskripsi_produk='$_POST[deskripsi]'
			,stok_produk='$_POST[stok]'
			 WHERE id_produk='$_GET[id]'");
	}
	else
	{
		$koneksi->query("UPDATE bouqet SET nama_produk='$_POST[nama]',kategori='$_POST[kategori]',
			harga_produk='$_POST[harga]',berat_produk='$_POST[berat]'
			,deskripsi_produk='$_POST[deskripsi]',stok_produk='$_POST[stok]' WHERE id_produk='$_GET[id]'");
	}
	
	echo "<script>alert('data produk telah diubah');</script>";
	echo "<script>location='index.php?halaman=bouqet';</script>";
} -->