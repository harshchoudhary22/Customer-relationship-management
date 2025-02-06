<?php
session_start();
include('../config.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    header('Location: login.php');
    exit();
}

$page_title = "View Ticket";
include '../includes/header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tickets WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $ticket = mysqli_fetch_assoc($result);
} else {
    header('Location: list_tickets.php');
    exit();
}
?>

<div class="container mt-4">
    <h1>View Ticket</h1>
    <div class="card">
        <div class="card-body">
            <h3><?php echo $ticket['subject']; ?></h3>
            <p><?php echo $ticket['description']; ?></p>
            <p><strong>Status:</strong> <?php echo $ticket['status']; ?></p>
            <p><strong>Created At:</strong> <?php echo $ticket['created_at']; ?></p>
            <a href="list_tickets.php" class="btn btn-secondary mt-3">Back to Tickets</a>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
