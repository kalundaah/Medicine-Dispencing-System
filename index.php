<?php
//establish connection to database
include('dbconnect.php');
include('overall.php');
$errors = array('emal' => '','pass' => '');
$emai = $pass = '';
$message = '';

if(isset($_POST['submit'])){
    if(empty($_POST['email'])){
        $errors['emal'] = 'An email is required <br />';
    }
    else{
         $emai = $_POST['email'];
        if($emai == '0000')
        {
            //proceed
            if($_POST['password'] == 0000){
                header("location:director/index.php");
            }
        }
        elseif(!filter_var($emai,FILTER_VALIDATE_EMAIL)){
             $errors['emal'] = 'email must be a valid email adress';
        }
    }
    if(empty($_POST['password'])){
        $errors['pass'] = 'A password is required <br />';
    }
    else{
         $pass = $_POST['password'];
         
         $sql = 'SELECT firstname,lastname,email,password FROM patient';
         $sql2 = 'SELECT firstname,lastname,email,password FROM doctor';
         //make query and get result
         $result = mysqli_query($conn, $sql);
         $result2 = mysqli_query($conn, $sql2);
         //fetch the resulting rows
         $data = mysqli_fetch_all($result,MYSQLI_ASSOC); //patient
         $data2 = mysqli_fetch_all($result2,MYSQLI_ASSOC); //doctor

         //compare the emails and password inputs to the ones in the patient table
        foreach($data as $dat):
             if($emai == $dat['email']){
                 if($pass == $dat['password'])
                 {
                    $myfile = fopen("patient/data.txt", "w");
                    $emaildata = $dat['email'];
                    fwrite($myfile,$emaildata);
                    fclose($myfile);
                    $message='Login successfull';
                    sleep(1);
                    header("location:patient/home.php");
                 }
            }
         endforeach;

          //compare the emails and password inputs to the ones in the doctor table
        foreach($data2 as $dat2):
            if($emai == $dat2['email']){
                    if($pass == $dat2['password'])
                    {
                        $myfile = fopen("doctor/data.txt", "w");
                        $emaildata = $dat2['email'];
                        fwrite($myfile,$emaildata);
                        fclose($myfile);
                        $message='Login successfull';
                        header("location:doctor/home.php");
                    }
                } //doctor table
                
        endforeach;
        }
    $message = 'Incorrect info';    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <style>
        input{
            margin:100px,0;
            width:350px;
            border:1px solid black;
            border-radius: 25px;
            padding: 20px;
        }
        button {
            background-color: #e63946; /* Green */
            border: 1px hidden;
            border-radius: 25px;
            padding:20px;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
            transition: width 2s;
            margin:10px;
        }
        button:hover{
            background-color: #457b9d;
        }
    </style>
</head>
<body>
        <div id="central">
        <h3><?php echo htmlspecialchars($message); ?></h3>
        <h4>Login to your account</h4>
        <form action="index.php" method="POST" style="display: flex; flex-direction: column; margin: 50px 20%;">

            <label for="email" style="margin:20px,0;">Your email: </label>
            <input type="text" name="email" value ="<?php echo htmlspecialchars($emai); ?>" >
            <div class="errormessage" style="color:red; margin:20px,0;"><?php echo($errors['emal']);  ?></div>

            <label for="password" style="margin:20px,0;">Password: </label>
            <input type="password" name="password">
            <div class="errormessage" style="color:red; margin:20px,0;"><?php echo($errors['pass']);  ?></div>

            <button name="submit">submit</button>
        
        </form>
        </div>
    </div>
</body>
</html>
