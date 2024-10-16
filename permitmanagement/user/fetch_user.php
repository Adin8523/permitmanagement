<?php
include('../config/db.php'); // Include your database connection

// Check if the connection was successful
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch users from the database
$sql = "SELECT * FROM usercredentials";
$result = $mysqli->query($sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $db->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['firstname'] . "</td>";
        echo "<td>" . $row['lastname'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['user_type'] . "</td>"; 
        echo "<td>
                <form style='display:inline-block;' onsubmit='return false;'>
                    <button class='edit-btn' 
                            data-id='" . $row['id'] . "' 
                            data-username='" . $row['username'] . "' 
                            data-firstname='" . $row['firstname'] . "' 
                            data-lastname='" . $row['lastname'] . "' 
                            data-email='" . $row['email'] . "' 
                            data-user_type='" . $row['user_type'] . "'>
                        Edit
                    </button>
                </form>
                <form action='user/delete_user.php' method='POST' style='display:inline-block;'>
                    <input type='hidden' name='id' value='" . $row['id'] . "' />
                    <button type='submit' class='delete-btn'>Delete</button>
                </form>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No users found</td></tr>";
}

$mysqli->close(); // Close the database connection
?>
