<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include '../includes/db.php';
$result = $conn->query("SELECT * FROM applications");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      margin: 20px;
    }

    table {
      width: 90%;
      margin: auto;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 12px;
      text-align: center;
      border-bottom: 1px solid #ddd;
      font-size: 16px;
    }

    th {
      background-color: #333;
      color: white;
    }

    a {
      color: blue;
      text-decoration: none;
      font-weight: bold;
    }

    form {
      display: inline;
      margin: 0;
    }

    select, button {
      padding: 6px 10px;
      font-size: 14px;
    }

    .logout-link {
      display: block;
      width: 90%;
      margin: 10px auto;
      text-align: right;
      font-size: 16px;
    }

    .logout-link a {
      color: red;
      text-decoration: none;
      font-weight: bold;
    }

    .delete-btn {
      background-color: red;
      color: white;
      border: none;
      padding: 6px 10px;
      cursor: pointer;
    }

    .delete-btn:hover {
      background-color: darkred;
    }
  </style>
</head>
<body>

<div class="logout-link">
  <a href="logout.php">Logout</a>
</div>

<table>
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Resume</th>
    <th>Status</th>
    <th>Update</th>
  </tr>

  <?php while($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?= $row['name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><a href="../<?= $row['resume'] ?>" target="_blank">View</a></td>
    <td><?= $row['status'] ?></td>
    <td>
      <!-- Update Form -->
      <form action="update_status.php" method="POST">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <select name="status">
          <option <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
          <option <?= $row['status'] == 'Selected' ? 'selected' : '' ?>>Selected</option>
          <option <?= $row['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
        </select>
        <button type="submit">Update</button>
      </form>

      <!-- Delete Form -->
      <form action="delete.php" method="GET" onsubmit="return confirm('Are you sure to delete this entry?');">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <button type="submit" class="delete-btn">Delete</button>
      </form>
    </td>
  </tr>
  <?php endwhile; ?>
</table>

</body>
</html>