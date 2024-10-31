<?php
include 'dbconfig.php';
session_start();

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found.";
    exit;
}

$sql = "SELECT * FROM changes WHERE user_id = :user_id ORDER BY change_time DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$changes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Current User</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h2>Current User: <?= htmlspecialchars($user['email']) ?></h2>
    <h3>Changes Made:</h3>
    <ul class="change-list">
    <?php foreach ($changes as $change) { ?>
        <li><?= htmlspecialchars($change['change_description']) ?> (<?= $change['change_time'] ?>)</li>
    <?php } ?>
    </ul>
</div>
</body>
</html>
