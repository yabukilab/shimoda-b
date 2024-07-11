<?php
require 'db.php'; 

$stmt = $pdo->query('SELECT position, status FROM seat');
$stmt = $pdo->prepare('SELECT position, status FROM seat ORDER BY position ASC');
$stmt->execute();
$seats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>混雑状況確認</title>
        <link rel="stylesheet" href="status.css">
	</head>
    <body>
        <h1>座席利用状況</h1>

        <form action="index.php" method="post">
        <button type="submit" name="top">TOP</button>

        <div class="seat-container">
        <script src="status.js"></script>
        </div>    
    </body>
</html>

