<?php
session_start();
include('../config.php');
include('checklogin.php');
check_login();

$page_title = "Admin Dashboard";
include('../includes/header.php');

// Fetch data for dashboard summary
$total_users_query = "SELECT COUNT(*) AS total_users FROM users WHERE role = 'customer'";
$total_tickets_query = "SELECT COUNT(*) AS total_tickets FROM tickets";
$total_quotations_query = "SELECT COUNT(*) AS total_quotations FROM quotations";
$total_users_result = mysqli_query($conn, $total_users_query);
$total_tickets_result = mysqli_query($conn, $total_tickets_query);
$total_quotations_result = mysqli_query($conn, $total_quotations_query);
$total_users = mysqli_fetch_assoc($total_users_result)['total_users'];
$total_tickets = mysqli_fetch_assoc($total_tickets_result)['total_tickets'];
$total_quotations = mysqli_fetch_assoc($total_quotations_result)['total_quotations'];
?>

<div class="container mt-4">
    <h1>Admin Dashboard</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="dashboard.php" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="manage_tickets.php" class="list-group-item list-group-item-action">Manage Tickets</a>
                <a href="manage_quotations.php" class="list-group-item list-group-item-action">Manage Quotations</a>
                <a href="manage_users.php" class="list-group-item list-group-item-action">Manage Users</a>
                <a href="view_logs.php" class="list-group-item list-group-item-action">View Logs</a>
                <a href="live_chat.php" class="list-group-item list-group-item-action">Live Chat</a>
                <a href="analytics_dashboard.php" class="list-group-item list-group-item-action">Analytics Dashboard</a>
                <a href="role_based_controls.php" class="list-group-item list-group-item-action">Role-Based Controls</a>
                <a href="Automated_Email_Reports.php" class="list-group-item list-group-item-action">Automated Email Reports</a>
                <a href="change_password.php" class="list-group-item list-group-item-action">Change Password</a>
                <a href="logout.php" class="list-group-item list-group-item-action">Logout</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
                    <p>Use the sidebar to navigate through the admin options.</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h3>Total Users</h3>
                                    <p><?php echo $total_users; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h3>Total Tickets</h3>
                                    <p><?php echo $total_tickets; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h3>Total Quotations</h3>
                                    <p><?php echo $total_quotations; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
