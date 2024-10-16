<?php
$host = 'localhost'; // Database host
$user = 'root';      // Database username
$password = '';      // Database password
$dbname = 'lgutestdb'; // Database name

// Create connection
$mysqli = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

return $mysqli; // Make sure this returns the connection object
?>