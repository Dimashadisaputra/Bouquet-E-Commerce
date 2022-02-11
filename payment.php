<?php 
session_start();
include 'koneksi/koneksi.php';
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
 {
    echo "<script>alert ('Silahkan Login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
 }

 $idpem = $_GET["id"];
 $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
 $detpem = $ambil->fetch_assoc();

 $id_pelanggan_beli = $detpem["id_pelanggan"];
 $id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

 if ($id_pelanggan_login !==$id_pelanggan_beli)
 {
    echo "<script>alert ('Jangan Nakal');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
 }
?>
<!-- ====== -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="static/css/style.css" />
    <title>Nilara | E-commerce Website</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="index.php">
                    <img src="static/img/pngLOGO/logo-2.png" alt="" / width="125px">
                </a>
                </div>
                
                <?php include 'navbar/navbar.php'; ?>

                <img src="images/menu.png" alt="" class="menu-icon" onclick="menutoggle()">
            </div>
        </div>
   


    <div class="small-container">

        <div class="row">
            

            <form method="post" enctype="multipart/form-data">
                <h2>Konfirmasi Pembayaran</h2>
                <p>Kirim Bukti Pembayaran Anda disini
                Total Tagihan Anda <strong>Rp. <?php echo number_format($detpem["total_pembelian"]) ?></strong></p><br>
                <div class="form-group">
                    <label>Nama penyetor</label>
                    <input type="text" class="form-control" name="nama" >
                </div>
                <div class="form-group">
                    <label>Bank</label>
                    <input type="text" class="form-control" name="bank" >
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" class="form-control" name="jumlah" min="1" >
                </div>
                <div class="form-group">
                    <label>Foto Bukti</label>
                    <input type="file" class="form-control" name="bukti" >
                    <p class="text-danger">foto bukti maksimal 2MB</p>
                </div>
                <button class="btn btn-success" name="kirim">Kirim</button>
            </form>
        </div> 

        <?php 
        if (isset($_POST["kirim"]))
        {
            $namabukti = $_FILES["bukti"]["name"];
            $lokasibukti = $_FILES["bukti"]["tmp_name"];
            $namafix = date("YmdHis").$namabukti;
            move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafix");

            $nama = $_POST["nama"];
            $bank = $_POST["bank"];
            $jumlah = $_POST["jumlah"];
            $tanggal = date("y-m-d");

            $koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti)
                VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafix')");

            $koneksi->query("UPDATE pembelian SET status_pembelian='sukses terkirim'
                WHERE id_pembelian='$idpem'");

            echo "<script>alert ('Terima Kasih Sudah Mengirim pembayaran');</script>";
            echo "<script>location='history.php';</script>";
        }
        ?>
        </div>

        
        
    </div>



    <?php include 'footer/footer.php'; ?>


    <script src="static/js/script.js"></script>



</body>

</html>