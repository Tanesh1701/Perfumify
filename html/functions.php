<?php

function check_login($con) {
    
    if (isset($_SESSION['id'])) {

        $id = $_SESSION['id'];
        $query = "select * from users where id = '$id' limit 1";

        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {

            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
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
    unset($_SESSION['id']);
    session_destroy();
    header("Location: index.php");
    die();
}