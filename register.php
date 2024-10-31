<?php
include 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (empty($email) || empty($password)) {
        echo "Please fill in all fields.";
        exit;
    }

    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{10,}$/", $password)) {
        echo "Password must be at least 10 characters long and include at least one uppercase letter, one lowercase letter, and one number.";
        exit;
    }
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email, 'password' => $hashedPassword]);
    
    echo "Registration successful. <a href='login.php'>Login here</a>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function validatePassword() {
            var password = document.getElementById('password').value;
            var errorMessage = document.getElementById('error-message');
            var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{10,}$/;

            if (!regex.test(password)) {
                errorMessage.textContent = 'Password must be at least 10 characters long and include at least one uppercase letter, one lowercase letter, and one number.';
                return false;
            }

            errorMessage.textContent = '';
            return true;
        }
    </script>
</head>
<body>
<form method="POST" onsubmit="return validatePassword()">
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" id="password" name="password" required><br>
    <span id="error-message"></span><br>
    <input type="submit" value="Register">
</form>
</body>
</html>
