<?php 
session_start();
$koneksi = new mysqli("localhost","root","","laquineshop");

if (!isset($_SESSION['admin']))
{
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="assets/css/styles.css">


        <title>Sidebar menu responsive</title>
    </head>
    <body id="body-pd">
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>

            
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="#" class="nav__logo">
                        <i class='bx bx-layer nav__logo-icon'></i>
                        <span class="nav__logo-name">Laquinne</span>
                    </a>

                    <div class="nav__list">
                        <a href="index.php" class="nav__link active">
                        <i class='bx bx-grid-alt nav__icon' ></i>
                            <span class="nav__name">Dashboard</span>
                        </a>

                        <a href="index.php?halaman=bouqet" class="nav__link">
                            <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__name">Bouquet</span>
                        </a>
                        
                        <a href="index.php?halaman=pembelian" class="nav__link">
                            <i class='bx bx-message-square-detail nav__icon' ></i>
                            <span class="nav__name">Pembelian</span>
                        </a>

                        <a href="#" class="nav__link">
                            <i class='bx bx-bookmark nav__icon' ></i>
                            <span class="nav__name">wkwk</span>
                        </a>

                        <a href="index.php?halaman=laporan_pembelian" class="nav__link">
                            <i class='bx bx-folder nav__icon' ></i>
                            <span class="nav__name">Laporan</span>
                        </a>

                        <a href="index.php?halaman=pelanggan" class="nav__link">
                            <i class='bx bx-bar-chart-alt-2 nav__icon' ></i>
                            <span class="nav__name">pelanggan</span>
                        </a>
                    </div>
                </div>

                <a href="index.php?halaman=logout" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

        <?php
                if (isset($_GET['halaman']))
                {
                    if ($_GET['halaman']=="bouqet")
                    {
                        include 'bouqet.php';
                    }
                    elseif ($_GET['halaman']=="pembelian")
                    {
                        include 'pembelian.php';
                    }
                    elseif ($_GET['halaman']=="pelanggan")
                    {
                        include 'pelanggan.php';
                    }
                    elseif ($_GET['halaman']=="detail")
                    {
                        include 'detail.php';
                    }
                    elseif ($_GET['halaman']=="tambahbouqet")
                    {
                        include 'tambahbouqet.php';
                    }
                    elseif ($_GET['halaman']=="tambahpelanggan")
                    {
                        include 'tambahpelanggan.php';
                    }
                    elseif ($_GET['halaman']=="hapusbouqet")
                    {
                        include 'hapusbouqet.php';
                    }
                    elseif ($_GET['halaman']=="hapuspelanggan")
                    {
                        include 'hapuspelanggan.php';
                    }
                    elseif ($_GET['halaman']=="ubahbouqet")
                    {
                        include 'ubahbouqet.php';
                    }
                    elseif ($_GET['halaman']=="logout")
                    {
                        include 'logout.php';
                    }
                    elseif ($_GET['halaman']=="pembayaran")
                    {
                        include 'pembayaran.php';
                    }
                    elseif ($_GET['halaman']=="laporan_pembelian")
                    {
                        include 'laporan_pembelian.php';
                    }
                    elseif ($_GET['halaman']=="detailpelanggan")
                    {
                        include 'detailpelanggan.php';
                    }


                } 
                else
                {
                    include 'home.php';
                }
                 ?>
        <!--===== MAIN JS =====-->
        <script src="assets/js/main.js"></script>
    </body>
</html>