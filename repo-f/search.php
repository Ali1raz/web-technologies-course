<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userSearch = $_POST["search"];
    try {
        require_once "includes/db.inc.php";

        $query = "SELECT c.message, c.user_id, u.username, c.created_at 
                   FROM comments c 
                   JOIN users u ON u.id = c.user_id 
                   WHERE u.username = :userSearch";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":userSearch", $userSearch);

        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("QUERY FAILED: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php First website</title>
    <style>
        body {
            font-family: poppins;
            color: #fff;
            background: #222;
            margin: 0;
            width: 100%;
            height: 100vh;
        }
        .comment {
            background: #000;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <article>
        <h3>Search Results</h3>
        <?php if (isset($result) && !empty($result)) { ?>
            <?php foreach($result as $row) { ?>
                <div class='comment'>
                    <span> <?php echo htmlspecialchars($row["username"]); ?> </span>
                    <span> <?php echo htmlspecialchars($row["created_at"]); ?> </span>
                    <p> <?php echo htmlspecialchars($row["message"]); ?> </p>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div>
                <p>There is no result.</p>
            </div>
        <?php } ?>
        </article>
</body>
</html>
