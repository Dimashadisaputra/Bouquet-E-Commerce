<?php 
session_start();

include 'koneksi/koneksi.php';

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
<div class="small-container cart-page">

    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Sub Total</th>
        </tr>
            <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
            <?php
                $ambil = $koneksi->query("SELECT * FROM bouqet
                WHERE id_produk='$id_produk'");
                $pecah = $ambil->fetch_assoc(); 
                $subharga = $pecah ["harga_produk"]*$jumlah; ?>
        <tr>
            <td>
                <div class="cart-info">
                    <img src="foto_bouqet/<?php echo $pecah['foto_bouqet']; ?>" alt="">
                    <div>
                        <p><?php echo $pecah["nama_produk"]; ?></p>
                        <small>Rp. <?php echo number_format($pecah["harga_produk"]); ?></small>
                        <br>
                        <a href="hapuscart.php?id=<?php echo $id_produk ?>">Remove</a>
                    </div>
                </div>
            </td>
            <td> <?php echo $jumlah; ?></td>
            <td>Rp. <?php echo number_format($subharga); ?></td>
        </tr>
        <!-- <?php $totalbelanja+=$subharga; ?> -->
        <?php endforeach ?>
    </table>

    <div class="total-price">
        <table>
            <tr>
                <td>Sub Total</td>
                <td>Rp. <?php echo number_format($totalbelanja); ?></td>
            </tr>
            <tr>
                <td><a href="products.php" class="btn">continue shopping</a></td>
                <td><a href="PayNow.php" class="btn">Pay Now</a></td>
            </tr>
            
        </table>
    </div>

</div>


    <?php include 'footer/footer.php'; ?>

    <script src="static/js/script.js"></script>



</body>
</html>