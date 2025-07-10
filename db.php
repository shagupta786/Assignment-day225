<?php
$conn = new mysqli("localhost", "root", "", "internship_portal");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
