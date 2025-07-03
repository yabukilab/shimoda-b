<?php
require_once 'db_connect.php';

$lang = $_GET['lang'] ?? 'ja';
$is_en = ($lang === 'en');

// フォーム値取得
$shop_name = trim($_GET['shop_name'] ?? '');
$area = trim($_GET['area'] ?? '');
$payment = $_GET['payment'] ?? '';
$category = $_GET['category'] ?? '';

// 入力がすべて空の場合は警告表示
if ($shop_name === '' && $area === '' && $payment === '' && $category === '') {
    $error_message = $is_en
        ? 'Please enter at least one search condition'
        : '検索条件を1つ以上入力してください';
    ?>
    <!DOCTYPE html>
    <html lang="<?= $is_en ? 'en' : 'ja' ?>">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title><?= $is_en ? 'Search Error' : '検索エラー' ?></title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css" />
    </head>
    <body>
    <main class="container">
      <h2><?= $is_en ? 'Search Error' : '検索エラー' ?></h2>
      <p style="color:red;"><?= htmlspecialchars($error_message) ?></p>
      <form action="index.php" method="GET" style="margin-top: 1em;">
        <input type="hidden" name="lang" value="<?= $lang ?>">
        <button type="submit"><?= $is_en ? 'Back to Search Page' : '検索画面に戻る' ?></button>
      </form>
    </main>
    </body>
    </html>
    <?php
    exit;
}

// SQL検索処理
$sql = "SELECT * FROM stores WHERE 1=1";
$params = [];

if ($shop_name !== '') {
    $sql .= " AND store_name LIKE ?";
    $params[] = "%{$shop_name}%";
}
if ($area !== '') {
    $sql .= " AND area LIKE ?";
    $params[] = "%{$area}%";
}
if ($payment !== '') {
    $sql .= " AND payment_methods LIKE ?";
    $params[] = "%{$payment}%";
}
if ($category !== '') {
    $sql .= " AND category = ?";
    $params[] = $category;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="<?= $is_en ? 'en' : 'ja' ?>">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= $is_en ? 'Search Results' : '検索結果' ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css" />
</head>
<body>

<main class="container">
  <h2><?= $is_en ? 'Search Results' : '検索結果' ?></h2>

  <?php if (count($results) === 0): ?>
    <p><?= $is_en ? 'No matching stores found.' : '条件に一致する店舗が見つかりませんでした。' ?></p>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th><?= $is_en ? 'Store Name' : '店舗名' ?></th>
          <th><?= $is_en ? 'Area' : '地域' ?></th>
          <th><?= $is_en ? 'Payment Methods' : '決済方法' ?></th>
          <th><?= $is_en ? 'Category' : '業種' ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($results as $shop): ?>
          <tr>
            <td>
              <a href="shop_detail.php?id=<?= $shop['id'] ?>&lang=<?= $lang ?>&shop_name=<?= urlencode($shop_name) ?>&area=<?= urlencode($area) ?>&category=<?= urlencode($category) ?>&payment=<?= urlencode($payment) ?>">
                <?= htmlspecialchars($shop['store_name']) ?>
              </a>
            </td>
            <td><?= htmlspecialchars($shop['area']) ?></td>
            <td>
              <?php
              $payments = explode(',', $shop['payment_methods']);
              $labels = [
                'credit' => ['ja' => 'クレジットカード', 'en' => 'Credit Card'],
                'qr' => ['ja' => 'QRコード決済', 'en' => 'QR Code'],
                'emoney' => ['ja' => '電子マネー', 'en' => 'E-Money'],
                'cash' => ['ja' => '現金', 'en' => 'Cash']
              ];
              $translated = array_map(fn($p) => $labels[$p][$is_en ? 'en' : 'ja'] ?? $p, $payments);
              echo implode(', ', $translated);
              ?>
            </td>
            <td>
              <?php
              $categories = [
                'food' => ['ja' => '飲食', 'en' => 'Food & Drink'],
                'retail' => ['ja' => '小売', 'en' => 'Retail'],
                'service' => ['ja' => 'サービス', 'en' => 'Service']
              ];
              echo $categories[$shop['category']][$is_en ? 'en' : 'ja'];
              ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>

  <form action="index.php" method="GET" style="margin-top: 1em;">
    <input type="hidden" name="lang" value="<?= $lang ?>">
    <button type="submit"><?= $is_en ? 'Back to Search Page' : '検索画面に戻る' ?></button>
  </form>
</main>

</body>
</html>
