<?php 

    //transfers code from database file
    require('database.php');

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $countrycode = filter_input(INPUT_POST, 'countrycode', FILTER_SANITIZE_STRING);
    $district = filter_input(INPUT_POST, 'district', FILTER_SANITIZE_STRING);
    $population = filter_input(INPUT_POST, 'population', FILTER_SANITIZE_STRING);

    // create the query that updates the database if there is a valid id passed
    if ($id){
        // update query where we set the "keys" with parameter values
        $query = 'UPDATE  city 
                    SET Name = :city, CountryCode = :countrycode:, District = district:, 
                    Population = population: WHERE ID = :id';

        $statement = db->prepare($query);
        // bind values to parameters
        $statement->bindValue(':id', $id);
        $statement->bindValue(':city', $city);
        $statement->bindValue(':countrycode', $countrycode);
        $statement->bindValue(':district', $district);
        $statement->bindValue(':population', $population);

        $success = $statement->execute();
        $statement->closeCursor();
    }

    $updated = true;

    include('index.php');

    // considered best pratice to not close of php tags for php only files