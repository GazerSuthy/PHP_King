<?php
    $user_input = filter_input(INPUT_GET, 'number', FILTER_SANITIZE_NUMBER_INT);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplication Flash Cards</title>
    <link rel="stylesheet" href="style.css">
    <!-- control f5 to refresh browser cache -->
</head>
<body>
    <header>
        <h1>Flash Cards</h1>
        <h6 class="multiplication">multiplications</h6>
    </header>

    <?php 
        if($user_input){
            include("views/result.php");
        }else{
            include("views/form.php");
        }
    ?>


</body>
</html>