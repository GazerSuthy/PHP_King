<!-- create container for cards -->
<section class="cards" aria-label="flash-cards"> 
    <?php 

        $cards = null;
        $result = 0;

        // highest value will go to multiple of 16
        for($i = 1; $i <= 16; $i++){
            $result = $user_input * $i;

            // assigning block of html to a variable 
            // aria-label for screen reader accessability 
            $cards .= "<div class='card' tab-index=0 aria-label={$user_input} multiplied by {$i} equals {$result}'>
                        <div class='card-front'>
                            {$user_input} x {$i}
                        </div>
                        <div class='card-back' 
                        aria-label={$user_input} multiplied by {$i} equals {$result}'>
                            {$result}
                        </div>";

            // if we echo cards it will display all the html blocks of the individual cards 
            echo($cards);
        }


    ?>
</section>