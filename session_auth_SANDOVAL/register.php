<?php
require_once 'db.php';
session_start();

$message = "";

// Check if the HTML form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the HTML form inputs
    $username = $_POST['form_username'];
    $email = $_POST['form_email'];
    $password_hash = $_POST['form_password_hash'];

    // Secure the text to prevent database breaking/hacking
    $username = $conn->real_escape_string($username);
    $email = $conn->real_escape_string($email);
    $hashed_password = password_hash($password_hash, PASSWORD_DEFAULT);

    // Simple SQL query string without parameters
    $sql = "INSERT INTO users (username, email, password_hash) VALUES ('$username', '$email', '$hashed_password')";

    // Run the query
    if ($conn->query($sql) === TRUE) {
        $message = "Registration successful! You can now log in.";
    } else {
        $message = "Error: Username might already be taken.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
    <h2>Register a New Account</h2>
    <p style="color: blue;"><?php echo $message; ?></p>

    <!-- Standard HTML Form -->
    <form method="POST" action="register.php">
        <label>Username:</label><br>
        <input type="text" name="form_username" required><br><br>

        <label>Email:</label><br>
        <input type="text" name="form_email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="form_password_hash" required><br><br>

        <button type="submit">Register</button>
    </form>
    
    <p>Already have an account? <a href="index.php">Login here</a></p>
</body>
</html>
