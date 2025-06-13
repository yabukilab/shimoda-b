<?php
$pdo = new PDO("mysql:host=localhost;dbname=payment_search;charset=utf8mb4", "root", "");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $store_name = $_POST["shop_name"];
    $area = $_POST["area"];
    $payment = $_POST["payment"];
    $category = $_POST["category"];

    $stmt = $pdo->prepare("UPDATE stores SET store_name=?, area=?, payment_methods=?, category=? WHERE id=?");
    $stmt->execute([$store_name, $area, $payment, $category, $id]);

    echo "店舗情報を更新しました。<br><a href='update_store.php'>戻る</a>";
    exit;
}

$shops = $pdo->query("SELECT * FROM stores")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
<head><meta charset="UTF-8"><title>店舗情報更新</title></head>
<body>
<h2>店舗情報更新</h2>
<?php foreach ($shops as $shop): ?>
<form method="POST">
  <input type="hidden" name="id" value="<?= $shop["id"] ?>">
  店舗名: <input type="text" name="shop_name" value="<?= $shop["store_name"] ?>"><br>
  地域: <input type="text" name="area" value="<?= $shop["area"] ?>"><br>
  決済方法: <input type="text" name="payment" value="<?= $shop["payment_methods"] ?>"><br>
  業種: <input type="text" name="category" value="<?= $shop["category"] ?>"><br>
  <button type="submit">更新</button>
</form><hr>
<?php endforeach; ?>
</body>
</html>
