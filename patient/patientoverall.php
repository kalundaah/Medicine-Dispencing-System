<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Open Sans', sans-serif;          
            margin: 0;
        }
        #navpane{
            display:flex;
            flex-direction: row;
            background-color: #283618;
            justify-content: space-evenly;
            color: antiquewhite;
            text-shadow: 0 0 3px black;
        }
        #sidepane{
            display:flex;
            flex-direction: column;
            background-color: #606c38;
            justify-content: space-evenly;
            height:100vh;
            color:antiquewhite;
            text-shadow: 0 0 4px black;
            max-height: 100vh;
            overflow:hidden;
        }
        .elements{
           height:10vh;
           
        }
        .side-elements{
           display:flex;
           height:10vh;
           margin: 0 auto;
           border-bottom: 10px solid white;
           justify-content: center;
           text-align: center;
        }
        h5:hover{
            transform:scale(1.5);
        }
        h5:hover{
            transform:scale(1.5);
        }
        #navprofile{
            border-right: 0;
        }
        h5{
            font-size:medium;

        }
        #con{
            display:flex;
            flex-direction:row;
        }
        #enlarged{
            background-color:black;
            width:12.5%;
            height:100vh;
            justify-content: start;
        }
        #central{
            background-color:whitesmoke;
            width: 100%;
            color: black;
            text-shadow: 0 0 1px black;
            max-height: 100vh;
            overflow: auto;
        }
        h3{
            color:red;
        }
        .icons:hover{
            transform:scale(1.5);
        }
    </style>
    <script src="https://kit.fontawesome.com/57a72e588d.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="navpane">
        <a href="home.php" style="text-decoration: none; color:white;"><div class="elements" id="navhome"><h5>Home</h5></div></a>
        <a href="order.php" style="text-decoration: none; color:white;"><div class="elements" id="navorder"><h5>Order</h5></div></a>
        <a href="history.php" style="text-decoration: none; color:white;"><div class="elements" id="navhistory"><h5>History</h5></div></a>
        <a href="profile.php" style="text-decoration: none; color:white;"><div class="elements" id="navprofile"><h5>Profile</h5></div></a>
    </div>
    <div id="con">
        <div id="enlarged">
            <div id="sidepane">
                <a href="home.php" style="text-decoration: none; color:white;"><div class="side-elements" id="home"><div class="icons"><i class="fa-solid fa-home"></i></div><div class="text"><h5>Home</h5></div></div></a>
                <a href="order.php" style="text-decoration: none; color:white;"><div class="side-elements" id="order"><div class="icons"><i class="fa-solid fa-magnifying-glass"></i></div><div class="text"><h5>Order</h5></div></div></a>
                <a href="history.php" style="text-decoration: none; color:white;"><div class="side-elements" id="history"><div class="icons"><i class="fa-solid fa-book"></i></div><div class="text"><h5>History</h5></div></div></a>
                <a href="profile.php" style="text-decoration: none; color:white;"><div class="side-elements" id="profile"><div class="icons"><i class="fa-solid fa-user"></i></div><div class="text"><h5>Profile</h5></div></div></a>
            </div>
        </div>
    
