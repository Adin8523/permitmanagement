<?php
// Include database connection
include('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Delete user from the database
    $sql = "DELETE FROM usercredentials WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect back to the admin dashboard after successful deletion
        header("Location: ../admin-dashboard.php");
        exit();
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    die("No user ID provided.");
}
?>
