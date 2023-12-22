<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .card-text {
            height: 60px;
            overflow: hidden;
            position:relative;
        }
        .pdt-img {
            width: 16rem;
            height: 15rem;
        }

        .card-text .overlay{
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 40px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0), white);
        }
       
        .cancel-order {
            position: absolute;
            bottom: 0;
            right: 0;
            margin: 10px;
            
        }
    </style>
    <script>
        function toggleDetails(cardId) {
            var cardDetails = document.getElementById('details-' + cardId);
            var showMoreLink = document.getElementById('show-more-' + cardId);

            if (cardDetails.style.height === '' ||cardDetails.style.height === '60px') {
                cardDetails.style.height = 'auto';
                showMoreLink.innerText = 'Show less';
            } else {
                cardDetails.style.height = '60px';
                showMoreLink.innerText = 'Show more';
            }
        }
    </script>
</head>
<body>
</body>
</html>

<?php
include_once "../shared/customer-authguard.php";
include "menu.html";
include "../shared/connection.php";

$result = mysqli_query($conn, "SELECT * FROM orders JOIN product ON orders.pid = product.pid WHERE userid = $userid");

echo "<div class='d-flex flex-wrap'>";
while ($row = mysqli_fetch_assoc($result)) {
    $orderid = $row['orderid'];
    $pid = $row['pid'];
    $name = $row['name'];
    $price = $row['price'];
    $details = $row['details'];
    $imgpath = $row['imgpath'];

    echo "<div class='card' style='width: 19rem;'>
            <img class='pdt-img' src='$imgpath' class='card-img-top' alt='...'>
            <div class='card-body'>
                <h5 class='card-title'>$name</h5>
                <h5 class='card-title text-success'>₹ $price</h5>
                
                <div class='card-text' id='details-$orderid'>
                <p>$details</p>
                <div class='overlay'></div>
                </div>
                <a href='javascript:void(0);' onclick='toggleDetails($orderid)' id='show-more-$orderid' class='show-more-less'>Show more</a><br><br>
                
                <a href='cancelorder.php?orderid=$orderid' class='btn btn-danger cancel-order'>Cancel Order</a>
                
            </div>
        </div>";
}

echo "</div>";
?>