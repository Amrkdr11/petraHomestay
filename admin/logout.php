<?php
session_start();
session_destroy();
// Redirect to the homepage or any other page
header("Location: ../home.php");
exit();
?>
