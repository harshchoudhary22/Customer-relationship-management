<?php
session_start();
include('../config.php');
include('checklogin.php');
check_login();

$page_title = "Edit Role";
include('../includes/header.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM roles WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $role = $result->fetch_assoc();
} else {
    header('Location: role_based_controls.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role_name = $_POST['role_name'];
    $permissions = implode(',', $_POST['permissions']);

    $query = "UPDATE roles SET role_name = ?, permissions = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $role_name, $permissions, $id);

    if ($stmt->execute()) {
        header('Location: role_based_controls.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<div class="container mt-4">
    <h1>Edit Role</h1>
    <form method="POST" action="">
        <div class="form-group">
            <label for="role_name">Role Name</label>
            <input type="text" name="role_name" class="form-control" value="<?php echo $role['role_name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="permissions">Permissions</label><br>
            <label><input type="checkbox" name="permissions[]" value="manage_users" <?php echo strpos($role['permissions'], 'manage_users') !== false ? 'checked' : ''; ?>> Manage Users</label><br>
            <label><input type="checkbox" name="permissions[]" value="manage_tickets" <?php echo strpos($role['permissions'], 'manage_tickets') !== false ? 'checked' : ''; ?>> Manage Tickets</label><br>
            <label><input type="checkbox" name="permissions[]" value="manage_quotations" <?php echo strpos($role['permissions'], 'manage_quotations') !== false ? 'checked' : ''; ?>> Manage Quotations</label><br>
            <label><input type="checkbox" name="permissions[]" value="view_logs" <?php echo strpos($role['permissions'], 'view_logs') !== false ? 'checked' : ''; ?>> View Logs</label><br>
            <label><input type="checkbox" name="permissions[]" value="manage_roles" <?php echo strpos($role['permissions'], 'manage_roles') !== false ? 'checked' : ''; ?>> Manage Roles</label><br>
            <label><input type="checkbox" name="permissions[]" value="send_notifications" <?php echo strpos($role['permissions'], 'send_notifications') !== false ? 'checked' : ''; ?>> Send Notifications</label>
        </div>
        <button type="submit" class="btn btn-primary">Update Role</button>
    </form>
    <a href="role_based_controls.php" class="btn btn-secondary mt-3">Back to Roles</a>
</div>

<?php include('../includes/footer.php'); ?>
