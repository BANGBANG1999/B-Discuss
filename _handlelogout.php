<?php
session_start();
echo 'Please wait. You are logging out...';
session_destroy();
header("Location: /forum/index.php");
?>