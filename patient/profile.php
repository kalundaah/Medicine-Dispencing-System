<?php
include('data.php');
//establish connection to database
include('dbconnect.php');
include('patientoverall.php');
$patid = 0;
foreach($data as $dat):
    if($email == $dat['email']){
        $fname = $dat['firstname'];
        $lname = $dat['lastname'];
        $patid = $dat['id'];
}
endforeach;
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
            border-bottom: 10px solid #f4e285;
        }
        th,td{
            border: 1px solid black;

        }
        table{
            margin-top: 100px;
            width:100%;
        }
    </style>
</head>
<body>
    <div id="central">
        <h7> Your details as per your last visit.</h7>
        <table class = "styled-table">
            <thead>        
            <tr>
                <th>First Name</th>
                <th>Last name</th>
                <th>Date of Birth</th>
                <th>email</th>
                <th>Phone Number</th>
            </tr>
            </thead>
            <?php
                $sqlpat = 'SELECT id,firstname,lastname,dob,email,phonenos FROM patient';
                //make query and get result
                $resultpat = mysqli_query($conn, $sqlpat);
                //fetch the resulting rows
                $datapat = mysqli_fetch_all($resultpat,MYSQLI_ASSOC);
                foreach($datapat as $dat2):
            ?>
            <tbody>
            <div>
                <tr>

                <?php if($patid == $dat2['id']){ ?>
                    <td> <h2> <?php echo htmlspecialchars($dat2['firstname']); ?> </h2></td> 
                    <td> <h2> <?php echo htmlspecialchars($dat2['lastname']); ?> </h2> </td>  
                    <td> <h2> <?php echo htmlspecialchars($dat2['dob']); ?> </h2> </td>
                    <td> <h2> <?php echo htmlspecialchars($dat2['email']); ?> </h2> </td>
                    <td> <h2> <?php echo htmlspecialchars($dat2['phonenos']); ?> </h2> </td> 
                </tr>
            </div>
            </tbody> 
            
            <?php } endforeach;
            ?>
        </table> 
    </div>
<!-- //end of content -->
</div>
</body>
</html>
