<?php 

$ambil = $koneksi->query("SELECT * FROM bouqet WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc;
$fotobouqet = $pecah['foto_bouqet'];
if (file_exists("../foto_bouqet/$fotobouqet"))
{
	unlink("../foto_bouqet/$fotobouqet");
}

$koneksi->query("DELETE FROM bouqet WHERE id_produk='$_GET[id]'");

echo "<script>alert('bouqet terhapus');</script>";
echo "<script>location='index.php?halaman=bouqet';</script>";

 ?>
