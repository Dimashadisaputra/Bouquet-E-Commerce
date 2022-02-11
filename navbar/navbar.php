<nav>
    <ul id="MenuItems">
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="PayNow.php">Pay Now</a></li>
            <?php if(isset($_SESSION["pelanggan"])): ?>
            <li><a href="history.php">Shopping History</a></li>
            <li><a href="logout.php">Log Out</a></li>
            <?php else: ?>
            <li><a href="account.php">Account</a></li>
            <?php endif ?>

    </ul>
</nav>

<a href="cart.php">
<img src="images/cart.png" alt="" width="40px" height="40px" /></a>