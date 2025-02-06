<?php
session_start();
include("../config.php");
include("checklogin.php");
check_login();

$page_title = "Manage Reports";
include("../includes/header.php");

// Example report generation code
$query = "SELECT COUNT(*) AS total_tickets, status FROM tickets GROUP BY status";
$result = mysqli_query($conn, $query);

?>

<div class="container mt-4">
    <h2>Manage Reports</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tickets Report</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Total Tickets</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['status']; ?></td>
                            <td><?php echo $row['total_tickets']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
