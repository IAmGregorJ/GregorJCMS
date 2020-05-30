<?php 
    session_start();
    $pageTitle = "I Am Gregor J. | New Post";
    include "../db.php";
    include "functions.php";

    if(isset($_SESSION['user']))
    {
        newPost();
    }
    else
    {
        header("Location: /");
    }

    include "includes/header.php";
?>

<div class="container">
    <form action="newPost" method="post">
        <div class="row">
            <div class="lab">
                <label for="category">Category.</label>
            </div>
            <div class="inp">
                <select id="category" required autofocus name="category">
                    <option value="" selected disabled hidden>Choose a category.</option>
                    <option value="About">About</option>
                    <option value="Coding">Coding</option>
                    <option value="Data">Data</option>
                    <option value="Design">Design</option>
                    <option value="Life">Life</option>
                    <option value="Privacy">Privacy</option>                  
                    <option value="Web">Web</option>
                    <option value="Autism">Autism</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class ="lab">
                <label for="title">Title.</label>
            </div>
            <div class ="inp">
                <input type="text" name="title" required placeholder="Title">
            </div>
        </div>
        <div class="row">
            <div class ="lab">
                <label for="summary">Summary.</label>
            </div>
            <div class ="inp">
                <input type="text" name="summary" required placeholder="Summary (for the RSS feed and Twitter)" maxlength="220">
            </div>
        </div>
        <div class="row">
            <div class="lab">
                <label for="content">Content.</label>
            </div>
            <div class="inp">
                <textarea name="content" id="content" placeholder="The content of the post" style="height: 30em;"></textarea>
            </div>
        </div>
        <div class="row">
            <input type="submit" name="submit" value="Post.">
        </div>
    </form>   
</div>
<?php
include "includes/footer.php";
?>