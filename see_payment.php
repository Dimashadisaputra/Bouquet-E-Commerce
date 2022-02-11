<?php 
session_start();
include 'koneksi/koneksi.php';
$id_pembelian = $_GET["id"];


$ambil = $koneksi->query("SELECT  * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian WHERE pembelian.id_pembelian='$id_pembelian'");
$detbay = $ambil->fetch_assoc();

if(empty($detbay))
{
    echo "<script>alert('belum ada data pembayaran')</script>";
    echo "<script>location='history.php';</script>";
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
            <div class="col-2">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Bank</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td><?php echo $detbay["nama"] ?></td>
                        <td><?php echo $detbay["bank"] ?></td>
                        <td><?php echo $detbay["tanggal"] ?></td>
                        <td>Rp. <?php echo number_format($detbay["jumlah"]) ?></td>
                    </tbody>
                </table>
            </div>
        </div>
            <div class="col-3">
                <img src="bukti_pembayaran/<?php echo $detbay["bukti"] ?>" class="img-responsive">
            </div>

            
        

        
    
    </div>



    <!-- <?php include 'footer/footer.php'; ?> -->


    <script src="static/js/script.js"></script>



</body>

</html>