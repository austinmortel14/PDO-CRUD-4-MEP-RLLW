<?php
include 'dbconfig.php';
include 'models.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include 'navbar.php';
$landlords = getLandlords($pdo);
$tenants = getTenants($pdo);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bob Cat's Commercial Space</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>Bob Cat's Commercial Space</h1>
            </div>
        </div>
    </header>

    <section class="container">
        <h2>Register Landlord</h2>
        <form action="models.php" method="POST">
            <input type="hidden" name="action" value="addLandlord">
            Full Name: <input type="text" name="FullName"><br>
            Contact Number: <input type="text" name="ContactNumber"><br>
            Email: <input type="text" name="Email"><br>
            Home Address: <textarea name="HomeAddress"></textarea><br>
            Total Properties: <input type="number" name="TotalProperties"><br>
            Date Joined: <input type="date" name="DateJoined"><br>
            Management Fee Percentage: <input type="text" name="ManagementFeePercentage"><br>
            <input type="submit" value="Add Landlord">
        </form>

        <h2>Register Tenant</h2>
        <form action="models.php" method="POST">
            <input type="hidden" name="action" value="addTenant">
            First Name: <input type="text" name="FirstName"><br>
            Last Name: <input type="text" name="LastName"><br>
            Date of Birth: <input type="date" name="DateOfBirth"><br>
            Email: <input type="text" name="Email"><br>
            Phone Number: <input type="text" name="PhoneNumber"><br>
            Lease Start Date: <input type="date" name="LeaseStartDate"><br>
            Lease End Date: <input type="date" name="LeaseEndDate"><br>
            Landlord: 
            <select name="LandlordID">
                <?php foreach ($landlords as $landlord) { ?>
                    <option value="<?= $landlord['LandlordID'] ?>"><?= htmlspecialchars($landlord['FullName']) ?></option>
                <?php } ?>
            </select><br>
            <input type="submit" value="Add Tenant">
        </form>

        <h2>Landlords</h2>
        <ul>
            <?php foreach ($landlords as $landlord) { ?>
                <li>
                    <?= htmlspecialchars($landlord['FullName']) ?> - <a href="edittenantandlandlord.php?table=Landlord&id=<?= $landlord['LandlordID'] ?>">Edit</a> 
                    <a href="deletetenantandlandlord.php?table=Landlord&id=<?= $landlord['LandlordID'] ?>">Delete</a>
                </li>
            <?php } ?>
        </ul>

        <h2>Tenants</h2>
        <ul>
            <?php foreach ($tenants as $tenant) { ?>
                <li>
                    <?= htmlspecialchars($tenant['FirstName'] . " " . $tenant['LastName']) ?> - <a href="edittenantandlandlord.php?table=Tenant&id=<?= $tenant['TenantID'] ?>">Edit</a> 
                    <a href="deletetenantandlandlord.php?table=Tenant&id=<?= $tenant['TenantID'] ?>">Delete</a>
                </li>
            <?php } ?>
        </ul>
    </section>
</body>
</html>
