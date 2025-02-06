<?php
session_start();
include('../config.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    header('Location: login.php');
    exit();
}

$page_title = "Create Ticket";
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO tickets (user_id, subject, description) VALUES ('$user_id', '$subject', '$description')";
    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>Ticket created successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
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
        <h1 class="heading-text">Create Ticket</h1>
        <div class="card card-custom mt-4">
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Ticket</button>
                </form>
                <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
