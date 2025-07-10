<?php
session_start();
include '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Get file path
    $stmt = $conn->prepare("SELECT resume FROM applications WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();

    // Delete resume file from uploads
    if ($row && file_exists("../" . $row['resume'])) {
        unlink("../" . $row['resume']);
    }

    // Delete DB record
    $stmt = $conn->prepare("DELETE FROM applications WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: dashboard.php");
exit;
?>