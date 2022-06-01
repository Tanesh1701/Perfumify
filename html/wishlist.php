<?php
    ob_start();
    session_start();
    include("../html/connection.php");
    include("../html/functions.php");

    $user = check_login($con);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>Perfumify: Wishlist</title>
</head>
<body>
    <header class="header" style="background-color: black; height: 100;">  
        <div class="container">
            <h4 class="headerTitle"><a href="index.php" class="headerTitleLink">Perfumify</a></h4>
            <nav>
                <ul class="mainLinks">
                    <li><a href="about.php">About</a></li>
                    <div class="dropdown">
                        <button class="dropbtn">Fragrances
                          <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                          <div class="header">
                            <h2 style="font-size: 16px;">Categories</h2>
                          </div>   
                          <div class="row">
                            <div class="column">
                              <h3>General</h3>
                              <a href="menProducts.php">Men</a>
                              <a href="#">Women</a>
                            </div>
                            <div class="column">
                              <h3>Brand</h3>
                              <a href="#">Chanel</a>
                              <a href="#">Gucci</a>
                              <a href="#">Joe Malone</a>
                            </div>
                            <div class="column">
                              <h3>Brand</h3>
                              <a href="#">Louis Vuitton</a>
                              <a href="#">Prada</a>
                              <a href="#">Ralph Lauren</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <li><a href="contact_us.php">Contact Us</a></li>
                    <?php
                        if ($user){
                            ?>
                            <li><a class="account" href="myAccount.php">My Account</a></li>
                            <?php
                        } else {
                            ?>
                            <li><a class="loginAnchor" href="login.php">Login</a></li>
                            <?php
                        }
                    ?>
                </ul>
                <ul class="secondaryLinks">
                <li><a href="map.php"><span style="color:whitesmoke; font-size:22px;" class="material-icons-outlined">place</span></a></li>
                    <li><a href="wishlist.php"><span style="color:whitesmoke; font-size:22px;" class="material-icons">favorite_border</span></a></li>
                    <li><a href=""><span style="color:whitesmoke; font-size:22px;" class="material-icons-outlined">shopping_bag</span></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <h1 class="title">my wishlist</h1>

    
    <div class="perfumeList">
    
        <div class="perfumes">
            <img src="../images/men's perfumes/lv_imagination.jpeg" alt="imagination" style="height: 100%; width: 100%; object-fit: cover;">
            <span class="material-icons">close</span>
            <div class="container">
                <h4 style="font-family: 'Varela Round', sans-serif; text-align: center; font-style: normal; text-transform: uppercase; letter-spacing: 0.115385em;"><b>Imagination</b></h4>
                <p style="font-family: 'Varela Round', sans-serif; text-align: center;">$360.00</p>
            </div>
        </div>
        <div class="perfumes">
            <img src="../images/men's perfumes/lv_imagination.jpeg" alt="imagination" style="height: 100%; width: 100%; object-fit: cover;">
            <span class="material-icons">close</span>
            <div class="container">
                <h4 style="font-family: 'Varela Round', sans-serif; text-align: center; font-style: normal; text-transform: uppercase; letter-spacing: 0.115385em;"><b>Imagination</b></h4>
                <p style="font-family: 'Varela Round', sans-serif; text-align: center;">$360.00</p>
            </div>
        </div>
        <div class="perfumes">
            <img src="../images/men's perfumes/lv_imagination.jpeg" alt="imagination" style="height: 100%; width: 100%; object-fit: cover;">
            <span class="material-icons">close</span>
            <div class="container">
                <h4 style="font-family: 'Varela Round', sans-serif; text-align: center; font-style: normal; text-transform: uppercase; letter-spacing: 0.115385em;"><b>Imagination</b></h4>
                <p style="font-family: 'Varela Round', sans-serif; text-align: center;">$360.00</p>
            </div>
        </div>
        <div class="perfumes">
            <img src="../images/men's perfumes/lv_imagination.jpeg" alt="imagination" style="height: 100%; width: 100%; object-fit: cover;">
            <span class="material-icons">close</span>
            <div class="container">
                <h4 style="font-family: 'Varela Round', sans-serif; text-align: center; font-style: normal; text-transform: uppercase; letter-spacing: 0.115385em;"><b>Imagination</b></h4>
                <p style="font-family: 'Varela Round', sans-serif; text-align: center;">$360.00</p>
            </div>
        </div>
        <div class="perfumes">
            <img src="../images/men's perfumes/lv_imagination.jpeg" alt="imagination" style="height: 100%; width: 100%; object-fit: cover;">
            <span class="material-icons">close</span>
            <div class="container">
                <h4 style="font-family: 'Varela Round', sans-serif; text-align: center; font-style: normal; text-transform: uppercase; letter-spacing: 0.115385em;"><b>Imagination</b></h4>
                <p style="font-family: 'Varela Round', sans-serif; text-align: center;">$360.00</p>
            </div>
        </div>
        <div class="perfumes">
            <img src="../images/men's perfumes/lv_imagination.jpeg" alt="imagination" style="height: 100%; width: 100%; object-fit: cover;">
            <span class="material-icons">close</span>
            <div class="container">
                <h4 style="font-family: 'Varela Round', sans-serif; text-align: center; font-style: normal; text-transform: uppercase; letter-spacing: 0.115385em;"><b>Imagination</b></h4>
                <p style="font-family: 'Varela Round', sans-serif; text-align: center;">$360.00</p>
            </div>
        </div>
    </div>

    <footer style = "margin-top: 200px;"class = "footer">
        <div class = "footerContainer">
            <div class = "footer-row">
                <div class = "footer-col">
                    <h4>Perfumify</h4>
                    <ul style = "position: relative; right: 40px">
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="contact_us.php">Contact Us</a></li>
                        <li><a href="sitemap.php">Site Map</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                    </ul>
                </div>
                    <div class = "footer-col">
                        <h4>Shop Now</h4>
                        <ul style = "position: relative; right: 40px">
                            <li><a href="menProducts.php">Men's Perfumes</a></li>
                            <li><a href="">Women's Perfumes</a></li>
                            <li><a href="">Chanel</a></li>
                            <li><a href="">Gucci</a></li>
                            <li><a href="">Joe Malone</a></li>
                            <li><a href="">Louis Vuitton</a></li>
                            <li><a href="">Ralph Lauren</a></li>
                        </ul>
                    </div>
                    <div class = "footer-col">
                        <h4>Main HQ</h4>
                        <p>+1 (646) 555-3890</p>
                        <p>46th Avenue, New York</p>
                    </div>
                    <div class = "footer-col">
                    <h4>Follow Us</h4>
                    <div class = "social-links">
                        <a href=""><i class = "fab fa-facebook-f"></i></a>
                        <a href=""><i class = "fab fa-twitter"></i></a>
                        <a href=""><i class = "fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>