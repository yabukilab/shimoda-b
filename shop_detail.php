<?php
require_once 'db_connect.php';

$lang = $_GET['lang'] ?? 'ja';
$is_en = ($lang === 'en');

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    header("Location: error_incomplete.php?lang=$lang");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM stores WHERE id = ?");
$stmt->execute([$id]);
$shop = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$shop) {
    header("Location: error_incomplete.php?lang=$lang");
    exit;
}

// 必須項目が空ならエラーに遷移（備考は除く）
$required_fields = ['store_name', 'area', 'address', 'category', 'payment_methods', 'hours', 'holidays'];
foreach ($required_fields as $field) {
    if (empty($shop[$field])) {
        header("Location: error_incomplete.php?lang=$lang");
        exit;
    }
}

$category_dict = [
  'food' => ['ja' => '飲食', 'en' => 'Food & Drink'],
  'retail' => ['ja' => '小売', 'en' => 'Retail'],
  'service' => ['ja' => 'サービス', 'en' => 'Service'],
];

$payments_dict = [
  'credit' => ['ja' => 'クレジットカード', 'en' => 'Credit Card'],
  'qr' => ['ja' => 'QRコード決済', 'en' => 'QR Code Payment'],
  'emoney' => ['ja' => '電子マネー', 'en' => 'E-Money'],
  'cash' => ['ja' => '現金', 'en' => 'Cash'],
];

$translated_payments = array_map(function($p) use ($payments_dict, $is_en) {
    return $payments_dict[trim($p)][$is_en ? 'en' : 'ja'] ?? $p;
}, explode(',', $shop['payment_methods']));
?>

<!DOCTYPE html>
<html lang="<?= $is_en ? 'en' : 'ja' ?>">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= $is_en ? 'Store Details' : '店舗詳細' ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css" />
</head>
<body>
<main class="container">
  <h2><?= htmlspecialchars($shop['store_name']) ?></h2>

  <ul>
    <li><?= $is_en ? 'Area' : '地域' ?>: <?= htmlspecialchars($shop['area']) ?></li>
    <li><?= $is_en ? 'Address' : '住所' ?>: <?= htmlspecialchars($shop['address']) ?></li>
    <li><?= $is_en ? 'Category' : '業種' ?>: <?= $category_dict[$shop['category']][$is_en ? 'en' : 'ja'] ?></li>
    <li><?= $is_en ? 'Payment Methods' : '決済方法' ?>: <?= implode(', ', $translated_payments) ?></li>
    <li><?= $is_en ? 'Business Hours' : '営業時間' ?>: <?= htmlspecialchars($shop['hours']) ?></li>
    <li><?= $is_en ? 'Holidays' : '定休日' ?>: <?= htmlspecialchars($shop['holidays']) ?></li>
    <?php if (!empty($shop['notes'])): ?>
      <li><?= $is_en ? 'Notes' : '備考' ?>: <?= nl2br(htmlspecialchars($shop['notes'])) ?></li>
    <?php endif; ?>
  </ul>

  <a href="index.php?lang=<?= $lang ?>"><?= $is_en ? 'Back to Home' : 'ホームに戻る' ?></a>
</main>
</body>
</html>
