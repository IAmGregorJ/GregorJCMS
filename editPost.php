<?php 
    session_start();
    $pageTitle = "I Am Gregor J. | Edit Post";
    include "../db.php";
    include "functions.php";

    if(isset($_SESSION['user']))
    {
        editPost();
    }
    else
    {
        header("Location: /");
    }

    include "includes/header.php";
    $return = getPost();
?>

<div class="container">
    <form action="edit" method="post">
        <?php $id = $_GET['id']?>
        <input type="hidden" name="id" value="<?php echo $id?>">
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
                <input type="text" name="title" required placeholder="Title" value="<?php echo $return[0]?>">
            </div>
        </div>
        <div class="row">
            <div class="lab">
                <label for="content">Content.</label>
            </div>
            <div class="inp">
                <textarea name="content" id="content" placeholder="The content of the post" style="height: 30em;">
                    <?php echo $return[1]?>
                </textarea>
            </div>
        </div>
        <div class="row">
            <input type="submit" name="edit" value="Post.">
        </div>
    </form>   
</div>
<?php
include "includes/footer.php";
?>