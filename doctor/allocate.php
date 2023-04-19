<?php

include('data.php');
//establish connection to database
include('dbconnect.php');
include('doctoroverall.php');
foreach($data as $dat):
    if($email == $dat['email']){
        $iddoc = $dat['id'];
}
endforeach;
$errors = array('patemail' => '','sympterror' => '','diagnosiserror' => '', 'mederror' => '','amounterror' => '','dateerror'=>'');
$patient_email = $symptom = $diagnosis = $medicine_name = $message = '';
$date = '0000-00-00';

$amount = 0;
$idpat = 0;
$idmedicine = 0;
$available = 0;
$new = 0;
$prev = 0;

if(isset($_POST['submit'])){
    if(empty($_POST['patientemail'])){
        $errors['patemal'] = 'An email is required <br />';
    }
    else{
        $patient_email = $_POST['patientemail'];
        if(!filter_var($patient_email,FILTER_VALIDATE_EMAIL)){
            $errors['patemail'] = 'email must be a valid email adress';
        }
        $sqlpat = 'SELECT id,email FROM patient';
        $result = mysqli_query($conn,$sqlpat);
        $datapatient = mysqli_fetch_all($result,MYSQLI_ASSOC);
        foreach($datapatient as $datpat):
            if($patient_email == $datpat['email']){
                $idpat = $datpat['id'];
        }
        endforeach;
        if($idpat == 0){
            $errors['patemail'] = 'INCORRECT EMAIL';
        }
        mysqli_free_result($result);
    }

    if(empty($_POST['patientemail'])){
        $errors['sympterror'] = 'Symptoms report required <br />';
    }
    else{
        $symptom = $_POST['symptoms'];
    }

    if(empty($_POST['diagn'])){
        $errors['diagnosiserror'] = 'Diagnosis report required <br />';
    }
    else{
        $diagnosis = $_POST['diagn'];
    }

    if(empty($_POST['medicine'])){
        $errors['mederror'] = 'Medicine name is required <br />';
    }
    else{
        $medicine_name = $_POST['medicine'];
        $sqlmed = 'SELECT id,name,availableamt,totalsold FROM medicine';
        $result2 = mysqli_query($conn,$sqlmed);
        $datamedicine = mysqli_fetch_all($result2,MYSQLI_ASSOC);
        foreach($datamedicine as $datmed):
            if($medicine_name == $datmed['name']){
                $idmedicin = $datmed['id'];
                $available = $datmed['availableamt'];
                $prev = $datmed['totalsold'];

        }
        endforeach;
        if($idmedicin == 0){
            $errors['mederror'] = 'INCORRECT EMAIL';
        }
        mysqli_free_result($result2);
    }
    if(empty($_POST['medamt'])){
        $errors['amounterror'] = 'Please enter a valid amount <br />';
    }
    else{
        if($_POST['medamt'] == 0){
            $errors['amounterror'] = 'INVALID AMOUNT';
        }
        else {
            $amount = $_POST['medamt'];
        }   
    }
    if(empty($_POST['edate'])){
        $errors['dateerror'] = 'Fill in a date <br />';
    }
    else{
        $date = $_POST['edate'];
        $current_time = new DateTime();
        $input_date = new DateTime($date);
        if ($input_date < $current_time) {
            // The date is in the past
            $errors['dateerror'] = "Please enter a future date";
        }
    }

    if(array_filter($errors)){}
    else{
        $symptom = mysqli_real_escape_string($conn,$_POST['symptoms']);
        $diagnosis = mysqli_real_escape_string($conn,$_POST['diagn']);
        $date = mysqli_real_escape_string($conn,$_POST['edate']);
        
        $sqlsce = "INSERT INTO scenario(patient,doctor,symptoms,diagnosis) VALUES ($idpat,$iddoc,'$symptom','$diagnosis')";
        if(mysqli_query($conn,$sqlsce)){
            $last_id = mysqli_insert_id($conn);
            $sqlall = "INSERT INTO allocation(patient,doctor,medicine,allocated,scenario,expected) VALUES ($idpat,$iddoc,$idmedicin,$amount,$last_id,'$date')";
            if(mysqli_query($conn,$sqlall)){
                $new = $available - $amount;
                $prev = $prev + $amount;
                $sqlupd = "UPDATE medicine SET availableamt = $new WHERE medicine.id = $idmedicin";
                if(mysqli_query($conn,$sqlupd)){
                    $sqltot = "UPDATE medicine SET totalsold = $prev WHERE medicine.id = $idmedicin";
                    if(mysqli_query($conn,$sqltot)){
                        $message = 'Medicine Allocated';
                    }else{
                        echo 'query error: '.mysqli_error($conn);
                    } 
                }else{
                    echo 'query error: '.mysqli_error($conn);
                }          

            }else{
                echo 'query error: '.mysqli_error($conn); 
            }

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
    <title>Allocation-Entry</title>
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
        #entry{
            background-color: lightgreen;
        }
        #confirmation{
            margin-left: 50vh;
            margin-right: auto;
            text-transform: capitalize;
            font-size: larger;
            color: red;
        }

    </style>
</head>
<body>
    <div id="central">
        <div id="all">
            <a href="allocate.php" style="text-decoration: none; color:white;"><div class="allmenu" id="entry">ENTRY</div></a>
            <a href="history.php" style="text-decoration: none; color:white;"><div class="allmenu" id="history">HISTORY</div></a>
            
        </div>
        <h6 id = "confirmation"><?php echo htmlspecialchars($message)?></h6> 
    <form action="allocate.php" method="POST" style="display: flex; flex-direction: column; margin: 50px 20%;">

        <label for="doctor name" style="margin:100px,0;">Doctor name: </label>
        <input disabled type="text" name="fnam" style="margin:100px,0;" value ="<?php echo htmlspecialchars($fname); ?>" >

        <label for="patient email" style="margin:100px,0;">Patient email: </label>
        <input type="input" name="patientemail" style="margin:100px,0;" value="<?php echo htmlspecialchars($patient_email);?>">
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['patemail']);  ?></div>

        <label for="symptoms description" style="margin:100px,0;">Recorded symptoms: </label>
        <input type="input" name="symptoms" style="margin:100px,0; height:150px;" value="<?php echo htmlspecialchars($symptom);?>">
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['sympterror']);  ?></div>

        <label for="diagnosis description" style="margin:100px,0;">Diagnosis: </label>
        <input type="input" name="diagn" style="margin:100px,0;" value="<?php echo htmlspecialchars($diagnosis);?>">
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['diagnosiserror']);  ?></div>

        <label for="medicine to allocate" style="margin:100px,0;">Medicine: </label>
        <input type="input" name="medicine" style="margin:100px,0;" value="<?php echo htmlspecialchars($medicine_name);?>"> 
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['mederror']);  ?></div>

        <label for="medamt description" style="margin:100px,0;">Amount allocated: </label>
        <input type="number" name="medamt" style="margin:100px,0;" value="<?php echo htmlspecialchars($amount);?>">
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['amounterror']);  ?></div>

        <label for="expected date" style="margin:100px,0;">Expected finishing date: </label>
        <input type="date" name="edate" style="margin:100px,0;" value="<?php echo htmlspecialchars($date);?>">
        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['dateerror']);  ?></div>

        <button name="submit">submit</button>

    </form>
        
    </div>
<!-- //end of content -->
</div>
<?php 


?>
</body>
</html>
