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
    <meta name="viewport">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
    <script src="https://unpkg.com/jquery.counterup@2.1.0/jquery.counterup.js"></script>
    <title>Perfumify</title>

    
</head>

<body>
    <div class="hero-image">
        <div class="container">
            <h4 class="headerTitle"><a href="index.php" class="headerTitleLink">Perfumify</a></h4>
            <nav>
                <ul style = "right: 470px;" class="mainLinks">
                    <li><a href="about.php" class="lang" key="about">About</a></li>
                    <div class="dropdown">
                        <button class="dropbtn lang" key = "fragrances">Fragrances
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
                    <li><a href="contact_us.php" class="lang" key = "contact us">Contact Us</a></li>
                    <?php
                    if ($user){
                    ?>
                      <li><a href="myAccount.php">My Account</a></li>
                    <?php
                    } else {
                    ?>
                      <li><a href="login.php">Login</a></li>
                    <?php
                    }
                    ?>
                    <!-- <button class="translate" id="english">English</button>
                    <button class="translate" id="french">French</button> -->
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
        <div class="HomeHeaderImage">
            <img src="../images/men's perfumes/lv_afternoon_swim.jpeg" alt="home perfume">
        </div>
        <div id="homeTextContainer">
            <p class = "FirstSectionTitle lang" key = "The fantasy of">The Fantasy Of</p>
            <p class = "FirstSectionTitle lang" key = "Paradise">Paradise</p>
            <p class="FirstSectionSubtitle lang" key = "Energetic aromatic irresistible">Energetic aromatic irresistible</p>
            <p class="FirstSectionSubtitle lang" key = "fragrance for all the ways you play">fragrance for all the ways you play.</p>
        </div>
        <div class="homeButton">
            <a class="homeButtonLink lang" href="genderProducts.php" key = "Shop Now">Shop Now</a>
        </div>
    </div>

    <div id="homeSecondSection">
        <h3 class="title"> Best Sellers </h3>
        <hr class = "sectionBreak" data-content="Perfume is a story in odour, sometimes poetry in memory.">
        <div class="topCategories">
            <div class="TopCategories-item">
                <img class="topCategories-image" src="../images/men's perfumes/jm_bronzewood&leather.png" alt="item 1">
                <h4>Bronzewood & Leather</h4>
            </div>
            <div class="TopCategories-item">
                <img class="topCategories-image" src="../images/men's perfumes/prada_lhomme_men.png" alt="item 2">
                <h4>L'homme</h4>
            </div>
            <div class="TopCategories-item">
                <img class="topCategories-image" src="../images/women's perfumes/chanel_1957.png" alt="item 3">
                <h4>1957</h4>
            </div>
            <div class="TopCategories-item">
                <img class="topCategories-image" src="../images/women's perfumes/rl_magnolia.png" alt="item 4">
                <h4>Magnolia</h4>
            </div>
        </div>
    </div>

    <div id="homeThirdSection">
        <h3 class="title" style = "color:whitesmoke; padding-top:40px;">Why Us?</h3>
        <hr class = "sectionBreakBlackBg" data-content="Imagination creates reality.">
        <div class = "whyUsCategories">
            <div class = "whyUs-item">
                <h2 class="count1">10</h2>
                <h2>+</h2>
                <hr>
                <h4>Years Of Service</h4>
            </div>
            <div class = "whyUs-item">
                <h2 class="count2">100000</h2>
                <h2>+</h2>
                <hr>
                <h4>Happy Customers</h4>
            </div>
            <div class = "whyUs-item">
                <h2 class="count3">100</h2>
                <h2>%</h2>
                <hr>
                <h4>Satisfaction</h4>
            </div>
        </div>
    </div>
    <div id="homeFifthSection">
            <h3 class="title"> Testimonials </h3>
            <hr class = "sectionBreak" data-content="A description of what has been, and a promise of what is to come. ">
            <div class="testimonials">
              <section class="testimonial-section" id="horace">
                <div class="testimonial-wrapper testimonial-wrapper-boxed">
                    <div class="t-bq-quote testimonial-quote">
                        <div class="t-bq-quote-base">
                            <blockquote class="testimonial-text">
                              Perfumify changed my life. Easy shipping, and OMG the customer service is unmatched. Definite recommendation for perfumes of all your needs and wants.
                            </blockquote>
                            <div class="t-bq-quote-meta">
                                <div class="t-bq-quote-userpic"></div>
                                <div class="t-bq-quote-meta-info">
                                    <div class="t-bq-quote-author"><cite>Emma Chamberlain</cite></div>
                                    <div class="t-bq-quote-source"><span>Youtuber</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </section>
              <section class="testimonial-section" id="horace">
                  <div class="testimonial-wrapper testimonial-wrapper-boxed">
                      <div class="t-bq-quote testimonial-quote">
                          <div class="t-bq-quote-base">
                              <blockquote class="testimonial-text">
                                A must-have if you want branded perfumes for cheaper. Anyone missing on Perfumify is definitely missing on a much better deal and easier life.
                              </blockquote>
                              <div class="t-bq-quote-meta">
                                  <div class="t-bq-quote-userpic3"></div>
                                  <div class="t-bq-quote-meta-info">
                                      <div class="t-bq-quote-author"><cite>Josh Richards</cite></div>
                                      <div class="t-bq-quote-source"><span>Tiktoker</span></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
              <section class="testimonial-section" id="horace">
                <div class="testimonial-wrapper testimonial-wrapper-boxed">
                    <div class="t-bq-quote testimonial-quote">
                        <div class="t-bq-quote-base">
                            <blockquote class="testimonial-text">
                              Don't look any further than Perfumify if you want branded perfumes. They have everything from cheap to expensive for every occasion. A big 5 star.
                            </blockquote>
                            <div class="t-bq-quote-meta">
                                <div class="t-bq-quote-userpic2"></div>
                                <div class="t-bq-quote-meta-info">
                                    <div class="t-bq-quote-author"><cite>Kyle Ranton</cite></div>
                                    <div class="t-bq-quote-source"><span>Professional racer</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </section>
            </div>

    </div>

    <div id="homeFifthSection">
            <h3 class="title"> Browse Part Of our gallery </h3>
            <hr class = "sectionBreak" data-content="Perfume is the art that makes memory speak.">
            <div class="slider">
                <input type="radio" name="testimonial" id="t-1" />
                <input type="radio" name="testimonial" id="t-2" />
                <input type="radio" name="testimonial" id="t-3" checked />
                <input type="radio" name="testimonial" id="t-4" />
                <input type="radio" name="testimonial" id="t-5" />
                <div class="testimonials mb-8">
                  <label class="item" for="t-1">
                    <div class="mycard">
                      <p class="cardtitle">Joe Malone</p>
                      <div>
                        <img src="../images/men's perfumes/jm_bronzewood&leather.png" alt="nivel5" class="cardimg" />
                      </div>
                      <div>
                        <p onclick = "location.href = 'product_details.php?id=17'" class="carddescription">Bronzewood & Leather</p>
                      </div>
                    </div>
                  </label>
                  <label class="item" for="t-2">
                    <div class="mycard">
                      <p class="cardtitle">Prada</p>
                      <div>
                        <img src="../images/men's perfumes/prada_lhomme_men.png" alt="nivel5" class="cardimg" />
                      </div>
                      <div>
                        <p onclick = "location.href = 'product_details.php?id=25'" class="carddescription">L'homme</p>
                      </div>
                    </div>
                  </label>
                  <label class="item" for="t-3">
                    <div class="mycard">
                      <p class="cardtitle">Joe Malone</p>
                      <div>
                        <img src="../images/women's perfumes/jm_englishpear&freesia.png" alt="nivel5" class="cardimg" />
                      </div>
                      <div>
                        <p onclick = "location.href = 'product_details.php?id=55'" class="carddescription">English Pear & Freesia</p>
                      </div>
                    </div>
                  </label>
                  <label class="item" for="t-4">
                    <div class="mycard">
                      <p class="cardtitle">Louis Vuitton</p>
                      <div>
                        <img src="../images/women's perfumes/lv_spellonyou.png" alt="nivel5" class="cardimg" />
                      </div>
                      <div>
                        <p onclick = "location.href = 'product_details.php?id=42'" class="carddescription">Spell On You</p>
                      </div>
                    </div>
                  </label>
                  <label class="item" for="t-5">
                    <div class="mycard">
                      <p class="cardtitle">Ralph Lauren</p>
                      <div>
                        <img src="../images/women's perfumes/rl_whitelily.png" alt="nivel5" class="cardimg" />
                      </div>
                      <div>
                        <p onclick = "location.href = 'product_details.php?id=71'" class="carddescription">WhiteLily</p>
                      </div>
                    </div>
                  </label>
                </div>
                <div class="dots">
                  <label for="t-1"></label>
                  <label for="t-2"></label>
                  <label for="t-3"></label>
                  <label for="t-4"></label>
                  <label for="t-5"></label>
                </div>
              </div>
        </div>

        <footer style = "margin-top:100px;" class = "footer">
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

        <script>
            $(document).ready(function () {
                $(".count1").counterUp({
                    delay: 10,
                    time: 1000
                });
                $(".count2").counterUp({
                    delay: 10,
                    time: 1000
                    
                });
                $(".count3").counterUp({
                    delay: 10,
                    time: 1000
                });
            });
        </script>

<script src="../script.js"></script>
</body>
</html>