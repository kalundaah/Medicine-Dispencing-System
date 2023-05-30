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
            text-shadow: 0px 0px 5px black;
            background-color: #d8f3dc;
            font-size: larger;
            
        }
        #navpane{
            display:flex;
            flex-direction: row;
            background-color: #081c15;
            justify-content: space-evenly;
            color: antiquewhite;
            text-shadow: 0 0 3px black;
            border: 2px solid white;
            border-radius: 12px;
            padding: 5px;
            height:15%;
            font-size:small;
            margin-bottom:10px;
            flex-grow: 1;
        }
        #sidepane{
            display:flex;
            flex-direction: column;
            background-color: #081c15;
            justify-content: space-evenly;
            height:70vh;
            color:antiquewhite;
            text-shadow: 0 0 4px black;
            width:auto;
            background-color: transparent;
        }
        .elements{
           height:10vh;
           
        }
        .side-elements{
           display:flex;
           position:sticky;
           height:10vh;
           margin: 0 auto;
           border-bottom: 10px solid white;
           justify-content: center;
           text-align: center;
           border:2px solid white;
           border-radius: 12px;
           padding: 5px;
           background-color: #081c15;
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
            background-color:transparent;
            width:12.5%;
            height:100vh;
            justify-content: start;
        }
        #central{
            background-color:transparent;
            width: 100%;
            color: black;
            text-shadow: 0 0 1px black;

        }
        h3{
            color:red;
        }
        .icons:hover{
            transform:scale(1.5);
        }
        button {
            background-color: #081c15; /* Green */
            border: 1px hidden;
            border-radius: 25px;
            padding:20px;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
            transition: width 2s;
        }
        button:hover{
            background-color: #457b9d;
        }
        input{
            margin:100px,0;
            width:350px;
            border:1px solid black;
            border-radius: 25px;
            padding: 20px;
        }
        table{
            border-collapse: collapse;
        }
        .styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    /* font-family: sans-serif; */
    font-family: 'Roboto', sans-serif;
    min-width: 400px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #081c15;
    color: #ffffff;
    text-align: left;
}
.styled-table th,.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #081c15;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #081c15;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #081c15;
}
    </style>
    <script src="https://kit.fontawesome.com/57a72e588d.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id ="navpane">
        <div class="elements" id="navhome"><h5><?php echo $fname; ?></h5></div>
        <!-- <a href="order.php" style="text-decoration: none; color:white;"><div class="elements" id="navorder"><h5>Data</h5></div></a>
        <a href="history.php" style="text-decoration: none; color:white;"><div class="elements" id="navhistory"><h5>History</h5></div></a>
        <a href="profile.php" style="text-decoration: none; color:white;"><div class="elements" id="navprofile"><h5>Profile</h5></div></a> -->
        <a href="/mda/index.php" style="text-decoration: none; color:white;"><div class="elements" ><h5>Sign out</h5></div></a>

        
    </div>
    <div id="con">
        <div id="enlarged">
            <div id="sidepane">
                <a href="home.php" style="text-decoration: none; color:white;"><div class="side-elements" id="home"><div class="icons"><i class="fa-solid fa-home"></i></div><div class="text"><h5>Home</h5></div></div></a>
                <a href="order.php" style="text-decoration: none; color:white;"><div class="side-elements" id="order"><div class="icons"><i class="fa-solid fa-magnifying-glass"></i></div><div class="text"><h5>Data</h5></div></div></a>
                <a href="history.php" style="text-decoration: none; color:white;"><div class="side-elements" id="history"><div class="icons"><i class="fa-solid fa-book"></i></div><div class="text"><h5>History</h5></div></div></a>
                <a href="profile.php" style="text-decoration: none; color:white;"><div class="side-elements" id="profile"><div class="icons"><i class="fa-solid fa-user"></i></div><div class="text"><h5>Profile</h5></div></div></a>
            </div>
        </div>
    
