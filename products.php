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
                    <img src="static/img/pngLOGO/logo-2.png" alt="" / width="125px">
                </a>
                </div>
                
                <?php include 'navbar/navbar.php'; ?>

                <img src="images/menu.png" alt="" class="menu-icon" onclick="menutoggle()">
            </div>
        </div>
   


    <div class="small-container">

        <div class="row">
        <?php $ambil = $koneksi->query("SELECT * FROM bouqet "); ?>
            <?php while($perproduk = $ambil->fetch_assoc()) { ?>
                <div class="col-4">
                    <a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>">
                        <img src="foto_bouqet/<?php echo $perproduk['foto_bouqet']; ?> " alt="" />
                    </a>
                    <a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>">

                        <h4><?php echo $perproduk['nama_produk']; ?></h4>
                    </a>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <p>Rp. <?php echo number_format($perproduk['harga_produk']); ?></p>
                    <!-- <a href="buy.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn">Buy Now &#8594;</a> -->
                </div>
            <?php } ?>
        </div>

        
    </div>
    </div>



    <?php include 'footer/footer.php'; ?>


    <script src="static/js/script.js"></script>



</body>

</html>