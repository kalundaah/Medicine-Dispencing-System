<?php
include('index.php');
require('dbconnect.php');
$find = "";
$medid = 0;
$medname = '';
$cost = 0;
$ncost = 0;
$namt = 0;
$amount = 0;
$det = $nname = '';

$errorfind = array('med' => '');
$errorupdate = array('name' =>'', 'cost' => '', 'amt' => '');
$success = '';

if (isset($_POST['submit'])) {
    if (empty($_POST['findname'])) {
        $error['med'] = "ENTER A MEDICINE NAME";
    } else {
        $find = $_POST['findname'];
    }
    if (array_filter($errorfind)) {
    } else {
        $sqlmed = 'SELECT id,name,cost,availableamt FROM medicine';
        //make query and get result
        $resultmed = mysqli_query($conn, $sqlmed);
        //fetch the resulting rows
        $datamed = mysqli_fetch_all($resultmed, MYSQLI_ASSOC);
        foreach ($datamed as $datmed) :
            if ($find == $datmed['name']) {
                $medid = $datmed['id'];
                $medname = $datmed['name'];
                $cost = $datmed['cost'];
                $amount = $datmed['availableamt'];
            }
        endforeach;
        if ($medid != 0) {
            $det = "Patient details found";
        } else {
            $det = "Patient details not found";
        }
    }
}
if (isset($_POST['submit2'])) {
    if (empty($_POST['updname'])) {
        $errorupdate['name'] = "Cannot change to empty";
    } else {
        $nname = $_POST['updname'];
    }
    if (empty($_POST['updcost'])) {
        $errorupdate['cost'] = "Cannot change to empty";
    } else {
        $ncost = $_POST['updcost'];
    }
    if (empty($_POST['updamt'])) {
        $errorupdate['amt'] = "Cannot change to empty";
    } else {
        $namt = $_POST['updamt'];
    }
    if(array_filter($errorupdate)){}
    else{
        $sqlupdate = "UPDATE medicine SET name = '$nname', cost = '$ncost', availableamt = '$namt' WHERE id =" . $medid;
       // $sqlupdate = "UPDATE medicine SET name = '$medname', cost = '$cost', availableamt = '$amount' WHERE id =" . $medid;
        // $sqlupdate = "UPDATE `medicine` SET `name` = '$medname', `cost` = '$cost', `availableamt` = '$amount' WHERE `medicine`.`id` = $medid";
        if(mysqli_query($conn,$sqlupdate)){
            sleep(3);
            $success = "Medicine edited successfully";
            $find = "";
            $medid = 0;
            $medname = '';
            $cost = 0;
            $amount = 0;
            $det = '';
            $errorfind = array('med' => '');
            $errorupdate = array('name' =>'', 'cost' => '', 'amt' => '');
        }
        else {
            echo "Error updating record: " . mysqli_error($conn);
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
        #updat{
            background-color: #e63946;
        }
        #far-end{
            height:50vh;
            font-family: 'Open Sans', sans-serif;          
            margin: 0;
            text-shadow: 0px 0px 1px black;
            font-size:large;
            width:70vh;
            padding-right: 40vh;            
        }
    </style>
</head>
<body>
<div id="central">
        <h7> Add/Update Medicine.</h7>
    <div id="all">
        <a href="reports.php" style="text-decoration: none; color:white;"><div class="allmenu" id="create">New Medicine</div></a>
        <a href="updmed.php" style="text-decoration: none; color:white;"><div class="allmenu" id="updat">Update medicine</div></a>
        <a href="reorder.php" style="text-decoration: none; color:white;"><div class="allmenu" id="updatre">Check reorder</div></a>
    </div>
    <div id="emailrequest">
        <h3><?php echo htmlspecialchars($det); ?></h3>
        <h4> Enter patient email</h4>

        <form action="updmed.php" method="POST" style="display: flex; flex-direction: column; margin: 50px 20%;">

            <label for="medicine name" style="margin:20px,0;">Medicine name: </label>
            <input class="fix" type="text" name="findname" value="<?php echo htmlspecialchars($find); ?>">
            <div class="errormessage" style="color:red; margin:20px,0;"><?php echo ($errorfind['med']); ?></div>

            <button style="margin:10px;" name="submit">submit</button>
        </form>
    </div>
    
<!-- //end of content -->
</div>
<div id="far-end">
    <h2 style="font-size: large;" id = "amt">MEDICINE DETAILS</h2>
    <div class="errormessage" style="color:red; margin:20px,0;"><?php echo ($success); ?></div>
    
    <div id="meddetails">
        <form action="updmed.php" method="POST" style="display: flex; flex-direction: column; margin: 50px 20%;">

        <label for="medicine name" style="margin:20px,0;">Medicine name: </label>
        <input class="fix" type="text" name="updname" value="<?php echo htmlspecialchars($medname); ?>">
        <div class="errormessage" style="color:red; margin:20px,0;"><?php echo ($errorupdate['name']); ?></div>

        <label for="medicine cost" style="margin:20px,0;">Medicine Cost: </label>
        <input class="fix" type="integer" name="updcost" value="<?php echo htmlspecialchars($cost); ?>">
        <div class="errormessage" style="color:red; margin:20px,0;"><?php echo ($errorupdate['cost']); ?></div>

        <label for="medicine amount" style="margin:20px,0;">Medicine amount: </label>
        <input class="fix" type="integer" name="updamt" value="<?php echo htmlspecialchars($amount); ?>">
        <div class="errormessage" style="color:red; margin:20px,0;"><?php echo ($errorupdate['amt']); ?></div>

        <button style="margin:10px;" name="submit2">Update</button>
        </form>
    </div>
</div>  
</body>

</html>