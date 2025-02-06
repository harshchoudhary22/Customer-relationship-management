<?php
session_start();
include('../config.php');
include('checklogin.php');
check_login();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM roles WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: role_based_controls.php');
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    header('Location: role_based_controls.php');
    exit();
}
?>
