<?php
    header('Content-type: text/css; charset=utf-8');
?>
@font-face {
    font-family: 'traveling__typewriterregular';
    src: url('travelingtypewriter-webfont.woff') format('woff');
    font-weight: normal;
    font-style: normal;
}
* {
    box-sizing: border-box;
    font-family: 'traveling__typewriterregular';
    font-size: 1rem;
}
* a {
    text-decoration: none;
}
body {
    background-image: url('../images/background.jpg');
}
/* Header */
header {
    padding-left:1rem;
}
.title {
    margin-left: 20%;
    background-color: limegreen;
    text-align: center;
    width: 20vw;
    height:20vw;
    transform:rotate(-10deg);
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.title a{
    font-size: 5vw;
    color:black;
    text-decoration:none;
}

/*Article*/
article {
    float:left;
    padding:1rem;
    width:75%;
}
.post h2 {
    padding:0;
    margin:0;
    font-size:1.3rem;
}
.post {
    padding:2rem;
    padding-bottom:3rem;
    margin-bottom:2rem;
    margin-right:2rem;
    background-color: whitesmoke;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.post a {
    text-decoration: none;
    font-weight: bold;
}
.post p {
    font-size: 1rem;
}
.post .right {
    padding:0;
    margin:0;
    float:right;
    font-size:0.75rem;
}
.post .right img {
    cursor:pointer;
}
/*Sidebar*/
aside {
    float:left;
    width:20%;
    margin-top:1rem;
}
aside h1 {
    font-size: 1.3rem;
}
.search {
    margin-top:2rem;
    background-color:gold;
    padding:1rem;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.about {
    background-color: orange;
    color:#091D34;
    padding:1rem;
    transform:rotate(1deg);
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.about a {
    color:#091D34;
    font-weight: bold;
}
.latest {
    margin-top:2rem;
    background-color: hotpink;
    padding:1rem;
    transform:rotate(-2deg);
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.latest a {
    color:darkblue;
}
.categories {
    margin-top:2rem;
    padding:1rem;
    background-color: skyblue;
    transform:rotate(2deg);
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.categories a {
    color: black;
}
.contact {
    margin-top:2rem;
    padding:1rem;
    background-color: limegreen;
    transform:rotate(-3deg);
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.contact a {
    font-weight: bold;
    color: black;
}
.center {
    text-align:center;
}

/* Footer */
footer {
    display: inline-block;
    width:50%;
    margin-left: 25%;
    margin-top: 2rem;
    background-color: magenta;
    padding:1rem;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
footer a {
    color:darkblue;
}

/* Nav */
nav {
    display: inline-block;
    color:gold;
    width:100%;
    padding-left:1rem;
}
nav a {
    color:limegreen;
    font-weight: bold;
}

/* Pagination buttons */
.pagination a {
    text-decoration: none;
    font-weight: bold;
}
.button {
    color:black;
    margin:.3rem;
    padding:.3rem;
    display:inline-block;
    background-color: gold;
}

/* Form styling */
input[type=text], input[type=password], input[type=email], select, textarea {
    width: 100%;
    padding: .7rem;
    border: 1px solid #ccc;
    box-sizing: border-box;
    resize: vertical;
}
label {
    padding: .7rem .7rem .7rem 0;
    display: inline-block;
}
input[type=submit] {
    background-color: #4CAF50;
    color: black;
    margin-top:1rem;
    padding: .7rem 1rem;
    border: none;
    cursor: pointer;
}
.container {
    width:70%;
    margin-left: 15%;
    background-color: gold;
    padding: 1rem;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.lab {
    float: left;
    width: 25%;
    margin-top: 6px;
}
.inp {
    float: left;
    width: 75%;
    margin-top: 6px;
}
.login {
    float: right;
}
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Misc */
code {
    font-family: monospace;
    font-size: .9rem;
    background-color: azure;
}
img {
    max-width: 100%;
}
.error {
    position:absolute;
    top:10rem;
    width: 25vw;
    height:25vw;
    font-size:2vw;
    margin-left: 30%;
    background-color: orange;
    text-align: center;
    transform:rotate(20deg);
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.error h1 {
    font-size:6vw;
    padding-top:3rem;
}
.error a {
    background-color:limegreen;
}

/* For smaller screens */
@media only screen and (max-width: 640px) {
    /* For mobile phones: */
    article, aside, .post {
        width:100%;
        padding:1rem;
    }
    .lab, .inp, input[type=submit] {
        width: 100%;
        margin-top: 0;
    }
    .container, .footer {
        width: 100%;
        margin-left:0;
    }
    .title, .title a {
        margin:0;
        width: 70vw;
        height:70vw;
        font-size:16vw;
    }
}