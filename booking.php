<?php
// Database connection
include 'sysconfig/mysql.php';

session_start();

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
</head>
<body>
    <h2><?php echo $car['make']; ?></h2>
    <h2><?php echo $_SESSION['user_id']; ?></h2>
    <div><?php echo $car['model']; ?></div>
    <div><?php echo $car['rental_price']; ?></div>
    <div><?php echo $car['year']; ?></div>
    <div><?php echo date("Y-m-d");?></div>
    <div><?php echo $available ? "available" : "not" ?></div>
    <form  action="book.php?car_id=<?php echo $car['car_id'];?>" method="post">
        <label for="start_date">Start Date:</label><br>
        <input type="date" id="start_date" name="start_date" required><br><br>
        <label for="end_date">End Date:</label><br>
        <input type="date" id="end_date" name="end_date" required><br><br>
        <label for="total_cost">total price:</label><br>
        <input type="number" id="total_cost" name="total_cost" placeholder="0" disabled required ><br><br>
        <input type="button" value="Calculate Price" onclick=calculatePrice()>
        <input type="submit" value="submit" <?php
            if (!$available) {
                echo "disabled";
            }
?>> 
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
</body>
</html>
