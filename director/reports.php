<?php
include('index.php');
require('dbconnect.php');
$errors = array('fname'=>'','lname'=>'','birth'=>'');
$medname = '';
$suc = '';
$cost = 0;
$amount = 0;
if(isset($_POST['submit']))
{
    if(empty($_POST['mn']))
    {
        $errors['fname'] = 'Medicine name is required';
    }
    else{
        $medname = $_POST['mn'];
    }
    if(empty($_POST['medcost']))
    {
        $errors['lname'] = 'Write a valid cost';
    }
    else{
        $cost = $_POST['medcost'];
    }
    if(empty($_POST['amt']))
    {
        $errors['birth'] = 'Write a valid amount';
    }
    else{
        $amount = $_POST['amt'];
    }
    
    if(array_filter($errors)){}
    else{
        $medname = mysqli_real_escape_string($conn,$_POST['mn']);


        $sql = "INSERT INTO medicine(name,cost,availableamt) VALUES ('$medname','$cost','$amount')";
        if(mysqli_query($conn,$sql)){
            $suc = 'MEDICINE ADDED SUCCESSFULLY';
            $medname = '';
            $cost = 0;
            $amount = 0;

        } else{
            echo 'query error: '.mysqli_error($conn);
        }

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        #update{
            border-bottom: 10px solid #111d13;
        }
        #create{
            background-color: #e63946;
        }
    </style>
</head>
<body>
<div id="central">
        <h7> Add/Update Medicine.</h7>
    <div id="all">
        <a href="reports.php" style="text-decoration: none; color:white;"><div class="allmenu" id="create">New Medicine</div></a>
        <a href="updmed.php" style="text-decoration: none; color:white;"><div class="allmenu" id="updat">Update medicine</div></a>
    </div>
    <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($suc);  ?></div>
        <!-- Form for creating new medicine -->
        <form action="reports.php" method="POST" style="display: flex; flex-direction: column; margin: 50px 20%;">

        <label for="med_name" style="margin:100px,0;">Medicine name: </label>
        <input type="input" name="mn" style="margin:100px,0;" value ="<?php echo htmlspecialchars($medname); ?>" >
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['fname']);  ?></div>

        <label for="med_cost" style="margin:100px,0;">Cost: </label>
        <input type="number" name="medcost" style="margin:100px,0;" value="<?php echo htmlspecialchars($cost);?>">
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['lname']);  ?></div>

        <label for="med_amt" style="margin:100px,0;">Available amount: </label>
        <input type="number" name="amt" style="margin:100px,0; height:150px;" value="<?php echo htmlspecialchars($amount);?>">
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['birth']);  ?></div>

        <button name="submit">submit</button>
             
<!-- //end of content -->
</div>

</body>

</html>