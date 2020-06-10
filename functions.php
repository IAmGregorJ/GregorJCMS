<?php
function login()
{
    if(isset($_POST['login']))
    {
        global $connection;

        /* Prepared statements - bedre valg ift sikkerhed end escape string - 
            bound parameters bliver sat ind i query som string, og derfor bliver ikke
            eksekveret, i tilfældet af et forsøg på injection.
            https://websitebeaver.com/prepared-statements-in-php-mysqli-to-prevent-sql-injection
        */
        $stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();

        if(mysqli_connect_errno())
        {
            //se kommentar om exit vs die i db.php
            exit('Something weird happened');
        }
    
        while($row = $result->fetch_array())
        {
            $db_username = $row['username'];
            $db_password = $row['password'];
            $db_rand = $row['rand'];
    
            $hashFormat = "$6$"; // sha512 $6$
            $rand = $db_rand; //fra db - skabt da brugeren blev oprettet (createUser.php)
            $salt = "rounds=3141$" . $rand;     
            $hash_and_salt = $hashFormat . $salt;
            $password = crypt($_POST['password'],$hash_and_salt);  
            
            if($password == $db_password)
            {
                /*
                    Så ved vi hvem brugeren er - og gemmer brugernavn i session 
                    for at kunne bruge brugerspecifikke funktioner på websiden
                */
                $_SESSION['user'] = $db_username;
                header("Location: /");
            }    
            else
            {
                return false;
            }
        }
        $stmt->close();
    }
}

function createUser()
{
    if(isset($_POST['create']))
    {
        global $connection;

        // Kontrollere, om username eksisterer allerede
        $stmt = $connection->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        if(mysqli_connect_errno())
        {
            exit('Something weird happened');
        }
        else
        {
            if(!$result)
            {
                // kryptere password med sha512 og tilfældigt genereret salt
                $hashFormat = "$6$";
                // genererer tilfældig salt. Skal gemmes i db (til kontrol af adgangskode ved login)
                $rand = substr(sha1(time()),0,16); 
                // rounds = hvor mange gange hashing loop bliver eksekveret - burde være mellem 1000 and 5000
                $salt = "rounds=3141$" . $rand;
                //
                $hash_and_salt = $hashFormat . $salt;
                $password = crypt($_POST['password'],$hash_and_salt);
    
                $stmt = $connection->prepare("INSERT INTO users(username, password, email, rand) VALUES ('?', '?', '?', '?')");
                $stmt->bind_param("ssss", $_POST['username'], $password, $_POST['email'], $rand);
                $stmt->execute();
    
                $result = $stmt->get_result();            
                if(mysqli_connect_errno())
                {
                    exit('Something weird happened');
                }
                else
                {
                    echo "User created.";
                }
                $stmt->close();
            }
            else
            {
                echo "That username is taken. Please try again.";
            }
        }
    }
}

