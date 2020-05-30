<?php
/*
    Der er taget et par valg på denne hjemmeside ift dens funktionalitet.
    - Den eneste cookie er session cookie - og GDPR tillader det uden advarsel eller accept
    - Så ingen sporing af besøgende. Hjemmesiden er til privat brug og ikke erhverv - jeg regner med at
        de personer der besøger som er interessante for mig er dem der kontakter mig.
    - Kun 1 ekstern script - TinyMCE - fordi jeg gad ikke opfinde den dyb tallerken og trængt til WYSIWYG i admin sider
    - Siden er LIVE på en ekstern webhost, og jeg har ikke kontrol over hvordan serveren er konfigureret.
        Selvom det er noget jeg kan komme til at savne, nogle testresultater fra f.eks. webhint.io foreslår
        ændringer i server konfiguration, har jeg valgt at koncentrere mig om koden på selve siden.
    - Kommentarer bliver lavet som regel FØRSTE GANG en bestemt kode forekommer, og ikke hver gang den kommer. 
        F.eks. kommentar om session_start() her om få linjer
*/

// Session skal startes på alle sider, INDEN kode, for at sikre der er adgang til session variabler
session_start();

header('Content-type: text/html; charset=utf-8');
header ("Cache-Control: max-age=200 ");

/* Sidens titel er forskellig fra side til side - 
    men for at kunne bruge en header fil har jeg brugt en variabel på hver side inden header
*/  
$pageTitle = "I Am Gregor J.";
include "includes/header.php";
include "../db.php";
include "functions.php";
?>
<nav>
    <?php
    //er brugeren logget på, bliver knappen vist - ellers ikke
    if(isset($_SESSION['user']))
    {
        echo "<a href = 'newPost' class='button'>New Post.</a>";
    }
    ?>
</nav>    
<article>
<?php
    $return = latestPosts();
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