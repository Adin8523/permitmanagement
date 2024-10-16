<?php
session_start();
include('../config/db.php'); // Include your database connection


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if the user exists
    $query = "SELECT * FROM usercredentials WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Check password
        if (password_verify($password, $user['password'])) {
            // Check user type
            if ($user['user_type'] === 'admin') {
                // Redirect with error message in the URL
                header("Location: ../index.html?error=admin_login");
                exit();
            } else {
                // Successful login for regular users
                $_SESSION['user_type'] = $user['user_type'];
                $_SESSION['username'] = $username;
                header("Location:../home.php"); // Redirect to user home page
                exit();
            }
        } else {
            header("Location: ../index.html?error=invalid_credentials");
            exit();
        }
    } else {
        header("Location: ../index.html?error=invalid_credentials");
        exit();
    }
}
?>
