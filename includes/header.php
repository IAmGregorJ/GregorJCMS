<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A middle-aged second-career programmer just trying to figure things out. Nothing more, nothing less.">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@IAmGregorJ" />
    <meta name="twitter:title" content="I am Gregor J., and this is my brutal truth." />
    <meta name="twitter:description" content="I built my own Content Management System using PHP and MYSQL." />
    <meta name="twitter:image" content="https://gregorj.org/images/card.jpg" />
    <meta name="twitter:image:alt" content="GregorJ.org Twitter card image." />
    <meta name="twitter:creator" content="@IAmGregorJ" />
    <meta http-equiv="Cache-Control" content="max-age=200" /> 
    <title><?php echo htmlspecialchars( $pageTitle )?></title>
    <link rel="stylesheet" type="text/css" href="/styles/style" />
    <link rel="shortcut icon" type="image/ico" href="/images/favicon.ico"/>
    <link rel="apple-touch-icon" type="image/png" href="/images/apple-touch-icon.png"/>
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
  </head>
  <body>
    <header>
    <div class="login">
      <?php
      if(isset($_SESSION['user']))
      {
          echo "<p style='color:gold'>You are logged in as: ". $_SESSION['user'];
          echo "<br/><a href='/logout' style='color:limegreen'>Log out.</a></p>";
          if($_SESSION['user'] == "GregorJ")
          {
            echo "<p><a href='/createUser' style='color:limegreen'>Create a new user.</a></p>";
          }
      }
      else
      {
          echo "<a href='/login' style='color:limegreen'>Log in.</a>";
      }
      ?>
    </div>
    <div class="title">
      <a href="/">I AM<br/>GREGOR J.</a>
    </div>
    </header>