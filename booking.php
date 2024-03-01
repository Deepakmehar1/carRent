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
    <title>Edit Car</title>
    <link rel="stylesheet" href="style.css" />

    <style>
      .date,
      .cal_price {
        display: flex;
        margin-bottom: 8px;
      }
      .car_booking img {
        width: 200px;
      }
      .car_booking {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px;
      }
      form {
        left: 50%;
        transform: translateX(-50%);
        height: 150px;
        width: 500px;
        border: 2px solid;
        border-radius: 16px;
        padding: 16px;
        position: relative;    margin-bottom: 39px;
      }
      input[type="submit"] {
        position: absolute;
        left: 39%;
        background: lightseagreen;
        border: 0;
        border-radius: 11px;
        font-size: 1.2rem;
        filter: drop-shadow(0px 0px 2px black);
      }
      input[type="button"] {
        border: 0;
        border-radius: 11px;
        color: lightseagreen;
        filter: drop-shadow(0px 0px 2px lightseagreen);
      }
      span {
        font-size: 20px;
        font-weight: 400;
        
color: #5b5b5b;

      }
      .car_booking .car_img {
        display: flex;
        justify-content: center;
        background: lightseagreen;
        border-radius: 8px;
      }input[type=date] {
    border: none;
    filter: drop-shadow(0px 0px 2px black);
}
    </style>
  </head>
  <body>
    <?php include('nav.php');?>

    <div class="car_booking">
      <div class="car_detail">
        <h2>
          <span>user name:- </span>
          <?php echo $user_data['username']; ?>
        </h2>
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

    <form action="book.php?car_id=<?php echo $car['car_id'];?>" method="post">
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
          onclick="calculatePrice()"
        />
      </div>
      <input type="submit" value="submit"
      <?php
if (!$available) {
    echo "disabled";
}
?>/>
    </form>

    <script>
      function calculatePrice() {
          var startDate = document.getElementById('start_date').value;
          var endDate = document.getElementById('end_date').value;

          // Perform validation
          var startDateObj = new Date(startDate);
          var endDateObj = new Date(endDate);

          if (startDate === "" || endDate === "" || startDateObj >= endDateObj) {
              alert("Please select valid dates.");
              return;
          }

          var rentalDays = Math.ceil((endDateObj - startDateObj) / (1000 * 60 * 60 * 24)); // Number of days rounded up

          // Retrieve rental price per day from PHP variable (you should set this value dynamically)
          var rentalPricePerDay = <?php echo $car['rental_price']; ?>;

          // Calculate total price
          var total_cost = rentalDays * rentalPricePerDay;
          // Display the total price to the user
          document.getElementById('total_cost').value = total_cost.toFixed(2);
      }
    </script>
     <?php include('footer.php');?>
  </body>
</html>
