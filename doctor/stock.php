<?php
include('data.php');
//establish connection to database
include('dbconnect.php');
include('doctoroverall.php');

$errors = array('emal' => '','medicin' => '','medtype'=> '');
$emai = $medicin = $typmed= '';
$mednos = 0;
$typnos = 0;
$message = '';
if(isset($_POST['find'])){
    if(empty($_POST['medicine'])){
        $errors['medicin'] = 'NO VALID MEDICINE LISTED <br />';
    } 
    else{
        $medicin = $_POST['medicine'];

        $sql = 'SELECT id,name,type FROM medicine';
        $sql2 = 'SELECT id,type FROM medicinetype';
        //make query and get result
        $result = mysqli_query($conn, $sql);
        $result2 = mysqli_query($conn, $sql2);
        //fetch the resulting rows
        $data = mysqli_fetch_all($result,MYSQLI_ASSOC); //medicine
        $data2 = mysqli_fetch_all($result2,MYSQLI_ASSOC); //medicinetype

        //compare the medicine names inputs to the ones in the patient table
        foreach($data as $dat):
            if($medicin == $dat['name']){
                $mednos = $dat['id'];
                $typnos = $dat['type'];
            }
        endforeach;

    
        //compare the emails and password inputs to the ones in the doctor table
        foreach($data2 as $dat2):
            if($typnos==0){
                die('MEDICINE IS NOT FOUND');
            }
            elseif($typnos == $dat2['id']){
                $typmed = $dat2['type'];
            }
        endforeach;
        }
    echo $patnos.$mednos;
}
if(isset($_POST['submit'])){
    $sql = 'SELECT id,email FROM patient';

    //make query and get result
    $result = mysqli_query($conn, $sql);

    //fetch the resulting rows
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC); //patient
    foreach($data as $dat):
        if($email == $dat['email']){
            $patnos = $dat['id'];
    }
    endforeach;

    if(empty($_POST['medicine'])){
        $errors['medicin'] = 'A password is required <br />';
    }
    else{
        $medicin = $_POST['medicine'];

        $sql = 'SELECT id,name,type FROM medicine';
        $sql2 = 'SELECT id,type FROM medicinetype';
        //make query and get result
        $result = mysqli_query($conn, $sql);
        $result2 = mysqli_query($conn, $sql2);
        //fetch the resulting rows
        $data = mysqli_fetch_all($result,MYSQLI_ASSOC); //medicine
        $data2 = mysqli_fetch_all($result2,MYSQLI_ASSOC); //medicinetype

        //compare the medicine names inputs to the ones in the patient table
        foreach($data as $dat):
            if($medicin == $dat['name']){
                $mednos = $dat['id'];
                $typnos = $dat['type'];
            }
        endforeach;

    
        //compare the emails and password inputs to the ones in the doctor table
        foreach($data2 as $dat2):
            if($typnos==0){
                die('MEDICINE IS NOT FOUND');
            }
            elseif($typnos == $dat2['id']){
                $typmed = $dat2['type'];
            }
        endforeach;

    }
    if(empty($_POST['medicinetype'])){
        $errors['medtype'] = 'The medicine should be listed <br />';
    }
               
    $sql = "INSERT INTO orders(patient,medicine) VALUES ($patnos,$mednos)";

    //save to db and check
    if(mysqli_query($conn,$sql)){
        header("location:history.php");
    } else{
        echo 'query error: '.mysqli_error($conn); 
    }     
}      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Page</title>
    <style>
        #stock{
            border-bottom: 10px solid #111d13;
        }
    </style>
</head>
<body>
    <div id="central">
        <form action="order.php" method="POST" style="display: flex; flex-direction: column; margin: 50px 20%;">

        <label for="email" style="margin:20px,0;">Your email: </label>
        <input disabled type="text" name="email" value ="<?php echo htmlspecialchars($email); ?>" >
        <div class="errormessage" style="color:red; margin:20px,0;"><?php echo($errors['emal']);  ?></div>

        <label for="medicine" style="margin:20px,0;">Medicine: </label>
        <input type="input" name="medicine" value="<?php echo htmlspecialchars($medicin);?>"> 
        <button name="find">find</button>

        <label for="medtype" style="margin:20px,0;">Medicine Type: </label>
        <input type="input" disabled name="medicinetype" value="<?php echo htmlspecialchars($typmed);?>">
        <div class="errormessage" style="color:red; margin:20px,0;"><?php echo($errors['medicin']);  ?></div>

        <button name="submit">submit</button>

        </form>
    </div>
<!-- //end of content -->
</div>
</body>
</html>
