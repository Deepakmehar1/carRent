<?php
// Database connection
    include 'sysconfig/mysql.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_car'])) {
        // Handle adding a new car
        $make = $_POST['make'];
        $model = $_POST['model'];
        $year = $_POST['year'];
        $rental_price = $_POST['rental_price'];

        $sql = "INSERT INTO cars (make, model, year, rental_price) VALUES ('$make', '$model', '$year', '$rental_price')";

        if ($conn->query($sql) === TRUE) {
            echo "New car added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['delete_car'])) {
        // Handle deleting a car
        $car_id = $_POST['car_id'];

        $sql = "DELETE FROM cars WHERE Car_ID = $car_id";

        if ($conn->query($sql) === TRUE) {
            echo "Car deleted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Retrieve and display existing cars
$sql = "SELECT * FROM cars";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Car ID</th><th>Make</th><th>Model</th><th>Year</th><th>Rental Price</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["Car_ID"]."</td>";
        echo "<td>".$row["Make"]."</td>";
        echo "<td>".$row["Model"]."</td>";
        echo "<td>".$row["Year"]."</td>";
        echo "<td>".$row["Rental_Price"]."</td>";
        echo "<td><form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                    <input type='hidden' name='car_id' value='".$row["Car_ID"]."'>
                    <input type='submit' name='delete_car' value='Delete'>
                </form></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No cars found.";
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Cars</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
    </header>
  
    <main>
        <section id="manage-cars">
            <h2>Manage Cars</h2>
            <?php include 'admin.php'; ?>
        </section>
        <!-- Other sections of the dashboard -->
    </main>
</body>
</html>
