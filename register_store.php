<?php
$lang = $_GET['lang'] ?? 'ja';
$is_en = ($lang === 'en');
?>
<!DOCTYPE html>
<html lang="<?= $is_en ? 'en' : 'ja' ?>">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= $is_en ? 'Register Store Information' : '店舗情報登録' ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css" />
  <style>
    .weekday-row {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      margin-bottom: 0.5em;
      gap: 0.5em;
    }
    .weekday-row span {
      width: 3em;
      display: inline-block;
    }
    .weekday-row label {
      display: inline-flex;
      align-items: center;
      gap: 0.2em;
      white-space: nowrap;
    }
  </style>
</head>
<body>
<main class="container">
  <h1><?= $is_en ? 'Register Store Information' : '店舗情報を登録する' ?></h1>

  <form method="POST" action="register_store_process.php">
    <input type="hidden" name="lang" value="<?= $lang ?>">

    <label>
      <?= $is_en ? 'Store Name' : '店舗名' ?>
      <input type="text" name="store_name" required>
    </label>

    <label>
      <?= $is_en ? 'Prefecture (e.g., Tokyo, Osaka)' : '地域' ?>
      <select name="area" required>
        <option value=""><?= $is_en ? 'Select Prefecture' : '都道府県を選択してください' ?></option>
        <?php
        $prefectures = [
          "北海道","青森県","岩手県","宮城県","秋田県","山形県","福島県",
          "茨城県","栃木県","群馬県","埼玉県","千葉県","東京都","神奈川県",
          "新潟県","富山県","石川県","福井県","山梨県","長野県",
          "岐阜県","静岡県","愛知県","三重県",
          "滋賀県","京都府","大阪府","兵庫県","奈良県","和歌山県",
          "鳥取県","島根県","岡山県","広島県","山口県",
          "徳島県","香川県","愛媛県","高知県",
          "福岡県","佐賀県","長崎県","熊本県","大分県","宮崎県","鹿児島県","沖縄県"
        ];
        foreach ($prefectures as $pref) {
          echo "<option value=\"$pref\">$pref</option>";
        }
        ?>
      </select>
    </label>

    <label>
      <?= $is_en ? 'Address' : '住所' ?>
      <p style="color:red; font-size: 0.9em;">
        <?= $is_en
          ? 'Please enter a valid address. Inappropriate content may be removed.'
          : '※ 正確な店舗住所を入力してください。個人宅など不適切な内容は削除される可能性があります。' ?>
      </p>
      <input type="text" name="address" required>
    </label>

    <label>
      <?= $is_en ? 'Category' : '業種' ?>
      <select name="category" required>
        <option value=""><?= $is_en ? 'Select Category' : '業種を選択' ?></option>
        <option value="food"><?= $is_en ? 'Food & Drink' : '飲食' ?></option>
        <option value="retail"><?= $is_en ? 'Retail' : '小売' ?></option>
        <option value="service"><?= $is_en ? 'Service' : 'サービス' ?></option>
      </select>
    </label>

    <fieldset>
      <legend><?= $is_en ? 'Accepted Payment Methods' : '対応している決済方法' ?></legend>
      <div class="checkbox-group">
        <label><input type="checkbox" name="payment_methods[]" value="credit"> <?= $is_en ? 'Credit Card' : 'クレジットカード' ?></label>
        <label><input type="checkbox" name="payment_methods[]" value="qr"> <?= $is_en ? 'QR Code Payment' : 'QRコード決済' ?></label>
        <label><input type="checkbox" name="payment_methods[]" value="emoney"> <?= $is_en ? 'E-Money' : '電子マネー' ?></label>
        <label><input type="checkbox" name="payment_methods[]" value="cash"> <?= $is_en ? 'Cash' : '現金' ?></label>
      </div>
    </fieldset>

    <label>
      <?= $is_en ? 'Business Hours' : '営業時間' ?>
      <input type="text" name="hours" placeholder="<?= $is_en ? 'e.g., 10:00~20:00' : '例：10:00~20:00' ?>">
    </label>

    <label>
      <?= $is_en ? 'Regular Holidays' : '定休日' ?>
      <fieldset>
        <?php
        $weeks_ja = ['第1', '第2', '第3', '最終'];
        $weeks_en = ['1st', '2nd', '3rd', 'Last'];
        $days_ja = ['月', '火', '水', '木', '金', '土', '日'];
        $days_en = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

        for ($w = 0; $w < count($weeks_ja); $w++) {
          $label_week = $is_en ? $weeks_en[$w] : $weeks_ja[$w];
          echo "<div class='weekday-row'><span>$label_week</span>";
          for ($d = 0; $d < 7; $d++) {
            $label_day = $is_en ? $days_en[$d] : $days_ja[$d];
            $value = $weeks_ja[$w] . $days_ja[$d];
            echo "<label><input type='checkbox' name='holidays[]' value='$value'> $label_day</label>";
          }
          echo "</div>";
        }
        ?>
      </fieldset>
    </label>

    <label>
      <?= $is_en ? 'Notes (optional)' : '備考（任意）' ?>
      <textarea name="notes"></textarea>
    </label>

    <button type="submit"><?= $is_en ? 'Register' : '登録する' ?></button>
  </form>

  <p style="margin-top: 1em;">
    <a href="index.php?lang=<?= $lang ?>" role="button"><?= $is_en ? 'Back to Top Page' : 'トップページに戻る' ?></a>
  </p>
</main>
</body>
</html>
