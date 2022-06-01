<?php

function check_login($con) {
    
    if (isset($_SESSION['user_id'])) {

        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";

        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {

            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
}


function random_num($length) {

    $text = "";

    if($length < 5) {
        $length = 5;
    }

    $len = rand(4, $length);

    for($i = 0; $i < $len; $i++) {
        $text .= rand(0,9);
    }

    return $text;
}

function display_product($con, $query){

    $product_data = array();
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while($product = mysqli_fetch_assoc($result)) {
            $product_data[] = $product;
        }
    }
    return $product_data;   
    
}

function logout() {
    unset($_SESSION['user_id']);
    session_destroy();
    header("Location: index.php");
    die();
}