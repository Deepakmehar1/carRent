<?php
// Database connection
    include 'sysconfig/mysql.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cars from database
$sql = "SELECT * FROM cars";
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
    <h2>Manage Cars</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>Rental Price</th>
            <th>Action</th>
        </tr>
        <?php foreach ($cars as $car): ?>
        <tr>
            <td><?php echo $car['car_id']; ?></td>
            <td><?php echo $car['make']; ?></td>
            <td><?php echo $car['model']; ?></td>
            <td><?php echo $car['year']; ?></td>
            <td><?php echo $car['rental_price']; ?></td>
            <td>
                <a href="edit_car.php?car_id=<?php echo $car['car_id']; ?>">Edit</a>
                <a href="delete_car.php?car_id=<?php echo $car['car_id']; ?>" onclick="return confirm('Are you sure you want to delete this car?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <form action="save_car.php" method="post">
        <label for="make">Make:</label><br>
        <input type="text" id="make" name="make" required><br><br>
        <label for="model">Model:</label><br>
        <input type="text" id="model" name="model" required><br><br>
        <label for="year">Year:</label><br>
        <input type="number" id="year" name="year" required><br><br>
        <label for="rental_price">Rental Price:</label><br>
        <input type="number" id="rental_price" name="rental_price" step="0.01" required><br><br>
        <input type="submit" value="Add Car">
    </form>
</body>
</html>
