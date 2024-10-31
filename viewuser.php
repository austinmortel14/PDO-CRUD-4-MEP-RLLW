<?php
include 'dbconfig.php';

$sql = "SELECT * FROM users";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h2>All Users</h2>
    <ul class="user-list">
    <?php foreach ($users as $user) { ?>
        <li><?= htmlspecialchars($user['email']) ?></li>
    <?php } ?>
    </ul>
</div>
</body>
</html>
