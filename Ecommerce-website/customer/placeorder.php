<?php
include_once "../shared/customer-authguard.php";
include "menu.html";
include "../shared/connection.php";

$result = mysqli_query($conn, "SELECT * FROM cart JOIN product ON cart.pid = product.pid WHERE userid = $userid");
$total = 0;


while ($row = mysqli_fetch_assoc($result)) {
    $pid = $row['pid'];
    $name = $row['name'];
    $price = $row['price'];
    $details = $row['details'];
    $imgpath = $row['imgpath'];
    $uploaded_by = $row['uploaded_by'];
    $deliveryAddress = $_POST['deliveryAddress'];
    $contactNumber = $_POST['contactNumber'];

    
    $status = mysqli_query($conn, "INSERT INTO orders (userid, pid, name, price, details, imgpath, uploaded_by) VALUES ('$userid', '$pid', '$name', '$price', '$details', '$imgpath', '$uploaded_by')");

    if ($status) {
        
        $total += $price;

        
        mysqli_query($conn, "DELETE FROM cart WHERE cartid = {$row['cartid']}");
    }
}
        
if ($total > 0) {
    echo "<div class='text-center'>
        <h2>Order Successfull!👍</h2>
        <p>Thank you for your order. Your total amount is ₹$total.</p>
        <p><b>Product Tracking Information:</b></p>
            <ul>
                <li>Product Name: $name</li>
                <li>Product ID: $pid</li>
                <li>Delivery Address: $deliveryAddress</li>
                <li>Contact Number: $contactNumber</li>
            </ul>
    </div>";
} else {
    echo "<div class='text-center'>
        <h2>No items in the cart☹️</h2>
        <p>Your cart is empty. Please add items to your cart before placing an order.</p>
    </div>";
}

mysqli_close($conn);
?>