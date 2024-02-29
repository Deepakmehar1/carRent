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



            // Serialize user data to store in the cookie
            $serialized_data = serialize($row);

            // Set a persistent cookie with user data
            setcookie('user_data', $serialized_data, time() + (86400 * 30), "/"); // Cookie expires in 30 days

            // Redirect to dashboard or any other page
            header("Location: /car_rent/");
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
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Login Page in HTML with CSS Code Example</title>

    <link rel="stylesheet" href="./test.css" />
  </head>
  <body>
    <div class="box-form">
      <div class="left">
        <div class="overlay">
          <h1>Hello World.</h1>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
            et est sed felis aliquet sollicitudin
          </p>
        </div>
      </div>

      <div class="right">
        <h5>Login</h5>
        <p>
          Don't have an account? <a href="
http://localhost/car_rent/register.php
">Creat Your Account</a> it takes
          less than a minute
        </p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="inputs">
          <input type="email" placeholder="Email" id="email_id" name="email_id" required/>
          <br />
          <input type="password" id="password" name="password" required placeholder="password" />
          <br /><br />
  
         
          <input type="submit" value="Login">
        </form>

      </div>
    </div>
  </body>
</html>
