<?php
include 'includes/db.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    $file = $_FILES['resume'];
    $allowed = ['pdf', 'doc', 'docx'];
    $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    if (in_array($fileExt, $allowed) && $file['size'] < 2 * 1034 * 1034) {
        $newName = uniqid() . "." . $fileExt;
        $filePath = "uploads/" . $newName;
        move_uploaded_file($file['tmp_name'], $filePath);
        
        $stmt = $conn->prepare("INSERT INTO applications (name, email, resume) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $filePath);
        $stmt->execute();
        echo "Application submitted successfully!";
    } else {
        echo "Invalid file type or size exceeds 2MB.";
    }
}
?>
