<?php
$lang = $_GET['lang'] ?? 'ja';
$is_en = ($lang === 'en');
?>
<!DOCTYPE html>
<html lang="<?= $is_en ? 'en' : 'ja' ?>">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= $is_en ? 'Payment Method Search System' : '決済方法検索システム' ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css" />
  <style>
    form.grid input,
    form.grid select,
    form.grid button {
      margin-bottom: 0.75em;
    }
    @media (max-width: 600px) {
      .register-store-btn {
        display: block;
        width: 100%;
        box-sizing: border-box;
      }
    }
    .register-store-btn {
      background-color: transparent;
      border: 1px solid #555;
      color: #555;
      padding: 0.3em 0.7em;
      font-size: 0.9em;
      border-radius: 4px;
      text-decoration: none;
    }
    .register-store-btn:hover {
      background-color: #eee;
      border-color: #333;
      color: #333;
    }
  </style>
</head>
<body>

<nav class="container-fluid">
  <ul>
    <li><strong><?= $is_en ? 'Payment Method Search' : '決済方法検索システム' ?></strong></li>
  </ul>
  <ul>
    <li>
      <a href="?lang=<?= $is_en ? 'ja' : 'en' ?>" role="button">
        <?= $is_en ? '日本語' : 'English' ?>
      </a>
    </li>
  </ul>
</nav>

<main class="container">
  <div class="grid">
    <section>
      <hgroup>
        <h2><?= $is_en ? 'Easily Search Store Payment Methods' : '店舗の決済対応状況を簡単検索' ?></h2>
        <h3><?= $is_en ? 'Check payment options before visiting' : '訪れる前に決済手段を確認しよう' ?></h3>
      </hgroup>
      <p>
        <?= $is_en
          ? 'Search by store name, area, payment method, or category to find stores that accept your preferred payment options.'
          : '店舗名、地域、決済方法、業種などで検索して、希望する決済手段が使えるお店を事前に確認できます。'
        ?>
      </p>

      <form method="GET" action="search.php" class="grid">
  <input type="hidden" name="lang" value="<?= $is_en ? 'en' : 'ja' ?>">
  <input type="text" name="shop_name" placeholder="<?= $is_en ? 'Enter store name' : '店舗名を入力' ?>" aria-label="店舗名">

  <!-- 地域セレクト（47都道府県） -->
  <select name="area" aria-label="地域">
    <option value=""><?= $is_en ? 'Select area' : '地域を選択' ?></option>
    <?php
    $areas = [
      '北海道' => 'Hokkaido', '青森県' => 'Aomori', '岩手県' => 'Iwate', '宮城県' => 'Miyagi', '秋田県' => 'Akita',
      '山形県' => 'Yamagata', '福島県' => 'Fukushima', '茨城県' => 'Ibaraki', '栃木県' => 'Tochigi', '群馬県' => 'Gunma',
      '埼玉県' => 'Saitama', '千葉県' => 'Chiba', '東京都' => 'Tokyo', '神奈川県' => 'Kanagawa', '新潟県' => 'Niigata',
      '富山県' => 'Toyama', '石川県' => 'Ishikawa', '福井県' => 'Fukui', '山梨県' => 'Yamanashi', '長野県' => 'Nagano',
      '岐阜県' => 'Gifu', '静岡県' => 'Shizuoka', '愛知県' => 'Aichi', '三重県' => 'Mie', '滋賀県' => 'Shiga',
      '京都府' => 'Kyoto', '大阪府' => 'Osaka', '兵庫県' => 'Hyogo', '奈良県' => 'Nara', '和歌山県' => 'Wakayama',
      '鳥取県' => 'Tottori', '島根県' => 'Shimane', '岡山県' => 'Okayama', '広島県' => 'Hiroshima', '山口県' => 'Yamaguchi',
      '徳島県' => 'Tokushima', '香川県' => 'Kagawa', '愛媛県' => 'Ehime', '高知県' => 'Kochi',
      '福岡県' => 'Fukuoka', '佐賀県' => 'Saga', '長崎県' => 'Nagasaki', '熊本県' => 'Kumamoto', '大分県' => 'Oita',
      '宮崎県' => 'Miyazaki', '鹿児島県' => 'Kagoshima', '沖縄県' => 'Okinawa'
    ];
    foreach ($areas as $jp => $en) {
      $value = $is_en ? $en : $jp;
      $label = $is_en ? $en : $jp;
      echo "<option value=\"$value\">$label</option>";
    }
    ?>
  </select>

  <!-- 決済方法 -->
  <select name="payment" aria-label="決済方法">
    <option value=""><?= $is_en ? 'Select payment method' : '決済方法を選択' ?></option>
    <option value="credit"><?= $is_en ? 'Credit Card' : 'クレジットカード' ?></option>
    <option value="qr"><?= $is_en ? 'QR Code' : 'QRコード決済' ?></option>
    <option value="emoney"><?= $is_en ? 'E-Money' : '電子マネー' ?></option>
    <option value="cash"><?= $is_en ? 'Cash' : '現金' ?></option>
  </select>

  <!-- 業種 -->
  <select name="category" aria-label="業種">
    <option value=""><?= $is_en ? 'Select category' : '業種を選択' ?></option>
    <option value="food"><?= $is_en ? 'Food & Drink' : '飲食' ?></option>
    <option value="retail"><?= $is_en ? 'Retail' : '小売' ?></option>
    <option value="service"><?= $is_en ? 'Service' : 'サービス' ?></option>
  </select>

  <button type="submit"><?= $is_en ? 'Search' : '検索' ?></button>
</form>

      <h3><?= $is_en ? 'How to Use' : '使い方' ?></h3>
      <p>
        <?= $is_en
          ? 'Enter the conditions in the search form and click "Search" to see a list of matching stores.'
          : '検索フォームに必要な条件を入力し、「検索」を押すと、条件に合う店舗情報の一覧が表示されます。'
        ?>
      </p>

      <?php if (!$is_en): ?>
        <a href="register_store.php?lang=ja" class="register-store-btn">
          店舗情報登録
        </a>
      <?php endif; ?>

    </section>
  </div>
</main>

</body>
</html>
