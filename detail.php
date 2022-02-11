<?php session_start(); ?>
<?php include 'koneksi/koneksi.php'; ?>
<?php   
// mendapatkan id_produk dari url
$id_produk = $_GET["id"];

// query ambil data
$ambil = $koneksi->query("SELECT * FROM bouqet WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();


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
                <img src="static/img/pngLOGO/logo-2.png" alt=""  width="125px">
            </a>
            </div>
            
            <?php include 'navbar/navbar.php'; ?>

            <img src="images/menu.png" alt="" class="menu-icon" onclick="menutoggle()">
        </div>
    </div>


    <form method="post">
    <div class="small-container single-product">
        <div class="row">
            <div class="col-2">
                <img src="foto_bouqet/<?php echo $detail['foto_bouqet']; ?>" alt="" width="100%" id="ProductImg">

            </div>
            
                <div class="col-2">
                    <h1><?php echo $detail['nama_produk']; ?></h1>
                    <p>Stock : <?php echo $detail['stok_produk']; ?></p>
                    <h4>Rp.<?php echo number_format($detail['harga_produk']); ?></h4>
                    <?php if ($detail['stok_produk']==0): ?>
                    <input type="number" disabled value="0" placeholder="stock habis" >
                    <button type="submit" class="btn" disabled>the item is out of stock</button>
                    <?php else: ?>
                    <p>amount of this purchased item</p>
                    <input type="number" min="1"  name="jumlah">
                    <button class="btn" type="submit" name="pesan">Add to Cart</button>
                    <?php endif ?>

                    <?php   
                    // jk ada tombol pesan
                    if (isset($_POST["pesan"])) 
                    {
                        // mendapatkan jumlah yang di inputkan
                        $jumlah = $_POST["jumlah"];
                        // masukkan di keranjang
                        $_SESSION["keranjang"][$id_produk] = $jumlah ;
                        echo "<script>location='cart.php';</script>";
                    }

                
                    ?>

                    <h3>Product Details <i class="fa fa-indent"></i></h3>
                    <br>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga consequuntur expedita neque, unde iste voluptatum!</p>
            </div>
            
        </div>
    </div></form>


    <div class="small-container">
        <div class="row row-2">
            <h2>recommended items</h2>
            
        </div>
    </div>

    <div class="small-container">


        <div class="row">
            <?php $ambil = $koneksi->query("SELECT * FROM bouqet ORDER BY stok_produk DESC LIMIT 4 "); ?>
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
                    <p>Stock: <?php echo ($perproduk['stok_produk']); ?></p>
                    <p>Rp. <?php echo number_format($perproduk['harga_produk']); ?></p>
                </div>
            <?php } ?>
        </div>
    
    </div>


<!-- belom kelar besok lagi -->
    <div class="testimonial">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <?php 
                    $ambil = $koneksi->query("SELECT * FROM komentar WHERE id_produk='$id_produk'");
                    while($pecah = $ambil ->fetch_assoc()){ ?>
                    <div class="isikomen">
                        <h3><?php echo $pecah['nama_komen']; ?></h3>
                        <p><?php echo $pecah['isi_komen']; ?></p>
                        <img src="foto_komen/<?php echo $pecah['foto_komen']; ?> " alt="" />
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="offer row">
    <form method="post" enctype="multipart/form-data">
        <label>Nama Anda</label>
        <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?>" class="form-control">
        <label>Foto komen</label>
        <input type="file" class="form-control" name="foto_komen" >
        <label>komentar disini</label>
        <input class="form-control" name="isi_komen" placeholder="silahkan masukan komentar"></input>
        <button class="btn btn-info" name="kirim_komen">kirim</button>
    </form>
    </div>



    <?php include 'footer/footer.php'; ?>


    <script src="static/js/script.js"></script>


</body>

</html>