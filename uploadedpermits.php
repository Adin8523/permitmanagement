<?php
// Start session
session_start();


if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: home.php");
    exit();
}
// Admin dashboard code...
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="uploadedpermits.css"> <!-- New CSS file -->
    <title>LGU User Dashboard - Uploaded Permits</title>
</head>
<body>

<div class="container">
<aside id="sidebar">
    <?php include 'sidebar.php'; ?>
</aside>

    <main>
            <h1>Uploaded Permits</h1>
            
            <?php
            // Database connection
            include 'config/db.php'; // Adjust the path to your database connection file

            // Fetch uploaded permits from the database
            $sql = "SELECT permit_type, file_name, file_path, submission_date FROM permits";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0): ?>
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Permit Type</th>
                            <th>File Name</th>
                            <th>Submission Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['permit_type']); ?></td>
                            <td><?php echo htmlspecialchars($row['file_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['submission_date']); ?></td>
                            <td>
                                <a href="<?php echo 'uploads/' . htmlspecialchars($row['file_name']); ?>" target="_blank">View</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No permits have been uploaded yet.</p>
            <?php endif; ?>
        </main>
    
</div>

            
        <!--Sidebar end-->

        
        
        
        <nav class="navigation">
            <button id="theme-toggle" class="btn-theme-toggle">
                <span class="material-symbols-outlined">light_mode</span>
            </button>

            <button class="btnLogin-popup"><a href="authentication/logout.php">Logout</button>
        </nav>
    </div>

    <script src="scripts/script.js"></script>
</body>
</html>


