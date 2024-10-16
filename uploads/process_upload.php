<?php
require '../config/db.php'; // Ensure you include your db.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the file was uploaded without errors
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $permit_type = $_POST['permit_type'];
        $file = $_FILES['file'];

        // Get file info
        $file_name = basename($file['name']);
        $file_path = 'uploads' . $file_name; // Ensure this path exists

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($file['tmp_name'], $file_path)) {
            // Prepare an insert statement
            $stmt = $mysqli->prepare("INSERT INTO permits (permit_type, file_name, file_path, submission_date) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("sss", $permit_type, $file_name, $file_path);

            // Execute the statement
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Database insertion failed.']);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'error' => 'File move failed.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'No file uploaded or upload error.']);
    }
}
$mysqli->close();
?>
