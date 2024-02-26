<?php

// Database connection
include 'sysconfig/mysql.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT rentals.car_id, cars.model, cars.make, cars.rental_price, COUNT(*) AS total_occurrences 
FROM rentals 
INNER JOIN cars ON rentals.car_id = cars.car_id 
GROUP BY rentals.car_id, cars.model, cars.make, cars.rental_price
ORDER BY total_occurrences DESC 
LIMIT 7;

";
$rentalsResult = $conn->query($sql);

$rentals = [];
if ($rentalsResult->num_rows > 0) {
    while ($row2 = $rentalsResult->fetch_assoc()) {
        $rentals[] = $row2;
    }
}

$sql = "SELECT * FROM `cars` ORDER BY rental_price DESC LIMIT 7;";
$topcarsResult = $conn->query($sql);

$topcars = [];
if ($topcarsResult->num_rows > 0) {
    while ($tcar4 = $topcarsResult->fetch_assoc()) {
        $topcars[] = $tcar4;
    }
}
$conn->close();
