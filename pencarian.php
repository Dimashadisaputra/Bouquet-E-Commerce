<?php 
session_start();
include 'koneksi/koneksi.php';
$keyword = $_GET["keyword"];

$semuadata=array();
$ambil = $koneksi->query("SELECT * FROM bouqet WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%'");
while($pecah = $ambil->fetch_assoc())
{
    $semuadata[]=$pecah;
}
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
    <h1 class="mt-5">Hasil Pencarian : <?php echo $keyword ?></h1>
        <?php if (empty($semuadata)): ?>
            <div class="alert alert-danger">Produk <strong><?php echo $keyword ?></strong> tidak ditemukan</div>
        <?php endif ?>
        <div class="row mt-5">
            
        

        <!-- === -->
        <div class="row">
            <?php foreach ($semuadata as $key => $value): ?>
                <div class="col-4">
                    <a href="detail.php?id=<?php echo $value['id_produk']; ?>">
                        <img src="foto_bouqet/<?php echo $value['foto_bouqet']; ?> " alt="" />
                    </a>
                    <a href="detail.php?id=<?php echo $value['id_produk']; ?>">

                        <h4><?php echo $value['nama_produk']; ?></h4>
                    </a>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <p>Rp. <?php echo number_format($value['harga_produk']); ?></p>
                    <!-- <a href="buy.php?id=<?php echo $value['id_produk']; ?>" class="btn">Buy Now &#8594;</a> -->
                </div>
            <?php endforeach ?>
        </div>

        
    
    </div>



    <?php include 'footer/footer.php'; ?>


    <script src="static/js/script.js"></script>



</body>

</html>