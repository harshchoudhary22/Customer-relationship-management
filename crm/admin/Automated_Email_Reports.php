<?php
session_start();
include("../config.php");
include("checklogin.php");
check_login();

$query_reports = "SELECT * FROM email_reports";
$result_reports = $conn->query($query_reports);

$query_users = "SELECT * FROM users";
$result_users = $conn->query($query_users);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $report_id = $_POST['report_id'];
    $user_id = $_POST['user_id'];

    // Fetch the report details
    $report_query = "SELECT * FROM email_reports WHERE id = ?";
    $stmt = $conn->prepare($report_query);
    $stmt->bind_param("i", $report_id);
    $stmt->execute();
    $report_result = $stmt->get_result();
    $report = $report_result->fetch_assoc();
    $stmt->close();

    // Fetch the user email
    $user_query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($user_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user_result = $stmt->get_result();
    $user = $user_result->fetch_assoc();
    $stmt->close();

    // Send the email
    $to = $user['email'];
    $subject = "Automated Report: " . $report['report_name'];
    $message = "Here is your requested report:\n\n" . $report['report_name'] . "\nGenerated At: " . $report['generated_at'] . "\nStatus: " . $report['status'];
    $headers = "From: admin@example.com";

    if (mail($to, $subject, $message, $headers)) {
        $email_status = "Report sent successfully to " . $user['email'];
    } else {
        $email_status = "Failed to send the report.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Automated Email Reports</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #2c3e50;
        }
        .container {
            margin-top: 50px;
        }
        .table-container {
            background-color: #34495e;
            padding: 20px;
            border-radius: 5px;
        }
        .table th, .table td {
            color: #ecf0f1;
        }
        .form-container {
            background-color: #34495e;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .form-container label, .form-container select, .form-container button {
            color: #ecf0f1;
        }
        .form-container button {
            background-color: #1abc9c;
        }
        .status-message {
            color: #1abc9c;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center text-white">Automated Email Reports</h2>
        <div class="table-container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Report Name</th>
                        <th>Generated At</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result_reports)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['report_name']; ?></td>
                            <td><?php echo $row['generated_at']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="form-container">
            <form method="post" action="Automated_Email_Reports.php">
                <div class="form-group">
                    <label for="report_id">Select Report</label>
                    <select class="form-control" id="report_id" name="report_id" required>
                        <?php
                        $result_reports->data_seek(0); // Reset result set pointer
                        while ($row = mysqli_fetch_assoc($result_reports)) { ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['report_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="user_id">Select User</label>
                    <select class="form-control" id="user_id" name="user_id" required>
                        <?php while ($row_user = mysqli_fetch_assoc($result_users)) { ?>
                            <option value="<?php echo $row_user['id']; ?>"><?php echo $row_user['username']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Send Report</button>
            </form>
        </div>
        <?php if (isset($email_status)) { ?>
            <div class="status-message text-center"><?php echo $email_status; ?></div>
        <?php } ?>
    </div>
</body>
</html>
