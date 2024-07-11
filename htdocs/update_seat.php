<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "testuser";
$password = "pass";
$dbname = "shimoda-b";

// POSTされたデータを取得
$data = json_decode(file_get_contents('php://input'), true);
$position = $data['position'];
$status = $data['status'];

// データベースに接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続をチェック
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'データベース接続に失敗しました。']));
}

// SQLクエリを実行
$sql = "UPDATE seat SET status = ? WHERE position = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $status, $position);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'データベース更新に失敗しました。']);
}

$stmt->close();
$conn->close();
?>