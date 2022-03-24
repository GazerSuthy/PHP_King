<?php
    //submiting data to same page
    $city = filter_input(INPUT_GET, "city-name" , FILTER_SANITIZE_STRING);

    $newCity = filter_input(INPUT_POST, "new-city-name" , FILTER_SANITIZE_STRING);
    $coutryCode = filter_input(INPUT_POST, "country-code" , FILTER_SANITIZE_STRING);
    $district = filter_input(INPUT_POST, "district" , FILTER_SANITIZE_STRING);
    $population = filter_input(INPUT_POST, "population" , FILTER_SANITIZE_STRING);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP PDO Tutorial</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="">
        <h1 class="title">PDO Tutorial</h1>
    </header>

    <!-- confirmation message on deleted/updated data -->
    <?php 
        if(isset($deleted)){
            echo "Record deleted!";
        } else if(isset($updated)){
            echo "Record Updated!";
        }
    ?>

    <section class="select-data">
        <h4>Select Data / REad Deata</h4>

    <form action="." method="GET">
        <label for="city-name">City Name:</label>
        <input type="text" name="city-name" id="city-name" required>
        <button type="submit">Submit</button>
    </form>
    </section>


    <!-- ===== conditional rendering  =====-->

    <!-- ----------------------------------
        If Page hasn't recieved any data from user input
    ------------------------------------------>
    <?php if(!$city && !$newCity) { ?>
        <section class="insert-data">
            <h4>Select Data / Create Deata</h4>
        <form class="POSTFORM" action="." method="POST">
            <label for="new-city-name">City Name:</label>
            <input type="text" name="new-city-name" id="new-city-name" required>
            <label for="country-code">County Code:</label>
            <input type="text" name="country-code" id="country-code" maxlength="3" required>
            <label for="distict">Distict:</label>
            <input type="text" name="district" id="district" required>
            <label for="population">Population:</label>
            <input type="text" name="population" id="population" required>
            <button type="submit">Submit</button>
        </form>
        </section>
    <?php } else {  ?>
    <!-- ----------------------------------
    If Page recieved any data from user input
    ------------------------------------------>
        <?php  require("database.php") ?>
        <?php 
            // insert new city to the database
            if($newCity){
                $query = "INSERT INTO city
                                (Name, CountyCode, District, Population)
                            VALUES
                                (:newCity, :countycode, :district, :newpopulation)";
                # for values we insert parameters not actual values (to avoid leaks)

                //sql statement template is created and sent to database
                $statement = $db->prepare($query);
                $statement->bindValue(':newCity', $newCity);
                $statement->bindValue(':countycode', $coutryCode);
                $statement->bindValue(':district', $district);
                $statement->bindValue(':newpopulation', $population);

                //execute binds values to the parameters and database executes statement
                $statement->execute();
                $statement->closeCursor();
            }

            // select city to display
            if($city || $newCity) {
                // sql code to get data from database
                $query = 'SELECT * FROM city 
                            WHERE Name = ":city"    
                            ORDER BY Population DESC'; 
                // we use parameters to put info in query :info, because its safter and avoids leaks

                # database variable defined in database.php
                $statement = $db->prepare($query);
                if ($city) {
                    // we set city variable from user input to the parameter
                    $statement->bindValue(':city', $city);
                }
                if($newCity){
                    $statement->bindValue(':newcity', $newCity);
                }
                $statement->execute();
                // fetch data that is returned from the database
                $results = $statement->fetchAll();
                // close cursor after making a query
                $statement->closeCursor();
            }
        ?>

        <!-- Handeling Results -->
        <?php if(!empty($results)) {?>

            <section>

            <?php  
                // form component -  render each result
                foreach($results as $result) {
                    // result object has keys which we store in variables for reference
                    $id = $result['ID'];
                    $city = $result['Name'];
                    $countrycode = $result['CountryCode'];
                    $district = $result['District'];
                    $population = $result['Population'];
            ?>

            <form class="update" action="update_record.php" method="POST">
                <!-- input is hidden because we want each form to keep track of id but don't want user to see it -->
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <label for="city-<?php echo $id ?>" name="id" value="<?php echo $id ?>">City Name:</label>
                <input type="text" name="city" id=""city-<?php echo $id ?>" 
                        value="<?php echo $city ?>" required>
                <button class="update-btn">Update</button>
                <!-- allows us to indentify each piece of unique data by have an unique id for each input -->
            </form>

            <form action="delte_record.php" class="delete" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <button class="delete-btn">Delete</button>
            </form>

            <!-- closing bracket for the foreach loop-->
            <?php } ?>

            </section>
                
        
        <?php } else { ?>
            <h1 class="empty-results-msg">Sorry, No Results!</h1>
        <?php } ?>

    <?php } ?>
</body>
</html>