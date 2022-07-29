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

?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfumify: FAQ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
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


    <div class="faqContainer">
      <h2>FAQ</h2>
      <hr>
      <div class="accordion">
        <div class="accordion-item">
          <button id="accordion-button-1" aria-expanded="false">
            <span class="accordion-title">How to contact Perfumify?</span>
            <span class="material-icons-outlined" aria-hidden="true">expand_more</span>
          </button>
          <div class="accordion-content">
            <p>
              Call our representative or write to us.
            </p>
          </div>
        </div>
        <div class="accordion-item">
          <button id="accordion-button-2" aria-expanded="false">
            <span class="accordion-title">Can I change my delivery address?</span>
            <span class="material-icons-outlined" aria-hidden="true">expand_more</span>
          </button>
          <div class="accordion-content">
            <p>
                Once an order has been placed unfortunately it cannot be cancelled or amended.
            </p>
          </div>
        </div>
        <div class="accordion-item">
          <button id="accordion-button-3" aria-expanded="false">
            <span class="accordion-title">Can I cancel or change my order?</span>
            <span class="material-icons-outlined" aria-hidden="true">expand_more</span>
          </button>
          <div class="accordion-content">
            <p>
                Once an order has been placed unfortunately it cannot be cancelled or amended. 
                You can return your order using our free returns service, or you can refuse delivery with the courier. 
                The parcel will then be returned to us and we'll refund you. 
                We’re hoping to be able to cancel or amend orders in the future!
            </p>
          </div>
        </div>
        <div class="accordion-item">
          <button id="accordion-button-4" aria-expanded="false">
            <span class="accordion-title">Where do you deliver to?</span>
            <span class="material-icons-outlined" aria-hidden="true">expand_more</span>
          </button>
          <div class="accordion-content">
            <p>
              We ship our products worldwide.
            </p>
          </div>
        </div>
        <div class="accordion-item">
          <button id="accordion-button-5" aria-expanded="false">
            <span class="accordion-title">How long are orders kept in store for?</span>
            <span class="material-icons-outlined" aria-hidden="true">expand_more</span>
          </button>
          <div class="accordion-content">
            <p>
                We will keep your order in store for 14 days before we automatically refund you if it isn't collected in time. 
                If you need your order to be held longer please contact the store directly.
            </p>
          </div>
        </div>
        <div class="accordion-item">
            <button id="accordion-button-5" aria-expanded="false">
              <span class="accordion-title">I have a question about Perfumify</span>
              <span class="material-icons-outlined" aria-hidden="true">expand_more</span>
            </button>
            <div class="accordion-content">
              <p>
                  If you have any other questions about perfumify, head to our contact us section.
                  We are always available for all your queries.
              </p>
            </div>
          </div>
      </div>
    </div>
    <footer style = "height: 300px;"class = "footer">
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
