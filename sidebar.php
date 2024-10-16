<?php
// Check if a session is already started
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start session if it's not already started
}

$user_type = $_SESSION['user_type'] ?? ''; // Get the user_type from the session, default to empty if not set
?>

<div class="container">
    <!-- Side bar-->
    <aside id="sidebar">
        <div class="toggle">
            <div class="logo">
                <img src="images/qclogo_main.jpg">
                <h2>Welcome</h2>
            </div>
            <div class="close" id="toggle-btn">
                <span class="material-icons-sharp">menu</span>
            </div>
        </div>

        <div class="sidebar">
            <a href="home.php">
                <span class="material-icons-sharp">home</span>
                <h3>Home</h3>
            </a>
            <a href="permitapplications.php">
                <span class="material-icons-sharp">person_outline</span>
                <h3>Permit Application</h3>
            </a>

            <!-- Show these links only if user is admin -->
            <?php if ($user_type === 'admin'): ?>
                <a href="admin-dashboard.php">
                    <span class="material-icons-sharp">campaign</span>
                    <h3>Admin Dashboard</h3>
                </a>
                <a href="uploadedpermits.php">
                    <span class="material-symbols-outlined">rate_review</span>
                    <h3>Uploaded Permits</h3>
                </a>
            <?php endif; ?>
        </div>
    </aside>
    <!-- Sidebar end -->
</div>

<div>        
        <nav class="navigation">
            <button id="theme-toggle" class="btn-theme-toggle">
                <span class="material-symbols-outlined">light_mode</span>
            </button>

            <button class="btnLogin-popup"><a href="authentication/logout.php">Logout</button>
        </nav>
    </div>