<?php
session_start();
include("../config.php");
include("checklogin.php");
check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role_id = intval($_POST['id']);
    $role_name = mysqli_real_escape_string($conn, $_POST['role_name']);
    $role_description = mysqli_real_escape_string($conn, $_POST['role_description']);
    $permissions = isset($_POST['permissions']) ? implode(',', $_POST['permissions']) : '';

    $query = "UPDATE roles SET role_name = '$role_name', role_description = '$role_description', permissions = '$permissions' WHERE id = $role_id";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Role updated successfully.";
    } else {
        $_SESSION['error'] = "Error updating role: " . mysqli_error($conn);
    }
    header("Location: manage_roles.php");
    exit;
} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: manage_roles.php");
    exit;
}
?>
