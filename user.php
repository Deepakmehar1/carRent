<?php

// Database connection
include 'sysconfig/mysql.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Retrieve data from the persistent cookie
if (isset($_COOKIE['user_data'])) {
    $user_data = unserialize($_COOKIE['user_data']);

    $user_Id = $user_data['user_id'];

    // Fetch rantalss from database

    $sql = "SELECT cars.model, cars.make,rentals.start_date,rentals.end_date,rentals.total_cost
FROM rentals 
INNER JOIN cars ON rentals.car_id = cars.car_id 
WHERE rentals.user_id=$user_Id
";



    // $sql = "SELECT * FROM rentals WHERE user_id=$user_Id";
    $rentalsResult = $conn->query($sql);

    $rentals = [];
    if ($rentalsResult->num_rows > 0) {
        while ($row2 = $rentalsResult->fetch_assoc()) {
            $rentals[] = $row2;
        }
    }

} else {
    // Fetch rantalss from database
    header("Location: login.php");

}


$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>user profile</title>
     <link rel="stylesheet" href="style.css" />
    <style>
      .top {
        height: 30%;
        display: flex;
        align-items: center;
        gap: 50px;
      }.top a{    position: absolute;
    top: 10%;
    right: 10%;
}
      .user_img img {
        height: 200px;
        width: 200px;
        object-fit: contain;
      }
      .user_img {
        background-color: red;
        border-radius: 50%;
        height: 200px;
        width: 200px;
      }
      .bottom {
        height: 70%;
        display: flex;
        flex-direction: column;
      }
      tr:nth-child(1) {
        background: lightseagreen !important;
      }
      tr:nth-child(2n + 1) {
        background: #5b5b5b;
      }
      tr:nth-child(2n) {
        background: #7a7a7a;
      }
      tr:hover {
        background: #b2f5f1;
      }td {
    padding: 10px;
    font-weight: 400;
} main{
    display: flex;
    flex-direction: column;
    padding: 16px;
}
    </style>
  </head>
  <body><?php include('nav.php');
?>
    <main>
      <div class="top">
        <div class="user_img"><img src="./img/car2.png" alt="" /></div>
        <div class="user_detail">
          username:- <?php echo $user_data['username'];?> <br />
          email:- <?php echo $user_data['email'];?>
        </div>
        <a href="update_user.php">Edit</a>
      </div>
      <div class="bottom">
        <h1 style="text-align: center">history</h1>
        <hr style="width: 70vw;     padding: 4px;   align-self: center;" />
        <div id="history" class="history" style="align-self: center">
          <table
            border="1"
            style=" border: 1px solid #8a8a8a height: 48vh; overflow: scroll;;
border-spacing: 0; text-align: center; "

          >
            <tr>
              <th>make</th>
              <th>model</th>
              <th>start_date</th>
              <th>end_date</th>
              <th>total_cost</th>
            </tr>
            <?php foreach ($rentals as $rental): ?>
            <tr>
              <td><?php echo $rental['make']; ?></td>
              <td><?php echo $rental['model']; ?></td>
              <td><?php echo $rental['start_date']; ?></td>
              <td><?php echo $rental['end_date']; ?></td>
              <td><?php echo $rental['total_cost']; ?></td>
            </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
    </main> <?php include('footer.php');?>
  </body>
</html>
