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
        }.top .ed{    position: absolute;
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
  <body style="position:relative;"><?php include('nav.php');
?>
    <main>
      <div class="top">
        <div class="user_img"><img src="./img/car2.png" alt="" /></div>
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
    <style>.edit {
  position: absolute;
  top: 40%;
  left: 50%;
  background: wheat;
  transform: translate(-50%, -50%);
  border-radius: 16px;
  filter: drop-shadow(2px 4px 6px black);
   padding: 40px;
  overflow: hidden;
}.edit h5 {
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

</style>
        <h5>Update</h5><p class="cancel">c</p>
        
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
    <script>
       var cancel = document.querySelector(".cancel")
       var ed = document.querySelector(".ed")
       var main = document.querySelector("main")
       var footer = document.querySelector("footer")
       var nav = document.querySelector("nav")
       var edit = document.querySelector(".edit")
       ed.addEventListener("click",()=>{

         edit.style.display="block";
         main.style.pointerEvents="none";
         main.style.opacity="0.4";
         nav.style.pointerEvents="none";
         nav.style.opacity="0.4";
         footer.style.pointerEvents="none";
         footer.style.opacity="0.4";
       })
       cancel.addEventListener("click",()=>{

         edit.style.display="none";
         main.style.pointerEvents="all";
         main.style.opacity="1";
         nav.style.pointerEvents="all";
         nav.style.opacity="1";
         footer.style.pointerEvents="all";
         footer.style.opacity="1";
       })
    </script>
  </body>
</html>
