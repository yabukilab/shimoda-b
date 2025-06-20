<?php
require_once 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>店舗情報登録</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css" />
  <style>
    form > label, form > fieldset {
      margin-bottom: 1em;
    }
    fieldset label {
      display: block;
      margin-top: 0.5em;
    }
    .store-card {
      border: 1px solid #ccc;
      padding: 1em;
      margin-bottom: 1.5em;
      border-radius: 6px;
      background: #f6f6f6;
    }
    .store-card p {
      margin: 0.2em 0;
    }
    .button-group {
      display: flex;
      gap: 1em;
      margin-top: 1em;
    }
  </style>
</head>
<body>
<main class="container">
  <h1>店舗情報を登録する</h1>

  <form method="POST" action="register_store_process.php">
    <label>
      店舗名
      <input type="text" name="store_name" required>
    </label>

    <label>
      地域（例：津田沼）
      <input type="text" name="area" required>
    </label>

    <label>
      住所
      <input type="text" name="address" required>
    </label>

    <label>
      業種
      <select name="category" required>
        <option value="">業種を選択</option>
        <option value="food">飲食</option>
        <option value="retail">小売</option>
        <option value="service">サービス</option>
      </select>
    </label>

    <fieldset>
      <legend>対応している決済方法（1つ以上選択）</legend>
      <label><input type="checkbox" name="payment_methods[]" value="credit"> クレジットカード</label>
      <label><input type="checkbox" name="payment_methods[]" value="qr"> QRコード決済</label>
      <label><input type="checkbox" name="payment_methods[]" value="emoney"> 電子マネー</label>
      <label><input type="checkbox" name="payment_methods[]" value="cash"> 現金</label>
    </fieldset>

    <label>
      営業時間
      <input type="text" name="hours" required>
    </label>

    <label>
      定休日
      <input type="text" name="holidays" required>
    </label>

    <label>
      備考（任意）
      <textarea name="notes"></textarea>
    </label>

    <button type="submit">登録する</button>
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
              echo "<div class='store-card'>";
              echo "<p><strong>店舗名：</strong>" . htmlspecialchars($store['store_name'], ENT_QUOTES, 'UTF-8') . "</p>";
              echo "<p><strong>地域：</strong>" . htmlspecialchars($store['area'], ENT_QUOTES, 'UTF-8') . "</p>";
              echo "<p><strong>住所：</strong>" . htmlspecialchars($store['address'], ENT_QUOTES, 'UTF-8') . "</p>";
              echo "<div class='button-group'>";

              // 編集ボタン
              echo "<form action='update_store.php' method='get'>";
              echo "<input type='hidden' name='id' value='" . htmlspecialchars($store['id'], ENT_QUOTES, 'UTF-8') . "'>";
              echo "<button type='submit'>編集</button>";
              echo "</form>";

              // 削除ボタン
              echo "<form action='delete_store.php' method='get' onsubmit=\"return confirm('この店舗情報を削除しますか？');\">";
              echo "<input type='hidden' name='id' value='" . htmlspecialchars($store['id'], ENT_QUOTES, 'UTF-8') . "'>";
              echo "<button type='submit' class='secondary'>削除</button>";
              echo "</form>";

              echo "</div></div>";
          }
      }
  } catch (PDOException $e) {
      echo "<p>一覧表示エラー: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</p>";
  }
  ?>

  <p><a href="index.php">ホームに戻る</a></p>
</main>
</body>
</html>
