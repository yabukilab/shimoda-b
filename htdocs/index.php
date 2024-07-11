<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>食堂利用システム</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>本日のメニュー</h1>
    <form action="disp_seat.php" method="post">
        <button type="submit" name="seat">混雑<br>状況</button>
    </form>

    <?php
    require 'db.php';

    // カテゴリーごとのメニュー数をカウント
    $stmt = $pdo->query('SELECT sort, COUNT(*) as count FROM menu GROUP BY sort ORDER BY count DESC');
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sortedMenus = [];
    foreach ($categories as $category) {
        $stmt = $pdo->prepare('SELECT sort, name, price, code, image FROM menu WHERE sort = ? ORDER BY code ASC');
        $stmt->execute([$category['sort']]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $sortedMenus[] = $row;
        }
    }

    // 結果を表示
    echo "<div class='menu-container'>";
    echo "<div class='menu-header'>";
    echo "<div class='menu-cell'>カテゴリー</div>";
    echo "<div class='menu-cell'>メニュー名</div>";
    echo "<div class='menu-cell'>価格</div>";
    echo "<div class='menu-cell'>メニュー番号</div>";
    echo "<div class='menu-cell'>画像</div>";
    echo "</div>";

    $prevSort = ''; // 前のカテゴリーを記憶する変数

    foreach ($sortedMenus as $row) {
        echo "<div class='menu-row'>";
        // 前のカテゴリーと同じなら空文字を表示
        if ($row['sort'] === $prevSort) {
            echo "<div class='menu-cell'></div>";
        } else {
            echo "<div class='menu-cell'>" . htmlspecialchars($row['sort']) . "</div>";
            $prevSort = $row['sort']; // 現在のカテゴリーを記憶
        }
        echo "<div class='menu-cell'>" . htmlspecialchars($row['name']) . "</div>";
        echo "<div class='menu-cell'>" . htmlspecialchars($row['price']) . "</div>";
        echo "<div class='menu-cell'>" . htmlspecialchars($row['code']) . "</div>";
        echo "<div class='menu-cell'><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='メニュー画像' /></div>";
        echo "</div>";
    }

    echo "</div>";
    ?>
</div>

</body>
</html>