function newPost()
{
    if(isset($_POST['submit']))
    {
        global $connection;

        /*
            generering af en "permalink" - altså titlen ryddet for alt så er den "web venlig"
            inspireret af https://github.com/ruvictor/Permalink/blob/master/index.php
        */
        $link = strtolower(trim($_POST['title']));
        $link = preg_replace('/[^a-z0-9-]/', '-', $link);
        $link = preg_replace('/-+/', "-", $link);
        $link = rtrim($link, '-');
        $link = preg_replace('/\s+/', '-', $link);

        // Dato formatteret for at være i overenstemmelse med MySQL datetime format
        $pubDate = date("Y-m-d H:i:s");

        $stmt = $connection->prepare("INSERT INTO articles (title, permalink, category, summary, content, pubDate, author) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $_POST['title'], $link, $_POST['category'], $_POST['summary'], $_POST['content'], $pubDate, $_SESSION['user']);
        $stmt->execute();

        $result = $stmt->get_result();
        if(mysqli_connect_errno())
        {
            exit('Something weird happened');
        }
        else
        {
            header("Location: /");
        }
        $stmt->close();
    }
}

function getPost()
{
    global $connection;

    $stmt = $connection->prepare("SELECT * FROM articles WHERE id = ?");
    $stmt->bind_param("s", $_GET['id']);
    $stmt->execute();

    $result = $stmt->get_result();    
    if($result)
    {
        while($post = $result->fetch_object())
        {
            $id = $post->id;
            $title = $post->title;
            $link = $post->permalink;
            $summary = $post->summary;
            $category = $post->category;
            $content = $post->content;
            $pubDate = $post->pubDate; 
            $author = $post->author;
            $return = array($title,$content);
            return $return;
        }
    }
    else
    {
        exit('Something weird happened');
    }
    $stmt->close();
}


// Checks to see if the person has already liked the post
function isLiked($id)
{
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    global $connection;

    $stmt = $connection->prepare("SELECT COUNT(*) FROM likes WHERE article_id = ? AND ip_address = ?");
    $stmt->bind_param("is", $id, $ipaddress);
    $stmt->execute();

    $result = $stmt->get_result();

    $likes = $result->fetch_array()[0];

    if($likes > 0)
    {
        return "true";
    }
    $stmt->close();
}

// Adds the like to the db
function likes()
{
    global $connection;

    if(isLiked($_GET['id']) != "true")
    {
        $stmt = $connection->prepare("INSERT INTO likes (article_id, ip_address) VALUES (?, ?)");
        $stmt->bind_param("is", $_GET['id'], $_SERVER['REMOTE_ADDR']);
        $stmt->execute();
    
        $result = $stmt->get_result();
        if(mysqli_connect_errno())
        {
            exit('Something weird happened');
        }
        else  
        {
            return getLikes($_GET['id']);
        }
    }
    else
    {
        return getLikes($_GET['id']);
    }
    $stmt-close();
} 

// Gets the number of likes for each post
function getLikes($id)
{
    global $connection;

    $stmt = $connection->prepare("SELECT COUNT(*) FROM likes WHERE article_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $likes = $result->fetch_array()[0];

    return $likes;
    $stmt->close();
}

function editPost()
{
    if(isset($_POST['edit']))
    {
        global $connection;

        // Permalink
        $link = strtolower(trim($_POST['title']));
        $link = preg_replace('/[^a-z0-9-]/', '-', $link);
        $link = preg_replace('/-+/', "-", $link);
        $link = rtrim($link, '-');
        $link = preg_replace('/\s+/', '-', $link);
        
        $stmt = $connection->prepare("UPDATE articles SET title = ?, permalink = ?, content = ?, category = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $_POST['title'], $link, $_POST['content'], $_POST['category'], $_POST['id']);
        $stmt->execute();
    
        $result = $stmt->get_result();
        if(mysqli_connect_errno())
        {
            exit('Something weird happened');
        }
        else
        {
            header("Location: /");
        }
        $stmt->close();
    }
}

function deletePost()
{
    global $connection;

    $stmt = $connection->prepare("DELETE FROM articles WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();

    $result = $stmt->get_result();    
    if($result)
    {
        echo "<script type='text/javascript'>alert('deleted successfully!')</script>";
        header("Location: /");
    }
    else
    {
        exit('Something weird happened');
    }
    $stmt-close();
}

function listAll()
{
    // Denne funktion er ikke brugt på siden - har den bare hvis der opstår senere behov
    global $connection;

    $stmt = $connection->prepare("SELECT * FROM articles ORDER BY pubDate DESC");
    $stmt->execute();

    $result = $stmt->get_result();    
    if($result)
    {
        while($post = $result->fetch_object())
        {
            echo "<a href='/article/" . $post->id . "/" . $post->permalink . "'>" . $post->title . "</a><br/>";
        }
    }
    $stmt->close();
}

function listLatest()
{
    global $connection;

    $stmt = $connection->prepare("SELECT * FROM articles ORDER BY pubDate DESC LIMIT 7");
    $stmt->execute();

    $result = $stmt->get_result();    
    if($result)
    {
        while($post = $result->fetch_object())
        {
            echo "<a href='/article/" . $post->id . "/" . $post->permalink . "'>" . $post->title . "</a><br/>";
        }
    }
    $stmt->close();
}

function listCategories()
{
    global $connection;

    // GROUP BY category giver mig praktisk talt bare en liste af kategorier, som er det jeg skal bruge
    $stmt = $connection->prepare("SELECT * FROM articles GROUP BY category");
    $stmt->execute();

    $result = $stmt->get_result();    
    if($result)
    {
        while($post = $result->fetch_object())
        {
            echo "<a href='/category/" . $post->category . "'>" . $post->category . "</a><br/>";
        }
    }
    $result->close();
}

function latestPosts()
{
    global $connection;

    /* 
        sidetal - sammenspil mellem index.php som får $pagenr fra denne funktion, 
        pagination.php som navigerer og sætter sidetallet som vi modtager igennem $_GET,
        og denne funktions $return, som sender sidetallet og antal sider i alt tilbage til index.php
    */
    if(isset($_GET['pagenr']))
    {
        $pagenr = $_GET['pagenr'];
    }
    else
    {
        $pagenr = 1;
    }

    // 3 artikler pr side
    $recordsPerPage = 3;
    // offset startert med at vise de korrekte artikler på en side. OBS at i MySQL den første række har en offset=0, derfor $pagenr-1 her
    $offset = ($pagenr-1) * $recordsPerPage;

    $stmt = $connection->prepare("SELECT COUNT(*) FROM articles");
    $stmt->execute();
    $resultTotal = $stmt->get_result();
    $totalRows = $resultTotal->fetch_array()[0];
    $totalPages = ceil($totalRows/$recordsPerPage);
    $return = array($pagenr,$totalPages);

    $stmt = $connection->prepare("SELECT * FROM articles ORDER BY pubDate DESC LIMIT ?, ?");
    $stmt->bind_param("ii", $offset, $recordsPerPage);
    $stmt->execute();

    $result = $stmt->get_result();    
    if($result)
    {
        while($post = $result->fetch_object())
        {
            $content = $post->content;
            include "includes/postFormat.php";
        }
    }
    else
    {
        exit('Something weird happened');
    }
    $stmt->close();
    return $return;
}

function postsByCategory()
{
    global $connection;

    // se kommentarer under latestposts()
    if(isset($_GET['pagenr']))
    {
        $pagenr = $_GET['pagenr'];
    }
    else
    {
        $pagenr = 1;
    }
    
    if(isset($_GET['category']))
    {
        $category = $_GET['category'];
    }
    else
    {
        header("Location: /");
    }
    $recordsPerPage = 3;
    $offset = ($pagenr-1) * $recordsPerPage;

    $stmt = $connection->prepare("SELECT COUNT(*) FROM articles WHERE category = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $resultTotal = $stmt->get_result();
    $totalRows = $resultTotal->fetch_array()[0];
    $totalPages = ceil($totalRows/$recordsPerPage);
    $return = array($pagenr,$totalPages);

    $stmt = $connection->prepare("SELECT * FROM articles WHERE category = ? ORDER BY pubDate DESC LIMIT ?, ?");
    $stmt->bind_param("sii", $category, $offset, $recordsPerPage);
    $stmt->execute();

    $result = $stmt->get_result();    
    if($result)
    {
        while($post = $result->fetch_object())
        {
            $content=$post->content;
            include "includes/postFormat.php";
        }
    }
    else
    {
        exit('Something weird happened');
    }
    $stmt->close();
    return $return;
}

function rss()
{
    global $connection;

    $stmt=$connection->prepare("SELECT * FROM articles ORDER BY pubDate DESC LIMIT 20");
    $stmt->execute();
    $result = $stmt->get_result();    

    header( "Content-type: text/xml");
 
    echo "<?xml version='1.0' encoding='UTF-8'?>
            <rss version='2.0'>
            <channel>
            <title>I Am Gregor J. | RSS</title>
            <link>https://gregorj.org/rss</link>
            <description>I built my own blog with php and mysql.</description>
            <language>en-us</language>";
    
    while($post = $result->fetch_object())
    {
        $title=$post->title;
        $link="https://gregorj.org/article/" . $post->id;
        $description=$post->summary;
        
        echo "<item>
        <title>$title</title>
        <link>$link</link>
        <description>$description</description>
        </item>";
    }
    echo "</channel></rss>";
    $stmt->close();
}

function showPost()
{
    global $connection;

    $stmt = $connection->prepare("SELECT * FROM articles WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();

    $result = $stmt->get_result();    
    if($result)
    {
        while($post = $result->fetch_object())
        {
            $content=$post->content;
            include "includes/postFormat.php";
        }
    }
    else
    {
        exit('Something weird happened');
    }
    $stmt->close();
}

function search()
{
    global $connection;
    // se kommentarer under latestposts()
    if(isset($_GET['pagenr']))
    {
        $pagenr = $_GET['pagenr'];
    }
    else
    {
        $pagenr = 1;
    }

    $recordsPerPage = 3;
    $offset = ($pagenr-1) * $recordsPerPage;

    $stmt = $connection->prepare("SELECT COUNT(*) FROM articles");
    $stmt->execute();
    $resultTotal = $stmt->get_result();
    $totalRows = $resultTotal->fetch_array()[0];
    $totalPages = ceil($totalRows/$recordsPerPage);
    $return = array($pagenr,$totalPages);
    
    if(isset($_POST['searching']))
    {
        // dette skal arbejdes på!!!
        $search = $connection->real_escape_string($_POST['search']);
        $searchArray = explode(" ", $search);
        $wordsCount = count($searchArray);
        $queryCondition = " WHERE ";
        for($i=0;$i<$wordsCount;$i++)
        {
            $queryCondition .= "title LIKE '%" . $searchArray[$i];
            $queryCondition .= "%' OR content LIKE '%" . $searchArray[$i];
            $queryCondition .= "%' OR category LIKE '%" . $searchArray[$i];
            $queryCondition .= "%' OR author LIKE '%" . $searchArray[$i] . "%'";
            if($i!=$wordsCount-1)
            {
                $queryCondition .= " OR ";
            }
        }
//      $orderBy = " ORDER BY id DESC LIMIT $offset, $recordsPerPage";
        $orderBy = " ORDER BY id DESC";

        $stmt = $connection->prepare("SELECT * FROM articles " . $queryCondition . $orderBy);
        $stmt->execute();
    
        $result = $stmt->get_result();        
        $queryResult = $result->fetch_array()[0];

        if($queryResult != 0)
        {
            echo "<p style='color:gold'>There ";
                if($queryResult == 1)
                {
                    echo "is 1 post ";
                }
                elseif($queryResult > 1)
                {
                    echo "are " . $queryResult . " posts ";
                }
            echo "matching your search.</p>";
        }

        if($queryResult > 0)
        {
            while($post = $result->fetch_object())
            {
                $search = $connection->real_escape_string($_POST['search']);
                $content = $post->content;
                $content = highlightTextWords($content, $search);
                
                include "includes/postFormat.php";
            }
        }
        else
        {
            echo "<p style='color:gold'>There are no posts matching your search.</p>";
        }
        $stmt->close();
        return $return;
    }
}

function highlightTextWords($content, $search)
{
    $colors = array('gold', 'lime', 'magenta', 'deepskyblue');
    $searchArray = explode(" ", $search);
    $wordsCount = count($searchArray);
    $colorIndex = 0;
    
    for($i=0;$i<$wordsCount;$i++) {
        $highlighted = "<span style='background-color:".$colors[$colorIndex].";'>".$searchArray[$i]."</span>";
        $content = str_ireplace($searchArray[$i], $highlighted, $content);
        $colorIndex = ($colorIndex +1);
    }
    return $content;
}
?>