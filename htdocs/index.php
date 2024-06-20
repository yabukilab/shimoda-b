<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>食堂利用システム</title>
	</head>
    <body>

        <h2>本日のメニュー</h2>
        <form method="POST">
            <button type="submit" name="list">混雑状況確認</button>
            <br><br>

        <?php

        // データベース接続情報
        $host = 'localhost';    // ホスト名
        $db   = 'system';       // データベース名
        $user = 'root';         // ユーザー名
        $pass = '';             // パスワード
        $charset = 'utf8mb4';   // 文字セット
        
        // DSN (Data Source Name) を作成
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        
        try {
            // データベース接続を確立
            $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            // 接続失敗時にエラーメッセージを表示
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        
        // SQLクエリを準備
        $sql = 'SELECT sort, name, price, code, image FROM menu';
        
        // クエリを実行して結果を取得
        $stmt = $pdo->query($sql);
        
        // 結果を表示
        echo "<table border='1'>";
        echo "<tr><th>メニュー区分</th><th>メニュー名</th><th>価格</th><th>メニュー番号</th><th>画像</th></tr>";
        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['sort']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['price']) . "</td>";
            echo "<td>" . htmlspecialchars($row['code']) . "</td>";
            echo "<td>" . htmlspecialchars($row['image']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        if (isset($_POST['list'])) {
            header("Location:disp_seat.php");
        }

        ?>
        

    </body>
<html>

