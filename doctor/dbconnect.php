<?php 

//connect to database
$conn = mysqli_connect('localhost','neville','1234','mda');
$fname = $lname = '';
$patnos = 0;
//check the connection
if(!$conn){
    echo 'connection failed' . mysqli_connect_error();
}

$sql = 'SELECT id,firstname,lastname,staffid,email FROM doctor';

//make query and get result
$result = mysqli_query($conn, $sql);

//fetch the resulting rows
$data = mysqli_fetch_all($result,MYSQLI_ASSOC); //patient
foreach($data as $dat):
    if($email == $dat['email']){
        $fname = $dat['firstname'];
        $lname = $dat['lastname'];
        $staff = $dat['staffid'];
}
endforeach;
?>