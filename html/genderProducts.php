<?php
    session_start();
    
    include("../html/connection.php");
    include("../html/functions.php");

    $userId = 0;
    $query = "select * from products";
    $title = "All Perfumes";

    $heartIcon = "favorite_border";
    $user = check_login($con);

    if(isset($_GET['gender'])) {
        $gender = $_GET['gender'];
        $query = "select * from products where sex = '$gender'";
        if ($gender == "male") {
            $title = "Men's Perfumes";
        } else if($gender == "female") {
            $title = "Women's Perfumes";
        } 
    }
    $product_data = display_product($con, $query);

    if(isset($user['id'])) {
        $userId =  $user['id'];
    }
    $wishlistQuery = "select * from wishlist join products on wishlist.perfumeID = products.id where wishlist.userID = '$userId'";
    $likedProducts = display_product($con, $wishlistQuery);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Perfumify: <?php echo $title ?></title>
</head>

<body>
    <header class="header" style="background-color: black; height: 100px;">  
        <div class="container">
            <h4 class="headerTitle"><a href="index.php" class="headerTitleLink">Perfumify</a></h4>
            <nav>
                <ul style = "right: 490px;"  class="mainLinks">
                    <li><a href="about.php">About Us</a></li>
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
                              <a href="genderProducts.php">All Products</a>
                              <a href="genderProducts.php?gender=male">Men</a>
                              <a href="genderProducts.php?gender=female">Women</a>
                            </div>
                            <div class="column">
                              <h3>Brand</h3>
                              <a href="brand.php?brand=Chanel">Chanel</a>
                              <a href="brand.php?brand=Gucci">Gucci</a>
                              <a href="brand.php?brand=Jo Malone">Jo Malone</a>
                            </div>
                            <div class="column">
                              <h3>Brand</h3>
                              <a href="brand.php?brand=Louis Vuitton">Louis Vuitton</a>
                              <a href="brand.php?brand=Prada">Prada</a>
                              <a href="brand.php?brand=Ralph Lauren">Ralph Lauren</a>
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
                    <li><a href="search.php"><span style="color:whitesmoke; font-size:22px;" class="material-icons-outlined">search</span></a></li>
                    <li><a href="map.php"><span style="color:whitesmoke; font-size:22px;" class="material-icons-outlined">place</span></a></li>
                    <?php
                      if(count($likedProducts) != 0) {
                    ?>
                      <li><a style="text-decoration: none;" href="wishlist.php"><span style="color:whitesmoke; font-size:22px;" class="material-icons-outlined">favorite_border</span><span class="wishlistNotEmpty">•</span></a></li>
                    <?php
                      } else { 
                    ?>
                      <li><a href="wishlist.php"><span style="color:whitesmoke; font-size:22px;" class="material-icons-outlined">favorite_border</span></a></li>
                    <?php
                      }
                    ?>
                    <li><a href=""><span style="color:whitesmoke; font-size:22px;" class="material-icons-outlined">shopping_bag</span></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <h1 class="title"><?php echo $title ?></h1>

    
    <div class="perfumeList">
    
        <?php 
        foreach($product_data as $row)
        {
        ?>
        <div class="perfumes">
            <img class="image" src="<?php echo $row['location'];?>" alt= "<?php echo $row['name'];?>" onclick = "location.href = 'product_details.php?id=' +  <?php echo $row['id'];?>;">
            <?php
                foreach($likedProducts as $liked) {
                    if($row['id'] == $liked['id']) {
                        $heartIcon = "favorite";
                        break;
                        
            ?>
                    <?php
                    } else {
                        $heartIcon = "favorite_border";
                    ?>

                    <?php
                    }
                    ?>

            <?php
                }
            ?>
            <a class="addToWishlist" data-data="<?php echo $row['id'];?>" href="javascript:;"><span class="material-icons"><?php echo $heartIcon ?></span></a>
            <div class="container" onclick = "location.href = 'product_details.php?id=' +  <?php echo $row['id'];?>;">
                <h4><b><?php echo $row['name'];?></b></h4>
                <p>Rs <?php echo $row['price'];?></p>
            </div>
        </div>
        <?php
        }
        ?>
    </div>


    <script>
        $(document).ready(function() {
            $(".addToWishlist").on('click', function(e) {
                var link = $(this).data('data');
                var $this = $(this);
                $.ajax({
                    type: "POST",
                    url: "wishlist.php",
                    data: ({product_id: link}),
                    success: function(data) {
                        if (data == "success") {
                        $($this).find('.material-icons').html("favorite");
                        } else {
                            $($this).find('.material-icons').html("favorite_border");
                        }
                    }
                });
            });
        });
    </script>

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
                        <li><a href="genderProducts.php?gender=male">Men's Perfumes</a></li>
                        <li><a href="genderProducts.php?gender=female">Women's Perfumes</a></li>
                        <li><a href="brand.php?brand=Chanel">Chanel</a></li>
                        <li><a href="brand.php?brand=Gucci">Gucci</a></li>
                        <li><a href="brand.php?brand=Jo Malone">Joe Malone</a></li>
                        <li><a href="brand.php?brand=Louis Vuitton">Louis Vuitton</a></li>
                        <li><a href="brand.php?brand=Prada">Prada</a></li>
                        <li><a href="brand.php?brand=Ralph Lauren">Ralph Lauren</a></li>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../script.js"></script>
</body>
</html>