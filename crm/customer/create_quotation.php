<?php
session_start();
include("../config.php");
include("../includes/header.php");

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'];
    $description = $_POST['description'];

    $query = "INSERT INTO quotations (user_id, subject, description) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $user_id, $subject, $description);
    if ($stmt->execute()) {
        echo "Quotation request submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<div class="container mt-4">
    <h2>Create Quotation</h2>
    <form method="post" action="create_quotation.php">
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" name="subject" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Request Quotation</button>
    </form>
</div>

<?php include("../includes/footer.php"); ?>
