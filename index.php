<?php 
session_start();
include 'koneksi/koneksi.php';
?>

<!-- =============== -->


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
    <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="index.php">
                        <img src="static/img/pngLOGO/logo-2.png" alt=""  width="125px">
                    </a>
                </div>
                
                <?php include 'navbar/navbar.php'; ?>

                <img src="images/menu.png" alt="" class="menu-icon" onclick="menutoggle()">
            </div>
            <div class="row">
                <div class="col-3">
                    <h1>Change your lens, <br />Change your Story.</h1>
                    <p>
                        When words becomes unclear, I shall focus with photographs.<br />When
                        Images becomes inadequate, I shall be content with silence.
                    </p>
                    <div  class="carii">
                    <form class="cari" method="get" action="pencarian.php">
                        <input  name="keyword" type="text" placeholder="Seacrh Bouquet" aria-label="Search">
                        <button class="btn" type="submit">Search </button>
                    </form></div>
                </div>
                
                <div class="col-3">
                    <img src="static/img/pngLOGO/logo-1.png" alt="" />
                </div>
                
            </div>
        </div>
    </div>

    <div class="categories">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <img src="static/img/md-1.jpg" alt="" />
                </div>
                <div class="col-3">
                    <img src="static/img/sm-2.jpg" alt="" />
                </div>
                <div class="col-3">
                    <img src="static/img/md-2.jpg" alt="" />
                </div>
            </div>
        </div>
    </div>

<!-- ================== -->

    <div class="small-container">
        <h2 class="title">the most sold items</h2>
        <div class="row">
            <?php $ambil = $koneksi->query("SELECT * FROM bouqet ORDER BY stok_produk LIMIT 4 "); ?>
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

<!-- ================== -->

        <h2 class="title">recently added items</h2>
        <div class="row">
        <?php $ambil = $koneksi->query("SELECT * FROM bouqet ORDER BY stok_produk DESC LIMIT 8 "); ?>
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


<!-- ================== -->

    <?php include 'footer/footer.php'; ?>


    <script src="static/js/script.js"></script>



</body>

</html>