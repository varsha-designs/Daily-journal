<?php
include "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    
    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE type>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>

<form method="post">
    <input type="text" name="username" required placeholder="Username">
    <input type="password" name="password" required placeholder="Password">
    <button type="submit">Register</button>
</form>
</html>
