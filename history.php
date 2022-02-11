<?php 
session_start();
include 'koneksi/koneksi.php';
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
 {
    echo "<script>alert ('Silahkan Login');</script>";
    echo "<script>location='account.php';</script>";
    exit();
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

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $nomor=1;
                $id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];
                $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
                while($pecah = $ambil ->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $nomor;  ?></td>
                    <td><?php echo $pecah["tanggal_pembelian"] ?></td>
                    <td>
                        <?php echo $pecah["status_pembelian"] ?>
                        <br>
                        <?php if(!empty($pecah['resi_pengiriman'])): ?>
                        Resi: <?php echo $pecah['resi_pengiriman']; ?>
                    <?php endif ?>
                    </td>
                    <td>Rp. <?php echo number_format($pecah["total_pembelian"]) ?></td>
                    <td>
                        <a href="note.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-info">nota</a>
                        <?php if ($pecah['status_pembelian']=="pending"): ?>
                        <a href="payment.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-success">input pembayaran</a>
                    <?php else: ?>
                    <a href="see_payment.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-warning">Lihat pembayaran</a>
                    <?php endif ?>
                    </td>
                </tr>
                <?php $nomor++ ?>
                <?php } ?>
            </tbody>
        </table>

        
    </div>
    



    <?php include 'footer/footer.php'; ?>


    <script src="static/js/script.js"></script>



</body>

</html>