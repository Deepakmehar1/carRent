<nav>
  <div class="left">CARHOST</div>
  <ul id="middle">
    <li>
      <a class="navitem" href="/car_rent/"><img src="./img/home.png" class="navicon" alt="" style="height: 16.8px;">Home</a>
    </li>
    <li>
      <a class="navitem" href="/car_rent/allcars.php"><img src="./img/car.png" class="navicon" alt="">Cars</a>
    </li>
    <li>
      <a class="navitem" href="/car_rent/about.php"><img src="./img/about.png" class="navicon" alt="">About</a>
    </li>
    <li>
      <a class="navitem" href="/car_rent/#contact"><img src="./img/contact.png" class="navicon" alt="" style="height: 22.8px;">Contact</a>
    </li>
  </ul>
  <div class="right" onclick="showMenu()">
    <?php
    if (isset($_COOKIE['user_data'])) {
        $user_data = unserialize($_COOKIE['user_data']);
        echo ' <div class="right-p"><img src="'. $user_data['user_img'].' "alt=""></div>';
        echo '<div class="right-contain" style="display:none;">';
        echo '<a href="/car_rent/user.php" class="navItem"><img src="./img/profile.png" class="navicon" alt="">PROFILE</a>';
        echo '<a href="/car_rent/user.php#history" class="navItem"><img src="./img/history.png" class="navicon" alt="">HISTORY</a>';
        if ($user_data['admin'] == 'yehh') {
            echo '<a href="/car_rent/admin.php" class="navItem"><img src="./img/setting.png" class="navicon" alt="">ADMIN</a>';
        }
        echo '<a href="/car_rent/logout.php" class="navItem"><img src="./img/logout.png" class="navicon" alt="">LOGOUT</a>';
        echo '</div>';
    } else {
        echo '<a href="/car_rent/register.php" class="navItem lore" style="color: black;">REGISTER</a>';
        echo '<a href="/car_rent/login.php" class="navItem lore" style="color: lightseagreen;">LOGIN</a>';
    }?>
  </div>     
</nav>