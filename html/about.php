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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>Perfumify: About</title>
    <style>
        *, *::before, *::after {
        box-sizing: border-box;
        }
        .timeline {
            position: relative;
            padding: 0;
            list-style: none;
        }
        .timeline:before {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 40px;
            width: 2px;
            margin-left: -1.5px;
            content: "";
            background-color: whitesmoke;
        }
        .timeline > li {
            position: relative;
            min-height: 50px;
            margin-bottom: 50px;
        }
        .timeline > li:after, .timeline > li:before {
            display: table;
            content: " ";
        }
        .timeline > li:after {
            clear: both;
        }
        .timeline > li .timeline-panel {
            position: relative;
            float: right;
            width: 100%;
            padding: 0 20px 0 100px;
            text-align: left;
        }
        .timeline > li .timeline-panel:before {
            right: auto;
            left: -15px;
            border-right-width: 15px;
            border-left-width: 0;
        }
        .timeline > li .timeline-panel:after {
            right: auto;
            left: -14px;
            border-right-width: 14px;
            border-left-width: 0;
        }
        .timeline > li .timeline-image {
            position: absolute;
            z-index: 100;
            left: 0;
            width: 80px;
            height: 80px;
            margin-left: 0;
            text-align: center;
            color: white;
            border: 7px solid #e9ecef;
            border-radius: 100%;
            background-color: black;
        }
        .timeline > li .timeline-image h4, .timeline > li .timeline-image .h4 {
            font-size: 10px;
            line-height: 14px;
            margin-top: 12px;
        }
        .timeline > li.timeline-inverted > .timeline-panel {
            float: right;
            padding: 0 20px 0 100px;
            text-align: left;
        }
        .timeline > li.timeline-inverted > .timeline-panel:before {
            right: auto;
            left: -15px;
            border-right-width: 15px;
            border-left-width: 0;
        }
        .timeline > li.timeline-inverted > .timeline-panel:after {
            right: auto;
            left: -14px;
            border-right-width: 14px;
            border-left-width: 0;
        }
        .timeline > li:last-child {
            margin-bottom: 0;
        }
        .timeline .timeline-heading h4, .timeline .timeline-heading .h4 {
            margin-top: 0;
            color: inherit;
        }
        .timeline .timeline-heading h4.subheading, .timeline .timeline-heading .subheading.h4 {
            text-transform: none;
        }
        .timeline .timeline-body > ul,
        .timeline .timeline-body > p {
            margin-bottom: 0;
        }

        @media (min-width: 768px) {
        .timeline:before {
            left: 50%;
        }
        .timeline > li {
            min-height: 100px;
            margin-bottom: 100px;
        }
        .timeline > li .timeline-panel {
            float: left;
            width: 41%;
            padding: 0 20px 20px 30px;
            text-align: right;
        }
        .timeline > li .timeline-image {
            left: 50%;
            width: 100px;
            height: 100px;
            margin-left: -50px;
        }
        .timeline > li .timeline-image h4, .timeline > li .timeline-image .h4 {
            font-size: 13px;
            line-height: 18px;
            margin-top: 16px;
        }
        .timeline > li.timeline-inverted > .timeline-panel {
            float: right;
            padding: 0 30px 20px 20px;
            text-align: left;
        }
        }
        @media (min-width: 992px) {
        .timeline > li {
            min-height: 150px;
        }
        .timeline > li .timeline-panel {
            padding: 0 20px 20px;
        }
        .timeline > li .timeline-image {
            width: 150px;
            height: 150px;
            margin-left: -75px;
        }
        .timeline > li .timeline-image h4, .timeline > li .timeline-image .h4 {
            font-size: 18px;
            line-height: 26px;
            margin-top: 30px;
        }
        .timeline > li.timeline-inverted > .timeline-panel {
            padding: 0 20px 20px;
        }
        }
        @media (min-width: 1200px) {
        .timeline > li {
            min-height: 170px;
        }
        .timeline > li .timeline-panel {
            padding: 0 20px 20px 100px;
        }
        .timeline > li .timeline-image {
            width: 170px;
            height: 170px;
            margin-left: -85px;
        }
        .timeline > li .timeline-image h4, .timeline > li .timeline-image .h4 {
            margin-top: 40px;
        }
        .timeline > li.timeline-inverted > .timeline-panel {
            padding: 0 100px 20px 20px;
        }
        }

        .page-section {
            padding: 6rem 0;
        }
        .page-section h2.section-heading, .page-section .section-heading.h2 {
            font-size: 2.5rem;
            margin-top: 0;
            margin-bottom: 1rem;
        }
        .page-section h3.section-subheading, .page-section .section-subheading.h3 {
            font-size: 1rem;
            font-weight: 400;
            font-style: italic;
            margin-bottom: 4rem;
        }

        @media (min-width: 768px) {
        section {
            padding: 9rem 0;
        }
        }

        .text-center {
            text-align: center !important;
        }

        .page-section h2.section-heading, .page-section .section-heading.h2 {
            font-size: 2.5rem;
            margin-top: 0;
            margin-bottom: 1rem;
        }
            .text-uppercase {
                text-transform: uppercase !important;   
            }   
    </style>
