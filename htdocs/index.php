<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>食堂利用システム</title>
	</head>
    <body>

        <h2>本日のメニュー</h2>
        <form action="disp_seat.php" method="post">
        <button type="submit" name="seat">混雑状況確認</button>
        <br><br>

        <?php

        require 'db.php';
        
        // SQLクエリを実行して結果を取得
        $stmt = $pdo->query('SELECT sort, name, price, code, image FROM menu');
        
        // 結果を表示
        echo "<table border='1'>";
        echo "<tr><th>メニュー区分</th><th>メニュー名</th><th>価格</th><th>メニュー番号</th><th>画像</th></tr>";
        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['sort']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['price']) . "</td>";
            echo "<td>" . htmlspecialchars($row['code']) . "</td>";
            echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='メニュー画像' /></td>";
            echo "</tr>";
        }
        echo "</table>";

        ?>
        
    </body>
<html>

