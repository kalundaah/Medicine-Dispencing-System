<?php
$myfile = fopen("data.txt", "r") or die("LOG INTO YOUR ACCOUNT");
$email = '';
$email = fgets($myfile);
fclose($myfile);


?>