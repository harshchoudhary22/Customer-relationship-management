<?php
session_start();
include('../config.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    header('Location: login.php');
    exit();
}

$page_title = "View Tickets";
include '../includes/header.php';

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM tickets WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-4">
    <h1>View Tickets</h1>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Description</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['subject']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                    <a href="view_ticket.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>

<?php include '../includes/footer.php'; ?>
