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
include('trand.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Car</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="car.css" />

  </head>
  <body>
    <?php include('nav.php');?>

    <div class="car_main">
      <div class="car_left">
        <div class="car_img">
        <img src="<?php echo $car['car_img']; ?>" alt="" /></div>
        <div class="details">
          <div class="cdeta">
            <span>make</span>
            <h2><?php echo $car['make']; ?></h2>
          </div>
          <div class="cdeta" style="position: absolute;
    top: 0;
    left: 200px;">
              <span>model</span>
            <h2>
              <?php echo $car['model']; ?>
            </h2>
          </div>
          <div class="cdeta" style="position: absolute; top: 0; 
right: 0; margin-right: 8px;">
            <span>Price</span>
            <h2 style="margin-right:0;"><?php echo $car['rental_price']; ?>$/day</h2>
          </div>
          <div class="cdeta">
            <span>year</span>
            <h2>
              <?php echo $car['year']; ?>
            </h2>
          </div>
          <a
            class="book"
            href="booking.php?car_id=<?php echo $car['car_id']; ?>"
            >book</a
          >
        </div>
      </div>
      <div class="car_right">
   
    <h2>Recomend Cars</h2>
    <!-- Add slider for most rented cars here -->
    <div class="high_rate_container">
        <?php foreach ($topcars as $topcar): ?>
            <a href=<?php echo "/car_rent/car.php?car_id=" . $topcar['car_id'];?> class="hrcar">
                <img src="<?php echo $topcar['car_img']; ?>" alt="">
                <div class="blur"></div>
                <div class="car_deta">
                    <h2>carId: <?php echo $topcar['car_id']; ?></h2>
                    <h2>make: <?php echo $topcar['make']; ?></h2>
                    <h2>model: <?php echo $topcar['model']; ?></h2>
                    <h2>price: <?php echo $topcar['rental_price']; ?></h2>
                </div>
            </a>     
        <?php endforeach; ?>
        
    </div>  
      </div>
    </div>
    <?php include('footer.php');?>
    <script src="script.js"></script>
  </body>
</html>
