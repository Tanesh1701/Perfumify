<?php
    session_start();
    include("../html/connection.php");
    include("../html/functions.php");

    $user = check_login($con);

    $userId = 0;

    if(isset($user['id'])) {
        $userId = $user['id'];
    }
?>
<?php
    $searchData = [];

    if(isset($_POST['searchTerm'])) {
        $searchVal = $_POST['searchTerm'];
        $query = "select * from products where name like '%{$searchVal}%' or brand like '%{$searchVal}%'";
        $searchData = display_product($con, $query);
        if (count($searchData) != 0) {
            foreach($searchData as $item) {
?>
                <div onclick = "location.href = 'product_details.php?id=<?php echo $item['id']; ?>'" class="searchData">
                    <div class="searchImage">
                        <img src="<?php echo $item['location'] ?>" alt="">
                    </div>
                    <div class="searchItemDetails">
                        <p style="margin-bottom: 25px;"><?php echo $item['name'] ?></p>
                        <p style="font-size: 14px;" >Rs <?php echo $item['price'] ?>*</p>
                    </div>
                </div>
                <hr style="width: 50%; margin: auto;" class="detailsHr">
            <?php
            }
            ?>
<?php
        }else {
            echo "<h3 class='noResults'>No results found!</h3>";
        }
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Perfumify: Search</title>
</head>
<body>
    <form class="searchForm" action="" method="post">
        <div class="input-group">
            <input placeholder="SEARCH" type="search" name="" id="searchProduct" autocomplete="off" autofocus>
            <span class="focus-border"></span>
        </div>
        <div class="suggestionsSearchContainer">
            <!-- <p class="suggestionsSearchTitle">Suggestions:</p> -->
            <!-- <ul class="suggestionsSearch">
                <li>Afternoon Swim</li>
                <li>Bronzewood & Leather</li>
                <li>Vetiver</li>
                <li>Store Location</li>
            </ul> -->
        </div>
        <p onclick="window.history.go(-1); return false;" class="closeSearchBtn">close</p>
    </form>

    <script>
        $(document).ready(e => {
            $('#searchProduct').keyup(function(e) {
                var searchValue = $(this).val();
                if(searchValue != "") {
                    $.ajax({
                    type: "POST",
                    url: "search.php",
                    data: ({searchTerm: searchValue}),
                    success: function(data) { 
                        console.log(data);
                        $('.searchResults').html(data);
                        
                    }
                    })
                }
            })
        })
    </script>

    <div class="searchResults"></div>
    
    
</body>
</html>