<?php
    session_start();
    include("../html/connection.php");
    include("../html/functions.php");

    $user = check_login($con);

    $userId = 0;

    if(isset($user['id'])) {
        $userId = $user['id'];
    }

    $product_data = [];
    
    $wishlistQuery = "select * from wishlist join products on wishlist.perfumeID = products.id where wishlist.userID = '$userId'";
    $wishlistData = display_product($con, $wishlistQuery);

    if (isset($_POST['product_id'])) {
        $productId = $_POST['product_id'];

        $query = ("select count(perfumeID) cnt from wishlist where userID = '$userId' and perfumeID = '$productId'");
        $result = mysqli_query($con, $query);
        $product_data = mysqli_fetch_assoc($result);

        if($product_data['cnt'] == 1){
            $query = ("delete from wishlist where userID = '$userId' and perfumeID = '$productId'");
            $result = mysqli_query($con, $query);
            echo "delete";
        } else {
            $query = ("insert into wishlist (userID,perfumeID) values ('$userId', '$productId')");
            $result = mysqli_query($con, $query);
            echo "success";
        }
        exit();
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Perfumify: Wishlist</title>
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
                      if(count($wishlistData) != 0) {
                    ?>
                      <li><a style="text-decoration: none;" href="wishlist.php"><span style="color:whitesmoke; font-size:22px;" class="material-icons-outlined">favorite_border</span><span class="wishlistNotEmpty">•</span></a></li>
                    <?php
                      } else { 
                    ?>
                      <li><a href="wishlist.php"><span style="color:whitesmoke; font-size:22px;" class="material-icons-outlined">favorite_border</span></a></li>
                    <?php
                      }
                    ?>
                    <li><a href="cart.php"><span style="color:whitesmoke; font-size:22px;" class="material-icons-outlined">shopping_bag</span></a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <?php 
        if(empty($wishlistData)) {
    ?>
        <h3 class="title">Your wishlist is empty</h3>
    <?php 
        } else {
    ?>
            <h1 class="title">my wishlist</h1>
            <div class="perfumeList">

                <?php
                    foreach($wishlistData as $row) {
                ?>
                <div class="perfumes <?php echo $row['id'];?>">
                    <img class="image" src="<?php echo $row['location'];?>" alt= "<?php echo $row['name'];?>" onclick = "location.href = 'product_details.php?id=' +  <?php echo $row['id'];?>;">
                    <a class="removeFromWishlist" data-data="<?php echo $row['id'];?>" href="javascript:;"><span class="material-icons">close</span></a>
                    <div class="container" onclick = "location.href = 'product_details.php?id=' +  <?php echo $row['id'];?>;">
                        <h4><b><?php echo $row['name'];?></b></h4>
                        <p>Rs <?php echo $row['price'];?></p>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        <?php 
        }
        ?>

    <script>
        $(document).ready(function() {
            $(".removeFromWishlist").on("click", function() {
                var link = $(this).data('data');
                var toRemove = $(this).parent().attr('class');
                var toRemoveId = toRemove.split(" ")[1];
                $.ajax({
                    type: "POST",
                    url: "wishlist.php",
                    data: ({product_id: link}),
                    success: function(data) {
                        $('.'+toRemoveId).fadeOut(2).remove();
                    }
                })
            })
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
</body>
</html>