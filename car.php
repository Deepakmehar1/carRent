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
    <title>Edit Car</title>
    <link rel="stylesheet" href="style.css" />

    <style>
      .car_main {
        width: 100vw;
        display: flex;
      }
      .car_left {
        width: 70%;
        
        padding: 8px;
      }
      .car_left span {
        opacity: 0.7;
        font-size: 16px;
      }
      .car_left .car_img{display: flex; justify-content: center;background: lightseagreen;
    border-radius: 16px;padding: 16px;}
      .car_left img {
        width: 662px;
       
      }
      .car_left .details h2 {
        line-height: 24px;
        font-size: 32px;
        margin-right: 50px;    margin-bottom: 8px;
      }
      .car_left .details {
        position: relative;margin-top: 50px;
      }.details:first-child{
        color: aqua;
    }
      .car_left .details .book {
        position: absolute;
       top: 65px;
    right: 37px;

        text-decoration: none;
            border: 2px solid #5a5a5a;
    border-radius: 8px;
    padding: 5px;
    color: #121212;
    background: lightseagreen;
        font-size: x-large;
        letter-spacing: 3px;
        margin-right: 8px;
        font-weight: 600;
      }.car_right {
    width: 30%;height: 600px;overflow: hidden;    overflow-y: scroll;
    overflow-x: hidden; 
}
        .high_rate_container {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            gap: 32px;
            flex-direction: column;    overflow-y: auto;

        }.hrcar {
            text-decoration:none;
            width: 300px;
            height: 200px;
            position: relative;
            border: 2px solid black;
            border-radius: 8px;
            display: flex;
            justify-content: center;
        }
        .hrcar img{
            height: 150px;
            align-self: center;
        }
        .hrcar .car_deta{
            display: none;
            position: absolute;
            top: 0;
            left: 0;
        }
        .hrcar:hover .car_deta{
            display: block;
        }
    </style>
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
                <div class="car_deta">
                    <h3>carId:<?php echo $topcar['car_id']; ?></h3>
                    <p>make<?php echo $topcar['make']; ?></p>
                    <p>model<?php echo $topcar['model']; ?></p>
                    <h2>price<?php echo $topcar['rental_price']; ?></h2>
                </div>
            </a>     
        <?php endforeach; ?>
        
    </div>  
      </div>
    </div>
    <?php include('footer.php');?>
  </body>
</html>
