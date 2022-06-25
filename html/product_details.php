<?php
    session_start();
    
    include("../html/connection.php");
    include("../html/functions.php");

    $pID = "";

    if(isset($_GET["id"])){
        $pID = $_GET["id"];
    }
    $heartIcon = "favorite_border";
    $query = "select * from products where id = '$pID'";
    $product_data = display_product($con, $query);
    $randomListQuery = "select * from products";
    $randomList = display_product($con, $randomListQuery);
    $randomList = \array_filter($randomList, static function ($element) {
        return $element !== $_GET["id"];
    });
    $user = check_login($con);
    if(isset($user['id'])) {
        $userId =  $user['id'];
    }
    $wishlistQuery = "select * from wishlist join products on wishlist.perfumeID = products.id where wishlist.userID = '$userId'";
    $likedProducts = display_product($con, $wishlistQuery);

    foreach($likedProducts as $liked) {
        if($product_data[0]['id'] == $liked['id']) {
            $heartIcon = "favorite";
            break;
        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Buy Now</title>
    <style>
        html,body{
            height: 100%;
        }
    </style>
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
                    <li><a href="wishlist.php"><span style="color:whitesmoke; font-size:22px;" class="material-icons-outlined">favorite_border</span></a></li>
                    <li><a href=""><span style="color:whitesmoke; font-size:22px;" class="material-icons-outlined">shopping_bag</span></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class = "main-wrapper">
        <div class = "detailsContainer">
            <div class = "product-div">
                <div class = "product-div-left">
                    <div class = "img-container">
                        <img style="width: 100%; display: block;" src = "<?php echo $product_data[0]['location'];?>" alt = "">
                    </div>
                </div>
                <div class = "product-div-right">
                    <p class = "product-name"><?php echo $product_data[0]['name'];?></p>
                    <!-- <span id="detailsIcon" style="cursor: pointer;" onclick = "toggleLikeIcon(this)" class="material-icons">favorite_border</span> -->
                    <a class="addToWishlist" data-data="<?php echo $product_data[0]['id'];?>" href="javascript:;"><span id="detailsIcon" class="material-icons"><?php echo $heartIcon ?></span></a>
                    <p style="font-family: 'Roboto Slab', serif;" class = "product-price">Rs <?php echo $product_data[0]['price'];?></p>
                    <hr style="margin-top: 40px;" class="detailsHr">
                    <div>
                    <p>Sizes</p>
                    <p class="productSize">100ML</p>
                    <span id="sizesIcon" class="material-icons">navigate_next</span>
                    <div id="panelID" class="panel">
                        <div class="panelFirstSection">
                            <p class="panelHeader">Sizes</p>
                            <div class="closePanelHolder">
                                <span id="closePanelIcon" class="material-icons">close</span>
                            </div>
                            <hr class="panelSectionHr" style="margin-bottom: 100px;"> 
                        </div>
                        <div style="cursor: pointer;" class="panelSecondSection">
                            <div class="size100">
                                <p style="font-family: 'Roboto Slab', serif;" class="panelSize">100ml</p>
                                <span id="selectedSize100" class="material-icons">done</span>
                            </div>
                            <hr class="panelSectionHr" style="width: 80%;">
                            <div class="size200">
                                <p style="font-family: 'Roboto Slab', serif;" class="panelSize">200ml</p>
                                <span id="selectedSize200" class="material-icons">done</span>
                            </div>
                            <hr class="panelSectionHr" style="width: 80%;">
                        </div>
                    </div>
                    </div>
                    <div class="productQtyDiv">
                        <p>Quantity</p>
                        <input class="pQuantity" type="number" value="1" min="1" max="5">
                    </div>
                    <hr style="margin-bottom: 40px;" class="detailsHr">
                    <p class = "product-description"><?php echo $product_data[0]['description'];?></p>
                    
                    <div class = "btn-groups">
                        <button style="font-family: var(--font); font-size: 15px;" type = "button" class = "buy-now-btn">Add To Cart</button>
                    </div>
                </div>
            </div>
        </div>
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


    <hr class="detailsHr" style="width: 99.9%; margin-top: 100px;">

    <section>
        
        <h3 class="title"> You may also like</h3>
        <hr class="detailsHr" style="width: 5%; margin: auto; border: 1px solid #19110B; background-color: #19110B;">
        <div class="perfumeList">

            <?php
                for($i = 0; $i<3; $i++) {
                    shuffle($randomList);
            ?>
                <script>
                    console.log("<?php echo $randomList[$i]['name'] ?>")
                </script>
                <div class="perfumes">
                    <img src="<?php echo $randomList[$i]['location'];?>" alt="<?php echo $randomList[$i]['name'];?>" onclick = "location.href = 'product_details.php?id=' +  <?php echo $randomList[$i]['id'];?>;" style="height: 100%; width: 100%; object-fit: cover;">
                    <div class="container" onclick = "location.href = 'product_details.php?id=' +  <?php echo $randomList[$i]['id'];?>;">
                        <h4 style="font-family: 'Varela Round', sans-serif; text-align: center; font-style: normal; text-transform: uppercase; letter-spacing: 0.115385em;"><b><?php echo $randomList[$i]['name'];?></b></h4>
                        <p style="font-family: 'Varela Round', sans-serif; text-align: center;"><?php echo $randomList[$i]['price'];?></p>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
        

    </section>
    <footer style = "height: 200px; margin-top: 300px;"class = "footer">
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
    <script>
        
    </script>
    <script src="../script.js"></script>
</body>
</html>