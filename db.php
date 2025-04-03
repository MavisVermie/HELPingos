<?php
$conn = mysqli_connect("localhost", "root", "", "helpingos");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
