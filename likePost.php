<?php
    session_start();
    include "../db.php";
    include "functions.php";

    $likes = likes();
    echo $likes;


?>