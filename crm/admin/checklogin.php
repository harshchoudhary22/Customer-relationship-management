<?php
function check_login() {
    if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
        header('Location: login.php');
        exit();
    }
}
?>
