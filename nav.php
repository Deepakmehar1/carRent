<style>
  .right:hover >.right-contain {
  background-color: #2b2b2b;
  height: auto;
}
</style>
<nav>
      <div class="left">GHOSTCAR</div>
      <ul id="middle">
        <li>
          <a class="navitem" href="/car_rent/"> Home</a>
        </li>
        <li>
          <a class="navitem" href="/car_rent/allcars.php"> Cars</a>
        </li>
        <li>
          <a class="navitem" href="/car_rent/about.php"> About</a>
        </li>
        <li>
          <a class="navitem" href="/car_rent/#contact"> Contact</a>
        </li>
      </ul>
      
      <div class="right">
        <?php
        if (isset($_COOKIE['user_data'])) {
          $user_data = unserialize($_COOKIE['user_data']);
            echo ' <div class="right-p"><img src="'. $user_data['user_img'].' "alt=""></div>';
            echo '<div class="right-contain">';
            echo '<a href="/car_rent/user.php" class="navItem">profile</a>';
            echo '<a href="/car_rent/user.php#history" class="navItem">HISTORY</a>';

            if ($user_data['admin'] == 'yehh') {
                echo '<a href="/car_rent/admin.php" class="navItem">ADMIN</a>';
            }
            echo '<a href="/car_rent/logout.php" class="navItem">LOGOUT</a>';

            echo '</div>';

        } else {
            echo '<a href="/car_rent/register.php" class="navItem lore" style="color: black;">REGISTER</a>';
            echo '<a href="/car_rent/login.php" class="navItem lore" style="color: lightseagreen;">LOGIN</a>';
        }?>
      </div>
        
</nav>