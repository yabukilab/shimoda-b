<?php
require_once 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>店舗登録</title>
</head>
<body>
    <h1>店舗登録フォーム</h1>
    <form action="register_store_process.php" method="post">
        <label>店舗名：<input type="text" name="store_name" required></label><br>
        <label>地域：<input type="text" name="area" required></label><br>
        <label>住所：<input type="text" name="address" required></label><br>
        <label>業種：<input type="text" name="category" required></label><br>
        <label>決済方法：<input type="text" name="payment_methods" required></label><br>
        <label>営業時間：<input type="text" name="business_hours" required></label><br>
        <label>定休日：<input type="text" name="holidays" required></label><br>
        <label>備考：<textarea name="notes"></textarea></label><br>
        <input type="submit" value="登録">
    </form>

    <hr>
    <h2>登録済み店舗一覧（編集・削除）</h2>

    <?php
    try {
        $stmt = $pdo->query("SELECT * FROM stores ORDER BY id DESC");
        $results = $stmt->fetchAll();

        if (count($results) === 0) {
            echo "<p>現在登録されている店舗情報はありません。</p>";
        } else {
            foreach ($results as $store) {
                echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:10px;'>";
                echo "<strong>店舗名：</strong>" . htmlspecialchars($store['name'], ENT_QUOTES, 'UTF-8') . "<br>";
                echo "<strong>地域：</strong>" . htmlspecialchars($store['area'], ENT_QUOTES, 'UTF-8') . "<br>";
                echo "<strong>住所：</strong>" . htmlspecialchars($store['address'], ENT_QUOTES, 'UTF-8') . "<br>";

                // 編集ボタン
                echo "<form action='update_store.php' method='get' style='display:inline-block; margin-top:5px;'>";
                echo "<input type='hidden' name='id' value='" . htmlspecialchars($store['id'], ENT_QUOTES, 'UTF-8') . "'>";
                echo "<button type='submit' style='padding:6px 12px; background:#007bff; color:#fff; border:none; border-radius:4px;'>編集</button>";
                echo "</form>";

                // 削除ボタン
                echo "<form action='delete_store.php' method='get' style='display:inline-block; margin-left:10px; margin-top:5px;' onsubmit=\"return confirm('この店舗情報を削除しますか？');\">";
                echo "<input type='hidden' name='id' value='" . htmlspecialchars($store['id'], ENT_QUOTES, 'UTF-8') . "'>";
                echo "<button type='submit' style='padding:6px 12px; background:#dc3545; color:#fff; border:none; border-radius:4px;'>削除</button>";
                echo "</form>";

                echo "</div>";
            }
        }
    } catch (PDOException $e) {
        echo "<p>一覧表示エラー: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</p>";
    }
    ?>

</body>
</html>
