<?php
require 'db.php'; // データベース接続を読み込み

$stmt = $pdo->query('SELECT position, status FROM seat');
$seats = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>混雑状況確認</title>
    <style>
        .seat {
            width: 50px;
            height: 50px;
            margin: 5px;
            display: inline-block;
            background-color: red;
            text-align: center;
            vertical-align: middle;
            line-height: 50px;
            color: white;
            font-weight: bold;
        }
        .occupied {
            background-color: green;
        }
    </style>
	</head>
    <body>
        <h2>座席の利用状況</h2>

        <form method="POST">
            <button type="submit" name="top">TOPへ</button>

        <div id="seats">
        <?php foreach ($seats as $seat): ?>
            <div class="seat <?php echo $seat['status'] == 1 ? 'occupied' : ''; ?>">
                <?php echo $seat['position']; ?>
            </div>
        <?php endforeach; ?>
         </div>
       
       <?php
        if (isset($_POST['top'])) {
            header("Location:index.php");
        }
        ?>
    </body>
</html>

