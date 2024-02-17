<?php
// Database connection
    include 'sysconfig/mysql.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cars from database
$sql = "SELECT car_id,make,model,rental_price FROM cars";
$result = $conn->query($sql);

$cars = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cars[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars</title>
</head>
<body>
    <h2>cars</h2>
    <div class="car_container">
    <?php foreach ($cars as $car): ?>
        <a href="car.php?car_id=<?php echo $car['car_id']; ?>">
            <div><?php echo $car['make']; ?></div>
            <div><?php echo $car['model']; ?></div>
            <div><?php echo $car['rental_price']; ?></div>
        </a>
    <?php endforeach; ?></div>
    

    
</body>
</html>
