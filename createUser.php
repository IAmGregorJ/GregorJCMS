<?php 
//Der er ingen link til denne side fra "hjemmesiden" - da det er pt. kun mig som administrerer brugere
    session_start();
    $pageTitle = "I Am Gregor J. | New User";
    include "../db.php";
    include "functions.php";
    
    if(isset($_SESSION['user']))
    {
        createUser();
    }
    else
    {
        // omdirigerer til index hvis ikke brugeren er logget på
        header("Location: /");
    }
    include "includes/header.php"
?>

    <div class="container">
        <form action="createUser" method="post">
            <div class="row">
                <div class="lab">
                    <label for="username">Username.</label>
                </div>
                <div class=inp>
                    <input type="text" name="username" required>
                </div>
            </div>
            <div class="row">
                <div class="lab">
                    <label for="password">Password.</label>
                </div>
                <div class="inp">
                    <input type="password" name="password" required>
                </div>
            </div>
            <div class="row">
                <div class="lab">
                    <label for="email">Email.</label>
                </div>
                <div class="inp">
                    <input type="email" name="email" required>
                </div>
            </div>
            <div class="row">
                <input type="submit" name="create" value="Create.">
            </div>
        </form>    
    </div>

<?php include "includes/footer.php"; ?>