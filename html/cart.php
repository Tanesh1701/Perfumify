<?php
  ob_start();
  session_start();
  include("../html/connection.php");
  include("../html/functions.php");

  $user = check_login($con);

  $userId = 0;
  if(isset($user['id'])) {
    $userId = $user['id'];
  }

  $cartQuery = "select * from cart join products on cart.perfumeID = products.id where cart.userID = '$userId'";
  $cartData = display_product($con, $cartQuery);
  $cartLength = count($cartData);
  $totalPrice = 0;

  $wishlistQuery = "select * from wishlist join products on wishlist.perfumeID = products.id where wishlist.userID = '$userId'";
  $likedProducts = display_product($con, $wishlistQuery);

  if(isset($_POST['perfume_id']) and isset($_POST['quantity'])) {
    $perfumeId = $_POST['perfume_id'];
    $quantity = $_POST['quantity'];

    $itemExistsQuery = "select count(perfumeID) cnt from cart where userID = '$userId' and perfumeID = '$perfumeId'";
    $itemExistsresult = mysqli_query($con, $itemExistsQuery);
    $itemExistsData = mysqli_fetch_assoc($itemExistsresult);

    if($itemExistsData['cnt'] == 1) {
        $incrementQuery = "update cart set quantity=quantity+'$quantity' where userID = '$userId' and perfumeID = '$perfumeId' and quantity<5";
        $incrementResult = mysqli_query($con, $incrementQuery);
    } else {
        $query = "insert into cart (userID,perfumeID,quantity) values ('$userId', '$perfumeId', '$quantity')";
        $result = mysqli_query($con, $query);
        echo "success";
    }
    exit();
  }

  if(isset($_POST['delete'])) {
    $perfumeId = $_POST['delete'];
    $deleteQuery = "delete from cart where userID = '$userId' and perfumeID = '$perfumeId'";
    $deleteResult = mysqli_query($con, $deleteQuery);
    echo "deleted";
    exit();
  }

  if(isset($_POST['decrement'])){
    $perfumeId = $_POST['decrement'];
    $decrementQuery = "update cart set quantity=quantity-1 where userID = '$userId' and perfumeID = '$perfumeId' and quantity>1";
    $decrementResult = mysqli_query($con, $decrementQuery);
    echo "decremented";
    exit(); 
  }

  if(isset($_POST['increment'])){
    $perfumeId = $_POST['increment'];
    $incrementQuery = "update cart set quantity=quantity+1 where userID = '$userId' and perfumeID = '$perfumeId' and quantity<5";
    $incrementResult = mysqli_query($con, $incrementQuery);
    echo "incremented";
    exit(); 
  }

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
    <link rel="stylesheet" href="../style.css">
    <title>Perfumify: Cart</title>
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
                              <a href="genderProducts.php?gender=all">All Products</a>
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

    <?php 
        if(!empty($cartData)) {
    ?>
        <div class="cartHeader">
            <h1 class="cartTitle">Shopping Cart</h1>
            <h1 class="cartTitle">Items: <?php echo $cartLength ?></h1>
        </div>
        <hr class="detailsHr" style="width: 85%; margin: auto;">
        <div class="cartBody">
            <table class="cartTable">
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Sub-total</th>
                </tr>
                <?php 
                    foreach($cartData as $cartItem) {
                ?>
                        <tr class="<?php echo $cartItem['id']?>">
                            <td>
                                <div class="cartProductDetails">
                                    <img src="<?php echo $cartItem['location']?>" alt="">
                                    <div style="margin-top: 25px;">
                                        <p><?php echo $cartItem['name']?></p>
                                        <p style="font-size: 15px;"><?php echo $cartItem['brand']?></p>
                                        <small data-data="<?php echo $cartItem['id'] ?>" class="removeFromCart">Remove</small>
                                    </div>
                                </div>
                            </td>
                            <td class="inputDetailsToggle<?php echo $cartItem['id'] ?>">
                                <span data-data="<?php echo $cartItem['id'] ?>" class="input-number-decrement">–</span><input id="inputQuantity" class="input-number" type="text" value="<?php echo $cartItem['quantity']?>" min="1" max="5"><span data-data="<?php echo $cartItem['id'] ?>" class="input-number-increment">+</span>
                            </td>
                            <td class = "unitPrice">Rs <?php echo $cartItem['price']?></td>
                            <td class="sub-total">Rs <?php echo ($cartItem['price'] * $cartItem['quantity'])?></td>
                        </tr>
                        <?php
                            $totalPrice = $totalPrice + ($cartItem['price'] * $cartItem['quantity']);
                        ?>
                <?php
                    }
                ?>
            </table>
        </div>


        <script>
            $(document).ready(function() {
                $('.removeFromCart').on('click', function() {
                    var idRemoval = $(this).data('data');
                    $.ajax({
                        url: "cart.php",
                        type: "POST",
                        data: ({delete: idRemoval}),
                        success: function(data) {
                            if (data == "deleted") {
                                $('.' + idRemoval).fadeOut(2).remove();
                            }
                        }
                    })
                })
            })

            $(document).ready(function() {
                $('.input-number-decrement').on('click', function() {
                    var decrement = $(this).data('data');
                    var item = $(this).parent().attr('class');
                    $.ajax({
                        url: "cart.php",
                        type: "POST",
                        data: ({decrement: decrement}),
                        success: function(data) {
                            if(data == "decremented") {
                                //console.log($('td.' + item).next().next().html());
                                var currentSubTotal = $('td.' + item).next().next().html().split(" ")[1]; //get current sub total and remove Rs
                                var currentUnitPrice = $('td.' + item).next().html().split(" ")[1]; //get current unit price and remove Rs
                                var total = currentSubTotal - currentUnitPrice; 
                                $('td.' + item).next().next().html("Rs " + total);
                            }
                        }
                    })
                })
            })

            $(document).ready(function() {
                $('.input-number-increment').on('click', function() {
                    var increment = $(this).data('data');
                    var item = $(this).parent().attr('class');
                    $.ajax({
                        url: "cart.php",
                        type: "POST",
                        data: ({increment: increment}),
                        success: function(data) {
                            if(data == "incremented") {
                                var currentSubTotal = $('td.' + item).next().next().html().split(" ")[1]; //get current sub total and remove Rs
                                var currentUnitPrice = $('td.' + item).next().html().split(" ")[1]; //get current unit price and remove Rs
                                var total = parseInt(currentSubTotal) + parseInt(currentUnitPrice); 
                                $('td.' + item).next().next().html("Rs " + total);
                            }
                        }
                    })
                })
            })
        </script>


        <div class="cartGroups">
            <div class="continueBrowsingContainer">
                <a style="text-decoration: none;" href="genderProducts.php"><p id="Continuebrowsing">Continue browsing</p></a>
            </div>
            <div class = "btn-groups">
                <a style="text-decoration: none;" href="#"><button id="goToCheckoutBtn" type = "button" class = "buy-now-btn">Checkout</button></a>
            </div>
            <form id="postTotal" action="checkout.php" method="POST">
                <input type="hidden" name="price" value="">             
            </form>
        </div>
    <?php
        } else {
    ?>
            <h3 style="margin-bottom: 208px;" class="title">Your cart is empty</h3>
    <?php
        }
    ?>

        <script>
            $(document).ready(function() {
                $('#goToCheckoutBtn').on('click', function() {
                    var priceTotal = <?php echo $totalPrice ?>;
                    $('[name="price"]').val(priceTotal);
                    $("#postTotal").submit();
                })
            })
        </script>

    <footer style = "height: 250px;"class = "footer">
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

    

<script src="../script.js"></script>
</body>
</html>