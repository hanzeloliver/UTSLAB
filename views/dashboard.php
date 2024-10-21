<?php
include '../config/db.php';
include '../includes/functions.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM todo_lists WHERE user_id = ?");
$stmt->execute([$user_id]);
$todo_lists = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Your To-Do Lists</h2>
    <a href="todo.php">Create New To-Do List</a>
    <ul>
        <?php foreach ($todo_lists as $list): ?>
            <li><?= htmlspecialchars($list['title']); ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="profile.php">View Profile</a>
    <a href="logout.php">Logout</a>
</body>
</html>
