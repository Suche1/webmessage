<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="login-bg">
    <nav>
        <h1>Messaging App</h1>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="#">Features</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </nav>
    
      
  <div class="login-box">
    <h2>Login</h2>
    <form action="#" method="post">
      <div class="input-group">
        <span class="icon"><i class="fa-solid fa-user"></i></span>
        <input type="text" placeholder="Username/Email" required>
      </div>
      <div class="input-group">
        <span class="icon"><i class="fa-solid fa-lock"></i> </span>
        <input type="password" placeholder="Password" required>
      </div>
      <label class="remember">
        <input type="checkbox"> Remember Me
      </label>
      <button class="login-btn" type="submit">Login</button>
      <button class="forgot-btn" type="button">Forgot Password</button>
    </form>
  </div>
</body>
</html>
