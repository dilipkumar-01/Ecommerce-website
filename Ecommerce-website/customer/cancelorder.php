<?php


include_once "../shared/customer-authguard.php";
include "../shared/connection.php";

if (isset($_GET['orderid'])) {
    $orderid = $_GET['orderid'];

    
    $checkQuery = "SELECT * FROM orders WHERE orderid = $orderid AND userid = $userid";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        
        $updateQuery = "UPDATE orders SET status = 'Cancelled' WHERE orderid = $orderid";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            
            echo "<script>alert('Order cancelled successfully.');</script>";
        } else {
            
            echo "<script>alert('Failed to cancel the order. Please try again later.');</script>";
        }
    } else {
        
        echo "<script>alert('Invalid order or unauthorized access.');</script>";
    }
} else {
    
    echo "<script>alert('Invalid request.');</script>";
}


header("Location: vieworders.php");
exit();
?>