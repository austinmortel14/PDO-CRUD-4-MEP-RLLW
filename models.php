<?php
include 'dbconfig.php';

function addLandlord($pdo, $data) {
    $sql = "INSERT INTO Landlord (FullName, ContactNumber, Email, HomeAddress, TotalProperties, DateJoined, ManagementFeePercentage) 
            VALUES (:FullName, :ContactNumber, :Email, :HomeAddress, :TotalProperties, :DateJoined, :ManagementFeePercentage)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
}

function addTenant($pdo, $data) {
    $sql = "INSERT INTO Tenant (FirstName, LastName, DateOfBirth, Email, PhoneNumber, LeaseStartDate, LeaseEndDate, LandlordID)    
            VALUES (:FirstName, :LastName, :DateOfBirth, :Email, :PhoneNumber, :LeaseStartDate, :LeaseEndDate, :LandlordID)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
}

function getLandlords($pdo) {
    $sql = "SELECT * FROM Landlord";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getTenants($pdo) {
    $sql = "SELECT * FROM Tenant";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action == 'addLandlord') {
        addLandlord($pdo, [
            'FullName' => $_POST['FullName'],
            'ContactNumber' => $_POST['ContactNumber'],
            'Email' => $_POST['Email'],
            'HomeAddress' => $_POST['HomeAddress'],
            'TotalProperties' => $_POST['TotalProperties'],
            'DateJoined' => $_POST['DateJoined'],
            'ManagementFeePercentage' => $_POST['ManagementFeePercentage']
        ]);
    } elseif ($action == 'addTenant') {
        addTenant($pdo, [
            'FirstName' => $_POST['FirstName'],
            'LastName' => $_POST['LastName'],
            'DateOfBirth' => $_POST['DateOfBirth'],
            'Email' => $_POST['Email'],
            'PhoneNumber' => $_POST['PhoneNumber'],
            'LeaseStartDate' => $_POST['LeaseStartDate'],
            'LeaseEndDate' => $_POST['LeaseEndDate'],
            'LandlordID' => $_POST['LandlordID']
        ]);
    }

    header('Location: index.php');
}