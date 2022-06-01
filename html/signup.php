<?php
session_start();

    include("../html/connection.php");
    include("../html/functions.php");

    $error = 1;

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $signUpUserName = $_POST['signUpUserName'];
        $signUpPassword = $_POST['signUpPassword'];
        $signUpUser = $_POST['signUpUser'];
        $signUpEmail = $_POST['signUpEmail'];

        if (!empty($signUpUserName) && !empty($signUpPassword) && !empty($signUpUser) && !empty($signUpEmail) && !is_numeric($signUpUserName)) {

            //save to database
            $user_id = random_num(20);
            $query = "Insert into users (user_id,user_name,password,email,fullName) values ('$user_id','$signUpUserName','$signUpPassword','$signUpEmail','$signUpUser')";

            mysqli_query($con, $query);
            
            sleep(3);
            header("Location: login.php");
        } else {
            // echo "<script type='text/javascript'>
            // Swal.fire({
            //     icon: 'error',
            //     title: 'Welcome!',
            //     text: 'You cannot leave any blank fields',
            //     iconColor: '#FF0065',
            //     showConfirmButton: false
            // });
            // </script>";

            // echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11" type="text/javascript">';
            // echo 'console.log("F")';
            // echo "Swal.fire({icon: 'error', title: 'error!', text:'Nooo', iconColor: '#FF0065', showConfirmButton: true});";
            // echo '</script>';
            $error = 0;
            
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
            <form action="" method="post">
                <div class="input-group">
                    <input type="text" name="signUpUser" id="signUpUser" required autocomplete="off">
                    <label for="signUpUser">Full name</label>
                </div>
                <div class="input-group">
                    <input type="text" name="signUpUserName" id="signUpUserName" required autocomplete="off">
                    <label for="signUpUserName">Username</label>
                </div>
                <div class="input-group">
                    <input type="text" name="signUpEmail" id="signUpEmail" required autocomplete="off">
                    <label for="signUpEmail">Email</label>
                </div>
                <div class="input-group">
                    <input type="password" name="signUpPassword" id="signUpPassword" required autocomplete="off">
                    <label for="signUpPassword">Password</label>
                </div>
                <input type="submit" value="Sign Up" class="submit-btn">
            </form>
        </div>
    </section>

    <?php
        if ($error == 0) { 
    ?>

    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Noo',
            iconColor: '#FF0065',
            showConfirmButton: false
        });
    </script>

    <?php
        }
    ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../script.js"></script>
</body>
</html>