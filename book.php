<?php

include 'sysconfig/mysql.php';
session_start();

if (!isset($_COOKIE['user_data'])) {
    header("Location: /car_rent/login.php");
}
if (isset($_COOKIE['user_data'])) {
   $user_data = unserialize($_COOKIE['user_data']);
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_id = $user_data['user_id'];

$sql = "SELECT * FROM users WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User exists, proceed with rental insertion
    // Rest of your code


// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $car_id = $_GET['car_id'];
    $user_id = $user_data['user_id'];
    $start_timestamp = strtotime($start_date);
    $end_timestamp = strtotime($end_date);
    $rental_days = ceil(($end_timestamp - $start_timestamp) / (60 * 60 * 24));
    // $total_cost = $_POST['total_cost'];
    $sql = "SELECT rental_price FROM cars WHERE car_id = $car_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $car = $result->fetch_assoc();
    }
    $total_price = $rental_days * $car['rental_price'];
    // SQL query to insert rantels data into database
    // $sql = "INSERT INTO rentals (car_id, user_id, start_date, end_date, total_cost) VALUES ('$car_id',$user_id,'$start_date', '$end_date', '$total_price')";

$sql = "INSERT INTO rentals (car_id, user_id, start_date, end_date, total_cost) VALUES ('$car_id', $user_id, '$start_date', '$end_date', '$total_price')";

    if ($conn->query($sql) === true) {
        echo "Registration successful!";
        // Redirect to login page or any other page
        setCarAvailability($car_id, "unavailable", $end_date);
        header("Location: allCars.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
} else {
    // User does not exist
    echo "Error: The user does not exist.";
}
function setCarAvailability($car_id, $availability, $end_date)
{
    global $conn; // Assuming $conn is your database connection object

    $sql = "UPDATE cars SET availability = '$availability', lastOfBook = '$end_date' WHERE car_id = $car_id";
    if ($conn->query($sql) === true) {
        return true; // Car availability updated successfully
    } else {
        return false; // Error updating car availability
    }
}
$conn->close();
