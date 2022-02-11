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
    </div>


    <div class="account-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="static/img/pngLOGO/logo-1.png" alt="">
                </div>
                <div class="col-2">
                    <div class="form-container">
                        <div class="form-btn">
                            <span onclick="login()">Login</span>
                            <span onclick="register()">Sign up</span>
                            <hr id="Indicator">
                        </div>
                        <form method="post" id="LoginForm">
                            <input type="text" placeholder="Email" name="email">
                            <input type="password" placeholder="Password" name="password">
                            <button type="submit" class="btn" name="simpan">Login</button>
                        </form>
                        <form method="post" id="RegForm">
                            <input type="text" placeholder="Username" name="nama">
                            <input type="email" placeholder="Email" name="email">
                            <input type="password" placeholder="Password" name="password">
                            <input type="text" placeholder="No/Telepon" name="telepon">
                            <button type="submit" class="btn" name="daftar">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- LOGIN -->
    <?php
    if (isset($_POST['simpan']))
    {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $ambil = $koneksi->query("SELECT * FROM pelanggan
            WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

        $akunyangcocok = $ambil->num_rows;

        if ($akunyangcocok==1)
            {
                $akun = $ambil->fetch_assoc();
                $_SESSION["pelanggan"] = $akun;
                
            
                if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
                {
                    echo "<script>location='PayNow.php';</script>";
                }
                else
                {
                    echo "<script>location='index.php';</script>"; 
                }

            }
        else
            {
                echo "<script>location='account.php';</script>;";
            }
    }   
    ?>

<!-- REGISTER -->
    
    <?php 
        if (isset($_POST["daftar"]))
        {
            $nama = $_POST["nama"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $telepon = $_POST["telepon"];
            $ambil = $koneksi->query("SELECT * FROM pelanggan
                WHERE email_pelanggan='$email'");
            $yangcocok = $ambil->num_rows;
            if ($yangcocok==1)
            {
                echo "<script>alert ('failed, this email is already registered');</script>";
                echo "<script>location='account.php';</script>";                                                                          
            }
            else
            {
                $koneksi->query("INSERT INTO pelanggan (email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan)
                    VALUES ('$email','$password','$nama','$telepon')");
                echo "<script>alert ('successfully registered');</script>";
                echo "<script>location='account.php';</script>";
            }
        }
     ?>

    <?php include 'footer/footer.php'; ?>


    <script src="static/js/script.js"></script>

</body>

</html>