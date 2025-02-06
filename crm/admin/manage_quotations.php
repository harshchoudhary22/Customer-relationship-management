<?php
session_start();
include("../config.php");

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit();
}

// Fetch quotations
$query = "SELECT * FROM quotations";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Quotations</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #2c3e50;
            color: white;
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
            margin-top: 20px;
        }
        .form-control {
            background-color: #3c4f63;
            color: white;
        }
        .form-control:focus {
            background-color: #3c4f63;
            color: white;
        }
        .btn-custom {
            background-color: #18bc9c;
            color: white;
            border: none;
            padding: 10px 20px;
            transition: background-color 0.3s;
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
        <h2>Manage Quotations</h2>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo ucfirst($row['status']); ?></td>
                        <td>
                            <a href="edit_quotation.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="delete_quotation.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this quotation?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
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


