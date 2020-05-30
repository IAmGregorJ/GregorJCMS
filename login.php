<?php 
    session_start();
    $pageTitle = "I Am Gregor J. | Log in.";
    include "../db.php";
    include "functions.php";

    login();

    include "includes/header.php";
?>

<div class="container">
    <form action="login" method="post">
        <div class="row">
            <div class = lab>
            <label for="username">Username</label>
            </div>
            <div class = inp>
            <input type="text" name="username" placeholder="Username" autofocus required>
            </div>
        </div>
        <div class="row">
            <div class = lab>
            <label for="password">Password</label>
            </div>
            <div class = inp>
            <input type="password" name="password" placeholder="Password" required>
            </div>
        </div>
        <div class="row">
            <input type="submit" name="login" value="Log in.">
        </div>
    </form>    
</div>
<?php
include "includes/footer.php";
?>