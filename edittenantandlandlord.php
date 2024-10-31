<?php
include 'dbconfig.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$table = $_GET['table'];
$sql = "SELECT * FROM $table WHERE " . ucfirst($table) . "ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    die("Record not found");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Information</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>Edit <?= ucfirst($table) ?> Information</h1>
            </div>
        </div>
    </header>

    <section class="container">
        <form action="handlesform.php" method="POST">
            <input type="hidden" name="table" value="<?= $table ?>">
            <input type="hidden" name="id" value="<?= $id ?>">

            <?php foreach ($data as $key => $value) { ?>
                <?php if ($key !== ucfirst($table) . 'ID') { ?>
                    <label for="<?= $key ?>"><?= $key ?>:</label>
                    <input type="text" name="<?= $key ?>" value="<?= htmlspecialchars($value) ?>"><br>
                <?php } ?>
            <?php } ?>

            <input type="submit" value="Save Changes">
        </form>
    </section>
</body>
</html>
