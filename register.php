<?php
// Database connection
include 'sysconfig/mysql.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Prepare SQL statement
    $sql = "INSERT INTO users (username, password, email, user_img) VALUES (?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $password, $email, $user_img);

    // Set parameters

    $username = $_POST['username'];
    $wpassword = $_POST['password'];
    $email = $_POST['email'];

    // Hash the password
    $password = password_hash($wpassword, PASSWORD_DEFAULT);


    // Handle file upload
    $target_dir = "uploads/user/";
    $target_file = $target_dir . basename($_FILES["user_img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["user_img"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Maximum file size in bytes (3MB)

    // Check file size
    if ($_FILES["user_img"]["size"] > 3 * 1024 * 1024) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }


    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "webp") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["user_img"]["tmp_name"], $target_file)) {
            echo "The file ". basename($_FILES["user_img"]["name"]). " has been uploaded.";
            // Set car_img parameter to the file path
            $user_img = $target_file;

            // $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";

            // Execute SQL statement
            if ($stmt->execute()) {
                echo "New record inserted successfully.";
                header("Location: /car_rent/login.php");

                exit();

            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

// SQL query to insert user data into database

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Login Page in HTML with CSS Code Example</title>

    <link rel="stylesheet" href="./test.css" />
  </head>
  <body>
    <div class="box-form" style="
transform: scale(.9);
">
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
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="inputs" enctype="multipart/form-data">
          <input type="text" placeholder="username" id="username" name="username" required/>
          <br />
          <input type="email" placeholder="Email" id="email" name="email" required/>
          <br />
          <input type="password" id="password" name="password" required placeholder="password" />
          <br />
          <input type="file" id="user_img" name="user_img" accept="image/*" required><br>
        <br />
         
          <input type="submit" value="register">
        </form>

      </div>
    </div>
  </body>
</html>
