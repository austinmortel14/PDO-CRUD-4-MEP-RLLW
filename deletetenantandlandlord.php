<?php
include 'dbconfig.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$table = $_GET['table'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['confirmation'] === 'Yes') {
        if ($table == 'Landlord') {
           
            $sql = "DELETE FROM Tenant WHERE LandlordID = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
        }
        $sql = "DELETE FROM $table WHERE " . ucfirst($table) . "ID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        
        header('Location: index.php');
        exit;
    } else {
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Confirmation</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>Delete <?= ucfirst($table) ?> Record</h1>
            </div>
        </div>
    </header>

    <section class="container">
        <form method="POST">
            <p>Are you sure you want to delete this record?</p>
            <input type="submit" name="confirmation" value="Yes">
            <input type="submit" name="confirmation" value="No">
        </form>
    </section>
</body>
</html>
