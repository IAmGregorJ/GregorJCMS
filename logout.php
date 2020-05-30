<?php 
    // Sletter alle session variabler
    session_start();
    unset($_SESSION['user']);
    session_destroy();
    header("Location: /");
?>