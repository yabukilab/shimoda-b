<?php
$lang = $_GET['lang'] ?? 'ja';
$is_en = ($lang === 'en');
?>

<!DOCTYPE html>
<html lang="<?= $is_en ? 'en' : 'ja' ?>">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= $is_en ? 'Registration Complete' : '登録完了' ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css" />
</head>
<body>
<main class="container">
  <h2><?= $is_en ? 'Store Registered Successfully' : '店舗の登録が完了しました' ?></h2>
  <p><?= $is_en ? 'Thank you for registering the store information.' : '店舗情報の登録ありがとうございました。' ?></p>

  <a href="index.php?lang=<?= $lang ?>" role="button"><?= $is_en ? 'Back to Top Page' : 'トップページに戻る' ?></a>
  <a href="register_store.php?lang=<?= $lang ?>" role="button" class="secondary"><?= $is_en ? 'Register Another Store' : '別の店舗を登録する' ?></a>
</main>
</body>
</html>
