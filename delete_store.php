<?php
require_once 'db_connect.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: error.php');
    exit;
}

$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM stores WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: index.php"); // 削除後の遷移先
    exit;
} catch (PDOException $e) {
    echo "削除中にエラーが発生しました: " . $e->getMessage();
    exit;
}
?>
