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
</head>
<body>
    <?php include('nav.php'); ?>
    <main class="allcars">
        <style>
            main.allcars {
                margin-bottom: 16px;
            }
            .car_container {
                display: flex;
                justify-content: space-evenly;
                align-items: center;
                gap: 32px;
                flex-wrap: wrap;
            }.car {
                text-decoration:none;
                width: 300px;
                height: 200px;
                background-color: #181818;
                color: white;
                position: relative;
                border-radius: 8px;
                display: flex;
                    justify-content: space-around;
    flex-direction: column;
    padding: 8px;
            }
            .car .car_img { text-align: center;
background: #363636;
display: flex;align-items: center;justify-content: center;
}
            .car img {
    height: 104px;
    width: fit-content;
    
}.other_deta {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    padding: 4px;
}.car_links {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 8px;
}a.b_now {
    text-decoration: none;
    border: 1px solid white;
    border-radius: 4px;
    padding: 2px;
    color: antiquewhite;
}
            

        </style>   

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
            <?php foreach ($cars as $car): ?>
            <div class="car">
                <a href="http://localhost/car_rent/car.php?car_id=<?php echo $car['car_id'];?>" class="car_img"><img src="./img/car2.png" alt=""></a>
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
            <?php endforeach; ?><?php foreach ($cars as $car): ?>
            <div class="car">
                <a href="http://localhost/car_rent/car.php?car_id=<?php echo $car['car_id'];?>" class="car_img"><img src="./img/car2.png" alt=""></a>
                <div class="other_deta">
                    <div class="short_deta">
                        <div><?php echo $car['make']; ?></div>
                        <div><?php echo $car['model']; ?></div>
                        <div><?php echo $car['rental_price']; ?></div>
                    </div>
                    <div class="car_links">
                        <a href="http://localhost/car_rent/booking.php?car_id=<?php echo $car['car_id'];?>" class="b_now">Book Now</a>
                        <a href="http://localhost/car_rent/car.php?car_id=<?php echo $car['car_id'];?>" style="color: #247e7e;">see details-></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
    <?php include('footer.php'); ?>
</body>
</html>
