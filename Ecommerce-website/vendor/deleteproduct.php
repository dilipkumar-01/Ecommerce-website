<?php

$pid=$_GET['pid'];

//echo "Received id=$pid";

include_once "../shared/connection.php";

$status=mysqli_query($conn,"delete from product where pid=$pid");
if($status)
{
    echo "Product Deleted Successfully!";
    header("location:view.php");
}
else
{
    echo "Delete Failed";
    echo mysqli_error($conn);
}
?>