<?php
// Include your database connection
include('../config/db.php');

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user ID and form data
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];

    // Validate the input data (basic validation)
    if (empty($user_id) || empty($username) || empty($firstname) || empty($lastname) || empty($email)) {
        die("All fields are required.");
    }

    // Update query
    $sql = "UPDATE usercredentials SET username = ?, firstname = ?, lastname = ?, email = ?, user_type = ? WHERE id = ?";
    $stmt = $mysqli->prepare($sql);

    // Bind parameters to the query
    $stmt->bind_param("sssssi", $username, $firstname, $lastname, $email, $user_type, $user_id);

    // Execute the query
    if ($stmt->execute()) {
        echo "User updated successfully!";
        header("Location: ../admin-dashboard.php"); // Redirect to the admin dashboard
    } else {
        echo "Error updating user: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $mysqli->close();
} else {
    echo "Invalid request!";
}
?>