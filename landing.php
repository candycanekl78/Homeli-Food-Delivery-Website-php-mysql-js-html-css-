<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Welcome - Homeli</title>
    <link rel="stylesheet" href="styles-landing.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>
  <header>
    <div class="logo">Homeli</div>
    <nav>
      <a href="./index.html" class="active">Home</a>
      <a href="./main/menu/menu.php">Menu</a>
      <a href="./main/about us/about.html">About Us</a>
      <a href="#">Contact Us</a>
    </nav>
      <div class="auth-buttons">
  
        <a href="./main/login/login.php"><button class="log-in">Log in</button></a>
    </div>
  
  </header>
  <section class="hero">
    <div class="content">
      <div class="search">
        <input type="text" placeholder="Search">
      </div>
      <br><br>
      <h1>Fastest Delivery & Easy Pickup.</h1>
      <p>Order any meal at any time and we will deliver it directly to your home.</p>
      <a href="./main/menu/index.html"><button class="order-btn">Make an order</button></a>
      <br>
      <a href="#" class="specials">Specials for lunch →</a>
    </div>
    <div class="image">
      <img <img src="./assets/images/main.png" alt="Onam Sadhya Meal" style="vertical-align: inherit; float: right;">

    </div>
  </section>
  <section class="food-inspiration">
    <h2>Inspiration for your first order</h2>
    <div class="food-container">
      <div class="food-item">
        <img src="./assets/images/pizza.avif" alt="Pizza">
        <p>Pizza</p>
      </div>
      <div class="food-item">
        <img src="./assets/images/biriyani.avif" alt="Biryani">
        <p>Biryani</p>
      </div>
      <div class="food-item">
        <img src="./assets/images/burger.avif" alt="Burger">
        <a href=""><p>Burger</p></a>
      </div>
      <div class="food-item">
        <img src="./assets/images/cake.avif" alt="Cake">
        <p>Cake</p>
      </div>
      <div class="food-item">
        <img src="./assets/images/chicken.avif" alt="Chicken">
        <p>Chicken</p>
      </div>
      <div class="food-item">
        <img src="./assets/images/sandwich.avif" alt="Sandwich">
        <p>Sandwich</p>
      </div>
    </div>
  </section>
  <footer>
    <div class="footer-container">
        <div class="footer-column brand">
          
            <h2><span class="highlight">Home</span>li</h2>
            <p><i class="fa-regular fa-envelope"></i> info@foodexpress.com</p>
            <p><i class="fa-solid fa-phone"></i> 910 468 587 1235</p>
            <p><i class="fa-solid fa-location-dot"></i> Avenue 6th floor, NYC</p>
        </div>

        <div class="footer-column">
            <h3>Our Menu</h3>
            <ul>
                <li><a href="#" class="active">Breakfast</a></li>
                <li><a href="#" class="active">Lunch</a></li>
                <li><a href="#" class="active">Dinner</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h3>Information</h3>
            <ul>
                <li><a href="./main/about us/about.html" class="active">About Us</a></li>
                <li><a href="#" class="active">Testimonials</a></li>
                <li><a href="#" class="active">Blog</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h3>Useful Links</h3>
            <ul>
                <li><a href="#" class="active">Services</a></li>
                <li><a href="#" class="active">Help & Support</a></li>
                <li><a href="#" class="active">Terms & Conditions</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h3>Social</h3>
            <ul class="social-icons">
                <li><i class="fa-brands fa-facebook"></i> Facebook</li>
                <li><i class="fa-brands fa-instagram"></i> Instagram</li>
                <li><i class="fa-brands fa-youtube"></i> Youtube</li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© Copyright 2022. Powered by ccDevelopers</p>
    </div>
</footer>
  
</body>
</html>