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
    <style>
        table.zebra {
          width: 100%;
          border-collapse: collapse;
        }
        table.zebra tr:nth-child(2n) {
          background: #aef7ff;
        }
        table.zebra td {
          padding: 10px;
        }
        .edit {
          position: absolute;
          top: 50%;
          left: 50%;
          background: wheat;
          transform: translate(-50%, -50%);
          border-radius: 16px;
          filter: drop-shadow(2px 4px 6px black);
          padding: 40px;
          overflow: hidden;    z-index: 5;

        }
        .edit h5 {
          font-size: 2vmax;
          line-height: 0;
        }
        .edit p {
          position: absolute;
          top: 6%;
          right: 15%;
        }
        .edit .inputs {
          overflow: hidden;
        }
        .edit input {
          width: 100%;
          padding: 10px;
          margin-top: 25px;
          font-size: 16px;
          border: none;
          outline: none;
          border-bottom: 2px solid #b0b3b9;
        }

        .edit input[type="submit"] {
          color: #fff;
          font-size: 16px;
          padding: 12px 35px;
          border-radius: 50px;
          display: inline-block;
          border: 0;
          outline: 0;
          box-shadow: 0px 4px 20px 0px #49c628a6;
          background-image: linear-gradient(135deg, #70f570 10%, #49c628 100%);
        }
        .ed {
          position: absolute;
          right: 10%;
          top: 3.5%;
          background: red;
          padding: 4px;
          cursor: pointer;

          border-radius: 4px;
          font-size: 20px;
          filter: drop-shadow(0px 0px 1px red);
        }
      </style>
  </head>
  <body>
    <?php include('nav.php'); ?>
    <main style="position: relative;
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
    <div class="edit" style="display: none">
      <h5>Add Car</h5>
      <p class="cancel">c</p>

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
    <script>
      var cancel = document.querySelector(".cancel");
      var ed = document.querySelector(".ed");
      var main = document.querySelector("main");
      var footer = document.querySelector("footer");
      var nav = document.querySelector("nav");
      var edit = document.querySelector(".edit");
      ed.addEventListener("click", () => {
        edit.style.display = "block";
        main.style.pointerEvents = "none";
        main.style.opacity = "0.4";
        nav.style.pointerEvents = "none";
        nav.style.opacity = "0.4";
        footer.style.pointerEvents = "none";
        footer.style.opacity = "0.4";
      });
      cancel.addEventListener("click", () => {
        edit.style.display = "none";
        main.style.pointerEvents = "all";
        main.style.opacity = "1";
        nav.style.pointerEvents = "all";
        nav.style.opacity = "1";
        footer.style.pointerEvents = "all";
        footer.style.opacity = "1";
      });
    </script>
  </body>
</html>
