<?php
session_start();

// Wipe out all session data
session_unset();
session_destroy();

// Go back to login
header("Location: index.php");
exit;
?>
