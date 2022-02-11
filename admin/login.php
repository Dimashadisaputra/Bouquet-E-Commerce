<?php 
session_start();
$koneksi = new mysqli("localhost","root","","laquineshop");
 ?>
<html>
<head>
<title>Login Admin</title>
    <link rel="stylesheet" type="text/css" href="dimas/style.css">
<body>
    <div class="loginbox">
    <img src="dimas/Screenshot from 2019-03-03 20-04-15.png" class="avatar">
        <h1>Login Admin</h1>
        <form role="form" method="post">
            <p>Email</p>
            <input type="text" name="user" placeholder="Enter Email">
            <p>Password</p>
            <input type="password" name="pass" placeholder="Enter Password">
            <input type="submit" name="login" value="Login">
        </form>
        <?php 
                        if (isset($_POST['login']))
                        {
                            $ambil = $koneksi->query("SELECT * FROM admin WHERE username='$_POST[user]'
                                AND password ='$_POST[pass]'");
                            $yangcocok = $ambil->num_rows;
                            if ($yangcocok==1)
                            {
                                $_SESSION['admin']=$ambil->fetch_assoc();
                                echo "<div class='alert alert-info'>Login Sukses</div>";
                                echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                            }
                            else
                            {
                                 echo "<div class='alert alert-danger'>Login Gagal</div>";
                                echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                            }
                        }
                         ?>
    </div>

</body>
</head>
</html>