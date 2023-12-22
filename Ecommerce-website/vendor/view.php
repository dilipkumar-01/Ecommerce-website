<?php
include_once "../shared/vendor-authguard.php";
include "menu.html";

$userid = $_SESSION['userid'];
include_once "../shared/connection.php";

$result = mysqli_query($conn, "SELECT * FROM product WHERE uploaded_by=$userid");
echo "<div class='d-flex flex-wrap'>";

while ($row = mysqli_fetch_assoc($result)) {
    $pid = $row['pid'];
    $name = $row['name'];
    $price = $row['price'];
    $details = $row['details'];
    $imgpath = $row['imgpath'];

    echo "<div class='card' style='width:18rem;'>
            <img class='pdt-img' src='$imgpath' class='card-img-top' alt='...'>
            <div class='card-body'>
                <h5 class='card-title'>$name</h5>
                <h5 class='card-title text-success'>₹ $price</h5>";
                
    
    $maxLength = 20;
    if (strlen($details) > $maxLength) {
        $trimmedDetails = substr($details, 0, $maxLength) . "...";
        echo "<p class='card-text'>$trimmedDetails <a href='#' onclick='showMore($pid)'>Show More</a></p>";
        echo "<p class='card-text' id='details-$pid' style='display: none;'>$details <a href='#' onclick='showLess($pid)'>Show Less</a></p>";
    } else {
        echo "<p class='card-text'>$details</p><br>";
        
    }
    
    
    echo "<div id='buttons-$pid' class='card-buttons'>
            <a onclick='confirmDelete($pid)' class='btn btn-danger'>Delete</a>
            <a href='editproduct.php?pid=$pid' class='btn btn-danger'>Edit</a>
        </div>";
    
    echo "</div></div>";
}

echo "</div>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .card-text
        {
            height:40px;
        }
        .pdt-img
        {
            width:16rem;
            height:15rem;
        }
        
    </style>
</head>
<body>
<script>
    function showMore(pid) {
        document.getElementById("details-" + pid).style.display = "block";
        document.getElementById("buttons-" + pid).style.marginTop = "10px"; // Adjust the margin as needed
    }
    
    function showLess(pid) {
        document.getElementById("details-" + pid).style.display = "none";
        document.getElementById("buttons-" + pid).style.marginTop = "0";
    }
    
    function confirmDelete(pid) {
        res = confirm("Are you sure you want to delete?");
        if (res) {
            window.location = `deleteproduct.php?pid=${pid}`;
        }
    }
</script>
</body>
</html>