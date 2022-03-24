<?php 

require('database.php');

// id is a hidden input
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if($id){
    // create delete query
    $query = 'DELETE FROM city
                WHERE ID = :id';

    $statement = $db->prepare($query);
    // bind values
    $statement->bindValue(':id', $id);
    $success = $statement->execute();
    $statement->closeCursor();
}

$deleted = true;

include('index.php');