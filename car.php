<?php
// Database connection
    include 'sysconfig/mysql.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID parameter is set
if (!isset($_GET['car_id'])) {
    header("Location: allcars.php");
    exit();
}

// Get the ID of the car to be display
$car_id = $_GET['car_id'];

// Fetch car details from the database
$sql = "SELECT * FROM cars WHERE car_id = $car_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $car = $result->fetch_assoc();
} else {
    // If no car found with the given car_id, redirect to manage_cars.php
    header("Location: allcars.php");
    exit();
}



$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
</head>
<body>
    <h2><?php echo $car['make']; ?></h2>
    <div><?php echo $car['model']; ?></div>
    <div><?php echo $car['rental_price']; ?></div>
    <div><?php echo $car['year']; ?></div>
    <a href="booking.php?car_id=<?php echo $car['car_id']; ?>">book</a>

</body>
</html>
