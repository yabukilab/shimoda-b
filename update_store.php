<?php
require_once 'db_connect.php';

if (!isset($_GET['id'])) {
    die('IDが指定されていません。');
}

$id = (int) $_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM stores WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $store = $stmt->fetch();

    if (!$store) {
        die('店舗が見つかりません。');
    }

} catch (PDOException $e) {
    die('データベースエラー: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8'));
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>店舗情報の編集</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css" />
</head>
<body>
<main class="container">
    <h1>店舗情報を編集する</h1>

    <form method="POST" action="update_store_process.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($store['id'], ENT_QUOTES, 'UTF-8') ?>">

        <label>
            店舗名
            <input type="text" name="store_name" value="<?= htmlspecialchars($store['store_name'], ENT_QUOTES, 'UTF-8') ?>" required>
        </label>

        <label>
            地域
            <input type="text" name="area" value="<?= htmlspecialchars($store['area'], ENT_QUOTES, 'UTF-8') ?>" required>
        </label>

        <label>
            住所
            <input type="text" name="address" value="<?= htmlspecialchars($store['address'], ENT_QUOTES, 'UTF-8') ?>" required>
        </label>

        <label>
            業種
            <select name="category" required>
                <option value="">業種を選択</option>
                <option value="food" <?= $store['category'] === 'food' ? 'selected' : '' ?>>飲食</option>
                <option value="retail" <?= $store['category'] === 'retail' ? 'selected' : '' ?>>小売</option>
                <option value="service" <?= $store['category'] === 'service' ? 'selected' : '' ?>>サービス</option>
            </select>
        </label>

        <fieldset>
            <legend>決済方法</legend>
            <?php
            $methods = explode(',', $store['payment_methods']);
            function isChecked($val, $methods) {
                return in_array($val, $methods) ? 'checked' : '';
            }
            ?>
            <label><input type="checkbox" name="payment_methods[]" value="credit" <?= isChecked('credit', $methods) ?>> クレジットカード</label>
            <label><input type="checkbox" name="payment_methods[]" value="qr" <?= isChecked('qr', $methods) ?>> QRコード決済</label>
            <label><input type="checkbox" name="payment_methods[]" value="emoney" <?= isChecked('emoney', $methods) ?>> 電子マネー</label>
            <label><input type="checkbox" name="payment_methods[]" value="cash" <?= isChecked('cash', $methods) ?>> 現金</label>
        </fieldset>

        <label>
            営業時間
            <input type="text" name="hours" value="<?= htmlspecialchars($store['hours'], ENT_QUOTES, 'UTF-8') ?>" required>
        </label>

        <label>
            定休日
            <input type="text" name="holidays" value="<?= htmlspecialchars($store['holidays'], ENT_QUOTES, 'UTF-8') ?>" required>
        </label>

        <label>
            備考
            <textarea name="notes"><?= htmlspecialchars($store['notes'], ENT_QUOTES, 'UTF-8') ?></textarea>
        </label>

        <button type="submit">更新する</button>
    </form>

    <p><a href="register_store.php">← 店舗情報登録に戻る</a></p>
</main>
</body>
</html>
