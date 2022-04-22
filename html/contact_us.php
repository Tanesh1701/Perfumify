<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>Perfumify: Contact Us</title>
</head>
<body>
    <header class="header" style="background-color: black; height: 100px;">  
        <div class="container">
            <h4 class="headerTitle"><a href="index.php" class="headerTitleLink">Perfumify</a></h4>
            <nav>
                <ul class="mainLinks">
                    <li><a href="#">About</a></li>
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
                              <a href="#">Men</a>
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
                    <li><a href="#">Contact Us</a></li>
                </ul>
                <ul class="secondaryLinks">
                    <li><a href="map.html"><span style="color:whitesmoke; font-size:22px;" class="material-icons-outlined">place</span></a></li>
                    <li><a href=""><span style="color:whitesmoke; font-size:22px;"" class="material-icons-outlined">favorite_border</span></a></li>
                    <li><a href=""><span style="color:whitesmoke; font-size:22px;" class="material-icons-outlined">shopping_bag</span></a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <section class="contactMeSection">
        <div class="contactMeForm">
            <h2>Get In Touch With Us !</h2>
            <form action="" method="post">
                <div class="input-group">
                    <input type="text" name="contactUser" id="contactUser" required>
                    <label for="contactUser">Full name</label>
                </div>
                <div class="input-group">
                    <input type="text" name="contactEmail" id="contactEmail" required>
                    <label for="contactEmail">Email</label>
                </div>
                <div style="padding-top: 10px;" class="input-group">
                    <textarea name="" id="" cols="30" rows="10"></textarea>
                    <label style="padding-top: 15px;" for="contactMessage">Message</label>
                </div>
                <input type="submit" value="Send Message" class="submit-btn">
            </form>
        </div>
        <div class="contactDetails">
            <div>
                <h4>Address</h4>
                <p>46th Avenue, New York</p>
            </div>
            <div>
                <h4>Email</h4>
                <p>perfumify@perfumify.com</p>
            </div>
            <div>
                <h4>Phone</h4>
                <p>+1 (646) 555-3890</p>
            </div>
            <div>
                <h4>Fax</h4>
                <p>+1 (212) 222 8888</p>
            </div>
        </div>
    </section>

    <footer style = "height: 200px;"class = "footer">
        <div class = "footerContainer">
            <div class = "footer-row">
                <div class = "footer-col">
                    <h4>Perfumify</h4>
                    <ul style = "position: relative; right: 40px">
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="contact_us.php">Contact Us</a></li>
                        <li><a href="sitemap.html">Site Map</a></li>
                        <li><a href="faq.html">FAQ</a></li>
                    </ul>
                </div>
                    <div class = "footer-col">
                        <h4>Shop Now</h4>
                        <ul style = "position: relative; right: 40px">
                            <li><a href="">Men's Perfumes</a></li>
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

</body>
</html>