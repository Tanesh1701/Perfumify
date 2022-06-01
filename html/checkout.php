<?php
  ob_start();
  session_start();
  include("../html/connection.php");
  include("../html/functions.php");

  $user = check_login($con);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
</head>
<body>
    <header class="header" style="background-color: black; height: 100px;">  
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
                    <li><a href="wishlist.php"><span style="color:whitesmoke; font-size:22px;"" class="material-icons-outlined">favorite_border</span></a></li>
                    <li><a href=""><span style="color:whitesmoke; font-size:22px;" class="material-icons-outlined">shopping_bag</span></a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="checkoutContainer">
        <h2 class="CheckoutHeading">
            Thank you for shopping with us!
        </h2>
        <hr>
        <div class="item-flex">

            <section class="checkout">
                <h2 class="sectionCheckoutHeader">
                    Payment Details
                </h2>
                <br>
                <div class="payment-form">
                    <div class="payment-method">
                        <form action="">
                            <div style="float:none; width: 50%;" class="col-3">
                                <label for="">Name:</label>
                                <input class="effect-1" type="text">
                                <span class="focus-border"></span>
                            </div>
                            <br>
                            <div style="float:none; width: 50%;"" class="col-3">
                                <label for="">Card Details:</label>
                                <input class="effect-1" type="text">
                                <span class="focus-border"></span>
                            </div>
                            <br>
                            <div style="display: flex;">
                                <div style="float:none; width: 20%;"" class="col-3">
                                    <label for="">Expiry Date(mm/yy):</label>
                                    <input class="effect-1" type="text">
                                    <span class="focus-border"></span>
                                </div>
                                <div style="width: 15%; margin-left: 50px;" class="col-3">
                                    <label for="">Security Code:</label>
                                    <input class="effect-1" type="text">
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <h2 style="margin-top: 20px; margin-bottom: 50px;" class="sectionCheckoutHeader">Shipping Details</h2>
                            <div class="shippingDetails">
                                <div class="selectDropdown">
                                    <select id="selectCountry" name="selectCountry">
                                        <option value="">Choose Country</option>
                                    </select>
                                </div>
                                <br>
                                <div style="float:none; width: 50%;" class="col-3">
                                    <label for="">City:</label>
                                    <input class="effect-1" type="text">
                                    <span class="focus-border"></span>
                                </div>
                                <div style="float:none; width: 50%;" class="col-3">
                                    <label for="">Street:</label>
                                    <input class="effect-1" type="text">
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </section>

            <section class="order-summary">
                <h2 style="margin-top: 10px; margin-left: 5px;" class="sectionCheckoutHeader">
                    Order Summary
                </h2>
                <p style="font-size: 14px; color: #FF0065; margin-left: 160px; margin-top: 30px;">5 items</p>
                <br>
                <div class="summaryCartItems">
                    <div class="shoppingCartSummary">
                        <div class="itemSummary">
                            <img src="../images/men's perfumes/jm_blackberry&bay.png" alt="">
                            <div>
                                <p class="summaryItemName"> 1 x Blackberry & Bay</p>
                                <p style="font-size: 13px;">Joe Malone</p>
                            </div>
                            <p class="cartSummaryPrice">Rs 8000</p>
                        </div>
                    </div>
                    <div class="shoppingCartSummary">
                        <div class="itemSummary">
                            <img src="../images/men's perfumes/jm_bronzewood&leather.png" alt="">
                            <div>
                                <p class="summaryItemName"> 1 x Bronzewood & Leather</p>
                                <p style="font-size: 13px;">Joe Malone</p>
                            </div>
                            <p class="cartSummaryPrice">Rs 8000</p>
                        </div>
                    </div>
                    <div class="shoppingCartSummary">
                        <div class="itemSummary">
                            <img src="../images/men's perfumes/lv_afternoon_swim.jpeg" alt="">
                            <div>
                                <p class="summaryItemName"> 1 x Afternoon Swim</p>
                                <p style="font-size: 13px;">Louis Vuitton</p>
                            </div>
                            <p class="cartSummaryPrice">Rs 8000</p>
                        </div>
                    </div>
                    <div class="shoppingCartSummary">
                        <div class="itemSummary">
                            <img src="../images/men's perfumes/rl_poloblack_men.png" alt="">
                            <div>
                                <p class="summaryItemName">1 x Polo Black</p>
                                <p style="font-size: 13px;">Ralph Lauren</p>
                            </div>
                            <p class="cartSummaryPrice">Rs 8000</p>
                        </div>
                    </div>
                    <div class="shoppingCartSummary">
                        <div class="itemSummary">
                            <img src="../images/men's perfumes/prada_lhomme_men.png" alt="">
                            <div>
                                <p class="summaryItemName">1 x L'homme</p>
                                <p style="font-size: 13px;">Prada</p>
                            </div>
                            <p class="cartSummaryPrice">Rs 8000</p>
                        </div>
                    </div>
                </div>
                <div class="summaryTotals">
                    <div class="priceLabels">
                        <p>Sub-total</p>
                        <p>Shipping Charges</p>
                    </div>
                    <div>
                        <p>Rs 40000</p>
                        <p>Rs 200</p>
                    </div>
                </div>
                <hr class="detailsHr" style="width: 100%; border: 1px solid #d2d2d2; background-color: #d2d2d2;">
                <div class="summaryFinalTotal">
                    <p>Total</p>
                    <p>Rs 40200</p>
                </div>
            </section>
        </div>
        <div class = "btn-groups" style="display: flex; justify-content: space-around; margin-top: 80px;">
            <a href="cart.html">
                <button style="font-family: var(--font); font-size: 15px; width: 275%; position: relative; left: -150px;" type = "button" class = "buy-now-btn">Cancel</button>
            </a>
            
            <button style="font-family: var(--font); font-size: 15px; width: 20%;" id="receiptButton" type = "button" class = "buy-now-btn">Confirm & Generate Receipt</button>
        </div>
    </main>

    <footer style = "height: 200px; margin-top: 120px;"class = "footer">
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
<script src="../script.js"></script>
</body>
</html>