<?php
include('data.php');
//establish connection to database
include('dbconnect.php');
include('doctoroverall.php');
$patid = 0;
foreach($data as $dat):
    if($email == $dat['email']){
        $fname = $dat['firstname'];
        $lname = $dat['lastname'];
        $patid = $dat['id'];
}
endforeach;
$date = date('Y-m-d');
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
    #chek{
            background-color: #e63946;
        }
    #update{
            border-bottom: 10px solid #e63946;
        }

    </style>
</head>
<body>
    <div id="central">
        <h7> Your details as per your last visit.</h7>
        <div id="all">
                <a href="create.php" style="text-decoration: none; color:white;"><div class="allmenu" id="create">Create Patient</div></a>
                <a href="update.php" style="text-decoration: none; color:white;"><div class="allmenu" id="updat">Find User</div></a>
                <a href="check.php" style="text-decoration: none; color:white;"><div class="allmenu" id="chek">Expected visit</div></a>
        </div>
        <table class = "styled-table">       
            <thead>
            <tr>
                <th>Treated by</th>
                <th>Patient Name</th>
                <th>Phone Number</th>
                <th>Medicine</th>
                <th>Diagnosis</th>
                <th>Expected date of return</th>
            </tr>
            </thead>
            <?php
                $sqlpat = 'SELECT doctor,patient,medicine,scenario,allocated,expected FROM allocation';
                $sqldoc = 'SELECT id,firstname FROM doctor';
                $sqlmed = 'SELECT id,name FROM medicine';
                $sqlscen = 'SELECT id,diagnosis FROM scenario';
                $sqlpatient = 'SELECT id,firstname,phonenos FROM patient';
                //make query and get result
                $resultpat = mysqli_query($conn, $sqlpat);
                //fetch the resulting rows
                $datapat = mysqli_fetch_all($resultpat,MYSQLI_ASSOC);
                foreach($datapat as $dat2):
                if($dat2['expected'] > $date){
            ?>
            <tbody>
            <div>
                <tr>
                    <?php
                        $resultdoc = mysqli_query($conn, $sqldoc);
                        $datadoc = mysqli_fetch_all($resultdoc,MYSQLI_ASSOC);
                        foreach($datadoc as $dat3):
                        if($dat2['doctor'] == $dat3['id']){ ?>
                            <td> <h2> <?php echo htmlspecialchars($dat3['firstname']); ?> </h2></td>               
                    <?php } endforeach; ?>
                    <?php 
                        $resultpatient = mysqli_query($conn, $sqlpatient);
                        $datapatient = mysqli_fetch_all($resultpatient,MYSQLI_ASSOC);
                        foreach($datapatient as $dat4):
                        if($dat2['patient'] == $dat4['id']){ ?>
                            <td> <h2> <?php echo htmlspecialchars($dat4['firstname']); ?> </h2></td>
                            

                    <?php }
                    if($dat2['patient'] == $dat4['id']){ ?>
                        
                        <td> <h2> <?php echo htmlspecialchars($dat4['phonenos']); ?> </h2></td>

                    <?php }
                 endforeach; ?>
                    <?php 
                        $resultmed = mysqli_query($conn, $sqlmed);
                        $datamed = mysqli_fetch_all($resultmed,MYSQLI_ASSOC);
                        foreach($datamed as $dat5):
                        if($dat2['medicine'] == $dat5['id']){ ?>
                            <td> <h2> <?php echo htmlspecialchars($dat5['name']); ?> </h2></td>
                    <?php } endforeach; ?>  
                    <?php 
                        $resultscen = mysqli_query($conn, $sqlscen);
                        $datascen = mysqli_fetch_all($resultscen,MYSQLI_ASSOC);
                        foreach($datascen as $dat6):
                        if($dat2['scenario'] == $dat6['id']){ ?>
                            <td> <h2> <?php echo htmlspecialchars($dat6['diagnosis']); ?> </h2></td>
                    <?php } endforeach; ?>
                    <td> <h2> <?php echo htmlspecialchars($dat2['expected']); ?> </h2> </td> 
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
