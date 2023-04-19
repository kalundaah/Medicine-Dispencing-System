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
            background-color: #000000;
            justify-content: space-evenly;
            color: antiquewhite;
            text-shadow: 0 0 3px black;
        }
        #sidepane{
            display:flex;
            flex-direction: column;
            background-color: #000000;
            justify-content: space-evenly;
            height:100vh;
            color:antiquewhite;
            text-shadow: 0 0 4px black;
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
        }
        h3{
            color:red;
        }

    </style>
</head>
<body>
    <div id="navpane">
        <div class="elements" id="navhome"><h5>Home</h5></div>
        <div class="elements" id="navorder"><h5>Order</h5></div>
        <div class="elements" id="navhistory"><h5>History</h5></div>
        <div class="elements" id="navprofile"><h5>Profile</h5></div>
    </div>
    <div id="con">
        <div id="enlarged">
            <div id="sidepane">
                <div class="side-elements" id="home"><h5>Home</h5></div>
                <div class="side-elements" id="order"><h5>Order</h5></div>
                <div class="side-elements" id="history"><h5>History</h5></div>
                <div class="side-elements" id="profile"><h5>Profile</h5></div>
            </div>
        </div>
        <!-- <div id="central">aa</div>
    </div> -->
    </a>
