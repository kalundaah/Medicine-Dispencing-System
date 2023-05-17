<?php
include('data.php');
//establish connection to database
include('dbconnect.php');
include('patientoverall.php');
foreach($data as $dat):
    if($email == $dat['email']){
        $fname = $dat['firstname'];
        $lname = $dat['lastname'];
        $idpat = $dat['id'];
}
endforeach;

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
    $res = 'no';         
    $sql = "INSERT INTO orders(patient,medicine,satisfied) VALUES ($patnos,$mednos,$res)";

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
    <title>Patient Data</title>
    <style>
        #order{
            border-bottom: 10px solid #f4e285;
        }
        td,tr{
            border: 1px solid black;
        }
        table{
            width:100%;
            border-collapse: collapse;
        }
        #tab{
            overflow:auto;
            height:90vh;
        }

    </style>
</head>
<body>
    <div id="central">
        <div id="tab">
            <table>
                    <tr>
                        <th>medicine</th>
                        <th>Allocated Time</th>
                        <th>Expected time for refill</th>   
                    </tr>
                    <?php   
                        $sqlhis = "SELECT patient,medicine,time,expected FROM allocation WHERE patient = '.$idpat.'" ;
                        $sqlmed = 'SELECT id,name FROM medicine';

                        //make query and get result
                        $resulthis = mysqli_query($conn, $sqlhis);
                        $resultmed = mysqli_query($conn, $sqlmed);

                        //fetch the resulting rows
                        $datahis = mysqli_fetch_all($resulthis,MYSQLI_ASSOC); //past orders
                        $datamed = mysqli_fetch_all($resultmed,MYSQLI_ASSOC); // medcine data

                        if(empty($datahis)){
                            $empty = 'N/A'; ?>
                            <div>
                                <tr> 
                                    <td> <h6> <?php echo htmlspecialchars($empty); ?> </h6> </td>  
                                    <td> <h6> <?php echo htmlspecialchars($empty); ?> </h6> </td>
                                    <td> <h6> <?php echo htmlspecialchars($empty); ?> </h6> </td>    
                                </tr> 
                            </div>

                        <?php }

                        foreach($datahis as $dat): ?>
                            <div>
                                <tr>
                                    <td> <h6> <?php 
                                    foreach($datamed as $dat2): 
                                        if($dat2['id'] == $dat['medicine'])
                                        {
                                            echo htmlspecialchars($dat2['name']);  
                                        } endforeach; ?> </h6> </td>
                                    <td> <h6> <?php echo htmlspecialchars($dat['time']); ?> </h6> </td>
                                    <td> <h6> <?php echo htmlspecialchars($dat['expected']); ?> </h6> </td>
                                </tr> 
                            </div>
                    <?php endforeach;
                    ?>
                    </table>
        </div>

    </div>
<!-- //end of content -->
</div>
</body>
</html>
