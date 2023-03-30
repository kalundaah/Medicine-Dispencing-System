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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History page</title>
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
        <h7> The following are your recent transactions by category: </h7>
        <div id="historyorg">
            <div id="ordercol">
                <h4>YOUR PAST ORDERS</h4>
                <table>
                <tr>
                     <th>patient</th>
                     <th>medicine</th>
                     <th>Time and day<th>
                </tr>
                <?php   
                    $sqlhis = 'SELECT patient,medicine,time_ordered FROM orders WHERE patient = '.$idpat ;
                    $sqlmed = 'SELECT id,name FROM medicine';
                    $sqldoc = 'SELECT id,firstname FROM doctor';

                    //make query and get result
                    $resulthis = mysqli_query($conn, $sqlhis);
                    $resultmed = mysqli_query($conn, $sqlmed);
                    $resultdoc = mysqli_query($conn, $sqldoc);

                    //fetch the resulting rows
                    $datahis = mysqli_fetch_all($resulthis,MYSQLI_ASSOC); //past orders
                    $datamed = mysqli_fetch_all($resultmed,MYSQLI_ASSOC); // medcine data
                    $datadoc = mysqli_fetch_all($resultdoc,MYSQLI_ASSOC); //
                    if(empty($datahis)){
                        $empty = 'N/A'; ?>
                        <div>
                            <tr>
                                <td> <h6> <?php echo htmlspecialchars($empty); ?> </h6></td> 
                                <td> <h6> <?php echo htmlspecialchars($empty); ?> </h6> </td>  
                                <td> <h6> <?php echo htmlspecialchars($empty); ?> </h6> </td>  
                            </tr> 
                        </div>

                    <?php }

                    foreach($datahis as $dat): ?>
                        <div>
                            <tr>
                                
                                <td> <h6> <?php echo htmlspecialchars($fname); ?> </h6></td> 
                                <td> <h6> <?php 
                                foreach($datamed as $dat2): 
                                    if($dat2['id'] == $dat['medicine'])
                                    {
                                        echo htmlspecialchars($dat2['name']);  
                                    } endforeach; ?> </h6> </td>
                                <td> <h6> <?php echo htmlspecialchars($dat['time_ordered']); ?> </h6> </td>

                            </tr> 
                        </div>
                <?php endforeach;
                 ?>
                </table>

            </div>
            <div id="allocatedcol">
                <h4>YOUR PAST ALLOCATIONS</h4>
                <table>
                <tr>
                     <th>patient</th>
                     <th>doctor</th>
                     <th>medicine</th>
                     <th>initial allocation</th>
                     <th>current allocation</th>
                     <th>finished</th>
                </tr>
                <?php
                    $sqlall = 'SELECT patient,doctor,medicine,initial,current,finished FROM allocation WHERE patient = '.$idpat;
                    //make query and get result
                    $result2 = mysqli_query($conn, $sqlall);

                    //fetch the resulting rows
                    $dataall = mysqli_fetch_all($result2,MYSQLI_ASSOC); //patient
                    if(empty($dataall)){
                        $empty = 'N/A'; ?>
                        <div>
                            <tr>
                                <td> <h6> <?php echo htmlspecialchars($empty); ?> </h6></td> 
                                <td> <h6> <?php echo htmlspecialchars($empty); ?> </h6> </td>  
                                <td> <h6> <?php echo htmlspecialchars($empty); ?> </h6> </td>
                                <td> <h6> <?php echo htmlspecialchars($empty); ?> </h6> </td>
                                <td> <h6> <?php echo htmlspecialchars($empty); ?> </h6> </td>
                                <td> <h6> <?php echo htmlspecialchars($empty); ?> </h6> </td>  
                            </tr> 
                        </div>

                    <?php }

                    foreach($dataall as $dat2): ?>
                        <div>
                            <tr>
                                <td> <h6> <?php echo htmlspecialchars($fname); ?> </h6></td> 
                                <td> <h6>  <?php 
                                foreach($datadoc as $dat3): 
                                    if($dat3['id'] == $dat2['doctor'])
                                    {
                                        echo htmlspecialchars($dat3['firstname']);  
                                    } endforeach; ?> </h6> </td>  
                                <td> <h6>  <?php 
                                foreach($datamed as $dat4): 
                                    if($dat4['id'] == $dat2['medicine'])
                                    {
                                        echo htmlspecialchars($dat4['name']);  
                                    } endforeach; ?> </h6> </td>  
                                <td> <h6> <?php echo htmlspecialchars($dat2['initial']); ?> </h6> </td>  
                                <td> <h6> <?php echo htmlspecialchars($dat2['current']); ?> </h6> </td>  
                                <td> <h6> <?php echo htmlspecialchars($dat2['finished']); ?> </h6> </td>
                            </tr> 
                        </div>
                <?php endforeach;
                 ?>
                </table>
            </div>
        </div>

    </div>
<!-- //end of content -->
</div>
<?php 
    //free result from memory
    mysqli_free_result($resulthis);
    mysqli_free_result($resultpat);
    mysqli_free_result($resultmed);
    mysqli_free_result($resultdoc);

?>
</body>
</html>
