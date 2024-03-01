<?php


// Database connection
include 'sysconfig/mysql.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Prepare SQL statement
    $sql = "INSERT INTO cars (make, model, year, rental_price, car_img) VALUES (?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $make, $model, $year, $rental_price, $car_img);

    // Set parameters
    $make = $_POST["make"];
    $model = $_POST["model"];
    $year = $_POST["year"];
    $rental_price = $_POST["rental_price"];

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["car_img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["car_img"]["tmp_name"]);
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
    if ($_FILES["car_img"]["size"] > 3 * 1024 * 1024) {
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
        if (move_uploaded_file($_FILES["car_img"]["tmp_name"], $target_file)) {
            echo "The file ". basename($_FILES["car_img"]["name"]). " has been uploaded.";
            // Set car_img parameter to the file path
            $car_img = $target_file;

            // Execute SQL statement
            if ($stmt->execute()) {
                echo "New record inserted successfully.";
            header("Location: /car_rent/manegeCars.php");

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
