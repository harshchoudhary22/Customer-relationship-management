<?php
session_start();
include("../config.php");

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

$admin_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $query = "INSERT INTO chat_messages (user_id, message, support_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isi", $admin_id, $message, $admin_id);
    $stmt->execute();
    $stmt->close();
}

$query = "SELECT * FROM chat_messages ORDER BY created_at";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Live Chat Support</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="bg-dark">
<div class="container mt-4">
    <h2 class="text-light">Admin Live Chat Support</h2>
    <div class="card">
        <div class="card-body">
            <div class="chat-box" style="height: 300px; overflow-y: scroll; background-color: #343a40; color: white;">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="chat-message">
                        <strong><?php echo ($row['user_id'] == $admin_id) ? 'Admin' : 'User'; ?>:</strong>
                        <span><?php echo $row['message']; ?></span>
                        <small class="text-muted"><?php echo $row['created_at']; ?></small>
                    </div>
                <?php } ?>
            </div>
            <form method="post" action="live_chat.php">
                <div class="form-group">
                    <label for="message" class="text-light">Message</label>
                    <textarea class="form-control" id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Send Message</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>


