<?php
  ob_start();
  session_start();
  include("../html/connection.php");
  include("../html/functions.php");

  $userId = 0;
  
  $user = check_login($con);
  if(isset($user['id'])) {
    $userId = $user['id'];
  }

  $wishlistQuery = "select * from wishlist join products on wishlist.perfumeID = products.id where wishlist.userID = '$userId'";
  $likedProducts = display_product($con, $wishlistQuery);

  if(isset($_POST['addToOrders'])) {
    $perfumeId = 0;
    $perfumeQuantity = 0;
    $date = date('Y-m-d H:i:s');
    $cartQuery = "select * from cart join products on cart.perfumeID = products.id where cart.userID = '$userId'";
    $cartData = display_product($con, $cartQuery);
    foreach($cartData as $item) {
        $perfumeId = $item['perfumeID'];
        $perfumeQuantity = $item['quantity'];
        $cartId = $item['id'];
        $query = "insert into orderdetails (userID,perfumeID,quantity,date) values ('$userId', '$perfumeId', '$perfumeQuantity', '$date')";
        $result = mysqli_query($con, $query);
        $deleteQuery = "delete from cart where userID = '$userId'";
        $deleteResult = mysqli_query($con, $deleteQuery);
    }
    exit();
  }
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>Perfumify: Purchase Successful</title>
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
                    <li><a href="cart.php"><span style="color:whitesmoke; font-size:22px;" class="material-icons-outlined">shopping_bag</span></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="checkoutSuccessContainer">
        <h2 class="title">
            Thank you for shopping with us!
        </h2>
        <hr>
        <div class="checkoutSuccessMsg">
          <h5>We hope to see you again <?php echo $user['user_name'] ?>!</h5>
          <h5>If there were any issues, please let us <a href="contact_us.php">know</a>!</h5>
        </div>
        <div class = "btn-groups">
            <a style="text-decoration: none;" href="genderProducts.php"><button id="" type = "button" class = "buy-now-btn">Browse some more</button></a>
        </div>
    </div>
</body>
</html>