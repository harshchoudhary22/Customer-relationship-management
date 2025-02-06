<?php
session_start();
include("../config.php");
include("checklogin.php");
check_login();

$page_title = "Manage Notifications";
include("../includes/header.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $notification = $_POST['notification'];
    $query = "INSERT INTO notifications (message) VALUES (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $notification);
    $stmt->execute();
    $stmt->close();
}

// Fetch notifications
$query = "SELECT * FROM notifications ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<div class="container mt-4">
    <h2>Manage Notifications</h2>
    <div class="card">
        <div class="card-body">
            <form method="post" action="manage_notifications.php">
                <div class="form-group">
                    <label for="notification">New Notification</label>
                    <textarea class="form-control" id="notification" name="notification" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Notification</button>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Previous Notifications</h5>
            <ul class="list-group">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <li class="list-group-item"><?php echo $row['message']; ?> <span class="badge bg-secondary"><?php echo $row['created_at']; ?></span></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
