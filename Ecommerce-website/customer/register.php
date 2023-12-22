<?php

echo "Data in POST=";
print_r($_POST);

$uname=$_POST["username"];
$upass=$_POST['pass1'];

$cipher_text=md5($upass);

include_once "../shared/connection.php";

$status=mysqli_query($conn,"insert into user(username,password,usertype) values('$uname','$cipher_text','customer')");
if($status)
{
    echo "Registration success";
}
else
{
    echo "Registration failed<br>";
    echo mysqli_error($conn);
}

?>