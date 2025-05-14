<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact Us - SwiftComm</title>
  <link rel="stylesheet" href="contact.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
  <nav>
    <h1>SwiftComm</h1>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="features.php">Features</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="contact.php">Contact</a></li>
    </ul>
  </nav>


  <!-- Hero Section -->
  <section class="hero">
    <h1>Contact Us</h1>
    <p>We're here to help. Get in touch with us for support or queries.</p>
  </section>

  <!-- Contact Info and Form -->
  <section class="contact-section">
    <div class="contact-info">
      <h2>Get In Touch</h2>
      <p>We would love to hear from you. Here's how you can reach us.</p>

      <div class="info-block">
        <strong>Phone:</strong>
        <p>+91 5678 1234</p>
      </div>
      <div class="info-block">
        <strong>Email:</strong>
        <p>contact@SwiftComm.com</p>
      </div>
      <div class="info-block">
        <strong>Address:</strong>
        <p>Kolkata, West Bengal, India</p>
      </div>
      <div class="info-block">
        <strong>Instagram:</strong>
        <p>@SwiftComm</p>
      </div>

      <div class="social-icons">
      <a href="#"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-youtube"></i></a>
        
      </div>
    </div>

    <div class="contact-form">
      <form action="contact.php" method="post">
        <div class="form-row">
          <input type="email" name="email" placeholder="Email" required>
          <input type="text" name="name" placeholder="Name" required>
        </div>
        <input type="text" name="phone" placeholder="Phone" required>
        <textarea name="message" placeholder="Message" required></textarea>
        <button type="submit">SUBMIT</button>
      </form>
    </div>
  </section>

  <!-- Google Map -->
  <section class="map">
    <iframe src="https://maps.google.com/maps?q=kolkata&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="400" style="border:0;" allowfullscreen loading="lazy"></iframe>
  </section>

  <footer class="site-footer">
    <div class="footer-container">
      <div class="footer-section">
        <h3>Contact Us</h3>
        <p>+123456789</p>
        <p>pansucheta@gmail.com</p>
        <p>126, Ram Bagan, Kolkata,<br>West Bengal 700006</p>
      </div>
  
      <div class="footer-section">
        <h3>Our Services</h3>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Features</a></li>
        </ul>
      </div>
  
      <div class="footer-section">
        <h3>Quick Link</h3>
        <ul>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Terms and Conditions</a></li>
        </ul>
      </div>
  
      <div class="footer-section">
        <h3>Footer</h3>
        <p>Lorem ipsum dolor sit amet,<br>consectetur adipiscing elit,<br>sed diam nonumy eirmod tempor</p>
      </div>
    </div>
  
    <hr>
  
    <div class="footer-bottom" style="grid-column: 1 / -1;">
      <p>&copy; 2020 All rights reserved | Block is made with ❤️ by Sucheta Pan and Supratim Das</p>
      <div class="footer-social">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>
      </div>
    </div>
  </footer>
  
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Replace with your DB credentials
  $host = "localhost";
  $username = "root";
  $password = "Sucheta@123";
  $dbname = "swiftcomm";

  // Connect
  $conn = new mysqli($host, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Safely get form data
  $name = $_POST['name'] ?? '';
  $email = $_POST['email'] ?? '';
  $phone = $_POST['phone'] ?? '';
  $message = $_POST['message'] ?? '';

  // Insert
  $stmt = $conn->prepare("INSERT INTO contact(name, email, phone, message) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $email, $phone, $message);

  if ($stmt->execute()) {
    echo "<script>alert('Message sent successfully!');</script>";
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>
