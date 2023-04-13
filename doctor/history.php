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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allocation-History</title>
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
        tr{
            border: 4px solid white;
        }
        #history{
            background-color: lightgreen;
        }
        #central{
            overflow:auto;
            height:100vh;
        }
        table{
            margin: 50px 20%;
            border: 2px solid black;
        }
        td,th{
            border: 2px solid black;

        }

    </style>
</head>
<body>
    <div id="central">
        <div id="all">
                <a href="allocate.php" style="text-decoration: none; color:white;"><div class="allmenu" id="entry">ENTRY</div></a>
                <a href="history.php" style="text-decoration: none; color:white;"><div class="allmenu" id="history">HISTORY</div></a>
        </div>
        <h6 style="margin: 50px 20%;">YOUR ALLOCATION HISTORY</h6>
        <table>
                <tr>
                    <th>Patient</th>
                    <th>Medicine</th>
                    <th>Symptoms</th>
                    <th>Diagnosis</th>
                    <th>Allocation</th>
                    <th>Time allocated</th>                           
                </tr>
                <?php   
                    $sqlall = "SELECT patient,doctor,medicine,allocated,scenario,time FROM allocation ORDER BY time DESC";
                    $sqlsce = "SELECT id,symptoms,diagnosis FROM scenario";
                    $sqlpat = "SELECT id,firstname FROM patient";
                    $sqlmed = "SELECT id,name FROM medicine";
                    
                    //make query and get result
                    $resultall = mysqli_query($conn, $sqlall);
                    $resultsce = mysqli_query($conn, $sqlsce);
                    $resultpat = mysqli_query($conn, $sqlpat);
                    $resultmed = mysqli_query($conn, $sqlmed);

                    //fetch the resulting rows
                    $dataall = mysqli_fetch_all($resultall,MYSQLI_ASSOC); // allocation data
                    $datasce = mysqli_fetch_all($resultsce,MYSQLI_ASSOC); //scenario data
                    $datapat = mysqli_fetch_all($resultpat,MYSQLI_ASSOC);
                    $datamed = mysqli_fetch_all($resultmed,MYSQLI_ASSOC);

                    foreach($dataall as $dat):
                        if($dat['doctor']==$iddoc){
                        ?>
                        <div>
                            <tr>
                                <td> <h6> <?php
                                foreach($datapat as $datp):
                                    if($dat['patient'] == $datp['id'])
                                    {
                                        echo htmlspecialchars($datp['firstname']); 
                                    }
                                endforeach;
                                 ?> </h6> </td>
                                <td> <h6> <?php
                                foreach($datamed as $datm):
                                    if($dat['medicine'] == $datm['id'])
                                    {
                                        echo htmlspecialchars($datm['name']); 
                                    }
                                endforeach; ?> </h6> </td>
                                <?php
                                foreach($datasce as $datasc):
                                    if($dat['scenario'] == $datasc['id']){ ?>
                                        <td> <h6> <?php echo htmlspecialchars($datasc['symptoms']); ?> </h6> </td>
                                        <td> <h6> <?php echo htmlspecialchars($datasc['diagnosis']); ?> </h6> </td> <?php
                                    } endforeach;    ?>                              
                                <td> <h6> <?php echo htmlspecialchars($dat['allocated']); ?> </h6> </td>
                                <td> <h6> <?php echo htmlspecialchars($dat['time']); ?> </h6> </td>                                
                            </tr> 
                        </div>
                <?php } endforeach;
                mysqli_free_result($resultall);
                mysqli_free_result($resultsce);
                mysqli_free_result($resultpat);
                mysqli_free_result($resultmed);
                 ?>
                </table>
        
    </div>
<!-- //end of content -->

</div>
</body>
</html> 