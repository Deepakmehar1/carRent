<?php
// Database connection
include 'sysconfig/mysql.php';



// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_COOKIE['user_data'])) {
    $user_data = unserialize($_COOKIE['user_data']);

    $user_id = $user_data['user_id'];


    // Fetch car details from the database
    $sql = "SELECT * FROM users WHERE user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        // If no user found with the given user_id, redirect to manage_cars.php
        header("Location: user.php");
        exit();
    }

} else {
    // Fetch rantalss from database
    header("Location: login.php");

}
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Update car details in the database
    $update_sql = "UPDATE users SET username='$username', password='$hashed_password',email='$email' WHERE user_id=$user_id";

    if ($conn->query($update_sql) === true) {
        // Redirect to manage_cars.php after successful update
        header("Location: user.php");
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
</head>
<body>
    <h2>Edit Car</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?user_id=' . $user_id; ?>" method="post">
        <label for="username">username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required><br><br>
        <label for="password">password:</label><br>
        <input type="password" id="password" name="password" placeholder="New Pasword" required><br><br>
        <label for="email">email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>
        
        <input type="submit" value="Update user">
    </form>
</body>
</html>
