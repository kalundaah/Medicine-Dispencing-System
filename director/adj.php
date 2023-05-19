<?php
include('index.php');
require('dbconnect.php');
$errors = array('fname'=>'','lname'=>'','birth'=>'','pemail'=>'','password'=>'','cpassword'=>'','phone'=>'');
$fname =  $lname = $pemail = $pp = $cp = $pph = '';
$dob = '0000-00-00';
$suc = '';
if(isset($_POST['submit']))
{
    if(empty($_POST['pfn']))
    {
        $errors['fname'] = 'First name is required';
    }
    else{
        $fname = $_POST['pfn'];
    }
    if(empty($_POST['pln']))
    {
        $errors['lname'] = 'Last name is required';
    }
    else{
        $lname = $_POST['pln'];
    }
    if(empty($_POST['dob']))
    {
        $errors['birth'] = 'Birth date is required';
    }
    else{
        $dob = $_POST['dob'];
    }
    if(empty($_POST['pemail']))
    {
        $errors['pemail'] = 'patient email is required';
    }
    else{
        $pemail = $_POST['pemail'];
        if(!filter_var($pemail,FILTER_VALIDATE_EMAIL)){
            $errors['pemail'] = 'email must be a valid email adress';
        }
    }
    if(empty($_POST['pp']))
    {
        $errors['password'] = 'Password is required';
    }
    else{
        
    }
    if(empty($_POST['cpp']))
    {
        $errors['cpassword'] = 'Confirmed password is required';
    }
    else{
        if(($_POST['pp']) != ($_POST['cpp']))
        {
            $errors['cpassword'] = 'The confirmed password and the passwords do not match';
        }

    }
    if(empty($_POST['pph']))
    {
        $errors['phone'] = 'phone number is required';
    }
    else{
        $pph = $_POST['pph'];
    }
    if(array_filter($errors)){}
    else{
        $fname = mysqli_real_escape_string($conn,$_POST['pfn']);
        $lname = mysqli_real_escape_string($conn,$_POST['pln']);
        $pemail = mysqli_real_escape_string($conn,$_POST['pemail']);
        $pp = mysqli_real_escape_string($conn,$_POST['pp']);
        $pph = mysqli_real_escape_string($conn,$_POST['pph']);
        $dob = mysqli_real_escape_string($conn,$_POST['dob']);

        $sql = "INSERT INTO patient(firstname,lastname,dob,email,password,phonenos) VALUES ('$fname','$lname','$dob','$pemail','$pp','$pph')";
        if(mysqli_query($conn,$sql)){
            $suc = 'PATIENT CREATED SUCCESSFULLY';
            $fname =  $lname = $pemail = $pp = $cp = $pph = $dob = '';

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
        #doc{
            border-bottom: 10px solid #111d13;
        }
        th,td{
            border: 1px solid black;

        }
        table{
            margin-top: 100px;
        }
        #updat{
            background-color: #e63946;
        }
        #central{
            overflow:auto;
            height:90%;
        }
        #all{
            margin:0;
        }
        form{
            margin:0;
        }
    </style>
</head>
<body>
    <div id="central">
        <h7> Create/Change a patient's details.</h7>
        <div id="all">
                <a href="doc.php" style="text-decoration: none; color:white;"><div class="allmenu" id="create">Create Doctor</div></a>
                <a href="adj.php" style="text-decoration: none; color:white;"><div class="allmenu" id="updat">Find User</div></a>
        </div>
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($suc);  ?></div>
        <!-- Form for creating new patient -->
        <form action="create.php" method="POST" style="display: flex; flex-direction: column; margin: 50px 20%;">

        <label for="patient_fname" style="margin:100px,0;">Patient first name: </label>
        <input type="input" name="pfn" style="margin:100px,0;" value ="<?php echo htmlspecialchars($fname); ?>" >
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['fname']);  ?></div>

        <label for="patient_lname" style="margin:100px,0;">Patient last name: </label>
        <input type="input" name="pln" style="margin:100px,0;" value="<?php echo htmlspecialchars($lname);?>">
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['lname']);  ?></div>

        <label for="date_of_birth" style="margin:100px,0;">Date of birth: </label>
        <input type="date" name="dob" style="margin:100px,0; height:150px;" value="<?php echo htmlspecialchars($dob);?>">
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['birth']);  ?></div>

        <label for="patient_email" style="margin:100px,0;">Patient email: </label>
        <input type="input" name="pemail" style="margin:100px,0;" value="<?php echo htmlspecialchars($pemail);?>">
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['pemail']);  ?></div>

        <label for="Create a password" style="margin:100px,0;">Patient Password: </label>
        <input type="password" name="pp" style="margin:100px,0;"> 
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['password']);  ?></div>

        <label for="Confirm password" style="margin:100px,0;">Confirm Password: </label>
        <input type="password" name="cpp" style="margin:100px,0;"> 
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['cpassword']);  ?></div>

        <label for="patient_phone" style="margin:100px,0;">Patient phone number: </label>
        <input type="input" name="pph" style="margin:100px,0;" value="<?php echo htmlspecialchars($pph);?>">
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['phone']);  ?></div>

        <button name="submit">submit</button>
 
    </div>
<!-- //end of content -->
</div>
    
    
</body>
</html>