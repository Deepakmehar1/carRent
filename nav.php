<nav>
    <div class="left">logo</div>
    <div class="middle">
        <a href="/car_rent/home.php" class="navItem">HOME</a>
        <a href="/car_rent/allcars.php" class="navItem">CARS</a>
        <a href="/car_rent/about.php" class="navItem">ABOUT</a>
        <a href="/car_rent/contact.php" class="navItem">CONTACT</a>
    </div>
    <div class="right">profile,history,logout</div>
</nav>
<style>
    nav{
        height: 40px;
        /* width: 100%; */
        background-color: red;
        border-radius:16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 5px;
    }
      nav  .middle a{text-decoration: none;}
      nav  .middle{
            display: flex;
        align-items: center;
        justify-content: space-between;
        gap:5px;
        }
</style>