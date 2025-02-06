<?php
session_start();
include("../config.php");
include("../admin/checklogin.php");
check_login();

$page_title = "Live Chat Support";
include("../includes/header.php");

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $query = "INSERT INTO chat_messages (user_id, message, is_admin) VALUES (?, ?, 0)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $user_id, $message);
    $stmt->execute();
    $stmt->close();
}

$query = "SELECT * FROM chat_messages ORDER BY created_at";
$result = $conn->query($query);
?>

<div class="container mt-4">
    <h2>Live Chat Support</h2>
    <div class="card">
        <div class="card-body">
            <div class="chat-box">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="chat-message">
                        <strong><?php echo ($row['is_admin'] == 1) ? 'Admin' : 'You'; ?>:</strong>
                        <span><?php echo $row['message']; ?></span>
                        <small class="text-muted"><?php echo $row['created_at']; ?></small>
                    </div>
                <?php } ?>
            </div>
            <form method="post" action="live_chat.php">
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Send Message</button>
            </form>
        </div>
    </div>
</div>

<?php 
