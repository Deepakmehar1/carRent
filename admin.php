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
$sql = "SELECT * FROM cars";
$result = $conn->query($sql);

$cars = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cars[] = $row;
    }
}
// Fetch users from database
$sql = "SELECT * FROM users";
$useResult = $conn->query($sql);

$users = [];
if ($useResult->num_rows > 0) {
    while ($row1 = $useResult->fetch_assoc()) {
        $users[] = $row1;
    }
}
// Fetch rantalss from database
$sql = "SELECT rentals.rental_id, users.username, cars.make,rentals.start_date,rentals.end_date,rentals.total_cost
FROM rentals 
INNER JOIN cars ON rentals.car_id = cars.car_id 
INNER JOIN users ON rentals.user_id = users.user_id
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
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
    </header>
  
    <main>
        <section id="manage-cars">
            <h2>Manage Cars</h2>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Rental Price</th>
                    <th>Action</th>
                    <th>lastOfBook</th>
                </tr>
                <?php foreach ($cars as $car): ?>
                <tr>
                    <td><?php echo $car['car_id']; ?></td>
                    <td><?php echo $car['make']; ?></td>
                    <td><?php echo $car['model']; ?></td>
                    <td><?php echo $car['year']; ?></td>
                    <td><?php echo $car['rental_price']; ?></td>
                    <td><?php echo $car['availability']; ?></td>
                    <td><?php echo $car['lastOfBook']; ?></td>
                    
                </tr>
                <?php endforeach; ?>
            </table>
                <a href="manegeCars.php">manegeCars</a>

        </section>
        <!-- Other sections of the dashboard -->
        <section id="manage-user">
            <h2>Manage user</h2>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>email</th>
                    <th>restriction</th>
                    
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
                <a href="manegeUsers.php">manegeUsers</a>

        </section>
        <section id="rentals">
            <h2>rentals</h2>
            <table border="1">
                <tr>
                    <th>rental_id</th>
                    <th>user_id</th>
                    <th>car_id</th>
                    <th>start_date</th>
                    <th>end_date</th>
                    <th>total_cost</th>
                    
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
                

        </section>
    </main>
</body>
</html>
   