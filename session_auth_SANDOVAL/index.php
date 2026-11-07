<?php
require_once 'db.php';
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the HTML form inputs
    $usernameoremail = $_POST['form_usernameoremail'];
    $password = $_POST['form_password_hash'];

    $usernameoremail = $conn->real_escape_string($usernameoremail);

    // Look for the user in the database
    $sql = "SELECT * FROM users WHERE username = '$usernameoremail' OR email = '$usernameoremail";
    $result = $conn->query($sql);

    // If we found the user 
    if ($result->num_rows > 0) {
        $user_row = $result->fetch_assoc(); // Turn data into an easy array

        // Check if the typed password matches the saved hash
        if (password_verify($password, $user_row['password_hash'])) {
            // Log them in by saving their info to the Session
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user_row['username'];

            // Go to the dashboard
            header("Location: dashboard.php");
            exit;
        } else {
            $message = "Wrong password!";
        }
    } else {
        $message = "User not found!";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <h2>Login to Your Account</h2>
    <p style="color: red;"><?php echo $message; ?></p>

    <!-- Standard HTML Form -->
    <form method="POST" action="login.php">
        <label>Username or Email:</label><br>
        <input type="text" name="form_usernameoremail" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="form_password_hash" required><br><br>

        <button type="submit">Log In</button>
    </form>

    <p>Need an account? <a href="register.php">Register here</a></p>
</body>
</html>

