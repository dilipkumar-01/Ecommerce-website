<?php

include "menu.html";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce-website";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM orders";
$result = $conn->query($sql);


if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo "orderid: " . $row["orderid"] . "<br>";
        echo "userid: " . $row["userid"] . "<br>";
        echo "pid: " . $row["pid"] . "<br>";
        echo "name: " . $row["name"] . "<br>";
        echo "price: " . $row["price"] . "<br>";
        echo "details: " . $row["details"] . "<br>";
        echo "uploaded_by: " . $row["uploaded_by"] . "<br>";
        echo "created_date: " . $row["created_date"] . "<br>";
        echo "imgpath: " . $row["imgpath"] . "<br>";
        echo "<hr>";
    }
} else {
    echo "No orders found.";
}


$conn->close();
