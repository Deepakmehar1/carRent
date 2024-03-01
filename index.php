<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Home</title>
    <!-- Add your CSS link here -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    include('nav.php');
include('trand.php');
?>
<!-- Hero Section -->
<style>
    a.btn {
    transform: translateY(32px);
    position: absolute;
    text-decoration: none;
    color: white;
    background: lightseagreen;
    padding: 10px;
    border-radius: 20px;
    }
    .hero{
        height: 60vh;
        position: relative;
    }.hero-left {
        display: inline;
        position: absolute;
        top: 40%;
        left: 10%;
    }h1 {
        font-size: 1.7rem;
        font-weight: 700;
        letter-spacing: -0.3px;
        word-spacing: 3.5px;
    }.hero-right {
        position: absolute;
        width: 50%;
        transform: translate(100%, 50%);
        display: flex;
        justify-content: flex-start;
    }
    .hero-right img{
        margin-right: -20px;
        height: 285px;
        display: none;
    }
    .hero-right img.active {
        display: block;
        transition: all 2s ;
        animation: rlfadeImg 0.8s;
    }@keyframes rlfadeImg {
    from {
      opacity: 0;
      transform:translateX(20px);
    }

    to {
      opacity: 1;
    }
  }
</style>
<section class="hero">
    <div class="hero-left">
        <h1>Welcome to Our Car Rental Service</h1>
        <p style="opacity: 0.9;">Find the perfect car for your next adventure!</p>
        <a href="/car_rent/allcars.php" class="btn">Explore Now</a>
    </div>
    <!-- Add hero image or video here -->
    <div class="hero-right">
        <img class="active" src="./img/car1.png" alt=""> 
        <img src="./img/car2.png" alt=""> 
        <img src="./img/car3.png" alt=""> 
    </div>
</section>
<script>

    const img_items = document . querySelectorAll("img");
    function showNextimg() {
        const itemCount = img_items . length;
        img_items[count].classList.remove("active");
    
        if (count < itemCount - 1) {
        count++;
        } else {
        count = 0;
        }
        img_items[count].classList.add("active");
    }
    
    setInterval(showNextimg, 3000);

</script>

<!-- Trending Cars Section -->
<section id="trending-cars">
    <style>
        section:nth-child(2n) {
    background: #bafffa;
}
        section {
    margin: 50px 0;
}
        .trand_container {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            gap: 32px;
            overflow-x: scroll;
        }.tcar {
            text-decoration:none;
            width: 300px;
            height: 200px;
            position: relative;
            border: 2px solid;
            border-radius: 8px;
            display: flex;
            justify-content: center;
        }
        .tcar img{
            height: 150px;
            align-self: center;
        }
        .tcar .car_deta{
            display: none;
            position: absolute;
            top: 0;
            left: 0;
        }
        .tcar:hover .car_deta{
            display: block;
        }

    </style>
    <h2>Trending Cars for Rent</h2>
    <div class="trand_container">
        <?php foreach ($rentals as $rental): ?>
            <a href=<?php echo "/car_rent/car.php?car_id=" . $rental['car_id'];?> class="tcar">
                <img src="<?php echo
$rental['car_img'];
            ?>" alt="">
                <div class="car_deta">
                    <h3>carId:<?php echo $rental['car_id']; ?></h3>
                    <p>make<?php echo $rental['make']; ?></p>
                    <p>model<?php echo $rental['model']; ?></p>
                    <h2>price<?php echo $rental['rental_price']; ?></h2>
                </div>
            </a>     
        <?php endforeach; ?>
        <div class="tcar"><img src="./img/car2.png" alt=""><div class="car_deta">fgfgd</div></div>
    </div>  
</section>

<!-- Slider for Most Rented Cars -->
<section class="most-rented">
    <style>
        .high_rate_container {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            gap: 32px;
            overflow-x: scroll;
        }.hrcar {
            text-decoration:none;
            width: 300px;
            height: 200px;
            position: relative;
            border: 2px solid black;
            border-radius: 8px;
            display: flex;
            justify-content: center;    padding: 8px;
        }
        .hrcar img{
            height: 150px;
            align-self: center;
        }
        .hrcar .car_deta{
            display: none;
            position: absolute;
            top: 0;
            left: 0;
        }
        .hrcar:hover .car_deta{
            display: block;
        }

    </style>
    <h2>Most Rented Cars</h2>
    <!-- Add slider for most rented cars here -->
    <div class="high_rate_container">
        <?php foreach ($topcars as $topcar): ?>
            <a href=<?php echo "/car_rent/car.php?car_id=" . $topcar['car_id'];?> class="hrcar">
                <img src="<?php echo
            $topcar['car_img'];
            ?>" alt="">
                <div class="car_deta">
                    <h3>carId:<?php echo $topcar['car_id']; ?></h3>
                    <p>make<?php echo $topcar['make']; ?></p>
                    <p>model<?php echo $topcar['model']; ?></p>
                    <h2>price<?php echo $topcar['rental_price']; ?></h2>
                </div>
            </a>     
        <?php endforeach; ?>
        <a href="/car_rent/allcars.php" class="hrcar"><img src="./img/car2.png" alt=""><div class="car_deta">fgfgd</div></a>
    </div>  
