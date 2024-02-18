<?php

// Database connection
include 'sysconfig/mysql.php';
session_start();

$user_id = $_SESSION['user_id'];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch rantalss from database
$sql = "SELECT * FROM users WHERE user_id=$user_id";
$userResult = $conn->query($sql);

$user = [];
if ($userResult->num_rows > 0) {
    while ($row = $userResult->fetch_assoc()) {
        $user[] = $row;
    }
}
// Fetch rantalss from database
$sql = "SELECT * FROM rentals WHERE user_id=$user_id";
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
        
        <section id="manage-user">
            <h2>Manage user</h2>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>email</th>
                    
                </tr>
                <?php foreach ($user as $user): ?>
                <tr>
                    <td><?php echo $user['user_id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                   
                    
                </tr>
                <?php endforeach; ?>
            </table>
                <a href="update_user.php">Edit</a>
             

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
                    <td><?php echo $rental['user_id']; ?></td>
                    <td><?php echo $rental['car_id']; ?></td>
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
   