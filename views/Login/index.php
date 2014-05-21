<div class="LoginWrapper">
    <?php

    if(!Session::get("LoggedIn")){
    ?>
    <form method="POST" action="<?php echo RequestPath ?>">
        <?php
        if(isset($_POST["UserName"])){
            ?>
            <span class="Error">The username or password is wrong</span>
            <?php
        }
        ?>
        Username
        <input type="edit" name="UserName"/>
        Password
        <input type="password" name="UserPassword"/>
        <input type="submit" value="Send"/>
    </form>
    <?php
    }else{
    ?>
    <h2>U bent ingelogd</h2>
    <a href="<?php echo HttpPath?>">Website</a>
    <a href="<?php echo HttpPath?>Admin">Admin</a>
    <?php
    }
    ?>
</div>