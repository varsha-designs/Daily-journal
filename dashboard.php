<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM journal_entries WHERE user_id = ? ORDER BY entry_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Journal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <a href="dashboard.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="container">
        <h2>Your Journal</h2>
        <form method="post" action="add_entry.php">
            <textarea name="content" required placeholder="Write your journal..."></textarea>
            <button type="submit">Save Entry</button>
        </form>

        <h3>Previous Entries</h3>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="journal-entry">
                <strong><?= $row["entry_date"] ?></strong>
                <p><?= $row["content"] ?></p>
                <a href="edit_entry.php?id=<?= $row['id'] ?>">Edit</a>
                <a href="delete_entry.php?id=<?= $row['id'] ?>">Delete</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
