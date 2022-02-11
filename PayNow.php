<?php 
session_start();
include 'koneksi/koneksi.php';

if (!isset($_SESSION["pelanggan"]))
{
    echo "<script>alert('you have to log in first');</script>";
    echo "<script>location='account.php';</script>;";
}
if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
    echo "<script>alert('Cart is empty');</script>";
    echo "<script>location='products.php';</script>;";
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="static/css/style.css" />
    <title>Nilara | E-commerce Website</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="index.php">
                <img src="static/img/pngLOGO/logo-2.png"  width="125px">
            </a>
            </div>
            
            <?php include 'navbar/navbar.php'; ?>

            <img src="images/menu.png" alt="" class="menu-icon" onclick="menutoggle()">
        </div>
    </div>
    </div>
    <br>
    <h2 class="title"><i class="fas fa-cash-register"></i> Pay Now</h2>
    <div class="small-container cart-page">
    <table class="table table-bordered">
        <thead>
            <tr>
                
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Sub Total</th>
             
            </tr>
        </thead>
        <tbody>
            
            <?php $totalbelanja=0; ?>
            <?php foreach ($_SESSION["keranjang"] as $id_produk =>$jumlah): ?>
            <?php
             $ambil = $koneksi->query("SELECT * FROM bouqet
                WHERE id_produk='$id_produk'");
                $pecah = $ambil->fetch_assoc(); 
                $subharga = $pecah ["harga_produk"]*$jumlah; ?>
            <tr>
                
                <td><?php echo $pecah["nama_produk"]; ?></td>
                <td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
                <td><?php echo $jumlah; ?></td>
                <td>Rp. <?php echo number_format($subharga); ?></td>
            </tr>
            
            <?php $totalbelanja+=$subharga; ?>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">total cost</th>
                <th>Rp. <?php echo number_format($totalbelanja) ?></th>
            </tr>
        </tfoot>
    </table>
    

    
    <div class="small-container">
        <br>
        <div class="col-3">
            <div class="carii">
                <form method="post" class="cari" >
                    <h2>Fill In The Destination Address</h2><br>
                    <h3><?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?></h3>
                    <input  name="alamat_pengiriman" placeholder="Kota, RT/RW No.rumah"></input>
                    <h3><?php echo $_SESSION["pelanggan"]['telepon_pelanggan'] ?></h3>
                    <select  name="id_ongkir">
                        <option value="">Pilih Ongkos kirim</option>
                        <?php $ambil = $koneksi->query("SELECT * FROM ongkir");
                        while($perongkir = $ambil->fetch_assoc()) { ?>
                        <option value="<?php echo $perongkir["id_ongkir"] ?>">
                            <?php echo $perongkir['nama_kota'] ?> -
                            Rp. <?php echo number_format($perongkir['tarif']) ?>
                        </option>
                        <?php } ?>
                    </select>
                    <input  name="kode_pos" placeholder="kode pos"></input>
                    <button class="btn" name="checkout">Pay Now</button>
                </form>

                <?php
            if (isset($_POST["checkout"]))
            {
                $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                $id_ongkir = $_POST["id_ongkir"];
                $tanggal_pembelian = date("y-m-d");
                $alamat_pengiriman = $_POST['alamat_pengiriman'];
                $kode_pos = $_POST['kode_pos'];

                $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
                $arrayongkir = $ambil->fetch_assoc();
                $nama_kota = $arrayongkir['nama_kota'];
                $tarif = $arrayongkir['tarif'];

                $total_pembelian = $totalbelanja + $tarif;

                $koneksi->query("INSERT INTO pembelian (
                    id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman,kode_pos )
                    VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman','$kode_pos')");

                $id_pembelian_barusan = $koneksi->insert_id;

                foreach ($_SESSION["keranjang"] as $id_produk => $jumlah)
                {
                    $ambil=$koneksi->query("SELECT * FROM bouqet WHERE id_produk='$id_produk'");
                    $perproduk = $ambil->fetch_assoc();

                    $nama = $perproduk['nama_produk'];
                    $harga = $perproduk['harga_produk'];
                    $berat = $perproduk['berat_produk'];

                    $subberat = $perproduk['berat_produk']*$jumlah;
                    $subharga = $perproduk['harga_produk']*$jumlah;
                    $koneksi->query("INSERT INTO pembelian_produk (id_pembelian, 
                        id_produk,nama,harga,berat,subberat,subharga, jumlah)
                        VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");

                        $koneksi->query("UPDATE bouqet SET stok_produk=stok_produk -$jumlah 
                            WHERE id_produk='$id_produk'");                    
                }

                unset($_SESSION["keranjang"]);

                
                echo "<script>location='note.php?id=$id_pembelian_barusan';</script>";
            } 
             ?>
                
            </div>  
        </div>
    </div>
    

</div>


    <?php include 'footer/footer.php'; ?>

    <script src="static/js/script.js"></script>



</body>

</html>