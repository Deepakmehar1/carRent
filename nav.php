<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <nav>
      <div class="left">DEEPAK</div>
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
          <a class="navitem" href="/car_rent/contact.php"> Contact</a>
        </li>
      </ul>
      <div class="right"><?php
        if (isset($_COOKIE['user_data'])) {
            echo '<a href="/car_rent/user.php" class="navItem">profile</a>';
            echo '<a href="/car_rent/rantals.php" class="navItem">HISTORY</a>';
            echo '<a href="/car_rent/logout.php" class="navItem">LOGOUT</a>';

        } else {
            echo '<a href="/car_rent/login.php" class="navItem">LOGIN</a>';
            echo '<a href="/car_rent/register.php" class="navItem">REGISTER</a>';
        }?></div>
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
  </body>
</html>
