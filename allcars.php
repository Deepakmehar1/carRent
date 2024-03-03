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
    <title>Ghosts Cars</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="car.css">
</head>
<body>
    <?php include('nav.php'); ?>
    <main class="allcars">
        <h2>cars</h2>
        <div class="car_container">
            <?php foreach ($cars as $car): ?>
            <div class="car">
                <a href="http://localhost/car_rent/car.php?car_id=<?php echo $car['car_id'];?>" class="car_img"><img src="<?php echo $car['car_img'];?>" alt=""></a>
                <div class="other_deta">
                    <div class="short_deta">
                        <div><?php echo $car['make']; ?></div>
                        <div><?php echo $car['model']; ?></div>
                        <div><?php echo $car['rental_price']; ?></div>
                    </div>
                    <div class="car_links">
                        <a href="http://localhost/car_rent/booking.php?car_id=<?php echo $car['car_id'];?>" class="b_now">Book Now</a>
                        <a href="http://localhost/car_rent/car.php?car_id=<?php echo $car['car_id'];?>"style="color: #247e7e;">see details-></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            
        </div>
    </main>
    <?php include('footer.php'); ?>
<script src="script.js"></script>

</body>
</html>
