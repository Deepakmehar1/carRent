<?php
// Database connection
include 'sysconfig/mysql.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Fetch users from database
$sql = "SELECT * FROM users";
$useResult = $conn->query($sql);

$users = [];
if ($useResult->num_rows > 0) {
    while ($row1 = $useResult->fetch_assoc()) {
        $users[] = $row1;
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="style.css">
    <style>
        
        </style>
</head>
<body><?php include('nav.php'); ?>
    <main style="    position: relative;
    min-height: 58.3vh;">
    <h1>Manage user</h1>
        <table class="zebra">
                <tr>
                    <td>ID</td>
                    <td>name</td>
                    <td>email</td>
                    <td>restriction</td>
                    <td>Action</td>
                    
                </tr>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['user_id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['restriction']; ?></td>
                   <td>
                    <?php
                    $res = 'Are you sure ?")';
                    if ($user['restriction'] == 'no') {
                        echo '<a href="restrictUser.php?user_id=';
                        echo $user['user_id'] . '&&restriction=6"';
                        echo ' onclick="return confirm("' . $res . '">' . 'restrict';
                        echo '</a>';
                    } else {
                        echo '<a href="restrictUser.php?user_id=';
                        echo $user['user_id'] . '&&restriction=12"';
                        echo ' onclick="return confirm("' . $res . '">' . 'undo restrict';
                        echo '</a>';

                    }
                    ?>
                
            </td>
                    
                </tr>
                <?php endforeach; ?>
            </table>


    
      

      
    </main>
    
    <?php include('footer.php'); ?>
    <script src="script.js"></script>

</body>
</html>
