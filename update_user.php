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
