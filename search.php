<?php
session_start();
$pageTitle = "I Am Gregor J.";
include "includes/header.php";
include "../db.php";
include "functions.php";
?>
<article>
<?php
    search();
?>
</article>
<?php
    include "includes/aside.php";
?>
<nav>
<?php
if(isset($_SESSION['user']))
{
    echo "<a href = 'newPost'>New Post.</a>";
    echo "<br/><a href = '/'>Home.</a>";
}
?>
</nav>
<?php
include "includes/footer.php";
?>