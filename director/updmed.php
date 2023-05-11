<?php
include('index.php');
require('dbconnect.php');
$find = "";
$patid = 0;
$medname = '';
$cost = 0;
$amount = 0;
$det = '';
$errorfind = array('med' => '');
$errorupdate = array('name =>', 'cost' => '', 'amt' => '');

if (isset($_POST['submit'])) {
    if (empty($_POST['findname'])) {
        $error['med'] = "ENTER A MEDICINE NAME";
    } else {
        $find = $_POST['findname'];
    }
    if (array_filter($errors)) {
    } else {
        $sqlmed = 'SELECT id,name,cost,availableamt FROM medicine';
        //make query and get result
        $resultmed = mysqli_query($conn, $sqlmed);
        //fetch the resulting rows
        $datamed = mysqli_fetch_all($resultmed, MYSQLI_ASSOC);
        foreach ($datamed as $datmed) :
            if ($find == $datpat['name']) {
                $patid = $datpat['id'];
                $medname = $datmed['name'];
                $cost = $datmed['cost'];
                $amount = $datmed['availableamt'];
            }
        endforeach;
        if ($patid != 0) {
            $det = "Patient details found";
        } else {
            $det = "Patient details not found";
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
    </style>
</head>
<body>
<div id="central">
        <h7> Add/Update Medicine.</h7>
    <div id="all">
        <a href="reports.php" style="text-decoration: none; color:white;"><div class="allmenu" id="create">New Medicine</div></a>
        <a href="updmed.php" style="text-decoration: none; color:white;"><div class="allmenu" id="updat">Update medicine</div></a>
    </div>
    <div id="emailrequest">
        <h3><?php echo htmlspecialchars($det); ?></h3>
        <h4> Enter patient email</h4>

        <form action="updmed.php" method="POST" style="display: flex; flex-direction: column; margin: 50px 20%;">

            <label for="medicine name" style="margin:20px,0;">Medicine name: </label>
            <input class="fix" type="text" name="findname" value="<?php echo htmlspecialchars($find); ?>">
            <div class="errormessage" style="color:red; margin:20px,0;"><?php echo ($errors['med']); ?></div>

            <button style="margin:10px;" name="submit">submit</button>
        </form>
    </div>      
<!-- //end of content -->
</div>

</body>

</html>