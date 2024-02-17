<?php
if (!isset($_GET['car_id'])) {
    header("Location: manegeCars.php");
    exit();
}

$car_id = $_GET['car_id'];

// Database connection
    include 'sysconfig/mysql.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete car from database
$sql = "DELETE FROM cars WHERE car_id = $car_id";

if ($conn->query($sql) === TRUE) {
    echo "Car deleted successfully";
    header("Location: manegeCars.php");
        exit();
} else {
    echo "Error deleting car: " . $conn->error;
}

$conn->close();
?>
