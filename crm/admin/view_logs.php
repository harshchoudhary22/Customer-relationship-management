<?php
session_start();
include('../config.php');
include('checklogin.php');
check_login();

$page_title = "View Logs";
include('../includes/header.php');

$query = "SELECT l.id, u.username, l.action, l.timestamp 
          FROM logs l 
          JOIN users u ON l.user_id = u.id";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-4">
    <h1>View Logs</h1>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Action</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['action']; ?></td>
                    <td><?php echo $row['timestamp']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>

<?php include('../includes/footer.php'); ?>
