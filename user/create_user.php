<?php
// Database connection
include '../config/db.php'; // Adjust the path if necessary

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_type = $_POST['user_type']; // user_type meaning if admin or user

    // Insert user data into the usercredentials table
    $sql = "INSERT INTO usercredentials (username, firstname, lastname, email, password, user_type) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssss", $username, $firstname, $lastname, $email, $password, $user_type);

    if ($stmt->execute()) {
        // Redirect back to the admin dashboard after successful user creation
        header("Location: ../admin-dashboard.php");
        exit();  // Make sure the script stops after the redirect
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to create user.']);
    }

    $stmt->close();
}
?>
