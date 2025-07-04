<?php
session_start();

// エラーメッセージ用の配列
$errors = [];

// POSTデータの取得（存在チェックとトリム）
$store_name = isset($_POST['store_name']) ? trim($_POST['store_name']) : '';
$area = isset($_POST['area']) ? trim($_POST['area']) : '';
$address = isset($_POST['address']) ? trim($_POST['address']) : '';
$category = isset($_POST['category']) ? trim($_POST['category']) : '';
$payment_methods = isset($_POST['payment_methods']) ? $_POST['payment_methods'] : [];
$hours = isset($_POST['hours']) ? trim($_POST['hours']) : '';
$holidays = isset($_POST['holidays']) ? trim($_POST['holidays']) : '';
$notes = isset($_POST['notes']) ? trim($_POST['notes']) : '';
$lang = $_POST['lang'] ?? 'ja';

// 必須入力チェック
if ($store_name === '' || $area === '' || $category === '') {
    $_SESSION['error'] = "店舗名、地域、業種はすべて入力必須です。";
    header("Location: error.php");
    exit;
}
if (empty($payment_methods)) {
    $_SESSION['error'] = "決済方法を1つ以上選択してください。";
    header("Location: error.php");
    exit;
}
if ($hours === '') {
    $_SESSION['error'] = "営業時間を入力してください。";
    header("Location: error.php");
    exit;
}
if ($holidays === '') {
    $_SESSION['error'] = "定休日を入力してください。";
    header("Location: error.php");
    exit;
}

// ✅ 営業時間フォーマットチェック（数字、~、: のみ許可）
if (!preg_match('/^[0-9:~\- ]+$/', $hours)) {
    $_SESSION['error'] = "営業時間には数字と「~」「:」「-」のみを使用してください。";
    header("Location: error.php");
    exit;
}

// ✅ 住所の不適切チェック
if (
    mb_strlen($address, 'UTF-8') < 5 ||
    !preg_match('/[市区町村]/u', $address) ||
    preg_match('/(不明|なし|123|abc|テスト|xxx|\?{2,})/iu', $address)
) {
    $_SESSION['error'] = "その住所は不適切です。";
    header("Location: error.php");
    exit;
}

// 決済方法をカンマ区切りの文字列に変換
$payment_methods_str = implode(',', $payment_methods);

// データベース接続
require_once 'db_connect.php';

try {
    $stmt = $pdo->prepare(
        'INSERT INTO stores 
        (store_name, area, address, category, payment_methods, hours, holidays, notes) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
    );

    $stmt->execute([
        $store_name,
        $area,
        $address,
        $category,
        $payment_methods_str,
        $hours,
        $holidays,
        $notes
    ]);

    $inserted_id = $pdo->lastInsertId();
    header("Location: register_complete.php?id=$inserted_id&lang=$lang");
    exit;

} catch (PDOException $e) {
    $_SESSION['error'] = 'データベースエラー: ' . $e->getMessage();
    header("Location: error.php");
    exit;
}
?>
