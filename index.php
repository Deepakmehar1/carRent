<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Home</title>
    <!-- Add your CSS link here -->
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="index.css"/>

</head>
<body>
<?php
    include('nav.php');
include('trand.php');
?>
<!-- Hero Section -->

<section class="hero">
    <div class="hero-left">
        <h1>Welcome to Our Car Rental Service</h1>
        <p style="opacity: 0.9;">Find the perfect car for your next adventure!</p>
        <a href="/car_rent/allcars.php" class="btn">Explore Now</a>
    </div>
    <!-- Add hero image or video here -->
    <div class="hero-right">
        <img class="active hr_img" src="./img/car1.png" alt=""> 
        <img class="hr_img"src="./img/car2.png" alt=""> 
        <img class="hr_img"src="./img/car3.png" alt=""> 
    </div>
</section>


<!-- Trending Cars Section -->
<section id="trending-cars">
    
    <h2>Trending Cars for Rent</h2>
    <div class="trand_container">
        <?php foreach ($rentals as $rental): ?>
            <a href=<?php echo "/car_rent/car.php?car_id=" . $rental['car_id'];?> class="tcar">
                <div class="blur"></div>
                <img src="<?php echo $rental['car_img'];  ?>" alt="">
                <div class="car_deta">
                    <h2>carId: <?php echo $rental['car_id']; ?></h2>
                    <h2>make: <?php echo $rental['make']; ?></h2>
                    <h2>model: <?php echo $rental['model']; ?></h2>
                    <h2>price: <?php echo $rental['rental_price']; ?></h2>
                </div>
            </a>     
        <?php endforeach; ?>
        <a href="/car_rent/allcars.php"class="tcar">
            <img src="./img/car2.png" alt="">
                <div class="blur"></div><h1 class="car_deta">All cars</h1></a>
    </div>  
</section>

<!-- Slider for Most Rented Cars -->
<section class="most-rented">
   
    <h2>Most Rented Cars</h2>
    <!-- Add slider for most rented cars here -->
    <div class="high_rate_container">
        <?php foreach ($topcars as $topcar): ?>
            <a href=<?php echo "/car_rent/car.php?car_id=" . $topcar['car_id'];?> class="hrcar">
                <img src="<?php echo
            $topcar['car_img'];
            ?>" alt="">
            <div class="blur"></div>
                <div class="car_deta">
                    <h2>carId: <?php echo $topcar['car_id']; ?></h2>
                    <h2>make: <?php echo $topcar['make']; ?></h2>
                    <h2>model: <?php echo $topcar['model']; ?></h2>
                    <h2>price: <?php echo $topcar['rental_price']; ?></h2>
                </div>
            </a>     
        <?php endforeach; ?>
        <a href="/car_rent/allcars.php" class="hrcar"><img src="./img/car2.png" alt=""><h1 class="car_deta">All Cars</h1></a>
    </div>  
</section>

<!-- Testimonial Slider -->
<section class="testimonials" id="testimonial">
    <h2>What Our Customers Say</h2>
    <!-- Add testimonial slider here -->
    <?php include('testimonial.php'); ?>
</section>

<!-- Small Contact Section -->
<section id="contact" class="contact">
    
    <div class="cleft">
        <h2>social media</h2>
        <div class="social">
            <a href="#"><img src="./img/whatsapp.png" alt=""></a>
					<a href="#"><img src="./img/twitter.png" alt=""></a>
					<a href="#"><img src="./img/linkedin.png" alt=""></a>
					<a href="#"><img src="./img/instagram.png" alt=""></a>
        </div>
        <hr style="    width: 200px;
    transform: rotate(90deg);">
    </div>
    <div class="cright">
   
    <!-- Add contact information here -->
     
    <div class="edit" >
   
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
    
    <h2>Frequently Asked Questions</h2>
    <!-- Add FAQ or Q&A content here -->
    <h3 onclick="toggleAnswer('q1')">Q: How do I make a reservation for a car?</h3>
    <p class="answer" id="q1">A: Making a reservation is simple! Just browse through our available cars, select the one you'd like to rent, choose your desired rental dates, and fill out the reservation form. Once you've submitted the form, our team will review your request and confirm the reservation as soon as possible.</p>

    <h3 onclick="toggleAnswer('q2')">Q: What documents do I need to provide for car rental?</h3>
    <p class="answer" id="q2">A: To rent a car, you'll typically need to provide a valid driver's license, proof of insurance, and a major credit card. Additionally, some rental locations may require additional identification or documentation, so it's always a good idea to check the specific requirements before booking.</p>

    <h3 onclick="toggleAnswer('q3')">Q: Can I cancel or modify my reservation?</h3>
    <p class="answer" id="q3">A: Yes, you can cancel or modify your reservation, subject to our cancellation policy. We understand that plans can change, so we offer flexible options for cancellations and modifications. Simply contact our customer service team with your reservation details, and we'll be happy to assist you.</p>
    
</section>

<!-- footer -->
<?php
          include('footer.php');
?>

<!-- Add your JavaScript scripts here -->
<script src="script.js"></script>
<script>
setInterval(showNextimg, 3000);
</script>
</body>
</html>
