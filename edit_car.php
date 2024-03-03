<?php
// Database connection
include 'sysconfig/mysql.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID parameter is set
if (!isset($_GET['car_id'])) {
    header("Location: manegeCars.php");
    exit();
}

// Get the ID of the car to be edited
$car_id = $_GET['car_id'];

// Fetch car details from the database
$sql = "SELECT * FROM cars WHERE car_id = $car_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $car = $result->fetch_assoc();
} else {
    // If no car found with the given car_id, redirect to manage_cars.php
    header("Location: manegeCars.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $rental_price = $_POST['rental_price'];
    $availability = $_POST['availability'];

    // Update car details in the database
    $update_sql = "UPDATE cars SET make='$make', model='$model', year='$year', rental_price='$rental_price', availability='$availability' WHERE car_id=$car_id";

    if ($conn->query($update_sql) === true) {
        // Redirect to manage_cars.php after successful update
        header("Location: manegeCars.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="car.css">
    
</head>
<body>
        <?php include('nav.php'); ?>
        <div class="ed-cont">
            <img src="<?php echo $car['car_img'];?>" alt="">
            <div class="overlay"></div>
<div class="edit" >
    <h2>Edit Car</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?car_id=' . $car_id; ?>" method="post" class="inputs" enctype="multipart/form-data">
        <input type="text" id="make" name="make" value="<?php echo $car['make']; ?>" required><br>
        <input type="text" id="model" name="model" value="<?php echo $car['model']; ?>" required><br>
        <input type="text" id="availability" name="availability" value="<?php echo $car['availability']; ?>" required><br>
        <input type="number" id="year" name="year" value="<?php echo $car['year']; ?>" required><br>
        <input type="number" id="rental_price" name="rental_price" value="<?php echo $car['rental_price']; ?>" step="0.01" required><br>
       
        <br />
        <input type="submit" value="Edit Car">
    </form>
    
</div>
</div>
        <?php include('footer.php'); ?>
    <script src="script.js"></script>
</body>
</html>
