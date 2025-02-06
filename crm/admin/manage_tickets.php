<?php
session_start();
include('../config.php');
include('checklogin.php');
check_login();

$page_title = "Manage Tickets";
include('../includes/header.php');

$query = "SELECT t.id, u.username, t.subject, t.description, t.status, t.created_at 
          FROM tickets t 
          JOIN users u ON t.user_id = u.id";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-4">
<h1 class="dark-text">Manage Tickets</h1>


    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
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
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['subject']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <a href="edit_ticket.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_ticket.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>

<?php include('../includes/footer.php'); ?>
