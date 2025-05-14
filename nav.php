<nav>
    <h1>Messaging App</h1>
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">Features</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
  </nav>

  

  * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', sans-serif;
}

body {
  background: linear-gradient(to bottom right, #dff3ff, #a3d8f4);
  color: #fff;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
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

