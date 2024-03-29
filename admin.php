<?php

// Database connection
include 'sysconfig/mysql.php';


if (isset($_COOKIE['user_data'])) {
    $user_data = unserialize($_COOKIE['user_data']);

    $admin = $user_data['admin'];
}
if ($admin == 'no') {

    header("Location: user.php");

}
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cars from database
$sql = "SELECT cars.*, counts.cofe
FROM cars
CROSS JOIN (SELECT COUNT(*) AS cofe FROM cars) AS counts LIMIT 10";
$result = $conn->query($sql);

$cars = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cars[] = $row;
    }
}
// Fetch users from database
$sql = "SELECT users.*, counts.cofe
FROM users
CROSS JOIN (SELECT COUNT(*) AS cofe FROM users) AS counts LIMIT 10;
";
$useResult = $conn->query($sql);

$users = [];
if ($useResult->num_rows > 0) {
    while ($row1 = $useResult->fetch_assoc()) {
        $users[] = $row1;
    }
}
// Fetch rantalss from database
$sql = "SELECT rentals.rental_id, users.username, cars.make,rentals.start_date,rentals.end_date,rentals.total_cost,counts.cofe
FROM rentals 
INNER JOIN cars ON rentals.car_id = cars.car_id 
INNER JOIN users ON rentals.user_id = users.user_id
CROSS JOIN (SELECT COUNT(*) AS cofe FROM rentals) AS counts LIMIT 20;
";
$rentalsResult = $conn->query($sql);

$rentals = [];
if ($rentalsResult->num_rows > 0) {
    while ($row2 = $rentalsResult->fetch_assoc()) {
        $rentals[] = $row2;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Cars</title>
    <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="user.css" />

</head>
<body>
  <?php
    include('nav.php')
?>
    <header>
        <h1>Admin Dashboard</h1>
    </header>
  
    <main class="admin_main">
    
      <div class="top">
        <div class="top-elem">
            <h2>Total Cars</h2><h3><?php  echo $cars[0]['cofe']; ?></h3></div>
        <div class="top-elem"><h2>Total Users</h2><h3><?php  echo $users[0]['cofe'];?></h3></div>
        <div class="top-elem"><h2>Total Rental</h2><h3><?php  echo $rentals[0]['cofe'];?></h3></div>
      </div>
      <hr />
      <div class="bottom">
        <div class="bottom-left">
          <div class="l-top">
            <!-- (B2) ZEBRA TABLE -->
            <h1>Manage Cars</h1>
            <table class="zebra">
              <tr>
                <td>Make</td>
                <td>Model</td>
                <td>Year</td>
                <td>Rent</td>
                <td>Action</td>
                <td>Date</td>
              </tr>
              <?php foreach ($cars as $car): ?>
                <tr>
                    <td><?php echo $car['make']; ?></td>
                    <td><?php echo $car['model']; ?></td>
                    <td><?php echo $car['year']; ?></td>
                    <td><?php echo $car['rental_price']; ?></td>
                    <td><?php echo $car['availability']; ?></td>
                    <td><?php echo $car['lastOfBook']; ?></td>
                    
                </tr>
                <?php endforeach; ?>
            </table>

            <a href="manegeCars.php" style="
    position: absolute;
    top: 5%;
    right: 5%;
">Manege Cars</a>
          </div>
          <hr />
          <div class="l-bottom">
            <!-- (B2) ZEBRA TABLE -->
            <h1>Manage Users</h1>
            <table class="zebra">
              <tr>
                <td>ID</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Restriction</td>
              </tr>
              <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['user_id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['restriction']; ?></td>
                   
                    
                </tr>
                <?php endforeach; ?>
            </table>
            <a href="manegeUsers.php" style="
    position: absolute;
    top: 5%;
    right: 5%;
">Manege Users</a>

          </div>
        </div>
        <div class="bottom-right" style="border-left: 2px solid">
          <!-- (B2) ZEBRA TABLE -->
          <h1>Rentals</h1>
          <table class="zebra">
            <tr>
                    <td>Rental Id</td>
                    <td>Name</td>
                    <td>Car</td>
                    <td>Start Date</td>
                    <td>End Date</td>
                    <td>Total Cost</td>

            </tr>
            <?php foreach ($rentals as $rental): ?>
                <tr>
                    <td><?php echo $rental['rental_id']; ?></td>
                    <td><?php echo $rental['username']; ?></td>
                    <td><?php echo $rental['make']; ?></td>
                    <td><?php echo $rental['start_date']; ?></td>
                    <td><?php echo $rental['end_date']; ?></td>
                    <td><?php echo $rental['total_cost']; ?></td>
                   
                    
                </tr>
                <?php endforeach; ?>
          </table>
        </div>
      </div>
    </main>
 <?php
    include('footer.php')
?>
<script src="script.js"></script>

  </body>
</html>
