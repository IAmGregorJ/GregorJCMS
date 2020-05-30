<?php 
    session_start();
    $pageTitle = "I Am Gregor J. | 404";
    include "../db.php";
    include "functions.php";
    include "includes/header.php";
?>
<div class="error">
    <h1>404</h1>
    <p>Oops! Something weird happened.</p>
    <p><a href="/">Go back and try again.</a></p>
</div>
<?php
include "includes/footer.php";
?>