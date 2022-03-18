<!-- input form -->
    <main class="enter-input">
        <!--  $_SERVER['PHP_SELF'] means to it self, so in this context submit form to the page itself-->
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="GET" >
            <h2 id="enterNumber" class="main_input_label">Please Enter A Number, Thank You</h2>
            <input 
                type="text" 
                name="number" 
                id="number"
                aria-labelledby="enterNumber"
                max-length="2"
                autofocus
                required
            >
            <button type="submit">Let's Go!</button>

        </form>
    </main>