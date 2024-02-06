<?php 
session_start();

include('navbar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Rent Houses</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    header {
      background-color: #333;
      color: #fff;
      padding: 20px;
      text-align: center;
    }

    .container {
      width: 80%;
      margin: 20px auto;
    }

    .content {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: white;
      text-align: center;
    }

    p {
      line-height: 1.6;
    }

    .about-image {
      display: block;
      margin: 20px auto;
      max-width: 100%;
      height: auto;
      border-radius: 5px;
    }

    footer {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 10px 0;
      position: absolute;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>
<body>
  <header>
    <h1>About Us</h1>
  </header>
  <div class="container">
    <div class="content">
      <h2>Welcome to selling Houses!</h2>
      <p>
        At Rent Houses, we aim to provide a seamless selling experience for tenants and landlords alike. Our platform connects renters with their ideal homes while assisting property owners in finding suitable tenants.
      </p>
      <img src="images/house.jpg" alt="House Image" class="about-image">
      <h2>Our Mission</h2>
      <p>
        Our mission is to simplify the process of selling properties by offering a user-friendly interface for searching, listing, and managing selling properties. We strive to create a reliable and transparent platform for all stakeholders involved in the rental process.
      </p>
  
    </div>
  </div>


  <footer>
    &copy; <?php echo date("Y"); ?> Rent Houses. All Rights Reserved.
  </footer>  </html>
