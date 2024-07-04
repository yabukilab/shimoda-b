<?php
require 'db.php'; // データベース接続を読み込み

header('Content-Type: application/json');

$stmt = $pdo->query('SELECT position, status FROM seat');
$seats = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($seats);
?>
