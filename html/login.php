<?php
session_start();

    include("../html/connection.php");
    include("../html/functions.php");

    $notFoundFlag = 0;

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $user_name = $_POST['loginUser'];
        $password = $_POST['loginPassword'];

        if (!empty($user_name) && !empty($password)) {

            //read from database
            $query = "select * from users where user_name = '$user_name' limit 1";
            $result = mysqli_query($con, $query);

            if($result) {

                if ($result && mysqli_num_rows($result) > 0) {

                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data['password'] === $password) {

                        $_SESSION['id'] = $user_data['id'];
                        header("Location: index.php");
                    } else {
                        $notFoundFlag = 1;
                    }
                }
            }
        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfumify: Login</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <section class="loginSection">
        <div class="loginImage">
            <video width="768" height="700" autoplay loop muted> 
                <source src="../video.mp4" type="video/mp4" />
            </video>
        </div>
        <div class="loginForm">
            <h2>Perfumify</h2>
            <form action="" method="post">
                <div class="input-group">
                    <input type="text" name="loginUser" id="loginUser" required autocomplete="off">
                    <label for="loginUser">Username</label>
                </div>
                <div class="input-group">
                    <input type="password" name="loginPassword" id="loginPassword" required autocomplete="off">
                    <label for="loginPassword">Password</label>
                </div>
                <input type="submit" value="Login" class="submit-btn">
                <h3>Don't have an account? <a href="signup.php">Sign Up</a></h3>
            </form>
        </div>
    </section>

    <?php
        if ($notFoundFlag == 1) { 
    ?>

    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Credentials not found ! Please enter the correct username and password.',
            iconColor: '#FF0065',
            showConfirmButton: false
        });
    </script>

    <?php
        }
    ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>