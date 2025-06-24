<?php
require_once 'db_connect.php';

if (!isset($_GET['id'])) {
    die('IDが指定されていません。');
}

$id = (int) $_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM stores WHERE id = :id");
    $stmt->execute([':id' => $id]);
    header("Location: register_store.php");
    exit;
} catch (PDOException $e) {
    echo "削除に失敗しました: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
}
