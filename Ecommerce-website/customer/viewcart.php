


<?php

include_once "../shared/customer-authguard.php";
include "menu.html";

include "../shared/connection.php";

if (isset($_GET['cartid'])) {
    $cartid = $_GET['cartid'];
    $deleteQuery = "DELETE FROM cart WHERE cartid = $cartid";
    mysqli_query($conn, $deleteQuery);
}

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

    echo "<div class='card' style='width:19rem;'>
            <img class='pdt-img' src='$imgpath' class='card-img-top' alt='...'>
            <div class='card-body'>
                <h5 class='card-title'>$name</h5>
                <h5 class='card-title text-success'>₹ $price</h5>
                
                <p class='card-text' id='details-$pid'>";
    
    // Add a condition to show a limited number of characters initially
    $shortDetails = substr($details, 0, 100);
    echo $shortDetails;
    
    // Add a hidden span element with full details for toggling
    echo "<span class='full-details' style='display: none;'>$details</span>";
    
    echo "</p>";
    
    // Add Show More/Less link
    echo "<a href='#' class='show-more-link' onclick='toggleDetails($pid)'>Show More</a><br>";
    
    echo "<button class='btn btn-danger' onclick='confirmDelete($cartid)'>Remove from cart</button>
                
            </div>
    
        </div>";
}

echo "</div>";

echo  "<div class='place-order gap-3 p-3 bg-dark w-23'>
        <div class='display-3 text-white'>₹$total</div>
   
           <form action='placeorder.php' method='POST'>
               
                <div class='text-white'>
               <label for='deliveryAddress'>Delivery Address:</label>
               <input type='text' class='form-control' id='deliveryAddress' name='deliveryAddress' required>
               </div>
                
               <div class='text-white'>
               <label for='contactNumber'>Contact Number:</label>
               <input type='text' class='form-control' id='contactNumber' name='contactNumber' required>
                </div>
           
               <button class='btn btn-warning w-100' type='submit'>Place Order</button>
            </form>
        </div>
    </div>";

?>

<script>
    function confirmDelete(cartid) {
        var res = confirm("Are you sure you want to remove from cart?");
        if (res) {
            window.location = `deletecart.php?cartid=${cartid}`;
        }
    }

    function toggleDetails(pid) {
        var detailsElement = document.getElementById('details-' + pid);
        var fullDetailsElement = detailsElement.getElementsByClassName('full-details')[0];
        var showMoreLink = detailsElement.getElementsByClassName('show-more-link')[0];
        
        if (detailsElement.classList.contains('show-full')) {
            detailsElement.classList.remove('show-full');
            fullDetailsElement.style.display = 'none';
            showMoreLink.textContent = 'Show More';
        } else {
            detailsElement.classList.add('show-full');
            fullDetailsElement.style.display = 'block';
            showMoreLink.textContent = 'Show Less';
        }
    }
</script>