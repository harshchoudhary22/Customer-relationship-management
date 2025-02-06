<?php
session_start();
include('../config.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    header('Location: login.php');
    exit();
}

$page_title = "Change Password";
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $user_id = $_SESSION['user_id'];

    // Fetch the current password from the database
    $query = "SELECT password FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if (password_verify($current_password, $row['password'])) {
        $new_password_hashed = password_hash($new_password, PASSWORD_BCRYPT);
        $update_query = "UPDATE users SET password = '$new_password_hashed' WHERE id = '$user_id'";
        if (mysqli_query($conn, $update_query)) {
            echo "<div class='alert alert-success'>Password changed successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Current password is incorrect</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar-custom {
            background-color: #343a40;
        }
        .navbar-custom .navbar-brand, .navbar-custom .nav-link {
            color: white;
        }
        .navbar-custom .nav-link:hover {
            color: #ffc107;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            padding: 15px;
            text-decoration: none;
            display: block;
        }
        .sidebar a:hover {
            background-color: #ffc107;
            color: #343a40;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .card-custom {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            margin-left: 260px;
        }
        .heading-text, .form-label {
            color: #343a40;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <a href="dashboard.php">Dashboard</a>
    <a href="create_ticket.php">Create Ticket</a>
    <a href="list_tickets.php">View Tickets</a>
    <a href="create_quotation.php">Request Quotation</a>
    <a href="live_chat.php">Live Chat</a>
    <a href="view_profile.php">View Profile</a>
    <a href="edit_profile.php">Edit Profile</a>
    <a href="change_password.php">Change Password</a>
    <a href="logout.php">Logout</a>
</div>
<div class="content">
    <div class="container mt-4">
        <h1 class="heading-text">Change Password</h1>
        <div class="card card-custom mt-4">
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
                <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
