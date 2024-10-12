document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggle-btn");
    const wrapper = document.querySelector('.wrapper');
    const loginLink = document.querySelector('.login-link');
    const registerLink = document.querySelector('.register-link');
    const btnPopup = document.querySelector('.btnLogin-popup');
    const iconClose = document.querySelector('.icon-close');
    const themeToggleBtn = document.getElementById("theme-toggle");
    const savedTheme = localStorage.getItem("theme");
    

    // Incorrect Password Popup
    const passwordPopup = document.getElementById('passwordpopup');
    const popupCloseBtn = document.querySelector('#passwordpopup .popup-close');

    // Function to display the incorrect password popup
    function showPasswordPopup() {
        if (passwordPopup) {
            passwordPopup.style.display = 'block';
        }
    }

    // Function to close the incorrect password popup
    function closePasswordPopup() {
        if (passwordPopup) {
            passwordPopup.style.display = 'none';
        }
    }

    // Show popup based on URL parameters
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('error')) {
            const error = urlParams.get('error');
            if (error === 'Incorrect current password') {
                showPasswordPopup(); // Show incorrect password popup
            } else if (error === 'invalid_admin_code') {
                showPopup(); // Show error popup for invalid admin code
            }
        } else if (urlParams.has('success')) {
            // Handle success message if necessary
        }
    };

    // Close the incorrect password popup when the close button is clicked
    if (popupCloseBtn) {
        popupCloseBtn.addEventListener('click', closePasswordPopup);
    } else {
        console.error("Popup close button not found");
    }

    // Error Popup Logic
    const errorPopup = document.getElementById('error-popup');
    const errorCloseBtn = document.querySelector('#error-popup button');

    // Function to display the popup
    function showPopup() {
        if (errorPopup) {
            errorPopup.style.display = 'block';
        }
    }

    // Function to close the popup and the registration form
    function closePopup() {
        if (errorPopup) {
            errorPopup.style.display = 'none';
            wrapper.classList.remove('active'); // Hide registration form
        }
    }

    

    // Theme toggle functionality
    if (savedTheme) {
        document.body.classList.add(savedTheme + "-mode");
        const icon = themeToggleBtn.querySelector("span");
        icon.textContent = savedTheme === "dark" ? "light_mode" : "dark_mode";
    }

    themeToggleBtn.addEventListener("click", () => {
        document.body.classList.toggle("dark-mode");
        const isDarkMode = document.body.classList.contains("dark-mode");
        const icon = themeToggleBtn.querySelector("span");
        icon.textContent = isDarkMode ? "light_mode" : "dark_mode";
        localStorage.setItem("theme", isDarkMode ? "dark" : "light");
    });

    // Toggle sidebar
    toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("minimized");
    });

    // Toggle between login and register forms
    registerLink.addEventListener('click', (e) => {
        e.preventDefault(); // Prevent page from refreshing
        wrapper.classList.add('active');
    });

    loginLink.addEventListener('click', (e) => {
        e.preventDefault(); // Prevent page from refreshing
        wrapper.classList.remove('active');
    });

    // Open and close popup
    btnPopup.addEventListener('click', () => {
        wrapper.classList.add('active-popup');
    });

    iconClose.addEventListener('click', () => {
        wrapper.classList.remove('active-popup');
        wrapper.classList.remove('active');  // Reset to login form
    });

    

    
    // sa modal ng admindashboard to js nya
        // Get the modal element
    const modal = document.getElementById('editModal');
    const closeBtn = document.querySelector('.close-modal');

    // Function to open the modal
    function openModal() {
        modal.style.display = 'block';
    }

    // Close the modal when clicking on the close button or outside the modal
    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    document.querySelectorAll('.edit-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            const username = this.getAttribute('data-username');
            const firstname = this.getAttribute('data-firstname');
            const lastname = this.getAttribute('data-lastname');
            const email = this.getAttribute('data-email');
    
            // Populate the modal fields
            document.getElementById('edit-id').value = userId;
            document.getElementById('edit-username').value = username;
            document.getElementById('edit-firstname').value = firstname;
            document.getElementById('edit-lastname').value = lastname;
            document.getElementById('edit-email').value = email;
    
            // Show the modal (if hidden)
            document.getElementById('editModal').style.display = 'block';
        });
    });

   
    
    
    
    
    


});