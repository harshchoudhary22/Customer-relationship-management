<?php
session_start();
include('../config.php');
include('checklogin.php');
check_login();

$page_title = "Analytics Dashboard";
include('../includes/header.php');

// Fetch total users, tickets, and quotations
$total_users_query = "SELECT COUNT(*) AS total_users FROM users WHERE role = 'customer'";
$total_tickets_query = "SELECT COUNT(*) AS total_tickets FROM tickets";
$total_quotations_query = "SELECT COUNT(*) AS total_quotations FROM quotations";
$total_users_result = mysqli_query($conn, $total_users_query);
$total_tickets_result = mysqli_query($conn, $total_tickets_query);
$total_quotations_result = mysqli_query($conn, $total_quotations_query);
$total_users = mysqli_fetch_assoc($total_users_result)['total_users'];
$total_tickets = mysqli_fetch_assoc($total_tickets_result)['total_tickets'];
$total_quotations = mysqli_fetch_assoc($total_quotations_result)['total_quotations'];

// Fetch tickets created in the last 7 days
$tickets_last_week_query = "
    SELECT DATE(created_at) as date, COUNT(*) as count
    FROM tickets
    WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
    GROUP BY DATE(created_at)
    ORDER BY DATE(created_at)";
$tickets_last_week_result = mysqli_query($conn, $tickets_last_week_query);

// Prepare data for display
$tickets_last_week = [];
while ($row = mysqli_fetch_assoc($tickets_last_week_result)) {
    $tickets_last_week[$row['date']] = $row['count'];
}
?>

<div class="container mt-4">
    <h1>Analytics Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-3">
                <div class="card-body">
                    <h3>Total Users</h3>
                    <p><?php echo $total_users; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white mb-3">
                <div class="card-body">
                    <h3>Total Tickets</h3>
                    <p><?php echo $total_tickets; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-white mb-3">
                <div class="card-body">
                    <h3>Total Quotations</h3>
                    <p><?php echo $total_quotations; ?></p>
                </div>
            </div>
        </div>
    </div>

    <h2>Tickets Created in the Last 7 Days</h2>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tickets_last_week as $date => $count) { ?>
            <tr>
                <td><?php echo $date; ?></td>
                <td><?php echo $count; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>

<?php include('../includes/footer.php'); ?>
