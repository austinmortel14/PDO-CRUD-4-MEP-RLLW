<?php
include 'dbconfig.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $table = $_POST['table'];
    $id = $_POST['id'];
    $fields = [];
    $params = [];
    $user_id = $_SESSION['user_id'];
    $change_description = "Updated record in $table with ID $id: ";

    foreach ($_POST as $key => $value) {
        if ($key !== 'table' && $key !== 'id') {
            $fields[] = "$key = :$key";
            $params[$key] = $value;
            $change_description .= "$key = $value, ";
        }
    }

    $change_description = rtrim($change_description, ', ');

    $params['id'] = $id;
    $sql = "UPDATE $table SET " . implode(', ', $fields) . " WHERE " . ucfirst($table) . "ID = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    // Log the change
    $sql = "INSERT INTO changes (user_id, change_description) VALUES (:user_id, :change_description)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id, 'change_description' => $change_description]);

    header('Location: index.php');
}