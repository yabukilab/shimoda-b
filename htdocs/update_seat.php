<?php
require 'db.php'; // データベース接続を読み込み

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['position']) && isset($data['status'])) {
    $position = $data['position'];
    $status = $data['status'];

    try {
        $stmt = $pdo->prepare('UPDATE seat SET status = ? WHERE position = ?');
        if ($stmt->execute([$status, $position])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to execute statement.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid input.']);
}
?>
