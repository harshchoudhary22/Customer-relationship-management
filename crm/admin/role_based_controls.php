<?php
session_start();
include('../config.php');
include('checklogin.php');
check_login();

$page_title = "Role-Based Controls";
include('../includes/header.php');

// Fetch roles and permissions data
$query = "SELECT * FROM roles";
$result = mysqli_query($conn, $query);
$roles = [];
while ($row = mysqli_fetch_assoc($result)) {
    $roles[] = $row;
}
?>

<div class="container mt-4">
    <h1>Role-Based Controls</h1>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Role Name</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $role) { ?>
                <tr>
                    <td><?php echo $role['id']; ?></td>
                    <td><?php echo $role['role_name']; ?></td>
                    <td><?php echo $role['permissions']; ?></td>
                    <td>
                        <a href="edit_role.php?id=<?php echo $role['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_role.php?id=<?php echo $role['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="add_role.php" class="btn btn-primary mt-3">Add New Role</a>
    <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>

<?php include('../includes/footer.php'); ?>
