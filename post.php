<?php
session_start();
$pageTitle = "I Am Gregor J.";
include "includes/header.php";
include "../db.php";
include "functions.php";
?>
<nav>
    <?php
        if(isset($_SESSION['user']))
        {
            echo "<a href='../../edit/" . $_GET['id'] . "' class='button'>Edit Post.</a>";
            echo "<a href='../../delete/" . $_GET['id'] . "' class='button'>Delete Post.</a>";
        }
    ?>
</nav>        
<article>
<?php
    showPost();
?>
</article>
<?php
    include "includes/aside.php";
?>
<nav>
</nav>
<?php    
include "includes/footer.php";
?>