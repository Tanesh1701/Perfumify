<?php
  ob_start();
  session_start();
  include("../html/connection.php");
  include("../html/functions.php");

  $user = check_login($con);
  $errorOldPassword = $errorNewPassword = 0;
  $errorUserExists = "";

  $userId = $user['id'];
  $wishlistQuery = "select * from wishlist join products on wishlist.perfumeID = products.id where wishlist.userID = '$userId'";
  $likedProducts = display_product($con, $wishlistQuery);

  $ordersQuery = "select * from orderdetails join products on orderdetails.perfumeID = products.id where orderdetails.userID = '$userId'";
  $orders = display_product($con, $ordersQuery);

  if (isset($_POST['changeUserInfo'])) {
    
    $fullName = $_POST['changeName'];
    $userName = $_POST['changeUsername'];
    $email = $_POST['changeEmail'];
    $id = $user['id'];

    $checkUser = "Select * from users where user_name = '$userName'";
    $queryUsers = mysqli_query($con, $checkUser);

    if (mysqli_num_rows($queryUsers) > 0) {
        $errorUserExists = "This username is already taken!";
    } else {
        $query = "Update users set fullName = '$fullName', user_name = '$userName', email = '$email' where id = '$id'";
        mysqli_query($con, $query);
        header("Refresh:0");
    }
  }

  if (isset($_POST['oldpwd']) and isset($_POST['newpwd'])) {
    $oldPassword = $_POST['oldpwd'];
    $newPassword = $_POST['newpwd'];
    $id = $user['id'];
    $name = $user['fullName'];
    $userEmail = $user['email'];
    $username = $user['user_name'];
    $currentPassword = $user['password'];

    if ($oldPassword != $currentPassword) {
        echo "currentPasswordError";
        exit();
    }
    if($newPassword == $currentPassword) {
        echo "newPasswordError";
        exit();
    }

    if (($oldPassword == $currentPassword) && ($newPassword != $currentPassword)) {
        $query = "Update users set fullName = '$name', user_name = '$username', email = '$userEmail', password = '$newPassword' where id = '$id'";
        mysqli_query($con, $query);
        echo "success";
        exit();
    }
  }

  isset($_POST['logoutBtn']) ? logout() : null;
  
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../style.css">
    <title>My Account</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: var(--font);
            text-decoration: none;
            list-style-type: none;
            box-sizing: border-box;
        }
        :focus{outline: none;}
    </style>
