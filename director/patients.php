<?php
include('index.php');
require('dbconnect.php');
$patid = 0;
$pemail = $eemail = $first = $last = $phone = $dob = $confirm = $det = '';
$errors = array('email' => '', 'fname' => '', 'lname' => '', 'dob' => '', 'phonenos' => '', 'newemail' => '');

if (isset($_POST['submit'])) {
    if (empty($_POST['patemail'])) {
        $errors['email'] = "ENTER AN EMAIL ADDRESS";
    } else {
        $eemail = $_POST['patemail'];
        if (!filter_var($eemail, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'email must be a valid email adress';
        }
    }
    if (array_filter($errors)) {
    } else {
        $sqlpat = 'SELECT id,firstname,lastname,dob,email,phonenos FROM patient';
        //make query and get result
        $resultpat = mysqli_query($conn, $sqlpat);
        //fetch the resulting rows
        $datapat = mysqli_fetch_all($resultpat, MYSQLI_ASSOC);
        foreach ($datapat as $datpat) :
            if ($eemail == $datpat['email']) {
                $patid = $datpat['id'];
                $first = $datpat['firstname'];
                $last = $datpat['lastname'];
                $dob = $datpat['dob'];
                $phone = $datpat['phonenos'];
            }
        endforeach;
        if ($patid != 0) {
            $det = "Patient details found";
        } else {
            $det = "Patient details not found";
        }
    }
}
if (isset($_POST['update'])) {
    $patid = $_POST['patid'];

    if (empty($_POST['patefname'])) {
        $errors['fname'] = "ENTER A FIRST NAME";
    } else {
        $first = $_POST['patefname'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $first)) {
            $error['fname'] = 'first name must be letters';
        }
    }
    if (empty($_POST['patelname'])) {
        $errors['lname'] = "ENTER A LAST NAME";
    } else {
        $last = $_POST['patelname'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $last)) {
            $error['lname'] = 'last name must be letters and spaces only';
        }
    }
    if (empty($_POST['patdob'])) {
        $errors['dob'] = "ENTER A DATE OF BIRTH";
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
        $sqlupd = "UPDATE patient SET firstname = '$first', lastname = '$last', dob = '$dob', phonenos = '$phone', email = '$pemail' WHERE id =" . $patid;
        
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
        #allocate {
            border-bottom: 10px solid #111d13;
        }
    </style>

</head>

<body>
    <div id="emailrequest">
        <h3><?php echo htmlspecialchars($det); ?></h3>
        <h4> Enter patient email</h4>

        <form action="patients.php" method="POST" style="display: flex; flex-direction: column; margin: 50px 20%;">

            <label for="patient email" style="margin:20px,0;">Patient email: </label>
            <input class="fix" type="text" name="patemail" value="<?php echo htmlspecialchars($eemail); ?>">
            <div class="errormessage" style="color:red; margin:20px,0;"><?php echo ($errors['email']); ?></div>

            <button style="margin:10px;" name="submit">submit</button>
        </form>
    </div>
    
    <form action="patients.php" method="POST" style="margin-left:20%;">
        <input type="hidden" name="patid" value="<?php echo htmlspecialchars($patid); ?>">
        <h3> <?php echo htmlspecialchars($confirm); ?> </h3>
        <table>
        <h2> Patient Details</h2>
            <tr>
                <th></th>
                <th></th>
                
            </tr>
            <div>
                <tr>
                    <td>
                        <label for="Updating patient details" style="margin:20px,0;">First name </label>
                    </td>
                    <td>
                        <input class="fix" type="text" name="patefname" value="<?php echo htmlspecialchars($first); ?>">
                        <div class="errormessage" style="color:red; margin:20px,0;"><?php echo ($errors['fname']); ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="Updating patient details" style="margin:20px,0;">Last name </label>
                    </td>
                    <td>
                        <input class="fix" type="text" name="patelname" value="<?php echo htmlspecialchars($last); ?>">
                        <div class="errormessage" style="color:red; margin:20px,0;"><?php echo ($errors['lname']); ?></div>
                    </td>

                </tr>
                <tr>
                    <td>
                        <label for="Updating patient details" style="margin:20px,0;">Date of Birth </label>
                    </td>
                    <td>
                        <input class="fix" type="text" name="patdob" value="<?php echo htmlspecialchars($dob); ?>">
                        <div class="errormessage" style="color:red; margin:20px,0;"><?php echo ($errors['dob']); ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="Updating patient details" style="margin:20px,0;">Phone Number </label>
                    </td>
                    <td>
                        <input class="fix" type="text" name="patphone" value="<?php echo htmlspecialchars($phone); ?>">
                        <div class="errormessage" style="color:red; margin:20px,0;"><?php echo ($errors['phonenos']); ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="Updating patient details" style="margin:20px,0;">New Email </label>
                    </td>
                    <td>
                        <input class="fix" type="text" name="patnewemail" value="<?php echo htmlspecialchars($eemail); ?>">
                        <div class="errormessage" style="color:red; margin:20px,0;"><?php echo ($errors['newemail']); ?></div>
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