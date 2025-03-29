<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["password"];

    try {
        require_once 'db.inc.php';

        $query = 'DELETE FROM users where username = :username AND pwd = :pwd;';

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $pwd);

        $stmt->execute();

        $pdo = null;
        $stmt = null;

        header("Location: ../index.php");

    } catch (PDOException $e) {
        die("QUERY FAILED: " . $e->getMessage());
    }

} else {
    header("Location: ../index.php");
}