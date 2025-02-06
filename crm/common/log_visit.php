<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../config.php");

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $visit_date = date('Y-m-d');

    $stmt = $conn->prepare("INSERT INTO user_visits (visit_date, user_id) VALUES (?, ?)");
    $stmt->bind_param("si", $visit_date, $user_id);
    $stmt->execute();
}
?>


