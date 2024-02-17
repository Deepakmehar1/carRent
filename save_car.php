<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
       include 'sysconfig/mysql.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $rental_price = $_POST['rental_price'];

    // Insert car into database
    $sql = "INSERT INTO cars (make, model, year, rental_price) VALUES ('$make', '$model', '$year', '$rental_price')";

    if ($conn->query($sql) === TRUE) {
        echo "New car added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
