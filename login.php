<?php
session_start();

// Database connection
    include 'sysconfig/mysql.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email_id'] ?? '';
    $password = $_POST['password'];

    // SQL query to fetch user data from database using email
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $row['user_id'];
            // Redirect to dashboard or any other page
            header("Location: nav.php");
            exit();
        } else {
            // Incorrect password
            $login_error = "Invalid email or password.";
        }
    } else {
        // User not found
        $login_error = "User not found.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>

<h2>User Login</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="email_id">Email:</label><br>
    <input type="email" id="email_id" name="email_id" required><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>

</body>
</html>
