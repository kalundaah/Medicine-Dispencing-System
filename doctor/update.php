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
$pemail= $first = $last = $phone = $dob ='';
$errors =array('email'=>'','na'=>'');
if(isset($_POST['submit']))
{
    if(empty($_POST['patemail']))
    {
        $errors['email']="ENTER AN EMAIL ADDRESS";
    }
    else{
        $pemail = $_POST['patemail'];
        if(!filter_var($pemail,FILTER_VALIDATE_EMAIL)){
            $error['email'] = 'email must be a valid email adress';
        }
    }
    if(array_filter($errors)){

    }
    else{
        $sqlpat = 'SELECT id,firstname,lastname,dob,email,phonenos FROM patient';
        //make query and get result
        $resultpat = mysqli_query($conn, $sqlpat);
        //fetch the resulting rows
        $datapat = mysqli_fetch_all($resultpat,MYSQLI_ASSOC);
        foreach($datapat as $datpat):
            if($pemail == $datpat['email'])
            {
                $first = $datpat['firstname'];
                $last = $datpat['lastname'];
                $dob = $datpat['dob'];
                $phone = $datpat['phonenos'];
                
            }
        endforeach;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        #update{
            border-bottom: 10px solid #e63946;
        }
        th,td{
            border: 1px solid black;

        }
        table{
            margin-top: 100px;
        }
        #updat{
            background-color: #e63946;
        }
    </style>
</head>
<body>
    <div id="central">
        <h7> Create/Find a patient's details.</h7>
        <div id="all">
                <a href="create.php" style="text-decoration: none; color:white;"><div class="allmenu" id="create">Create Patient</div></a>
                <a href="update.php" style="text-decoration: none; color:white;"><div class="allmenu" id="updat">Find User</div></a>
        </div>

        <form action="update.php" method="POST" style="display: flex; flex-direction: column; margin: 50px 20%;">

        <label for="patient email" style="margin:20px,0;">Patient email: </label>
        <input type="text" name="patemail" value ="<?php echo htmlspecialchars($pemail); ?>">
        <div class="errormessage" style="color:red; margin:20px,0;"><?php echo($errors['email']); ?></div>

        <button style="margin:10px;" name="submit" >submit</button>
        
        <table>
                    
            <tr>
                <th>First Name</th>
                <th>Last name</th>
                <th>Date of Birth</th>
                <th>email</th>
                <th>Phone Number</th>
            </tr>
            <div>
                <tr>
                    <td> <h2> <?php echo htmlspecialchars($first); ?> </h2></td> 
                    <td> <h2> <?php echo htmlspecialchars($last); ?> </h2> </td>  
                    <td> <h2> <?php echo htmlspecialchars($dob); ?> </h2> </td>
                    <td> <h2> <?php echo htmlspecialchars($pemail); ?> </h2> </td>
                    <td> <h2> <?php echo htmlspecialchars($phone); ?> </h2> </td>  
                </tr>
            </div> 
        </table> 
    </div>
<!-- //end of content -->
</div>
</body>
</html>
