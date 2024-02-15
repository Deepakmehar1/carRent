<?php
    $servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// create database
$sql = "CREATE DATABASE car_rental_system";

if ($conn->query($sql) === TRUE) {
  echo "database created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

?>