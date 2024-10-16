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
    <title>Admin Dashboard</title>

    <!-- style sa modal(yung pop up) -->
    <style>
        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
        <!-- Sidebar start -->
<div class="container">
<aside id="sidebar">
    <?php include 'sidebar.php'; ?>
</aside>

    <main>
            <h1>Manage Users</h1>
        
            <div class="user-management">
                <!-- Form to create a new user -->
                <div class="create-user-section">
                    <h2>Create User</h2>
                    <form id="userForm" action="user/create_user.php" method="POST">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="firstname">First Name:</label>
                            <input type="text" id="firstname" name="firstname" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name:</label>
                            <input type="text" id="lastname" name="lastname" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div>
                            <label for="user_type">User Type:</label>
                            <select name="user_type" id="user_type" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="submit-btn">Create User</button>
                    </form>
                </div>
        
                <!-- Table to display users -->
                <div class="user-section">
                    <h2>List of Users</h2>
                    <table id="userTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Actions</th> <!-- New column for actions -->
                                
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Populate the table with user data -->
                            <script>
                                // Fetch the user data from the PHP file
                                fetch('user/fetch_user.php')
                                    .then(response => response.text()) // Get the response as text
                                    .then(data => {
                                        // Inject the response data (table rows) into the table body
                                        document.querySelector('#userTable tbody').innerHTML = data;
                                    })
                                    .catch(error => console.error('Error fetching user data:', error)); // Handle any errors
                            </script>
                        </tbody>
                    </table> 
                </div>
            </div>
        </main>
        
                <!-- Modal Structure -->
                <div id="editModal" class="modal">
                    <div class="modal-content">
                        <span class="close-modal-btn">&times;</span>
                        <form method="POST" action="user/edit_user.php">
                            <input type="hidden" id="edit-id" name="user_id">
                            <div class="edit-form-group">
                                <label for="edit-username">Username:</label>
                                <input type="text" id="edit-username" name="username" required>
                            </div>
                            <div class="edit-form-group">
                                <label for="edit-firstname">First Name:</label>
                                <input type="text" id="edit-firstname" name="firstname" required>
                            </div>
                            <div class="edit-form-group">
                                <label for="edit-lastname">Last Name:</label>
                                <input type="text" id="edit-lastname" name="lastname" required>
                            </div>
                            <div class="edit-form-group">
                                <label for="edit-email">Email:</label>
                                <input type="email" id="edit-email" name="email" required>
                            </div>   
                            <div class="edit-form-group">
                                <label for="edit-user_type">User Type:</label>
                                <select id="edit-user_type" name="user_type" required>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>                         
                            <div class="edit-form-group">
                                <button type="submit" class="submit-btn">Update</button>
                            </div>
                        </form>
                    </div>
                </div> 
    
</div>
            
 <!-- Styles for the modal (Add this to your existing CSS) -->
<style>
            /* Modal Background */
.modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 1; /* Sit on top of everything */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5); /* Black with opacity */
    animation: fadeIn 0.3s ease-out;
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: var(--color-background); /* Automatically uses light or dark background based on theme */
    color: var(--color-text); /* Ensures the text color matches the theme */
    margin: 10% auto;
    padding: 20px;
    border-radius: 10px;
    width: 80%;
    max-width: 500px;
    animation: slideUp 0.4s ease-out;
    transform: translateY(-50px);
    opacity: 0;
    box-shadow: var(--box-shadow); /* Adds a shadow that also adapts to the theme */
}

.modal-content.show {
    transform: translateY(0);
    opacity: 1;
}

/* Close button */
.close-modal-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 30px;
    color: #aaa;
    cursor: pointer;
    transition: color 0.3s;
}

.close-modal-btn:hover {
    color: #000;
}

/* Form styling */
.form-group {
    margin-bottom: 15px;
}

label {
    font-size: 14px;
    margin-bottom: 5px;
    display: block;
}

input[type="text"], input[type="email"] {
    width: 100%;
    padding: 8px;
    margin: 5px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.submit-btn {
    padding: 10px 15px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.submit-btn:hover {
    background-color: #45a049;
}

/* Animation for modal */
@keyframes fadeIn {
    0% { opacity: 0; }
    100% { opacity: 1; }
}

@keyframes slideUp {
    0% { transform: translateY(50px); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
}

            </style>


            <script>
                // Get modal element
                document.addEventListener('DOMContentLoaded', function () {
                    const modal = document.getElementById('editModal');
                    const closeBtn = document.querySelector('.close-modal-btn');
                    const editButtons = document.querySelectorAll('.edit-btn');


        // Open modal when edit button is clicked and populate form fields
        editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-id');
            const username = this.getAttribute('data-username');
            const firstname = this.getAttribute('data-firstname');
            const lastname = this.getAttribute('data-lastname');
            const email = this.getAttribute('data-email');
            const userType = this.getAttribute('data-user_type');

            // Populate the modal form with the data
            document.getElementById('edit-id').value = userId;
            document.getElementById('edit-username').value = username;
            document.getElementById('edit-firstname').value = firstname;
            document.getElementById('edit-lastname').value = lastname;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-user_type').value = userType;

            // Show the modal
            document.getElementById('editModal').style.display = 'block';
            });
        });

        // Close modal when close button is clicked
        document.querySelector('.close-modal-btn').addEventListener('click', function () {
            document.getElementById('editModal').style.display = 'none';
        });

        // Close modal when clicked outside the modal
        window.addEventListener('click', function (event) {
            if (event.target == document.getElementById('editModal')) {
                document.getElementById('editModal').style.display = 'none';
            }
        });

    // Function to open the modal with animation
    function openModal() {
        modal.style.display = 'block';
        setTimeout(() => {
            document.querySelector('.modal-content').classList.add('show');
        }, 10);
    }

    // Function to close the modal with animation
    function closeModal() {
        document.querySelector('.modal-content').classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 400);  // 400ms delay to ensure the animation finishes before hiding the modal
    }

    // Use event delegation to handle the dynamically created edit buttons
    document.body.addEventListener('click', function (event) {
        if (event.target.classList.contains('edit-btn')) {
            const userId = event.target.getAttribute('data-id');
            const username = event.target.getAttribute('data-username');
            const firstname = event.target.getAttribute('data-firstname');
            const lastname = event.target.getAttribute('data-lastname');
            const email = event.target.getAttribute('data-email');
            const userType = event.target.getAttribute('data-user_type');

            // Populate the modal form with the user data
            document.getElementById('edit-id').value = userId;
            document.getElementById('edit-username').value = username;
            document.getElementById('edit-firstname').value = firstname;
            document.getElementById('edit-lastname').value = lastname;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-user_type').value = userType;
            

            openModal();
            }
        });

            // Close modal when close button is clicked
            closeBtn.addEventListener('click', closeModal);

            // Close modal if clicked outside of modal content
            window.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closeModal();
                }
            });
        });


            </script>





        

    

    <script src="scripts/script.js"></script>
</body>
</html>

