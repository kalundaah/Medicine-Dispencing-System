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
$errors = array('patemail' => '','sympterror' => '','diagnosiserror' => '', 'mederror' => '','amounterror' => '','dateerror'=>'','lesserror' => '');
$patient_email = $symptom = $diagnosis = $medicine_name = $message = '';
$date = '0000-00-00';

$amount = 0;
$idpat = 0;
$idmedicin = 0;
$available = 0;
$new = 0;
$prev = 0;
$cost = 0;
$rev = 0;
$allcost = 0;
$tot = 0;
$sqlmed = 'SELECT name,type,availableamt FROM medicine';
$sqltype = 'SELECT id,type FROM medicinetype';
//make query and get result
$resultmed = mysqli_query($conn, $sqlmed);
$resulttype = mysqli_query($conn, $sqltype);

//fetch the resulting rows
$datamed = mysqli_fetch_all($resultmed,MYSQLI_ASSOC); // medicine data
$datatype = mysqli_fetch_all($resulttype,MYSQLI_ASSOC); //medicine tyoe data

if(isset($_POST['submit'])){
    if(empty($_POST['patientemail'])){
        $errors['patemail'] = 'An email is required <br />';
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
        $sqlmed = 'SELECT id,name,availableamt,totalsold,cost,revenue FROM medicine';
        $result2 = mysqli_query($conn,$sqlmed);
        $datamedicine = mysqli_fetch_all($result2,MYSQLI_ASSOC);
        foreach($datamedicine as $datmed):
            if($medicine_name == $datmed['name']){
                $idmedicin = $datmed['id'];
                $available = $datmed['availableamt'];
                $prev = $datmed['totalsold'];
                $cost = $datmed['cost'];
                $rev = $datmed['revenue'];

        }
        endforeach;
        if($available < $_POST['medamt'])
        {
            $errors['lesserror'] = 'The amount will not be enough for the allocation. Available amount is '.$available;
        }
        elseif(empty($available)){
            $errors['lesserror'] = 'The medicine is currently unavailable ';
        }
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
        $allcost = $cost * $amount;
        if(mysqli_query($conn,$sqlsce)){
            $last_id = mysqli_insert_id($conn);
            $sqlall = "INSERT INTO allocation(patient,doctor,medicine,allocated,scenario,expected,cost) VALUES ($idpat,$iddoc,$idmedicin,$amount,$last_id,'$date',$allcost)";
            if(mysqli_query($conn,$sqlall)){
                $new = $available - $amount;
                $prev = $prev + $amount;
                $sqlupd = "UPDATE medicine SET availableamt = $new WHERE medicine.id = $idmedicin";
                if(mysqli_query($conn,$sqlupd)){
                    $sqltot = "UPDATE medicine SET totalsold = $prev WHERE medicine.id = $idmedicin";
                    if(mysqli_query($conn,$sqltot)){
                        if($rev == 0){
                            $tot = $allcost;
                        }
                        else{
                            $tot = $allcost + $rev;
                        }
                        $sqlrev = "UPDATE medicine SET revenue = $tot WHERE medicine.id = $idmedicin";
                        if(mysqli_query($conn,$sqlrev)){
                            $amount = 0;
                            $idpat = 0;
                            $idmedicin = 0;
                            $available = 0;
                            $new = 0;
                            $prev = 0;
                            $cost = 0;
                            $rev = 0;
                            $allcost = 0;
                            $tot = 0;
                            $errors = array('patemail' => '','sympterror' => '','diagnosiserror' => '', 'mederror' => '','amounterror' => '','dateerror'=>'','lesserror' => '');
                            $patient_email = $symptom = $diagnosis = $medicine_name = $message = '';
                            $date = '0000-00-00';
                            $message = 'Medicine Allocated';
                        }
                        else{
                            echo 'query error: '.mysqli_error($conn);
                        }
                       
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
            border-bottom: 10px solid #e63946;
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

        #entry{
            background-color: #e63946;
        }
        #confirmation{
            margin-left: 50vh;
            margin-right: auto;
            text-transform: capitalize;
            font-size: larger;
            color: red;
        }
        #far-end{
            overflow: auto;
            height:50vh;
            font-family: 'Open Sans', sans-serif;          
            margin: 0;
            text-shadow: 0px 0px 1px black;
            font-size:large;
            width:70vh;
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
        <table>
            <tr>
                    <th></th>
                    <th></th>
                    <th></th>                         
            </tr>
            <div>
                <tr>
                    <td> <label for="doctor name" style="margin:100px,0;">Doctor name: </label>  </td>
                    <td> <input disabled type="text" name="fnam" style="margin:100px,0;width:350px;border:1px solid black; border-radius: 25px;padding: 20px;" value ="<?php echo htmlspecialchars($fname); ?>" >  </td>                             
                    <td> <div class="errormessage" style="color:red; margin:100px,0;"><?php echo('');  ?></div> </td>                               
                </tr>
                <tr>
                    <td><label for="patient email" style="margin:100px,0;">Patient email: </label></td>
                    <td><input type="input" name="patientemail" style="margin:100px,0;width:350px;border:1px solid black; border-radius: 25px;padding: 20px;" value="<?php echo htmlspecialchars($patient_email);?>"></td>
                    <td><div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['patemail']);  ?></div></td>
                </tr>
                <tr>
                    <td><label for="symptoms description" style="margin:100px,0;">Recorded symptoms: </label></td>
                    <td><input type="input" name="symptoms" style="margin:100px,0; width:350px;border:1px solid black; border-radius: 25px;padding: 20px;" value="<?php echo htmlspecialchars($symptom);?>"></td>
                    <td> <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['sympterror']);  ?></div></td>
                </tr>
                <tr>
                    <td><label for="diagnosis description" style="margin:100px,0;">Diagnosis: </label></td>
                    <td> <input type="input" name="diagn" style="margin:100px,0;width:350px;border:1px solid black; border-radius: 25px;padding: 20px;" value="<?php echo htmlspecialchars($diagnosis);?>"></td>
                    <td><div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['diagnosiserror']);  ?></div></td>
                </tr>
                <tr>
                    <td><label for="medicine to allocate" style="margin:100px,0;">Medicine: </label></td>
                    <td> <input type="input" name="medicine" style="margin:100px,0;width:350px;border:1px solid black; border-radius: 25px;padding: 20px;" value="<?php echo htmlspecialchars($medicine_name);?>"> </td>
                    <td><div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['mederror']);  ?></div></td>
                </tr>
                <tr>
                    <td><label for="medamt description" style="margin:100px,0;">Amount allocated: </label></td>
                    <td><input type="number" name="medamt" style="margin:100px,0;width:350px;border:1px solid black; border-radius: 25px;padding: 20px;" value="<?php echo htmlspecialchars($amount);?>"></td>
                    <td><div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['amounterror']);  ?></div>
                        <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['lesserror']);  ?></div>
                    </td>
                </tr>
                <tr>
                    <td><label for="expected date" style="margin:100px,0;">Expected finishing date: </label></td>
                    <td><input type="date" name="edate" style="margin:100px,0;width:350px;border:1px solid black; border-radius: 25px;padding: 20px;" value="<?php echo htmlspecialchars($date);?>"></td>
                    <td><div class="errormessage" style="color:red; margin:100px,0;"><?php echo($errors['dateerror']);  ?></div></td>
                </tr>
            </div>
        </table>
        <button name="submit">submit</button>

    </form>

    </div>
