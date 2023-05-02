<?php
include('index.php');
require('dbconnect.php');
$medid = 0;
$cost = 0;
$availableamt = 0;
$typeid = 0;
$type = $name = $confirm = $det = '';
$errors = array('medicinename' => '','');

if (isset($_POST['submit'])) {
    if (empty($_POST['medname'])) {
        $errors['medicinename'] = "ENTER THE MEDICINE NAME";
    } else {
        $name = $_POST['medname'];
    }
    if (array_filter($errors)) {
    } else {
        $sqlmed = 'SELECT id,name,type,cost,availableamt FROM patient';
        $sqltyp = 'SELECT id,type FROM medicinetype';
        //make query and get result
        $resultmed = mysqli_query($conn, $sqlmed);
        $resulttyp = mysqli_query($conn, $sqltyp);
        //fetch the resulting rows
        $datamed = mysqli_fetch_all($resultmed, MYSQLI_ASSOC);
        $datatyp = mysqli_fetch_all($resulttyp, MYSQLI_ASSOC);
        foreach ($datamed as $datmed) :
            if ($name == $datmed['name']) {
                $medid = $datmed['id'];
                foreach ($datatyp as $dataty) :
                    if ($datmed['type'] == $dataty['id'])
                        $typeid = $dataty['id'];
                        $type = $dataty['type'];
                endforeach;
                $cost = $datmed['cost'];
                $availableamt = $datmed['availableamt'];
            }
        endforeach;
        if ($medid != 0) {
            $det = "Medicine details found";
        } else {
            $det = "Medicine details not found";
        }
    }
}
if (isset($_POST['update'])) {
    $medid = $_POST['medid'];

    if (empty($_POST['medname'])) {
        $errors['medicinename'] = "ENTER A VALID MEDICINE NAME";
    } else {
        $name = $_POST['medname'];
    }
    if (empty($_POST['medtype'])) {
        $errors['medicinetype'] = "ENTER A VALID";
    } else {
        $type = $_POST['medtype'];
    }
    if (empty($_POST['cost'])) {
        $errors['money'] = "ENTER A DATE OF BIRTH";
    } else {
        $dob = $_POST['patdob'];
        if (!preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/', $dob)) {
            $error['dob'] = 'date of birth must be in the format yyyy-mm-dd';
        }
    }
    if (empty($_POST['patphone'])) {
        $errors['phonenos'] = "ENTER A PHONE NUMBER";
    } else {
        $phone = $_POST['patphone'];
    }
    if (empty($_POST['patnewemail'])) {
        $errors['newemail'] = "ENTER AN EMAIL ADDRESS";
    } else {
        $pemail = $_POST['patnewemail'];
        if (!filter_var($pemail, FILTER_VALIDATE_EMAIL)) {
            $error['newemail'] = 'email must be a valid email adress';
        }
    }
    if (array_filter($errors)) {
    } else {
        $sqlupd = "UPDATE patient SET firstname = '$first', lastname = '$last', dob = '$dob', phonenos = '$phone', email = '$pemail' WHERE id =" . $medid;
        echo $sqlupd;
        // "UPDATE `patient` SET `firstname` = 'rua', `lastname` = 'dak', `dob` = '2003-01-01' , `phonenos` = 0713572468, `email` = 'rudak@example.com' WHERE `patient`.`id` = 3";

        if (mysqli_query($conn, $sqlupd)) {
            //success
            //header('Location:patients.php');
            $confirm = "Patient details updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        #update{
            border-bottom: 10px solid #111d13;
        }
    </style>
</head>
<body>
<div id="emailrequest">
        <h3><?php echo htmlspecialchars($det); ?></h3>
        <h4> Enter medicine name</h4>

        <form action="patients.php" method="POST" style="display: flex; flex-direction: column; margin: 50px 20%;">

            <label for="patient email" style="margin:20px,0;">Patient email: </label>
            <input class="fix" type="text" name="medname" value="<?php echo htmlspecialchars($eemail); ?>">
            <div class="errormessage" style="color:red; margin:20px,0;"><?php echo ($errors['email']); ?></div>

            <button style="margin:10px;" name="submit">submit</button>
        </form>
    </div>
    
    <form action="patients.php" method="POST" style="margin-left:20%;">
        <input type="hidden" name="medid" value="<?php echo htmlspecialchars($medid); ?>">
        <h3> <?php echo htmlspecialchars($confirm); ?> </h3>
        <table>
        <h2> Medicine Details</h2>
            <tr>
                <th></th>
                <th></th>
                
            </tr>
            <div>
                <tr>
                    <td>
                        <label for="Updating medicine details" style="margin:20px,0;">Medicine name </label>
                    </td>
                    <td>
                        <input class="fix" type="text" name="medname" value="<?php echo htmlspecialchars($name); ?>">
                        <div class="errormessage" style="color:red; margin:20px,0;"><?php echo ($errors['medicinename']); ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="Updating medicine details" style="margin:20px,0;">Medicine type </label>
                    </td>
                    <td>
                        <input class="fix" type="number" name="medtype" value="<?php echo htmlspecialchars($type); ?>">
                        <div class="errormessage" style="color:red; margin:20px,0;"><?php echo ($errors['medicinetype']); ?></div>
                    </td>

                </tr>
                <tr>
                    <td>
                        <label for="Updating medicine details" style="margin:20px,0;">Cost </label>
                    </td>
                    <td>
                        <input class="fix" type="number" name="cost" value="<?php echo htmlspecialchars($cost); ?>">
                        <div class="errormessage" style="color:red; margin:20px,0;"><?php echo ($errors['cost']); ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="Updating medicine details" style="margin:20px,0;">Available amount </label>
                    </td>
                    <td>
                        <input class="fix" type="number" name="availamt" value="<?php echo htmlspecialchars($availableamt); ?>">
                        <div class="errormessage" style="color:red; margin:20px,0;"><?php echo ($errors['amt']); ?></div>
                    </td>
                </tr>
            </div>
        </table>

        <button style="margin:10px;" name="update">update</button>
    </form>
              


        <!-- //end of content -->
        </div>




</body>

</html>