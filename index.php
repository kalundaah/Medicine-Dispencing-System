<?php
//establish connection to database
include('templates/dbconnect.php');
include('templates/overall.php')

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <style>
        #con{
            display:flex;
            flex-direction:row;
            justify-content: space-around;
        }
        #enlarged{
            background-color:black;

        }
        #central{
            background-color:blue;
        }
        #smallpane{
            background-color:red;
        }
    </style>
</head>
<body>
<div id="con">
        <div id="enlarged">e</div>
        <div id="central">f</div>
        <div id ="smallbox">g</div>
    </div>
</body>
</html>
