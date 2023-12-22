


<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .card-text {
            overflow: hidden;
        }
        .pdt-img {
            width: 16rem;
            height: 15rem;
        }
        .hidden-details {
            display: none;
        }
    </style>
    <script>
        function toggleDetails(cardId) {
            var cardDetails = document.getElementById('details-' + cardId);
            var showMoreLink = document.getElementById('show-more-' + cardId);

            if (cardDetails.style.display === 'none') {
                cardDetails.style.display = 'block';
                showMoreLink.innerText = 'Show less';
            } else {
                cardDetails.style.display = 'none';
                showMoreLink.innerText = 'Show more';
            }
        }

        function confirmDelete(pid) {
            res = confirm("Are you sure you want to remove from cart?");
            if (res) {
                window.location = `deleteproduct.php?pid=${pid}`;
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

$total = 0;
$result = mysqli_query($conn, "SELECT * FROM cart JOIN product ON cart.pid = product.pid WHERE userid = $userid");
echo "<div class='d-flex flex-wrap'>";
while ($row = mysqli_fetch_assoc($result)) {
    $cartid = $row['cartid'];
    $pid = $row['pid'];
    $name = $row['name'];
    $price = $row['price'];
    $details = $row['details'];
    $imgpath = $row['imgpath'];

    $total = $total + $price;

    echo "<div class='card' style='width: 19rem;'>
            <img class='pdt-img' src='$imgpath' class='card-img-top' alt='...'>
            <div class='card-body'>
                <h5 class='card-title'>$name</h5>
                <h5 class='card-title text-success'>₹ $price</h5>
                
                <p class='card-text' id='details-$pid'>$details</p>
                <a href='javascript:void(0);' onclick='toggleDetails($pid)' id='show-more-$pid'>Show more</a>
                <a href='javascript:void(0);' onclick='deletecart.php?cartid=$cartid' class='btn btn-danger'>Remove from cart</a>
                
            </div>
        </div>";
}

echo "</div>";

echo "<div class='place-order gap-3 p-3 bg-dark w-23'>
        <div class='display-3 text-white'>₹$total</div>
   
        <form action='placeorder.php' method='POST'>
            <div class='text-white'>
                <label for='deliveryAddress'>Delivery Address:</label>
                <input type='text' class='form-control mt-2' id='deliveryAddress' name='deliveryAddress' required>
            </div>
                
            <div class='text-white'>
                <label for='contactNumber'>Contact Number:</label>
                <input type='text' class='form-control mt-2' id='contactNumber' name='contactNumber' required>
            </div><br>
           
            <a href='placeorder.php'>
                <button class='btn btn-warning w-100'>Place Order</button>
            </a>
        </form>
    </div>
</div>";
   
?>