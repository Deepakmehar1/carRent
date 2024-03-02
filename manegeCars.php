<?php
// Database connection
include 'sysconfig/mysql.php';


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

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Cars</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="car.css" />
    <style>
       
      </style>
  </head>
  <body>
    <?php include('nav.php'); ?>
    <main class="m_car" style="position: relative;
       min-height: 58.3vh;">
      <div class="ed">Add Cars</div>

      <div class="car-detail">
        <!-- (B2) ZEBRA TABLE -->
        <h1>Manage Cars</h1>
        <table class="zebra">
          <tr>
            <td>Id</td>
            <td>make</td>
            <td>model</td>
            <td>year</td>
            <td>rent</td>
            <td>Avaiability</td>
            <td>date</td>
            <td>Action</td>
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
            <td>
              <a href="edit_car.php?car_id=<?php echo $car['car_id']; ?>"
                >Edit</a
              >
              <a
                href="delete_car.php?car_id=<?php echo $car['car_id']; ?>"
                onclick="return confirm('Are you sure you want to delete this car?')"
                >Delete</a
              >
            </td>
          </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </main>
    <div class="edit add_car" style="display: none">
      <h5>Add Car</h5>
      <p class="cancel"><img style="width:16px;" src="./img/close.png" alt=""></p>

      <form action="save_car.php" method="post" class="inputs" enctype="multipart/form-data">
        <input
          type="text"
          id="make"
          name="make"
          placeholder="car company name"
          required
        /><br />
        <input
          type="text"
          id="model"
          name="model"
          placeholder="car model name"
          required
        /><br />
        <input
          type="number"
          id="year"
          name="year"
          placeholder="year"
          required
        /><br />
        <input
        type="number"
        id="rental_price"
        name="rental_price"
        step="0.01"
        placeholder="rent price per day"
        required
        /><br />
        <input type="file" id="car_img" name="car_img" accept="image/*" required><br>
        <br />

        <input type="submit" value="Add Car" />
      </form>
    </div>
    <?php include('footer.php'); ?>
<script src="script.js"></script>
<script>card_apear()</script>
  </body>
</html>
