<?php
// Database connection
    include '../sysconfig/mysql.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch the top 4 cars for rent
$sql = "SELECT c.Make, c.Model, c.Year, c.Rental_Price, COUNT(r.Car_ID) AS rental_count
        FROM cars c
        LEFT JOIN rentals r ON c.Car_ID = r.Car_ID
        GROUP BY c.Car_ID
        ORDER BY rental_count DESC
        LIMIT 4";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Make: " . $row["Make"]. " - Model: " . $row["Model"]. " - Year: " . $row["Year"]. " - Rental Price: $" . $row["Rental_Price"]. " - Rental Count: " . $row["rental_count"]. "<br>";
    }
} else {
    echo "No cars found for rent.";
}

$conn->close();
?>
