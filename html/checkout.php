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

  $totalPrice = 0;
  $cartData = [];
  if(isset($_POST['price'])) {
    $totalPrice = $_POST['price'];
    //$cartData = json_decode(stripslashes($_POST['cartArray']), true);
    $cartQuery = "select * from cart join products on cart.perfumeID = products.id where cart.userID = '$userId'";
    $cartData = display_product($con, $cartQuery);
  }
?>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-base64@3.7.2/base64.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>Perfumify: Checkout</title>
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
    <main class="checkoutContainer">
        <h2 class="CheckoutHeading">
            Checkout
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
                                <input id="fullNameCheckout" class="effect-1" type="text">
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
                                    <input id="cityCheckout" class="effect-1" type="text">
                                    <span class="focus-border"></span>
                                </div>
                                <div style="float:none; width: 50%;" class="col-3">
                                    <label for="">Street:</label>
                                    <input id="streetCheckout" class="effect-1" type="text">
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </section>

            <section class="order-summary">
                <h2 style="margin-left: 5px;" class="sectionCheckoutHeader">
                    Order Summary
                </h2>
                <p class="order-summary-items"><?php echo count($cartData) ?> items</p>
                <br>
                <div class="summaryCartItems">
                    <?php
                    foreach($cartData as $item) {
                    ?>
                    <div class="shoppingCartSummary">
                        <div class="itemSummary">
                            <img src="<?php echo $item['location'] ?>" alt="">
                            <div>
                                <p class="summaryItemName"> <?php echo $item['quantity']?> x <?php echo $item['name'] ?></p>
                                <p style="font-size: 13px;"><?php echo $item['brand'] ?></p>
                            </div>
                            <p class="cartSummaryPrice">Rs <?php echo ($item['price'] * $item['quantity'])?></p>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="summaryTotals">
                    <div class="priceLabels">
                        <p>Sub-total</p>
                        <p>Shipping Charges</p>
                    </div>
                    <div>
                        <p>Rs <?php echo $totalPrice ?></p>
                        <p>Rs 200</p>
                    </div>
                </div>
                <hr class="detailsHr" style="width: 100%; border: 1px solid #d2d2d2; background-color: #d2d2d2;">
                <div class="summaryFinalTotal">
                    <p>Total</p>
                    <p>Rs <?php echo $totalPrice+200 ?></p>
                </div>
            </section>
        </div>
        <div id="checkoutBtn-groups" class = "btn-groups">
            <a href="cart.html">
                <button style=" width: 275%; left: -150px;" type = "button" class = "buy-now-btn">Cancel</button>
            </a>
            
            <button style="width: 20%; left: 20px;" id="receiptButton" type = "button" class = "buy-now-btn">Confirm & Generate Receipt</button>
        </div>
    </main>

    <script>
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = mm + '/' + dd + '/' + yyyy;
        window.jsPDF = window.jspdf.jsPDF

        $('#receiptButton').on('click', function() {
            var fullName = document.getElementById("fullNameCheckout").value;
            var country = document.getElementById("selectCountry").options[document.getElementById("selectCountry").selectedIndex].text; //get country selected
            var street = document.getElementById("streetCheckout").value;
            var city = document.getElementById("cityCheckout").value;
            const doc = new jsPDF();

            doc.setFont("Helvetica", "bold");
            doc.setFontSize(20);
            doc.text("Perfumify", 10, 10);
            doc.setDrawColor(0);
            doc.setFillColor(255,0,101);
            doc.rect(200, 4, 3, 3, 'F');
            doc.setFont("Helvetica", "normal");
            doc.setFontSize(10);
            doc.setTextColor("#B2B2AF");
            doc.text("Thank you for shopping with Perfumify!", 10, 20);
            doc.text("Your order has successfully been processed", 10, 30);
            doc.setDrawColor(0, 0, 0);
            doc.setLineWidth(1.0); 
            doc.line(10, 40, 200, 40);
            doc.setTextColor("#000000");
            doc.text("Date: ", 150, 50);
            doc.setTextColor("#B2B2AF");
            doc.text(today, 162, 50);
            doc.setTextColor("#000000");
            doc.text("Name: ", 150, 60);
            doc.setTextColor("#B2B2AF");
            doc.text(fullName, 162, 60);
            doc.setTextColor("#000000");
            doc.text("Country: ", 150, 70);
            doc.setTextColor("#B2B2AF");
            doc.text(country, 165, 70);
            doc.setTextColor("#000000");
            doc.text("City: ", 150, 80);
            doc.setTextColor("#B2B2AF");
            doc.text(city, 162, 80);
            doc.setTextColor("#000000");
            doc.text("Street: ", 150, 90);
            doc.setTextColor("#B2B2AF");
            doc.text(street, 162, 90);
            doc.setLineWidth(0.3);
            doc.line(10, 100, 200, 100);
            doc.setTextColor("#000000");
            doc.setFontSize(12);
            <?php
                $ycoordinate = 70;
                foreach($cartData as $cartItem) {
                    $ycoordinate += 50;
            ?>
                    var quantity = "<?php echo $cartItem['quantity'] ?>";
                    var name = "<?php echo $cartItem['name'] ?>"
                    var subTotalPrice = <?php echo $cartItem['price'] ?> * <?php echo $cartItem['quantity'] ?>;
                    doc.text(quantity, 10, <?php echo $ycoordinate ?>);
                    doc.text("x", 15, <?php echo $ycoordinate ?>)
                    doc.text(name, 20, <?php echo $ycoordinate ?>);
                    doc.text("Rs " + subTotalPrice.toString(), 180, <?php echo $ycoordinate ?>)
            <?php     
                }
            ?>
            doc.line(10, 240, 200, 240);
            doc.text("Total Cost: ", 150, 255);
            doc.text("Rs <?php echo $totalPrice ?>", 180, 255);
            doc.setLineWidth(1.0);
            doc.setDrawColor(255, 0, 101);
            doc.line(10, 270, 200, 270);
            doc.save("PerfumifyReceipt.pdf");

            $.ajax({
                url: "purchase_success.php",
                type: "POST",
                data: ({addToOrders: "addtoDB"}),
                success: function(data) {
                    window.location.href = "purchase_success.php"
                }
            })
        })
    </script>

    <footer style = "height: 300px; margin-top: 120px;"class = "footer">
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