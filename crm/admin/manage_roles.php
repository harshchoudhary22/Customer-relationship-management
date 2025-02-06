<?php 
session_start();
include("../config.php");
include("checklogin.php");
check_login();

$page_title = "Manage Roles";
include("../includes/header.php");

$query = "SELECT * FROM roles";
$result = mysqli_query($conn, $query);

if (!$result) {
    // The query failed
    echo "Query failed: " . mysqli_error($conn);
    exit;
}

$roles = [];
while ($row = mysqli_fetch_assoc($result)) {
    $roles[] = $row;
}
?>

<div class="container">
    <h1 class="mt-4">Manage Roles</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Role Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $role): ?>
            <tr>
                <td><?php echo htmlspecialchars($role['id']); ?></td>
                <td><?php echo htmlspecialchars($role['role_name']); ?></td>
                <td>
                    <a href="edit_role.php?id=<?php echo $role['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_role.php?id=<?php echo $role['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include("../includes/footer.php"); ?>
