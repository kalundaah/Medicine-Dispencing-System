<?php
include('data.php');
//establish connection to database
include('dbconnect.php');
include('doctoroverall.php');
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock-Page</title>
    <style>
        #stock{
            border-bottom: 10px solid #111d13;
        }
        table,tr,td{
        border: 1px solid black;
        margin:10px;
        }
        #central{
            overflow:auto;
            height:100vh;
        }
  


    </style>
</head>
<body>
    <div id="central">
        <h6>AVAILABLE MEDICINE</h6>
        <table>
                <tr>
                    <th>Medicine Name</th>
                    <th>Medicine Type</th>
                    <th>Medicine description</th>
                    <th>Available Amount</th>                        
                </tr>
                <?php   
                    $sqlmed = 'SELECT name,type,availableamt FROM medicine';
                    $sqltype = 'SELECT id,type,priority,description FROM medicinetype';

                    //make query and get result
                    $resultmed = mysqli_query($conn, $sqlmed);
                    $resulttype = mysqli_query($conn, $sqltype);

                    //fetch the resulting rows
                    $datamed = mysqli_fetch_all($resultmed,MYSQLI_ASSOC); // medicine data
                    $datatype = mysqli_fetch_all($resulttype,MYSQLI_ASSOC); //medicine tyoe data

                    foreach($datamed as $dat): ?>
                        <div>
                            <tr>
                                <td> <h6> <?php echo htmlspecialchars($dat['name']); ?> </h6> </td>
                                <td> <h6> <?php 
                                foreach($datatype as $dat2): 
                                    if($dat2['id'] == $dat['type'])
                                    {
                                        echo htmlspecialchars($dat2['type']);  
                                    } endforeach; ?> </h6> </td>
                                    <td> <h6> <?php
                                    foreach($datatype as $dat2): 
                                    if($dat2['id'] == $dat['type'])
                                    {
                                        echo htmlspecialchars($dat2['description']);  
                                    } endforeach; ?> </h6> </td>
                                <td id="lastno"> <h6> <?php echo htmlspecialchars($dat['availableamt']); ?> </h6> </td>
                            </tr> 
                        </div>
                <?php endforeach;
                mysqli_free_result($resultmed);
                mysqli_free_result($resulttype);
                 ?>
                </table>
        
    </div>
<!-- //end of content -->

</div>
</body>
</html>
