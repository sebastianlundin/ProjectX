<?php
require_once 'DbHandler.php';
require_once 'AuthHandler.php';

$dbHandler = new DbHandler();
$sqlQuery = "INSERT INTO rating (userId, snippetId, rating) VALUES (?, ?, ?)";

$user_id = $_POST['user_id']; // Should get user_id from cookie or something here
$snippet_id = $_POST['snippet_id'];
$rating = $_POST['rating'];


if ($stmt = $dbHandler->PrepareStatement($sqlQuery)) {
    $stmt->bind_param("iii", $user_id, $snippet_id, $rating);
    if ($stmt->execute()) {
        echo "<p>Thank you for voting!</p>";
    } else {
        echo "<p>You have already voted on this snippet</p>";
    }
    $stmt->close();
}