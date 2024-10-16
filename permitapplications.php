<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="style/style.css">
    <title>LGU User Dashboard</title>
    <style>
        /* Add some basic styles for the modal */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
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

<div class="container">   
<aside id="sidebar">
    <?php include 'sidebar.php'; ?>
</aside>

    <main>
            
            <h1>Permit Applications</h1>
            
            <form id="uploadForm" action="uploads/process_upload.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="permit_type">Select Permit Type:</label>
                    <select name="permit_type" id="permit_type" required>
                        <option value="">Select a Permit</option>
                        <option value="Barangay Clearance">Barangay Clearance</option>
                        <option value="Business Permit">Business Permit</option>
                        <option value="Building Permit">Building Permit</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="file" class="custom-file-button">Upload your permit</label>
                    <input type="file" name="file" id="file" class="custom-file-input" required>
                    <span id="file-name">No file chosen</span> <!-- This displays the file name -->
                </div>
                <div class="form-group">
                    <button type="submit" class="submit-btn">Submit</button>
                </div>
            </form>

            <!-- Success Modal HTML -->
            <div id="successModal" class="modal">
                <div class="modal-content">
                    <span class="close" id="closeModalBtn">&times;</span>
                    <p id="modalMessage">File uploaded successfully!</p> <!-- This message will be updated dynamically -->
                </div>
            </div>
    
</div>
        <!--Sidebar end-->

       
       

            <script>

                // Listen for file input change event
                document.getElementById("file").addEventListener("change", function() {
                    const fileInput = document.getElementById("file");
                    const fileNameSpan = document.getElementById("file-name");

                    if (fileInput.files.length > 0) {
                        // If a file is chosen, update the span text with the file name
                        fileNameSpan.textContent = fileInput.files[0].name;
                        fileNameSpan.style.color = "green"; // Optionally change the text color to green
                    } else {
                        // Reset if no file is chosen
                        fileNameSpan.textContent = "No file chosen";
                        fileNameSpan.style.color = ""; // Reset color
                    }
                });
                // Function to show the success modal
                function showSuccessModal(message) {
                    const modalMessage = document.getElementById("modalMessage");
                    modalMessage.textContent = message; // Dynamically set the message
                    const successModal = document.getElementById("successModal");
                    successModal.style.display = "block";
                }

                // Close the success modal
                document.getElementById("closeModalBtn").addEventListener("click", function() {
                    const successModal = document.getElementById("successModal");
                    successModal.style.display = "none";
                });

                // Handle form submission
                document.getElementById('uploadForm').addEventListener('submit', function(event) {
                    event.preventDefault();
                    const formData = new FormData(this);

                    fetch('uploads/process_upload.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showSuccessModal('File uploaded successfully!');
                        } else {
                            showSuccessModal('Failed to upload the file.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showSuccessModal('An error occurred during file upload.');
                    });
                });
            </script>

            <script src="scripts/script.js"></script> 

        </main>
        
        

    
   
</body>
</html>
