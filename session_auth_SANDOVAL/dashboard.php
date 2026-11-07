<?php
session_start();

// Kick the user out if they aren't logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <!-- htmlspecialchars stops malicious code scripts from executing -->
    <h2>Welcome to your Dashboard, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>You have successfully bypassed the login wall.</p>
    
    <br><br>
    <a href="logout.php">Log Out Safely</a>
</body>
</html>
