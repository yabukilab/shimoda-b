<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <link rel='stylesheet' href='style.css' />
    <title>全データ表示（その1）</title>
  </head>
  <body>
<?php
require 'db.php';                               # 接続
$sql = 'SELECT * FROM testtable';                  # SQL文
$prepare = $db->prepare($sql);                  # 準備
$prepare->execute();                            # 実行
$result = $prepare->fetchAll(PDO::FETCH_ASSOC); # 結果の取得

foreach ($result as $row) {
  $id       = h($row['id']);
  $varcharA = h($row['varcharA']);
  $intA     = h($row['intA']);
  $intB     = h($row['intB']);
  $intC     = h($row['intC']);
  $intD     = h($row['intD']);
  $intE     = h($row['intE']);
  $intF     = h($row['intF']);

  echo "{$id}, {$varcharA}, {$intA}, {$intB}, {$intC}, {$intD}, {$intE}, {$intF}<br/>";
}
?>
  </body>
</html>