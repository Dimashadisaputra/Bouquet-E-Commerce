<?php 
session_start();
include 'koneksi/koneksi.php';
?>

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
                        <img src="static/img/pngLOGO/logo-2.png"  width="125px">
                    </a>
                </div>
                
                <?php include 'navbar/navbar.php'; ?>

                <img src="images/menu.png" alt="" class="menu-icon" onclick="menutoggle()">
                </div>
            </div>
        </div>
    
        <div class="brands">
            <div class="small-container">
                <?php 
                    $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
                        ON pembelian.id_pelanggan=pelanggan.id_pelanggan
                        WHERE pembelian.id_pembelian='$_GET[id]'");
                        $detail = $ambil->fetch_assoc();
                        ?>

                        <?php 
                        $idpelangganyangbeli = $detail["id_pelanggan"];
                        $idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];
                        if ($idpelangganyangbeli!==$idpelangganyanglogin)
                        {
                            
                            echo "<script>location='riwayat.php';</script>";
                            exit();
                        }
                ?>

                <div class="row">
                    <div class="col-5">
                        <h4>
                            Date : <br><?php echo $detail['tanggal_pembelian']; ?><br>
                            Total : <?php echo number_format($detail['total_pembelian']); ?>
                        </h4>
                    </div>
                    <div class="col-5">
                        <h4>
                            <?php echo $detail['nama_pelanggan']; ?><br>
                            <p>
                                <?php echo $detail['telepon_pelanggan']; ?> <br>
                                <?php echo $detail['email_pelanggan']; ?>
                            </p>
                        </h4>
                    </div>
                    <div class="col-5">
                        <h4>
                            <?php echo $detail['nama_kota']; ?><br>
                            Ongkos Kirim:<br> Rp. <?php echo number_format($detail['tarif']); ?>
                            
                        </h4>
                    </div>
                    <div class="col-5">
                        <h4>
                            Address: <br><?php echo $detail['alamat_pengiriman']; ?><br>
                            Kode pos: <?php echo $detail['kode_pos']; ?>
                        </h4>
                    </div>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            
                            <th>product name</th>
                            <th>Price</th>
                            
                            <th>Quantity</th>
                            
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
                        <?php while($pecah=$ambil->fetch_assoc()){ ?>
                        
                        <td><?php echo $pecah['nama']; ?></td>
                        <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
                        
                        <td><?php echo $pecah['jumlah']; ?></td>
                        
                        <td> Rp. <?php echo number_format($pecah['subharga']); ?></td>
                    </tbody>
                    
                    <?php } ?>
                </table><br><br>

                <div class="offer">
			        <p>Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> Ke</p>
			        <strong>Bank BCA 167-999999-7654 Dimas Hadi</strong>
		        </div>
            </div>

        </div>


        <?php include 'footer/footer.php'; ?>

        <script src="static/js/script.js"></script>



</body>
</html>