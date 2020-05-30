<?php
session_start();
$pageTitle = "I Am Gregor J. | Posts by Category";
include "includes/header.php";
include "../db.php";
include "functions.php";
?>
<nav>
    <?php
    if(isset($_SESSION['user']))
    {
        echo "<a href = 'newPost' class='button'>New Post.</a>";
    }
    ?>
</nav>    
<article>
<?php
    $return = postsByCategory();
    $pagenr = $return[0];
    $totalPages = $return[1];
?>
</article>
<?php
    include "includes/aside.php";
?>
<nav>
<?php
include "includes/pagination.php";
?>
</nav>

<?php
include "includes/footer.php";
?>