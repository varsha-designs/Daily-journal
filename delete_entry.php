<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$entry_id = $_GET["id"];
$user_id = $_SESSION["user_id"];

$sql = "DELETE FROM journal_entries WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $entry_id, $user_id);

if ($stmt->execute()) {
    header("Location: dashboard.php");
} else {
    echo "Error deleting entry.";
}
?>
