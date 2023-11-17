<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "site";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get values from the login form
$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$query = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Verify hashed password
    if (password_verify($password, $row['password'])) {
        // Successful login
        echo "Login successful!";
    } else {
        // Failed login
        echo "Login failed. Invalid username or password.";
    }
} else {
    // Failed login
    echo "Login failed. Invalid username or password.";
}

$conn->close();
?>
