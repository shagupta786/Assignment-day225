<?php
session_start();
include '../includes/db.php';

if (isset($_POST['id'], $_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    
    $stmt = $conn->prepare("UPDATE applications SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
}

header("Location: dashboard.php");
