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
        td,tr{
            border: 1px solid white;
        }
        #history{
            background-color: lightgreen;
        }
        #central{
            overflow:auto;
            height:100vh;
        }

    </style>
</head>
<body>
    <div id="central">
        <div id="all">
                <a href="allocate.php" style="text-decoration: none; color:white;"><div class="allmenu" id="entry">ENTRY</div></a>
                <a href="history.php" style="text-decoration: none; color:white;"><div class="allmenu" id="history">HISTORY</div></a>
        </div>
        <h6>ALLOCATION HISTORY</h6>
        <table>
                <tr>
                    <th>Patient</th>
                    <th>Medicine</th>
                    <th>Symptoms<th>
                    <th>Diagnosis<th>
                    <th>Allocation<th>
                    <th>Time allocated<th>                           
                </tr>
                <?php   
                    $sqlall = "SELECT patient,doctor,medicine,allocated,scenario,time FROM allocation";
                    $sqlsce = "SELECT id,doctor,symptoms,diagnosis FROM scenario WHERE 'doctor' = $iddoc";

                    //make query and get result
                    $resultall = mysqli_query($conn, $sqlall);
                    $resultsce = mysqli_query($conn, $sqlsce);

                    //fetch the resulting rows
                    $dataall = mysqli_fetch_all($resultall,MYSQLI_ASSOC); // medicine data
                    $datasce = mysqli_fetch_all($resultsce,MYSQLI_ASSOC); //medicine tyoe data

                    foreach($dataall as $dat): ?>
                        <div>
                            <tr>
                                <td> <h6> <?php echo htmlspecialchars($dat['patient']); ?> </h6> </td>
                                <td> <h6> <?php echo htmlspecialchars($dat['doctor']); ?> </h6> </td>
                                <td> <h6> <?php echo htmlspecialchars($dat['medicine']); ?> </h6> </td>
                                <td> <h6> <?php echo htmlspecialchars($dat['allocated']); ?> </h6> </td>
                                <td> <h6> <?php echo htmlspecialchars($dat['scenario']); ?> </h6> </td>                                
                            </tr> 
                        </div>
                <?php endforeach;
                 ?>
                </table>
        
    </div>
<!-- //end of content -->

</div>
</body>
</html>