
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SwiftComm | Signup</title>
  <link rel="stylesheet" href="profile.css" />
  <style>
    .profile-upload {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      cursor: pointer;
    }
    .image-preview {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      border: 2px dashed #007bff;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      background-color: #f0f0f0;
    }
    .image-preview img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: none;
      border-radius: 50%;
    }
  </style>
</head>
<body>
 
  <nav>
    <h1>SwiftComm</h1>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="#">Features</a></li>
      <li><a href="#">About</a></li>
      <li><a href="contact.php">Contact</a></li>
    </ul>
  </nav>

  <div class="container">
    <!-- Right form panel -->
    <div class="right-panel">
      <form action="#" method="POST" enctype="multipart/form-data" class="form-box">
        <!-- Profile Image Upload -->
        <label for="profileImage" class="profile-upload">
          <input type="file" id="profileImage" accept="image/*" style="display:none;" onchange="previewImage(event)">
          <div class="image-preview" id="preview">
            <span id="uploadText">Upload</span>
            <img id="previewImg" src="" alt="Preview Image">
          </div>
        </label>

        <span class="highlight"><h2>Welcome to SwiftComm</h2></span>
        <p>Access your chat from a computer anytime, anyplace.</p>

        <label>Username</label>
        <input type="text" name="username" placeholder="Enter username" required>

        <label>Enter Your Mobile Number</label>
        <div class="mobile-row">
          <select>
            <option value="+1">(+1)</option>
            <option value="+91">(+91)</option>
            <option value="+44">(+44)</option>
          </select>
          <input type="tel" name="mobile" placeholder="Mobile number" required>
        </div>

        <button type="submit">Send Verification Code</button>
        <p class="note">Send an SMS code to verify your number</p>
      </form>
    </div>
  </div>

  <!-- ✅ JavaScript for Image Preview -->
  <script>
    function previewImage(event) {
      const input = event.target;
      const previewImg = document.getElementById('previewImg');
      const uploadText = document.getElementById('uploadText');

      if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
          previewImg.src = e.target.result;
          previewImg.style.display = 'block';
          uploadText.style.display = 'none';
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>

</body>
</html>
