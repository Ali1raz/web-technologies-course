<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $username = $_POST["username"];
    $newUsername = $_POST["newusername"];
    $pwd = $_POST["password"];

    try {
        require_once 'db.inc.php';

        $query = "UPDATE users set username = :newUsername where username = :username and pwd = :pwd;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":newUsername", $newUsername);
        $stmt->bindParam(":pwd", $pwd);

        $stmt->execute();

        $pdo = null;
        $stmt = null;
        header("Location: ../index.php");

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: ../index.php");
}