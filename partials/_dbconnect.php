<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "bdiscuss";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn)
{
    die("Error ");
}
?>