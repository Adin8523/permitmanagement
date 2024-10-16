<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "lgutestdb";


$conn = new mysqli($servername, $username, $password, "lgutestdb");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$stmt = $conn->prepare("INSERT INTO usercredentials (username, firstname, lastname, email, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $username,$firstname, $lastname, $email, $password);


$username = $_POST["username"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

$stmt->execute();

echo "Registered successfully";

$stmt->close();
$conn->close();
header("Location: ../index.html");
exit();
?>