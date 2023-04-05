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
            background-color: #1d3557;
            justify-content: space-evenly;
            color: antiquewhite;
            text-shadow: 0 0 3px black;
        }
        #sidepane{
            display:flex;
            flex-direction: column;
            background-color: #457b9d;
            justify-content: space-evenly;
            height:100vh;
            color:antiquewhite;
            text-shadow: 0 0 4px black;
            width:auto;
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

    </style>
    <script src="https://kit.fontawesome.com/57a72e588d.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="navpane">
        <a href="home.php" style="text-decoration: none; color:white;"><div class="elements" id="navhome"><h5>Home</h5></div></a>
        <a href="stock.php" style="text-decoration: none; color:white;"><div class="elements" id="navorder"><h5>Stock</h5></div></a>
        <a href="allocate.php" style="text-decoration: none; color:white;"><div class="elements" id="navhistory"><h5>Allocate</h5></div></a>
        <a href="update.php" style="text-decoration: none; color:white;"><div class="elements" id="navprofile"><h5>Update</h5></div></a>
    </div>
    <div id="con">
        <div id="enlarged">
            <div id="sidepane">
                <a href="home.php" style="text-decoration: none; color:white;"><div class="side-elements" id="home"><div class="icons"><i class="fa-solid fa-home"></i></div><div class="text"><h5>Home</h5></div></div></a>
                <a href="stock.php" style="text-decoration: none; color:white;"><div class="side-elements" id="stock"><div class="icons"><i class="fa-solid fa-warehouse"></i></div><div class="text"><h5>Stock</h5></div></div></a>
                <a href="allocate.php" style="text-decoration: none; color:white;"><div class="side-elements" id="allocate"><div class="icons"><i class="fa-solid fa-handshake"></i></div><div class="text"><h5>Allocate</h5></div></div></a>
                <a href="update.php" style="text-decoration: none; color:white;"><div class="side-elements" id="update"><div class="icons"><i class="fa-solid fa-pen"></i></div><div class="text"><h5>Update</h5></div></div></a>
            </div>
        </div>
        <!-- <div id="central">aa</div>
    </div> -->
    </a>
