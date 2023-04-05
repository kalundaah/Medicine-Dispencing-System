<?php

include('data.php');
//establish connection to database
include('dbconnect.php');
include('doctoroverall.php');
foreach($data as $dat):
    if($email == $dat['email']){
        $idpat = $dat['id'];
}
endforeach;
$errors = array('emal' => '','medicin' => '','medtype'=> '','pat' =>'');
$emai = $patemail = $medicin = $typmed= $patname= $sympt = $diag = '';
$mednos = 0;
$patnos = 0;
$typnos = 0;
$message = '';
if(isset($_POST['findpat'])){
    //find the listed patient through the email address\
    if(empty($_POST['patientemail'])){
        $errors['pat'] = 'NO VALID EMAIL LISTED <br />';
    }
    else{
        $patemail = $_POST['patientemail'];
        $sympt = $_POST['symptom'];
        $diag = $_POST['diagn'];
        $medicin = $_POST['medicine'];    
        $typmed = $_POST['medtyp'];

        $sql = 'SELECT id,email,firstname FROM patient';

        //make query and get result
        $result = mysqli_query($conn, $sql);

        //fetch the resulting rows
        $data = mysqli_fetch_all($result,MYSQLI_ASSOC); //patient
        foreach($data as $datpatient):
        if($patemail == $datpatient['email']){
            $patnos = $datpatient['id'];
            $patname = $datpatient['firstname'];
            $errors['pat'] = 'EMAIL IS FOUND <br />';
        }  
        endforeach;
        //free result from memory
        mysqli_free_result($result);
    }
}
if(isset($_POST['find'])){
    if(empty($_POST['medicine'])){
        $errors['medicin'] = 'NO VALID MEDICINE LISTED <br />';
    } 
    else{
        $patemail = $_POST['patientemail'];
        $sympt = $_POST['symptom'];
        $diag = $_POST['diagn'];
        $medicin = $_POST['medicine'];
        $patname = $_POST['patname'];
        if(empty($_POST['medtyp']))
        {
            $typmed = '';
            
        }
        else{
            $typmed = $_POST['medtyp'];
        }

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

    //free result from memory
    mysqli_free_result($result);
    mysqli_free_result($result2);

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
        mysqli_free_result($result);
        mysqli_free_result($result2);
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
    <title>Allocation</title>
    <style>
        #allocate{
            border-bottom: 10px solid #111d13;
        }
        #historyorg{
            display:flex;
            flex-direction:row;
            margin-left:20%;
            height:50vh;
            padding:10px;

        }
        #ordercol{
            margin-right:5vh; 
            border: 2px solid black;
            height:70vh;
            width:50vh;
            color:whitesmoke;
            background-image: linear-gradient(#606c38,#283618);
        }
        #allocatedcol{
            border: 2px solid black;
            height:70vh;
            width:50vh; 
            margin-left:100px;
            color:whitesmoke;
            background-image: linear-gradient(#606c38,#283618);
        }
        td,tr{
            border: 1px solid white;
        }

    </style>
</head>
<body>
    <div id="central">
    <form action="allocate.php" method="POST" style="display: flex; flex-direction: column; margin: 50px 20%;">

        <label for="email" style="margin:100px,0;">Doctor name: </label>
        <input disabled type="text" name="email" style="margin:100px,0;" value ="<?php echo htmlspecialchars($fname); ?>" >
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['emal']);  ?></div>

        <label for="medicine" style="margin:100px,0;">Patient email: </label>
        <input type="input" name="patientemail" style="margin:100px,0;" value="<?php echo htmlspecialchars($patemail);?>">

        <button name="findpat">find patient</button>
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['pat']);  ?></div>

        <label for="patname" style="margin:100px,0;">patient name: </label>
        <input type="text" name="patname" style="margin:100px,0;" value ="<?php echo htmlspecialchars($patname); ?>" >

        <label for="symptoms" style="margin:100px,0;">Recorded symptoms: </label>
        <input type="input" name="symptom" style="margin:100px,0; height:150px;" value="<?php echo htmlspecialchars($sympt);?>">

        <label for="diagnosis" style="margin:100px,0;">Diagnosis: </label>
        <input type="input" name="diagn" style="margin:100px,0;" value="<?php echo htmlspecialchars($diag);?>">

        <label for="medicine" style="margin:100px,0;">Medicine: </label>
        <input type="input" name="medicine" style="margin:100px,0;" value="<?php echo htmlspecialchars($medicin);?>"> 
        <button name="find">find medicine</button>
        
        <label for="medtype" style="margin:100px,0;">Medicine Type: </label>
        <input type="input" name="medtyp" style="margin:100px,0;" value="<?php echo htmlspecialchars($typmed);?>">
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['medicin']);  ?></div>

        <button name="submit">submit</button>

    </form>

    </div>
<!-- //end of content -->
</div>
<?php 


?>
</body>
</html>
