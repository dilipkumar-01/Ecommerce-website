<?php

$conn = new mysqli("localhost", "root", "", "ecommerce-website");

if ($conn->connect_error) {
    echo "connection failed, Aborting Execution";
    die;
}
