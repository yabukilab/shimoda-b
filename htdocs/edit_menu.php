<?php
// データベース接続ファイルを読み込み
require 'db.php';

// 初期化
$errors = [];
$success = '';

// メニュー登録処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_menu'])) {
    $sort = $_POST['sort'] ?? '';
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $image = $_FILES['image']['tmp_name'] ?? '';

    // 入力チェック
    if (empty($sort)) {
        $errors[] = 'メニュー区分を入力してください。';
    }
    if (empty($name)) {
        $errors[] = 'メニュー名を入力してください。';
    }
    if (empty($price)) {
        $errors[] = '価格を入力してください。';
    }
    if (empty($image)) {
        $errors[] = '画像を選択してください。';
    }

    // エラーがない場合、データベースに登録
    if (empty($errors)) {
        $imageData = file_get_contents($image);
        $stmt = $pdo->prepare('INSERT INTO menu (sort, name, price, image) VALUES (?, ?, ?, ?)');
        if ($stmt->execute([$sort, $name, $price, $imageData])) {
            $success = 'メニューが正常に追加されました。';
        } else {
            $errors[] = 'メニューの追加に失敗しました。';
        }
    }
}

// メニュー削除処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_menu'])) {
    $code = $_POST['code'] ?? '';

    // 入力チェック
    if (empty($code)) {
        $errors[] = 'メニュー番号を入力してください。';
    } else {
        $stmt = $pdo->prepare('DELETE FROM menu WHERE code = ?');
        if ($stmt->execute([$code])) {
            $success = 'メニューが正常に削除されました。';
        } else {
            $errors[] = 'メニューの削除に失敗しました。';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メニュー編集</title>
</head>
<body>
    <h1>メニュー編集</h1>

    <?php if (!empty($errors)): ?>
        <ul style="color: red;">
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <p style="color: green;"><?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>

    <h2>メニュー追加</h2>
    <form action="edit_menu.php" method="post" enctype="multipart/form-data">
        <label for="sort">メニュー区分:</label>
        <input type="text" name="sort" id="sort"><br>
        <label for="name">メニュー名:</label>
        <input type="text" name="name" id="name"><br>
        <label for="price">価格:</label>
        <input type="text" name="price" id="price"><br>
        <label for="image">画像:</label>
        <input type="file" name="image" id="image"><br>
        <input type="submit" name="add_menu" value="追加">
    </form>

    <h2>メニュー削除</h2>
    <form action="edit_menu.php" method="post">
        <label for="code">メニュー番号:</label>
        <input type="text" name="code" id="code"><br>
        <input type="submit" name="delete_menu" value="削除">
    </form>
</body>
</html>
