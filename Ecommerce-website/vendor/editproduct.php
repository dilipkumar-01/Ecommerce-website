<?php

include_once "../shared/vendor-authguard.php";
include "menu.html";
$pid = $_GET['pid'];



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce-website";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM product WHERE pid = $pid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $name = $row["name"];
    $price = $row["price"];
    $details = $row["details"];
?>


    <form method="post" action="updateproduct.php">
        <input type="hidden" name="pid" value="<?php echo $pid; ?>">
        <label for="name">Name: </label>
        <input type="text" name="name" value="<?php echo $name; ?>"><br>
        <label for="price">Price: </label>
        <input type="number" name="price" value="<?php echo $price; ?>"><br>
        <label for="details">Details: </label>
        <textarea name="details"><?php echo $details; ?></textarea><br>
        <input type="submit" value="Update">
    </form>

<?php
} else {
    echo "Product not found.";
}


$conn->close();
?>