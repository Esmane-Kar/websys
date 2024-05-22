<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Admin Dashboard - Fruit Sales</title>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo $_SESSION['admin']; ?></h2>
        <p>This is the admin dashboard for managing fruit sales records.</p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
