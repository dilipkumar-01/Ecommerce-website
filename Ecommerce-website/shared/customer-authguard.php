<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .auth-parent
        {
            display:flex;
            justify-content:space-around;
        }
    </style>
</head>
<body>
    
</body>
</html>

<?php

session_start();
if(!isset($_SESSION['login_status']))
{
    echo "Illegal attempt";
    die;
}
if($_SESSION['login_status']==false)
{
    echo "Login failed; unauthorised attempt";
    die;
}
if($_SESSION['usertype']!='customer')
{
    echo "unauthorised USER TYPE";
    die;
}
$userid=$_SESSION['userid'];
$username=$_SESSION['username'];
$usertype=$_SESSION['usertype'];
echo "<div class='auth-parent'>
    <div>$userid</div>
    <div>$username</div>
    <div>$usertype</div>
</div>";

?>