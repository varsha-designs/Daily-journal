<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$entry_id = $_GET["id"];
$user_id = $_SESSION["user_id"];

// Fetch the entry
$sql = "SELECT * FROM journal_entries WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $entry_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$entry = $result->fetch_assoc();

if (!$entry) {
    echo "Entry not found!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = $_POST["content"];
    $sql = "UPDATE journal_entries SET content = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $content, $entry_id);
    
    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo "Error updating entry.";
    }
}
?>

<form method="post">
    <textarea name="content" required><?= $entry["content"] ?></textarea>
    <button type="submit">Update</button>
</form>
