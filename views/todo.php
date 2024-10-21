<?php
include '../config/db.php';
include '../includes/functions.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO todo_lists (user_id, title) VALUES (?, ?)");
    if ($stmt->execute([$user_id, $title])) {
        header("Location: dashboard.php");
    } else {
        echo "Error creating to-do list.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create To-Do List</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Create To-Do List</h2>
    <form action="" method="POST">
        <input type="text" name="title" placeholder="To-Do List Title" required>
        <button type="submit">Create</button>
    </form>
</body>
</html>