</section>

<!-- Testimonial Slider -->
<section class="testimonials" id="testimonial">
    <h2>What Our Customers Say</h2>
    <!-- Add testimonial slider here -->
    <?php
                    include('testimonial.php');
?>
</section>

<!-- Small Contact Section -->
<section id="contact" class="contact">
    <style>
        .contact{
            display:flex;justify-content: space-evenly;
        }.cright {
position:relative;

        }.cleft {
            position:relative;display: flex;
    align-items: center;
        }.social {
    position: absolute;
    display: flex;
    flex-direction: column;
    left: 40%;
   
    gap: 5px;
}.social a {
    width: 35px;
    height: 35px;
    background: #2b2b2b;
    text-align: center;
} .cleft h2   {transform: rotate(90deg);
    position: relative;
    font-size:2rem;
       left: -15%;}
    </style>
    <div class="cleft">
        <h2>social media</h2>
        <div class="social">
            <a href="">i</a>
            <a href="">i</a>
            <a href="">i</a>
            <a href="">i</a>
        </div>
        <hr style="    width: 200px;
    transform: rotate(90deg);">
    </div>
    <div class="cright">
   
    <!-- Add contact information here -->
     
    <div class="edit" >
    <style>.edit {
  
  background: 
#98c3c0
;
  
 
  
   padding: 40px;
 
  
transform: scale(.8);

}.edit h5 {
  font-size: 2vmax;
  line-height: 0;
}

.edit .inputs {
  overflow: hidden;
}
.edit input,.edit textarea{
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
        <h5>Contact Us</h5>
        
        <form method="post" action="addonfunc/cmail.php" class="inputs">
          <input type="text" placeholder="name" id="name" name="name" value="<?php if (isset($_COOKIE['user_data'])) {
              echo $user_data['username'];
          } ?>" required/>
          <br />
          <input type="email" placeholder="Email" id="email" name="email" value="<?php if (isset($_COOKIE['user_data'])) {
              echo $user_data['email'];
          } ?>" required/>
          <br />
          <textarea id="message" name="message" rows="4" required placeholder="message" ></textarea>
          <br /><br />
  
         
          <input type="submit" value="Connect">
        </form>

        
    </div>
</div>
</section>

<!-- #FAQ or Q&A Section -->
<section class="faq" id="faq">
    <style>
        .answer {
            display: none;
        }
    </style>
    <h2>Frequently Asked Questions</h2>
    <!-- Add FAQ or Q&A content here -->
    <h3 onclick="toggleAnswer('q1')">Q: How do I make a reservation for a car?</h3>
    <p class="answer" id="q1">A: Making a reservation is simple! Just browse through our available cars, select the one you'd like to rent, choose your desired rental dates, and fill out the reservation form. Once you've submitted the form, our team will review your request and confirm the reservation as soon as possible.</p>

    <h3 onclick="toggleAnswer('q2')">Q: What documents do I need to provide for car rental?</h3>
    <p class="answer" id="q2">A: To rent a car, you'll typically need to provide a valid driver's license, proof of insurance, and a major credit card. Additionally, some rental locations may require additional identification or documentation, so it's always a good idea to check the specific requirements before booking.</p>

    <h3 onclick="toggleAnswer('q3')">Q: Can I cancel or modify my reservation?</h3>
    <p class="answer" id="q3">A: Yes, you can cancel or modify your reservation, subject to our cancellation policy. We understand that plans can change, so we offer flexible options for cancellations and modifications. Simply contact our customer service team with your reservation details, and we'll be happy to assist you.</p>
    <script>
        function toggleAnswer(id) {
            var answer = document.getElementById(id);
            if (answer.style.display === "none") {
                answer.style.display = "block";
            } else {
                answer.style.display = "none";
            }
        }
    </script>
</section>

<!-- footer -->
<?php
          include('footer.php');
?>

<!-- Add your JavaScript scripts here -->


</body>
</html>
