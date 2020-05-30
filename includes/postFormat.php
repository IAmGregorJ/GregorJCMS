<?php
    echo "<div class='post'>";
    echo "<a href='/article/" . $post->id . "/" . $post->permalink . "'><h2>" . $post->title . "</h2></a>";
    echo "<br/>";
    echo $content;
    echo "<br/>";

    $id = $post->id;
    if(getLikes($id) ==1)
    {
        $plural = "like";
    }
    else
    {
        $plural = "likes";
    }
    if(isLiked($post->id) == "true") {
        echo "<div class='right' id='post" . $id . "'><span class='likes'>" . getLikes($id) . " ".$plural." </span><img src='/images/liked.png' title='Thanks for liking!' height='32' width='32' alt='Like button - liked'></div>";
    } else {
        echo "<div class='right' id='post" . $id . "'><span class='likes'>" . getLikes($id) . " ".$plural." </span><img src='/images/like.png' id='thumb' title='Like it?' height='32' width='32' alt='Like button' onClick='likeButton(" . $id . ");'></div>";
    }

    echo "Posted to: <a href='/category/" . $post->category . "'>" . $post->category . "</a>";
    echo "<br/>";
    echo date("Y-m-d - H:i", strtotime($post->pubDate)); 
    echo "<br/>";
    echo "by: " . $post->author;

    $find = array('/ /', '/"/');
    $replace = array('%20', '%22');
    $cleanTitle = preg_replace($find, $replace, $post->title);
    echo "<div class='right'><a href='https://twitter.com/intent/tweet?text=".$cleanTitle."&url=https%3A%2F%2FGregorJ.org%2Farticle%2F".$id.
        "&via=iAmGregorJ' target='_blank' rel='noopener noreferrer'><img src='/images/twitter-xxl.png' title='Share this post on Twitter' 
        alt='Share this post on Twitter' height='32' width='32''></a></div>";
    echo "</div>";
?>