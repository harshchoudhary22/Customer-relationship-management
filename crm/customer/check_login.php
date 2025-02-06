<?php
function check_login() {
    global $conn;

    if (!isset($_SESSION['user_id'])) {
        header('Location: ../customer/login.php');
        exit();
    }

    // Check if the user is an admin
    $user_id = $_SESSION['user_id'];
    $query = "SELECT is_admin FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($is_admin);
        $stmt->fetch();
        $_SESSION['is_admin'] = $is_admin;
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>
