<?php
// Database connection
include 'sysconfig/mysql.php';

if (isset($_COOKIE['user_data'])) {
    $user_data = unserialize($_COOKIE['user_data']);
}
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
function isCarAvailable($car_id)
{
    // Assuming $conn is your database connection object
    global $conn;
    $sql = "SELECT availability FROM cars WHERE car_id = $car_id";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row['availability'] == 'available';
    } else {
        return false; // Car not found or error retrieving availability
    }
}
$check_available = isCarAvailable($car_id);

function setCarAvailability($car_id, $availability)
{
    global $conn; // Assuming $conn is your database connection object

    $sql = "UPDATE cars SET availability = '$availability' WHERE car_id = $car_id";
    if ($conn->query($sql) === true) {
        return true; // Car availability updated successfully
    } else {
        return false; // Error updating car availability
    }
}
if (!$check_available && $car['lastOfBook'] == date("Y-m-d")) {
    $available = setCarAvailability($car_id, "available");
} else {
    $available = $check_available ;
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Car</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="user.css" />

  </head>
  <body>
    <?php include('nav.php');?>

    <div class="car_booking">
      <div class="car_detail">
        
        <h2>
          <span>make:-</span
          ><?php echo $car['make']; ?>
        </h2>
        <h2>
          <span>model:-</span
          ><?php echo $car['model']; ?>
        </h2>
        <h2>
          <span>year:-</span>
          <?php echo $car['year']; ?>
        </h2>
        <h2>
          <span>rent price:- </span
          ><?php echo $car['rental_price']; ?>$/day
        </h2>
        <h2>
          <span>date:-</span
          ><?php echo date("Y-m-d");?>
        </h2>
        <h2 style="color:<?php
            echo $available ? "green" : "red";
?>">
          <span>avaliblity :-</span
          ><?php echo $available ? "available" : "not available" ?>
        </h2>
      </div>
      <div class="car_img">
        <img src="<?php echo $car['car_img'];?>" alt="" />
      </div>
    </div>

    <h2>booking dates</h2>

    <form action="book.php?car_id=<?php echo $car['car_id'];?>" method="post" class="book-form">
      <div class="date">
        <div>
          <label for="start_date">Start Date:</label><br />
          <input type="date" id="start_date" name="start_date" required />
        </div>
        <br />---------------------------------------------
        <div style="position: absolute; right: 16px">
          <label for="end_date">End Date:</label><br />
          <input type="date" id="end_date" name="end_date" required />
        </div>
      </div>
      <div class="cal_price" style="align-items: center">
        <label for="total_cost">total price:</label>
        <input
          type="number"
          id="total_cost"
          name="total_cost"
          placeholder="0"
          disabled
          required
        /><br /><br />
        <input
          type="button"
          value="Calculate Price"
          onclick="calculatePrice(<?php echo $car['rental_price']; ?>)"
        />
      </div>
      <input type="submit" value="submit"
      <?php
if (!$available ||  isset($user_data['restriction']) && $user_data['restriction'] == 'yes') {
    echo "disabled";
}
?>/>
    </form>
    
    
    <?php include('footer.php');?>
    <script src="script.js"></script>
  </body>
</html>
