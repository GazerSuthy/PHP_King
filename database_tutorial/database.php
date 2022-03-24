<?php
    //create connection  to database (location and username)
    $dbname = 'mysql:host=localhost;dbname=world';
    $username = 'root';

    try {
        // create new php data object
        $db = new PDO($dsn, $username);

    } catch(PDOException $err){
        $error_message = 'Database Error: ';
        // php arrow function that calls method on the event "e"
        $error_message .= $err->getMessage();
        echo $error_message;
        exit();
    }

?>