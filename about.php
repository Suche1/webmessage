<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us - SwiftComm</title>
  <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
  }
  
  body {
    background: url('bgimg.png');
    background-size: cover;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }
  
  header h1 {
    color:#0a74da;
  }
  
  nav {
    background: #0a74da;
    padding: 1rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    
  }
  
  nav h1 {
    font-size: 1.5rem;
    color: #fff;
  }
  
  nav ul {
    list-style: none;
    display: flex;
    gap: 1.5rem;
  }
  
  nav ul li a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
  }
  
  nav ul li a:hover {
    text-decoration: underline;
  }
    .container {
      max-width: 900px;
      margin: auto;
      padding: 40px 20px;
      
    }
    .container h1{
      
      margin-bottom:40px ;
    }

    h1 {
      text-align: center;
      color: #0a74da;
    }
    h2 {
      margin-bottom: 40px;
      color: #0a74da;
    }

    .about {
      background: #2e8dd1;
      color: #fff;
      padding: 20px;
      margin-bottom: 40px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .team {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }

    .member {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      width: 260px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      text-align: center;
    }

    .member img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 15px;
    }

    .member h3 {
      margin: 10px 0 5px;
      color: #444;
    }

    .member p {
      font-size: 14px;
      color: #666;
    }
    footer {
  background: #0a74da;;
  color: #ccc;
  padding: 2rem;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 2rem;
}

footer h3 {
  color: white;
  margin-bottom: 1rem;
}

footer ul {
  list-style: none;
  padding: 0;
}

footer ul li {
  margin-bottom: 0.5rem;
}

footer ul li a {
  color: #ccc;
  text-decoration: none;
  transition: color 0.3s ease;
}

footer ul li a:hover {
  color: #fff;
}

footer p {
  font-size: 0.9rem;
  line-height: 1.5;
}

.footer-bottom {
  text-align: center;
  padding-top: 1rem;
  border-top: 1px solid #333;
  font-size: 0.9rem;
}

.social-icons {
  margin-top: 1rem;
}

.social-icons a {
  color: #ccc;
  margin: 0 0.5rem;
  font-size: 1.2rem;
  transition: color 0.3s;
}

.social-icons a:hover {
  color: #fff;
}

@media (max-width: 768px) {
  nav ul {
    flex-direction: column;
    margin-top: 1rem;
    gap: 0.8rem;
  }

  .description {
    margin: 1rem;
  }
}

  </style>
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
  <div class="container">
    <h1>About SwiftComm</h1>
    <div class="about">
      <p>
        SwiftComm is a modern and secure chat platform built to connect people in real time, whether it's for casual conversations or professional communication. With a focus on speed, privacy, and use-friendly design, SwiftComm ensures seamless communication for users around the globe.
      </p>
      <p>
        Our mission is to make online conversations more engaging and reliable. We are constantly working on new features, enhancements, and community-driven updates to improve your chatting experience.
      </p>
    </div>

    <h2 style="text-align:center; color:#333;">Meet Our Team</h2>
    <div class="team">
      <div class="member">
        <img src="https://via.placeholder.com/100" alt="Team Member 1" />
        <h3>ABC</h3>
        <p>Frontend Developer & UI Designer</p>
        <p>Passionate about creating intuitive user interfaces and smooth user experiences.</p>
      </div>

      <div class="member">
        <img src="https://via.placeholder.com/100" alt="Team Member 2" />
        <h3>XYZ</h3>
        <p>Backend Developer</p>
        <p>Handles the logic, security, and real-time messaging system of SwiftComm.</p>
      </div>
    </div>
  </div>
  <footer>
    <div>
      <h3>Contact Us</h3>
      <ul>
        <li>+123456789</li>
        <li>pansucheta@gmail.com</li>
        <li>126, Ram Bagan, Kolkata, West Bengal 700006</li>
      </ul>
    </div>
    <div>
      <h3>Our Services</h3>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Features</a></li>
      </ul>
    </div>
    <div>
      <h3>Quick Link</h3>
      <ul>
        <li><a href="#">FAQ</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms and Conditions</a></li>
      </ul>
    </div>
    <div>
      <h3>Footer</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonumy eirmod tempor</p>
    </div>
    <div class="footer-bottom" style="grid-column: 1 / -1;">
      <p>Copyright ©2020 All rights reserved | Block is made with ❤️ by 
        <a href="#" style="color: #4ab3ff;">SUcheta Pan and Supratim Das</a></p>
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>
      </div>
    </div>
  </footer>


</body>
</html>