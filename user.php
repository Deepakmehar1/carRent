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
     <link rel="stylesheet" href="user.css" />
    <style>
        
    </style>
  </head>
  <body style="position:relative;"><?php include('nav.php');
?>
    <main class="user_main">
      <div class="top">
        <div class="user_img"><img src="<?php echo $user_data['user_img'];?>" alt="" /></div>
        <div class="user_detail">
          username:- <?php echo $user_data['username'];?> <br />
          email:- <?php echo $user_data['email'];?>
        </div>
        <div class="ed">Edit</div>
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
    </main> 
    <div class="edit" style="display:none;">
    <style>

</style>
        <h5>Update</h5><p class="cancel"><img style="width:16px;" src="./img/close.png" alt=""></p>
        
        <form method="post" action="update_user.php?user_id=<?php echo $user_Id;?>" class="inputs">
          <input type="text" placeholder="username" id="username" name="username" value="<?php echo $user_data['username']; ?>" required/>
          <br />
          <input type="email" placeholder="Email" id="email" name="email" value="<?php echo $user_data['email']; ?>" required/>
          <br />
          <input type="password" id="password" name="password" required placeholder="password" />
          <br /><br />
  
         
          <input type="submit" value="Update">
        </form>

        
    </div>
    <?php include('footer.php');?>
<script src="script.js"></script>
<script>card_apear()</script>

  </body>
</html>
