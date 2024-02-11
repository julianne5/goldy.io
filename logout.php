<?php 
    session_start();
    session_destroy();
    header("Location: login.php");
    exit(); // Ensure the script stops execution after redirect
?>
