<?php
    session_start();
    include "../db.php";
    include "functions.php";

        // omdirigerer til index hvis ikke brugeren er logget på
        if(isset($_SESSION['user']))
    {
        deletePost();
    }
    else
    {
        header("Location: /");
    }

    include "includes/header.php";
?>