<?php
require_once 'db_connect.php';

if (!isset($_POST['id'])) {
    die('不正なアクセスです。');
}

$id = (int) $_POST['id'];
$store_name = isset($_POST['store_name']) ? $_POST['store_name'] : '';
$area = isset($_POST['area']) ? $_POST['area'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';
$payment_methods = isset($_POST['payment_methods']) ? implode(',', $_POST['payment_methods']) : '';
$hours = isset($_POST['hours']) ? $_POST['hours'] : '';
$holidays = isset($_POST['holidays']) ? $_POST['holidays'] : '';
$notes = isset($_POST['notes']) ? $_POST['notes'] : '';

try {
    $stmt = $pdo->prepare("
        UPDATE stores SET
            store_name = :store_name,
            area = :area,
            address = :address,
            category = :category,
            payment_methods = :payment_methods,
            hours = :hours,
            holidays = :holidays,
            notes = :notes
        WHERE id = :id
    ");
    $stmt->execute([
        ':store_name' => $store_name,
        ':area' => $area,
        ':address' => $address,
        ':category' => $category,
        ':payment_methods' => $payment_methods,
        ':hours' => $hours,
        ':holidays' => $holidays,
        ':notes' => $notes,
        ':id' => $id
    ]);

    // ✅ 更新後に登録画面に戻る
    header("Location: register_store.php");
    exit;

} catch (PDOException $e) {
    echo "更新に失敗しました: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
}
