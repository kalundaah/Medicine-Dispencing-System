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
            background-color: blue;
            justify-content: space-evenly;
        }
        .elements{
           display:flex;
           height:10vh;

        }
        .elements:hover{
            transform:scale(1.5);
        }
        #last{
            border-right: 0;
        }
        h5{
            font-size:medium;
        }


    </style>
</head>
<body>
    <div id="navpane">
        <div class="elements"><h5>Home</h5></div>
        <div class="elements"><h5>Order</h5></div>
        <div class="elements"><h5>History</h5></div>
        <div class="elements"><h5>Book</h5></div>
        <div class="elements" id="last"><h5>Profile</h5></div>
    </div>
</body>
</html>