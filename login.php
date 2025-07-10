<?php
session_start();
include '../includes/db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
    } else {
        echo "Invalid credentials!";
    }
}
?>

<form method="POST">
  <input type="text" name="username" placeholder="Admin Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit" name="login">Login</button>
</form>
