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
    <a href="/page/1" class="button">First</a>
    <a href="<?php if($pagenr <= 1){ echo '/#'; } else { echo "/category/".$_GET['category']."/page/".($pagenr - 1); } ?>" class="button">Prev</a>
    <a href="<?php if($pagenr >= $totalPages){ echo '#'; } else { echo "/category/".$_GET['category']."/page/".($pagenr + 1); } ?>" class="button">Next</a>
    <a href="<?php echo"/category/".$_GET['category']."/page/".$totalPages;?>" class="button">Last</a>
</nav>

<?php
include "includes/footer.php";
?>