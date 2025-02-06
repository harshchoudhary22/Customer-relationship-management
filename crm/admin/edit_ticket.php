<?php
session_start();
include("../config.php");
include("checklogin.php");
check_login();

if (isset($_GET['id'])) {
    $ticket_id = $_GET['id'];

    // Fetch ticket details
    $query = "SELECT * FROM tickets WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $ticket = $result->fetch_assoc();

    if (!$ticket) {
        echo "Ticket not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Update ticket details
    $query = "UPDATE tickets SET subject = ?, description = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $subject, $description, $status, $ticket_id);
    $stmt->execute();

    header("Location: manage_tickets.php");
    exit();
}

$page_title = "Edit Ticket";
include("../includes/header.php");
?>

<div class="container">
    <h2>Edit Ticket</h2>
    <form method="post" action="edit_ticket.php?id=<?php echo $ticket_id; ?>">
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" class="form-control" id="subject" name="subject" value="<?php echo $ticket['subject']; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" required><?php echo $ticket['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="open" <?php if ($ticket['status'] == 'open') echo 'selected'; ?>>Open</option>
                <option value="closed" <?php if ($ticket['status'] == 'closed') echo 'selected'; ?>>Closed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Ticket</button>
        <a href="manage_tickets.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include("../includes/header.php"); ?>
