<?php

$host = "localhost";
$user = "root";
$password = "55829536";
$db = "logmaster";

$conn = new mysqli($host, $user, $password, $db);

if($conn -> connect_error){
    echo "There is an error: $conn->error";
}