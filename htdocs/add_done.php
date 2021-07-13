<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>DB登録</title>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';

			session_start();
			if (isset($_SESSION['name'])) {
				$pro_name=$_SESSION['name'];
			}
			else{
				print'名前が受信できません。';
				exit();
			}
			if (isset($_SESSION['price'])) {
				$pro_price=$_SESSION['price'];
			}
			else{
				print'価格が受信できません。';
				exit();
			}
			if (isset($_SESSION['syuppan'])) {
				$pro_syuppan=$_SESSION['syuppan'];
			}
			else{
				print'出版社が受信できません。';
				exit();
			}
			if (isset($_SESSION['nouki'])) {
				$pro_nouki=$_SESSION['nouki'];
			}
			else{
				print'納期が受信できません。';
				exit();
			}
			if (isset($_SESSION['zaiko'])) {
				$pro_nouki=$_SESSION['zaiko'];
			}
			else{
				print'在庫が受信できません。';
				exit();
			}
			if (isset($_SESSION['gaku'])) {
				$pro_gaku=$_SESSION['gaku'];
			}
			else{
				print'学科が受信できません。';
				exit();
			}
			if (isset($_SESSION['grade'])) {
				$pro_gakun=$_SESSION['grade'];
			}
			else{
				print'学年が受信できません。';
				exit();
			}
			session_unset();// セッション変数をすべて削除
			session_destroy();// セッションIDおよびデータを破棄

			try
			{
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql='INSERT INTO mst_product(name,price,syuppan,nouki,zaiko,gaku,gakun) VALUES (:name, :price, :syuppan, :nouki,:zaiko, :gaku, :grade)';
				$prepare=$db->prepare($sql);
				$prepare->bindValue(':name', $pro_name, PDO::PARAM_STR);
				$prepare->bindValue(':price', $pro_price, PDO::PARAM_INT);
				$prepare->bindValue(':syuppan', $pro_syuppan, PDO::PARAM_STR);
				$prepare->bindValue(':nouki', $pro_nouki, PDO::PARAM_STR);
				$prepare->bindValue(':zaiko', $pro_zaiko, PDO::PARAM_STR);
				$prepare->bindValue(':gaku', $pro_gaku, PDO::PARAM_STR);
				$prepare->bindValue(':grade', $pro_gakun, PDO::PARAM_INT);
				$prepare->execute();

				$db=null;

				print h($pro_name).' ';
				print'<br/>';
				print h($pro_price).' ';
				print h($pro_syuppan).' ';
				print h($pro_nouki).' ';
				print h($pro_zaiko).' ';
				print h($pro_gaku).' ';
				print h($pro_gakun).' ';
				print 'を追加しました。<br />';

			}
			catch(Exception$e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
		?>
		<a href="index.php">戻る</a>
	</body>
</html>
