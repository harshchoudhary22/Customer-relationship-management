<?php
session_start();
include('../config.php');
include('checklogin.php');
check_login();

$page_title = "Add New Role";
include('../includes/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role_name = $_POST['role_name'];
    $permissions = implode(',', $_POST['permissions']);

    $query = "INSERT INTO roles (role_name, permissions) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $role_name, $permissions);

    if ($stmt->execute()) {
        header('Location: role_based_controls.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<div class="container mt-4">
    <h1>Add New Role</h1>
    <form method="POST" action="">
        <div class="form-group">
            <label for="role_name">Role Name</label>
            <input type="text" name="role_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="permissions">Permissions</label><br>
            <label><input type="checkbox" name="permissions[]" value="manage_users"> Manage Users</label><br>
            <label><input type="checkbox" name="permissions[]" value="manage_tickets"> Manage Tickets</label><br>
            <label><input type="checkbox" name="permissions[]" value="manage_quotations"> Manage Quotations</label><br>
            <label><input type="checkbox" name="permissions[]" value="view_logs"> View Logs</label><br>
            <label><input type="checkbox" name="permissions[]" value="manage_roles"> Manage Roles</label><br>
            <label><input type="checkbox" name="permissions[]" value="send_notifications"> Send Notifications</label>
        </div>
        <button type="submit" class="btn btn-primary">Add Role</button>
    </form>
    <a href="role_based_controls.php" class="btn btn-secondary mt-3">Back to Roles</a>
</div>

<?php include('../includes/footer.php'); ?>
