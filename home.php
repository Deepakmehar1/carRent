<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Home</title>
    <!-- Add your CSS link here -->
</head>
<body>

<!-- Hero Section -->
<section class="hero">
    <h1>Welcome to Our Car Rental Service</h1>
    <!-- Add hero image or video here -->
    <p>Find the perfect car for your next adventure!</p>
    <a href="#trending-cars" class="btn">Explore Now</a>
</section>

<!-- Trending Cars Section -->
<section id="trending-cars">
    <h2>Trending Cars for Rent</h2>
    <!-- Add trending cars here -->
    
</section>

<!-- Slider for Most Rented Cars -->
<section class="most-rented">
    <h2>Most Rented Cars</h2>
    <!-- Add slider for most rented cars here -->
</section>

<!-- Testimonial Slider -->
<section class="testimonials">
    <h2>What Our Customers Say</h2>
    <!-- Add testimonial slider here -->
    <div class="testimonial">
        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget magna in libero pharetra placerat. Etiam at eros ac justo lobortis fermentum."</p>
        <p>- John Doe</p>
    </div>
    <div class="testimonial">
        <p>"Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam auctor magna sed risus semper, nec ultricies elit fermentum."</p>
        <p>- Jane Smith</p>
    </div>
</section>

<!-- Small Contact Section -->
<section class="contact">
    <h2>Contact Us</h2>
    <!-- Add contact information here -->
     <form action="addonfunc/cmail.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br><br>
        <input type="submit" value="Submit">
    </form>
</section>

<!-- #FAQ or Q&A Section -->
<section class="faq">
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

<!-- Add your JavaScript scripts here -->

</body>
</html>
