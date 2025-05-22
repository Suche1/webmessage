<?php 
session_start();
require_once "connection_database.php";

if (!isset($_SESSION['user_id'])) {
    echo "User not logged in.";
    exit();
}

$sender_id = $_SESSION['user_id'];

// Fetch username and profile_image for current user
$stmt = $conn->prepare("SELECT username, profile_image FROM users WHERE id = ?");
$stmt->bind_param("i", $sender_id);
$stmt->execute();
$userInfoRes = $stmt->get_result();
if ($userInfoRes->num_rows === 1) {
    $userInfo = $userInfoRes->fetch_assoc();
    $currentUsername = $userInfo['username'];
    // Use a default avatar if profile_image is empty or null
    $currentProfileImage = !empty($userInfo['profile_image']) ? $userInfo['profile_image'] : 'user_images/default.png';
} else {
    $currentUsername = "Unknown User";
    $currentProfileImage = "user_images/default.png";
}
$stmt->close();

$contacts = [];
$stmt = $conn->prepare("SELECT id, username FROM users WHERE id != ?");
$stmt->bind_param("i", $sender_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $contacts[] = $row;
}
$stmt->close();

$userResult = $conn->query("SELECT email FROM users WHERE id = $sender_id");
$userRow = $userResult->fetch_assoc();
$email = $userRow['email'] ?? '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle sending message or fetching new messages via AJAX
    if (isset($_POST['action']) && $_POST['action'] === 'fetch') {
        // Fetch new messages for conversation (polling)
        $receiver_username = trim($_POST['receiver'] ?? '');
        if (empty($receiver_username)) {
            echo json_encode(['error' => 'Receiver not specified']);
            exit();
        }

        // Get receiver ID
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $receiver_username);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows !== 1) {
            echo json_encode(['error' => 'Receiver not found']);
            exit();
        }
        $receiver_row = $res->fetch_assoc();
        $receiver_id = $receiver_row['id'];

        // Find conversation
        $stmt = $conn->prepare("SELECT id FROM conversations WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) LIMIT 1");
        $stmt->bind_param("iiii", $sender_id, $receiver_id, $receiver_id, $sender_id);
        $stmt->execute();
        $conv_res = $stmt->get_result();
        if ($conv_res->num_rows === 0) {
            echo json_encode(['messages' => []]);
            exit();
        }
        $conv = $conv_res->fetch_assoc();
        $conv_id = $conv['id'];

        // Fetch messages
        $sql = "
            SELECT messages.sender_id, messages.message, 
                   DATE_FORMAT(messages.created_at, '%M %e at %l:%i %p') AS time2,
                   users.username
            FROM messages
            JOIN users ON messages.sender_id = users.id
            WHERE messages.conversation_id = ?
            ORDER BY messages.created_at ASC
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $conv_id);
        $stmt->execute();
        $messages_result = $stmt->get_result();
        $messages = [];
        while ($row = $messages_result->fetch_assoc()) {
            $messages[] = $row;
        }
        echo json_encode(['messages' => $messages, 'current_user_id' => $sender_id]);
        exit();
    }

    // Normal POST send message
    $receiver_username = trim($_POST['receiver'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($receiver_username) || empty($message)) {
        echo "Missing receiver or message.";
        exit();
    }

    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $receiver_username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows !== 1) {
        echo "Receiver not found.";
        exit();
    }
    $receiver_row = $result->fetch_assoc();
    $receiver_id = $receiver_row['id'];

    // Find or create conversation
    $stmt = $conn->prepare("SELECT id FROM conversations WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) LIMIT 1");
    $stmt->bind_param("iiii", $sender_id, $receiver_id, $receiver_id, $sender_id);
    $stmt->execute();
    $conv_res = $stmt->get_result();

    if ($conv_res->num_rows === 0) {
        // Create conversation
        $stmt = $conn->prepare("INSERT INTO conversations (sender_id, receiver_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $sender_id, $receiver_id);
        $stmt->execute();
        $conversation_id = $stmt->insert_id;
    } else {
        $conv = $conv_res->fetch_assoc();
        $conversation_id = $conv['id'];
    }

    $stmt = $conn->prepare("INSERT INTO messages (conversation_id, sender_id, message, email, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("iiss", $conversation_id, $sender_id, $message, $email);
    if ($stmt->execute()) {
        echo "Message sent successfully.";
    } else {
        echo "Failed to send message.";
    }
    $stmt->close();
    $conn->close();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Chat | SwiftComm</title>
  <style>
    /* Your existing styles unchanged */
    .messages {
      flex: 1;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      gap: 1rem;
      padding: 1rem;
      border: 1px solid #1976d2;
      border-radius: 10px;
      background-color: #f0f7ff;
      height: 400px;
    }
    .message {
      max-width: 60%;
      padding: 0.5rem 1rem;
      border-radius: 15px;
      color: #1976d2;
      background-color: #e3f2fd;
      word-wrap: break-word;
    }
    .message.self {
      background-color: #bbdefb;
      align-self: flex-end;
    }
    .message .time {
      font-size: 0.7rem;
      color: #555;
      margin-top: 2px;
      text-align: right;
    }
    /* New user header styles */
    .user-header {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 20px;
      background: #007bff;
      color: white;
    }
    .user-header img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid white;
      box-shadow: 0 0 5px rgba(255, 255, 255, 0.7);
    }
    .user-header div {
      font-size: 1.2rem;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <div class="logo">SwiftComm</div>
    <div class="nav-links">
      <a href="#">Home</a>
      <a href="#">Features</a>
      <a href="#">About</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <!-- Added User Header -->
  <div class="user-header">
    <img src="<?php echo htmlspecialchars($currentProfileImage); ?>" alt="Profile Picture" />
    <div><?php echo htmlspecialchars($currentUsername); ?></div>
  </div>

  <div class="layout" style="height: calc(100vh - 60px); display: flex;">
    <div class="sidebar" style="width: 250px; border-right: 1px solid #ddd; padding: 10px;">
      <input type="text" class="search-bar" placeholder="Search a contact" style="width: 100%; padding: 5px; margin-bottom: 10px;" />
      <button class="new-message" style="width: 100%; margin-bottom: 10px;">New Message</button>
      <?php foreach ($contacts as $contact): ?>
        <div class="contact" onclick="selectContact('<?php echo htmlspecialchars($contact['username']); ?>')" style="cursor: pointer; display:flex; align-items:center; gap: 10px; padding: 8px; border-radius: 5px; transition: background 0.2s;">
          <img src="https://api.dicebear.com/6.x/initials/svg?seed=<?php echo urlencode($contact['username']); ?>" width="50" height="50" alt="Avatar" style="border-radius:50%;" />
          <div class="contact-info">
            <strong><?php echo htmlspecialchars($contact['username']); ?></strong><br />
            <small style="color: #555;">Click to chat</small>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="chat-area" style="display:flex; flex-direction: column; flex: 1; padding: 10px;">
      <div id="messages" class="messages">
        <p style="color:#1976d2;">Select a contact to start chatting</p>
      </div>
      <div class="send-message" style="margin-top:10px; display:flex; gap: 1rem;">
        <input type="text" id="receiverInput" placeholder="Receiver username" style="width: 25%;" />
        <input type="text" id="messageInput" placeholder="Type a message..." style="flex: 1;" />
        <button id="sendBtn">Send</button>
      </div>
    </div>

    <div class="info-panel" style="width: 200px; border-left: 1px solid #ddd; padding: 10px;">
      <div class="info-section">Contact Information<br>Baptiste Durand<br>Product Manager at Castorama</div>
      <div class="info-section">Notes</div>
      <div class="info-section">Shared Files</div>
      <div class="info-section">Favorite Messages</div>
      <div class="info-section">Download Conversation</div>
    </div>
  </div>

<script>
  let currentReceiver = '';

  function selectContact(username) {
    currentReceiver = username;
    document.getElementById("receiverInput").value = username;
    document.getElementById("receiverInput").disabled = true; // prevent changing receiver while chatting
    loadMessages();
  }

  async function loadMessages() {
    if (!currentReceiver) {
      document.getElementById("messages").innerHTML = '<p style="color:#1976d2;">Select a contact to start chatting</p>';
      return;
    }
    try {
      const formData = new URLSearchParams();
      formData.append('action', 'fetch');
      formData.append('receiver', currentReceiver);

      const res = await fetch(window.location.href, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: formData.toString()
      });
      const data = await res.json();

      if (data.error) {
        document.getElementById("messages").innerHTML = `<p style="color:red;">${data.error}</p>`;
        return;
      }

      const messagesDiv = document.getElementById("messages");
      messagesDiv.innerHTML = '';

      if (data.messages.length === 0) {
        messagesDiv.innerHTML = '<p style="color:#1976d2;">No messages yet. Say hi!</p>';
      } else {
        data.messages.forEach(msg => {
          const div = document.createElement('div');
          div.classList.add('message');
          if (msg.sender_id == data.current_user_id) {
            div.classList.add('self');
          }
          div.innerHTML = `
            ${escapeHtml(msg.message)}
            <div class="time">${msg.time2}</div>
          `;
          messagesDiv.appendChild(div);
        });
      }
      messagesDiv.scrollTop = messagesDiv.scrollHeight; // Auto scroll to bottom
    } catch (err) {
      console.error('Error loading messages:', err);
    }
  }

  function escapeHtml(text) {
    return text.replace(/&/g
