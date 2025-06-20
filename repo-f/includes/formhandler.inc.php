<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $username = $_POST["username"];
    $pwd = $_POST["password"];

    try {
        require_once 'db.inc.php';

        $query = "INSERT INTO users (username, pwd) VALUES (?, ?);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([$username, $pwd]);

        $pdo = null;
        $stmt = null;
        header("Location: ../index.php");

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: ../index.php");
}