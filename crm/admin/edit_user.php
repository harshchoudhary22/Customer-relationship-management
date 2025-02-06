<?php
session_start();
include("../config.php");

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $query = "UPDATE users SET username = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $username, $email, $id);
    $stmt->execute();
    $stmt->close();

    header('Location: manage_users.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User - CRM</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #2c3e50;
        }
        .navbar-custom {
            background-color: #2c3e50;
        }
        .navbar-custom .navbar-brand, .navbar-custom .nav-link {
            color: white;
        }
        .navbar-custom .nav-link:hover {
            color: #18bc9c;
        }
        .container {
            margin-top: 50px;
        }
        .form-group label {
            color: white;
        }
        .btn-custom {
            background-color: #18bc9c;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #148f77;
        }
        .footer {
            background-color: #2c3e50;
            padding: 10px 0;
            text-align: center;
            color: white;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">CRM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_tickets.php">Manage Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_quotations.php">Manage Quotations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_users.php">Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_logs.php">View Logs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="live_chat.php">Live Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="analytics_dashboard.php">Analytics Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="role_based_controls.php">Role-Based Controls</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Automated_Email_Reports.php">Automated Email Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="change_password.php">Change Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h2>Edit User</h2>
        <form method="post" action="edit_user.php">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
            </div>
            <button type="submit" class="btn btn-custom">Save Changes</button>
        </form>
        <a href="manage_users.php" class="btn btn-custom">Back to Manage Users</a>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="text-center text-white">&copy; 2024 Cloud based CRM - PHP. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
