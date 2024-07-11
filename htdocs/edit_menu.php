<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メニュー編集</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>

<div class="container">
    <h1>メニュー編集</h1>

    <?php
    require 'db.php';

    $errors = [];
    $messages = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // メニューの追加処理
        if (isset($_POST['add'])) {
            $sort = trim($_POST['sort']);
            $name = trim($_POST['name']);
            $price = trim($_POST['price']);
            $code = trim($_POST['code']);

            // 入力値の検証
            if (empty($sort) || !preg_match("/^[a-zA-Z0-9ぁ-んァ-ヶー一-龠]+$/u", $sort)) {
                $errors[] = "カテゴリーには有効な文字を使用してください。";
            }
            if (empty($name) || !preg_match("/^[a-zA-Z0-9ぁ-んァ-ヶー一-龠]+$/u", $name)) {
                $errors[] = "メニュー名には有効な文字を使用してください。";
            }
            if (empty($price) || !is_numeric($price)) {
                $errors[] = "価格には有効な数字を使用してください。";
            }
            if (empty($code) || !preg_match("/^[a-zA-Z0-9]+$/", $code)) {
                $errors[] = "メニュー番号には有効な文字を使用してください。";
            }

            // エラーがない場合、データベースに保存
            if (empty($errors)) {
                try {
                    $stmt = $pdo->prepare('INSERT INTO menu (sort, name, price, code) VALUES (?, ?, ?, ?)');
                    $stmt->execute([$sort, $name, $price, $code]);
                    $messages[] = "メニューが正常に追加されました。";
                } catch (PDOException $e) {
                    $errors[] = "データベースエラー: " . htmlspecialchars($e->getMessage());
                }
            }
        }

        // メニューの削除処理
        if (isset($_POST['delete'])) {
            $code = trim($_POST['code']);

            // 入力値の検証
            if (empty($code) || !preg_match("/^[a-zA-Z0-9]+$/", $code)) {
                $errors[] = "メニュー番号には有効な文字を使用してください。";
            } else {
                try {
                    // メニューが存在するか確認
                    $stmt = $pdo->prepare('SELECT * FROM menu WHERE code = ?');
                    $stmt->execute([$code]);
                    $menu = $stmt->fetch();

                    if ($menu) {
                        // メニューを削除
                        $stmt = $pdo->prepare('DELETE FROM menu WHERE code = ?');
                        $stmt->execute([$code]);
                        $messages[] = "メニューが正常に削除されました。";
                    } else {
                        $messages[] = "メニューは既に削除されています。";
                    }
                } catch (PDOException $e) {
                    $errors[] = "データベースエラー: " . htmlspecialchars($e->getMessage());
                }
            }
        }
    }
    ?>

    <?php if (!empty($errors)): ?>
        <div class="error-messages">
            <?php foreach ($errors as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($messages)): ?>
        <div class="success-messages">
            <?php foreach ($messages as $message): ?>
                <p><?php echo htmlspecialchars($message); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="edit_menu.php" method="post">
        <div>
            <label for="sort">カテゴリー:</label>
            <input type="text" id="sort" name="sort" required>
        </div>
        <div>
            <label for="name">メニュー名:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="price">価格:</label>
            <input type="text" id="price" name="price" required>
        </div>
        <div>
            <label for="code">メニュー番号:</label>
            <input type="text" id="code" name="code" required>
        </div>
        <button type="submit" name="add">追加</button>
        <button type="submit" name="delete">削除</button>
    </form>
</div>

</body>
</html>
