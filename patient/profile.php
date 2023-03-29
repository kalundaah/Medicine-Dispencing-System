<?php
include('data.php');
//establish connection to database
include('dbconnect.php');
include('patientoverall.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        #profile{
            border-bottom: 10px solid #111d13;
        }
    </style>
</head>
<body>
    <div id="central"> <p> Welcome <?php echo $fname."<br>"; ?></p> </div>
<!-- //end of content -->
</div>
</body>
</html>
