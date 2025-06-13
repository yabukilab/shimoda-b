<?php
$lang = $_GET['lang'] ?? 'ja';
$is_en = ($lang === 'en');
?>

<!DOCTYPE html>
<html lang="<?= $is_en ? 'en' : 'ja' ?>">
<head>
  <meta charset="UTF-8">
  <title><?= $is_en ? 'Data Error' : 'データエラー' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
</head>
<body>
<main class="container">
  <h2><?= $is_en ? 'Incomplete Store Data' : '店舗データが不完全です' ?></h2>
  <p>
    <?= $is_en
      ? "Sorry, this store's information is incomplete and cannot be displayed."
      : "申し訳ありませんが、この店舗の情報は不完全のため表示できません。" ?>
  </p>
  <a href="index.php?lang=<?= $lang ?>"><?= $is_en ? 'Back to Search' : '検索画面に戻る' ?></a>
</main>
</body>
</html>
