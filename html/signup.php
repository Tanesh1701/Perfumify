<?php
session_start();

    include("../html/connection.php");
    include("../html/functions.php");

    $errorUserExists = "";
    if($_SERVER['REQUEST_METHOD'] == "POST") {
            $signUpUserName = isset($_POST['signUpUserName']) ? $_POST['signUpUserName'] : '';
            $signUpPassword = isset($_POST['signUpPassword']) ? $_POST['signUpPassword'] : '';
            $signUpUser = isset($_POST['signUpUser']) ? $_POST['signUpUser'] : '';
            $signUpEmail = isset($_POST['signUpEmail']) ? $_POST['signUpEmail'] : '';
    
            $checkUser = "Select * from users where user_name = '$signUpUserName'";
            $queryUsers = mysqli_query($con, $checkUser);
    
            if (mysqli_num_rows($queryUsers) > 0) {
                $errorUserExists = "This username is already taken!";
            } else 
            if (!empty($signUpUserName) && !empty($signUpPassword) && !empty($signUpUser) && !empty($signUpEmail) && !is_numeric($signUpUserName)) {
                //save to database
                $query = "Insert into users (user_name,password,email,fullName) values ('$signUpUserName','$signUpPassword','$signUpEmail','$signUpUser')";
    
                mysqli_query($con, $query);
                
                sleep(3);
                header("Location: login.php");
            } else {
            }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfumify: Signup</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <section class="signUpSection">
        <div class="signUpImage">
            <video width="768" height="700" autoplay loop muted> 
                <source src="../video.mp4" type="video/mp4" />
            </video>
        </div>
        <div class="signUpForm">
            <h2>Perfumify</h2>
            <form name="signUpForm" action="" method="post">
                <div class="input-group">
                    <input type="text" name="signUpUser" id="signUpUser" required autocomplete="off">
                    <label for="signUpUser">Full name</label>
                </div>
                <label id="signUpNameValidation" for=""></label>
                <div class="input-group">
                    <input type="text" name="signUpUserName" id="signUpUserName" required autocomplete="off">
                    <label for="signUpUserName">Username</label>
                </div>
                <label id="signUpUserValidation" for=""><?php echo $errorUserExists?></label>
                <div class="input-group">
                    <input type="text" name="signUpEmail" id="signUpEmail" required autocomplete="off">
                    <label for="signUpEmail">Email</label>
                </div>
                <label id="signUpemailValidation" for=""></label>
                <div class="input-group">
                    <input type="password" name="signUpPassword" id="signUpPassword" required autocomplete="off">
                    <label for="signUpPassword">Password</label>
                </div>
                <label id="signUpPwdValidation" for=""></label>
                <input id="signUpBtn" onclick="return validateSignUp();" type="submit" value="Sign Up" class="submit-btn">
            </form>
        </div>
    </section>


<script src="../script.js"></script>
</body>
</html>