</head>
<body style="background-color: black; color: whitesmoke; min-height: 100vh;">

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

    <div class="aboutPage">
        <div class="aboutContainer">
            <header>
              <h1 class="page-title">About Us</h1>
            </header>
            <main>
              <article class="content">
                <section class="content__descriptor">
                  <h2 class="content__title">Our Story</h2>
                </section>
                <section class="content__text-box">
                  <p class="content__text">
                    We had always wanted luxury fragrances to be widely available at lower prices.
                    Luxury fragrances are not necessities, they are masterpieces of art.
                    And everyone needs colors in their lives.
                  </p>
                  <p class="content__text">
                    Thus, Perfumify was founded.
                    Imagination met reality and with 100000+ customers,
                    we strive to sell luxury fragances everywhere at a much lower cost.
                    After all, you cannot put a price on art.
                  </p>
                </section>
              </article>
            </main>
        </div>

        <section class="page-section" id="about">
            <div class="aboutSecondContainer" style="line-height: 1.5;">
              <div class="text-center">
                <h3 class="section-subheading text-muted">Our Timeline</h3>
              </div>
              <ul class="timeline">
                <li>
          
                  <div class="timeline-panel">
                    <div class="timeline-heading">
                      <h4>2009-2011</h4>
                      <h4 class="subheading">The Beginnings of our dreams</h4>
                    </div>
                    <div class="timeline-body">
                      <p class="text-muted">
                          In the beginning, luxury perfumes were rare and were bought only by a small percentage of the population.
                          As young people with ambitions, we decided to eventually make luxury fragances available to the common population at much lower prices.
                          This was our dream, our way of creating a sense of purpose.
                      </p>
                    </div>
                  </div>
                </li>
                <li class="timeline-inverted">
                  <div class="timeline-image"></div>
                  <div class="timeline-panel">
                    <div class="timeline-heading">
                      <h4>March 2011</h4>
                      <h4 class="subheading">Perfumify is Born</h4>
                    </div>
                    <div class="timeline-body">
                      <p class="text-muted">
                          Perfumify started small. We would buy second hand luxury perfumes and sell at a lower price, netting major losses. 
                          At some point during 2013, we eventually considered closing the store and moving on to another project.
                          In the end determination and perseverance proved to be the key difference.
                        </p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="timeline-image"></div>
                  <div class="timeline-panel">
                    <div class="timeline-heading">
                      <h4>December 2015</h4>
                      <h4 class="subheading">Transition to Full Service</h4>
                    </div>
                    <div class="timeline-body">
                      <p class="text-muted"> 
                        After some months of negotiations, Perfumify managed to get major sponsors such as Louis Vuitton, Ralph Lauren amongst others. 
                        This proved to be a masterstroke, as the stocks of Perfumify began to hit new heights, establishing good relationships with
                        leading brands.
                      </p>
                    </div>
                  </div>
                </li>
                <li class="timeline-inverted">
                  <div class="timeline-image"></div>
                  <div class="timeline-panel">
                    <div class="timeline-heading">
                      <h4>July 2022</h4>
                      <h4 class="subheading">Phase Two Expansion</h4>
                    </div>
                    <div class="timeline-body">
                      <p class="text-muted">
                          In phase two, Perfumify will soon expand on its infrastructure. By 2023, Perfumify will have 20 stores in different parts of the world,
                          eventually establishing Perfumify as a leading force.
                        </p>
                    </div>
                  </div>
                </li>
                <li class="timeline-inverted">
                  <div class="timeline-image">
                    <h4>
                      Be Part
                      <br>
                      Of Our
                      <br>
                      Story!
                    </h4>
                  </div>
                </li>
              </ul>
            </div>
          </section>
    </div>


    <footer style = "height: 300px;"class = "footer">
        <div class = "footerContainer">
            <hr style="background-color: #818078;border-top: 1px solid #818078; border-bottom: 1px solid #818078;width: 100%;">
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
                          <li><a href="brand.php?brand=Jo Malone">Jo Malone</a></li>
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