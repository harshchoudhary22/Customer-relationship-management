<?php
session_start();
include("../config.php");

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit();
}

// Delete the quotation
if (isset($_GET['id'])) {
    $quotation_id = $_GET['id'];
    $query = "DELETE FROM quotations WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $quotation_id);

    if ($stmt->execute()) {
        header('Location: manage_quotations.php');
        exit();
    } else {
        $error = "Failed to delete quotation.";
    }
} else {
    header('Location: manage_quotations.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Quotation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Delete Quotation</h2>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <a href="manage_quotations.php" class="btn btn-primary">Back to Manage Quotations</a>
    </div>
</body>
</html>