<!-- //end of content -->
<div id ="far-end">
    <h2 style="font-size: large;" id = "amt">AVAILABLE MEDICINE</h2>
        <table class = "styled-table">
            <thead>
                <tr>
                    <th>Medicine Name</th>
                    <th>Medicine Type</th>
                    <th>Available Amount</th>                        
                </tr>
            </thead>
                <?php   
                    foreach($datamed as $dat): ?>
                        <tbody>
                        <div>
                            <tr>
                                <td> <h6> <?php echo htmlspecialchars($dat['name']); ?> </h6> </td>
                                <td> <h6> <?php 
                                foreach($datatype as $dat2): 
                                    if($dat2['id'] == $dat['type'])
                                    {
                                        echo htmlspecialchars($dat2['type']);  
                                    } endforeach; ?> </h6> </td>
                                <td id="amt"> <h6> <?php
                                if(empty($dat['availableamt'])){
                                    echo htmlspecialchars('0');
                                }
                                else{
                                 echo htmlspecialchars($dat['availableamt']); } ?> </h6> </td>
                            </tr> 
                        </div>
                        </tbody>
                <?php endforeach;
                mysqli_free_result($resultmed);
                mysqli_free_result($resulttype);
                 ?>
                </table>
    </div>
</div>
<?php 


?>
</body>
</html>
