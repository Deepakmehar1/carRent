<?php
// Database connection
    include 'sysconfig/mysql.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert user data into database
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        // Redirect to login page or any other page
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
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
        <h5>Register</h5>
        <p>
          Already have an account? <a href="
http://localhost/car_rent/login.php
">Login Now</a> fast
        </p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="inputs">
          <input type="text" placeholder="username" id="username" name="username" required/>
          <br />
          <input type="email" placeholder="Email" id="email" name="email" required/>
          <br />
          <input type="password" id="password" name="password" required placeholder="password" />
          <br /><br />
  
         
          <input type="submit" value="register">
        </form>

      </div>
    </div>
  </body>
</html>
