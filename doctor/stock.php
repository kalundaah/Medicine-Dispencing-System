<?php
include('data.php');
//establish connection to database
include('dbconnect.php');
include('doctoroverall.php');
$sqlmed = 'SELECT name,type,availableamt FROM medicine';
$sqltype = 'SELECT id,type FROM medicinetype';

//make query and get result
$resultmed = mysqli_query($conn, $sqlmed);
$resulttype = mysqli_query($conn, $sqltype);

//fetch the resulting rows
$datamed = mysqli_fetch_all($resultmed,MYSQLI_ASSOC); // medicine data
$datatype = mysqli_fetch_all($resulttype,MYSQLI_ASSOC); //medicine tyoe data
$medname = $error  = $tye = '' ;
$amt = 0;
if(isset($_POST['submit']))
{
    if(empty($_POST['mednam']))
    {
        $error = 'Please enter a medicine name';
    }
    else{
        $medname = $_POST['mednam'];
    }
    if(empty($errors)){
        $medname = mysqli_real_escape_string($conn,$_POST['mednam']);

        foreach($datamed as $dat2): 
            if($dat2['name'] == $medname)
            {
                $amt = $dat2['availableamt'] ;
                foreach($datatype as $dat3):
                    if($dat2['type']==$dat3['id'])
                    {
                        $tye = $dat3['type'];
                    }endforeach;
            } endforeach; 
    }
}
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
            border-bottom: 10px solid #e63946;
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
        <form action="stock.php" method="POST" style="display: flex; flex-direction: column; margin: 50px 20%;">
        <table>
            <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>name</th>
                    <th>type</th>
                    <th>amount available</th>
                    

            </tr>
            <div>
                <tr>
                    <td> <label for="med-name" style="margin:100px,0;">Medicine name: </label>  </td>
                    <td> <input type="text" name="mednam" style="margin:100px,0;width:350px;border:1px solid black; border-radius: 25px;padding: 20px;" value ="<?php echo htmlspecialchars($medname); ?>" >  </td>                             
                    <td> <div class="errormessage" style="color:red; margin:100px,0;"><?php echo($error);  ?></div> </td> 
                    <td style="border:1px solid black;"> <?php echo($medname) ?> </td>
                    <td style="border:1px solid black;"> <?php echo($tye) ?> </td>
                    <td style="border:1px solid black;"> <?php echo($amt) ?> </td>

                </tr>
            </div>
        </table>
        <button name="submit">Find</button>

    </form>
    <h2 style="font-size: large;">AVAILABLE MEDICINE</h2>
        <table>
                <tr>
                    <th>Medicine Name</th>
                    <th>Medicine Type</th>
                    <th>Available Amount</th>                        
                </tr>
                <?php   
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
                                <td id="lastno"> <h6> <?php
                                if(empty($dat['availableamt'])){
                                    echo htmlspecialchars('0');
                                }
                                else{
                                 echo htmlspecialchars($dat['availableamt']); } ?> </h6> </td>
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
