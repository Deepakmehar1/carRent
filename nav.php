<style>
  nav {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    padding: 20px 10px;
    margin: 0px;
    color: #292d2d;
    z-index: 10000;
    transition: 0.6s;
  }
  nav.sticky {
    padding: 10px 10px;
    background: #fff;
    filter: drop-shadow(0px 0px 0.6px black);

  }
  nav ul {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  nav ul li {
    position: relative;
    list-style: none;
  }
  nav ul li a {
    position: relative;
    color: rgb(27, 23, 23);
    text-decoration: none;
    font-size: 18px;
    margin: 0 15px;
    letter-spacing: 2px;
    font-weight: 500px;
  }
  nav ul li a::after {
    content: "";
    width: 0;
    height: 2px;
    background: rgb(42, 135, 124);
    border-radius: 3px;
    position: absolute;
    left: 0;
    bottom: -6px;
    transition: 0.5s;
  }
  nav ul li a:hover::after {
    width: 110%;
  }
 /*  .right {
    display: flex;
    gap: 5px;
    justify-content: space-between;
  } */
  .right .lore{
    text-decoration: none;
    padding: 4px 6px;
    border:.1px solid;
    border-radius: 20px;
  }
  .right-contain .navItem{ text-decoration: none; color:white;    font-size: 24px;}
  .right {
    position: relative;
  }
  .right-contain {
    overflow: hidden;
    position: absolute;
    display: flex;
    right: -2px;
    flex-direction: column;
    height: 0;
    transition: 0.6s;
    padding: 4px;
    top: 40px;
    gap:4px;    border-radius: 8px;
}
  .right:hover > .right-contain {
    background-color: #2b2b2b;
    height: auto;
  }
  .right-p{
    border-radius: 50%;
        background-color: blue;
            height: 32px;
    width: 32px;
    text-align: center;
  }
  .right-p img{
    border-radius: 50%;
    object-fit: contain;
    height: 32px;
    width: 32px;
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
<script>
      function stick_navigatio() {
        window.addEventListener("scroll", function () {
          var nav = this.document.querySelector("nav");
          nav.classList.toggle("sticky", window.scrollY > 0);
        });
      }
      stick_navigatio();
</script>