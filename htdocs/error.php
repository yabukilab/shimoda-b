<?php
session_start();
$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : "不明なエラーが発生しました。";
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <title>エラー</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css" />
</head>
<body>
  <main class="container">
    <h2>エラーが発生しました</h2>
    <p style="color:red;"><?= htmlspecialchars($error_message) ?></p>
    <a href="register_store.php" role="button">店舗登録画面に戻る</a>
  </main>
</body>
</html>
