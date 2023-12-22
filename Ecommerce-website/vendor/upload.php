<?php

include "../shared/vendor-authguard.php";

$userid=$_SESSION['userid'];

//echo "FILE Received Data=";
//print_r($_FILES);

//echo "<br>POST Received Data=";
//print_r($_POST);

$file_name=$_FILES['pdtimg']['name'];
$file_path="../shared/images/".$file_name;

move_uploaded_file($_FILES['pdtimg']['tmp_name'],$file_path);

$name=$_POST['name'];
$price=$_POST['price'];
$details=$_POST['details'];

include_once "../shared/connection.php";

$status=mysqli_query($conn,"insert into product(name,price,details,imgpath,uploaded_by) values('$name','$price','$details','$file_path','$userid')");
if($status)
{
    echo "Product Uploaded Successfully";
    header("location:view.php");
}
else
{
    echo "Failed to Upload Product!<br>";
    echo mysqli_error($conn);
}

?>