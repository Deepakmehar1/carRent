<?php

if (!isset($_GET['user_id'])) {
    header("Location: manegeUsers.php");
    exit();
}

$user_id = $_GET['user_id'];
$restriction = $_GET['restriction'];

// Database connection
include 'sysconfig/mysql.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete car from database
if ($restriction == 6) {
    $sql = "UPDATE users SET restriction='yes' WHERE user_id=$user_id";

} elseif ($restriction == 12) {

    $sql = "UPDATE users SET restriction='no' WHERE user_id=$user_id";

}

// $sql = "UPDATE users SET restriction='yes' WHERE user_id=$user_id";

if ($conn->query($sql) === true) {
    echo "user resrcted successfully";
    header("Location: manegeUsers.php");
    exit();
} else {
    echo "Error restrict user: " . $conn->error;
}

$conn->close();
