<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userId = $_POST["search"];

    try {
        require_once "includes/db.inc.php";

        $query = "select * from comments where user_id = :userId";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":userId", $userId);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $pdo = null;
        $stmt = null;

        // header("Location: index.php");

    } catch (PDOException $e) {
        die("QUERY FAILED: " . $e->getMessage());
    }

} else {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php First website</title>
    <link rel="stylesheet" href="./style/styles.css">
</head>
<body>
    <main>
        <h3>Search Results</h3>
        <?php
        if (empty($result)) {
            echo "<div>";
            echo "<p>There is no result.</p>";
            echo "</div>";
        } else {
            foreach($result as $row) {
                echo "<div class='comment'>";
                echo "<span> " . htmlspecialchars($row["user_id"]) . "</span>";
                echo "<span> " . htmlspecialchars($row["created_at"]) . "</span>";
                echo "<p> " . htmlspecialchars($row["message"]) . "</p>";
                echo "</div>";
            }
        }
        ?>
    </main>
</body>
</html>