</head>
<body>
    
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2>Perfumify</h2>
            <p id="dashboardQuote">Sometimes you win, sometimes you learn.</p>
            <p id="dashboardQuoter">~ John C. Maxwell</p>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li class="active" onclick="openPage('displayUserDetails', this)">
                    <span class="material-icons-outlined">summarize</span><span>Dashboard</span>
                </li>
                <li onclick="openPage('changeInfo', this)">
                    <span class="material-icons-outlined">manage_accounts</span><span>Change user details</span>
                </li>
                
                <li onclick="openPage('changePassword', this)">
                   <span class="material-icons-outlined">key</span><span>Change Password</span>
                </li>
                <li onclick="openPage('chatBot', this)">
                    <span class="material-icons-outlined">chat_bubble_outline</span><span>Chat Now</span>
                </li>
                <li onclick="openPage('ordersTable', this)">
                    <span class="material-icons-outlined">shopping_bag</span><span>View Orders</span>
                </li>
                <li onclick="openPage('myAccountLogout', this)">
                    <span class="material-icons-outlined">logout</span><span>Logout</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>
                <label for="">
                    <span style="vertical-align: middle;" class="material-icons-outlined">menu</span>
                </label>
                Dashboard
            </h2>

            <div class="user-wrapper">
                <div>
                    <h4>Welcome <?php echo $user['user_name'] ?></h4>
                </div>
            </div>
        </header>

        <main>
            <div id="changeInfo" class="tabContent">
                <form action="" method="post">
                    <div style="display: flex;">
                        <div class="col-3">
                            <label for="">Full Name:</label>
                            <input name="changeName" class="effect-1" type="text" placeholder="" autocomplete="off">
                            <span class="focus-border"></span>
                        </div>
                        <div class="col-3">
                            <label for="">Username:</label>
                            <input name="changeUsername" class="effect-1" type="text" placeholder="" autocomplete="off">
                            <span class="focus-border"></span>
                            <label style="position:absolute;" id="signUpUserValidation" for=""><?php echo $errorUserExists?></label>
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="">Email:</label>
                        <input name="changeEmail" class="effect-1" type="text" placeholder="" autocomplete="off">
                        <span class="focus-border"></span>
                    </div>
                    <div class = "btn-groups">
                        <button name="changeUserInfo" type = "submit" class = "buy-now-btn">Save Changes</button>
                    </div>
                </form>
               
            </div>

            <div id="changePassword" class="tabContent">
                <form action="" method="post">
                    <div style="float: none;" class="col-3">
                        <label for="">Old Password:</label>
                        <input id="oldPwd" name="oldPassword" class="effect-1" type="text" autocomplete="off">
                        <span class="focus-border"></span>
                    </div>
                    <div class="col-3">
                        <label for="">New Password:</label>
                        <input id="newPwd" name="newPassword" class="effect-1" type="text" autocomplete="off">
                        <span class="focus-border"></span>
                    </div>
                    <div class = "btn-groups">
                        <button id="changePasswordButton" name="changePasswordbtn" class = "buy-now-btn">Save Changes</button>
                    </div>
                </form>
                
            </div>

            <script>
                $(document).ready(function() {
                    $('#changePasswordButton').on('click', function(e) {
                        console.log("hi");
                        var oldpwd = $("#oldPwd").val();
                        var newpwd = $("#newPwd").val();
                        e.preventDefault();
                        $.ajax({
                            url: "myAccount.php",
                            type: "POST",
                            data: ({oldpwd: oldpwd, newpwd: newpwd}),
                            success: function(data) {
                                if (data == "newPasswordError") {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: 'Your new Password cannot be the same as your old password !',
                                        iconColor: '#FF0065',
                                        showConfirmButton: false
                                    });
                                } else if(data == "currentPasswordError") {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: 'You have entered the wrong password !',
                                        iconColor: '#FF0065',
                                        showConfirmButton: false
                                    });
                                } else if(data == "success"){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Error!',
                                        text: 'You have successfully changed your password !',
                                        iconColor: '#FF0065',
                                        showConfirmButton: false
                                    });
                                }
                            }
                        })
                    })
                })
            </script>

            <div id="chatBot" class="tabContent">
                <div id="AxiaContainer" class="AxiaContainer">
                    <!-- <span id="axiaVolume" class="material-icons-outlined">volume_up</span> -->
                    <div id="chat" class="chat">
                        <div id="messages" class="messages"></div>
                        <input id="inputMessage" type="text" placeholder="Message" autocomplete="off" autofocus>
                    </div>
                </div>
            </div>

            <div id="ordersTable" class="tabContent">
                <table class="orders-table">
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date</th>
                    </tr>
                    <?php
                        foreach($orders as $items) {
                    ?>
                            <tr onclick="location.href = 'product_details.php?id=' +  <?php echo $items['id'];?>;">
                                <td style="text-transform:Lowercase;"><?php echo $items['name'] ?></td>
                                <td><?php echo $items['quantity'] ?></td>
                                <td><?php echo $items['price'] ?></td>
                                <td><?php echo $items['date'] ?></td>
                            </tr>
                    <?php
                        }
                    ?>
                    
                </table>           
            </div>

            <div id="myAccountLogout" class="tabContent">
                <p>Are you sure you want to log out of Perfumify?</p>
                <form action="" method="post">
                    <div class = "btn-groups">
                        <button name="logoutBtn" type = "submit" class = "buy-now-btn">Logout</button>
                    </div>
                </form>
                
            </div>

            <div id="displayUserDetails" class="userDetails">

                <div class="detailCards">
                    <div class="card-single">
                        <div>
                            <h1 style="font-family: 'Roboto Slab';"><?php echo count($orders)?></h1>
                            <span>Purchases</span>
                        </div>
                       
                    </div>
                    <div class="card-single">
                        <div>
                            <h1 style="font-family: 'Roboto Slab';"><?php echo count($likedProducts)?></h1>
                            <span>Favorites</span>
                        </div>
                       
                    </div>
                </div>

                <div class="user-info">
                    <div style="display: flex;">
                        <div class="col-3">
                            <label for="">Full Name:</label>
                            <input class="effect-1" type="text" placeholder="<?php echo $user['fullName'] ?>" readonly>
                            <span class="focus-border"></span>
                        </div>
                        <div class="col-3">
                            <label for="">Username:</label>
                            <input class="effect-1" type="text" placeholder="<?php echo $user['user_name'] ?>" readonly>
                            <span class="focus-border"></span>
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="">Email:</label>
                        <input class="effect-1" type="text" placeholder="<?php echo $user['email'] ?>" readonly>
                        <span class="focus-border"></span>
                    </div>
                </div>
            </div>
        </main>
    </div>
<script src="../script.js"></script>
</body>
</html>