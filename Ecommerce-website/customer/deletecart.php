<?php

$cartid=$_GET['cartid'];
include_once "../shared/connection.php";

$status=mysqli_query($conn,"delete from cart where cartid=$cartid");
if($status)
{
    echo "Item removed from cart successfully";
    header("location:viewcart.php");
}
else
{
    echo "Error inremoving the cart item!";
    echo mysqli_error($conn);

}


?>