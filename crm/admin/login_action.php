<?php
session_start();
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password
    $password_hashed = md5($password);

    // Prepare the SQL query
    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password_hashed'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check for query execution errors
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Check if a user was found
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
    } else {
        header("Location: login.php?error=Invalid%20credentials");
    }
}
?>


