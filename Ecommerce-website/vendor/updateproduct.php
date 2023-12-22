
<?php

$pid = $_POST['pid'];
$name = $_POST['name'];
$price = $_POST['price'];
$details = isset($_POST['details']) ? $_POST['details'] : '';


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce-website";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "UPDATE product SET name = '$name', price = '$price', details = '$details' WHERE pid = $pid";

if ($conn->query($sql) === TRUE) {
    echo "Product updated successfully.";
} else {
    echo "Error updating product: " . $conn->error;
}


$conn->close();
?>