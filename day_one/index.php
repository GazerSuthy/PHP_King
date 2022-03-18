

<?php 
// store user input
    $user_input = filter_input(INPUT_GET, 'user-input', FILTER_SANITIZE_NUMBER_INT);
    echo($user_input)
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

    <php? echo("hi") ?>

    <!-- input form -->
    <main class="enter-input">
        <form action="" method="post" >
            <label for="num-input" class="user-input-label">Please Enter A Number:</label>
            <input type="text" name="user-input" id="user-input">
        </form>
    </main>
</body>
</html>