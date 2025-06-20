<?php
require_once 'db_connect.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: error.php');
    exit;
}

$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM stores WHERE id = ?");
    $stmt->execute([$id]);
    $store = $stmt->fetch();

    if (!$store) {
        header('Location: error.php');
        exit;
    }
} catch (PDOException $e) {
    echo "データベースエラー: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>店舗詳細情報</title>
</head>
<body>
    <h1>店舗詳細情報</h1>

    <ul>
        <li><strong>店舗名：</strong> <?php echo htmlspecialchars($store['name'], ENT_QUOTES, 'UTF-8'); ?></li>
        <li><strong>地域：</strong> <?php echo htmlspecialchars($store['area'], ENT_QUOTES, 'UTF-8'); ?></li>
        <li><strong>住所：</strong> <?php echo htmlspecialchars($store['address'], ENT_QUOTES, 'UTF-8'); ?></li>
        <li><strong>業種：</strong> <?php echo htmlspecialchars($store['category'], ENT_QUOTES, 'UTF-8'); ?></li>
        <li><strong>決済方法：</strong> <?php echo htmlspecialchars($store['payment_methods'], ENT_QUOTES, 'UTF-8'); ?></li>
        <li><strong>営業時間：</strong> <?php echo htmlspecialchars($store['business_hours'], ENT_QUOTES, 'UTF-8'); ?></li>
        <li><strong>定休日：</strong> <?php echo htmlspecialchars($store['holidays'], ENT_QUOTES, 'UTF-8'); ?></li>
        <li><strong>備考：</strong> <?php echo nl2br(htmlspecialchars($store['notes'], ENT_QUOTES, 'UTF-8')); ?></li>
    </ul>

    <!-- 編集ボタン -->
    <form action="update_store.php" method="get" style="margin-top: 20px;">
        <input type="hidden" name="id" value="<?php echo $store['id']; ?>">
        <button type="submit" style="padding:8px 16px; background:#007bff; color:#fff; border:none; border-radius:4px;">
            編集する
        </button>
    </form>

    <!-- 削除ボタン（確認ダイアログ付き） -->
    <form action="delete_store.php" method="get" onsubmit="return confirm('この店舗情報を本当に削除してもよろしいですか？');" style="margin-top: 10px;">
        <input type="hidden" name="id" value="<?php echo $store['id']; ?>">
        <button type="submit" style="padding:8px 16px; background:#dc3545; color:#fff; border:none; border-radius:4px;">
            削除する
        </button>
    </form>

</body>
</html>
