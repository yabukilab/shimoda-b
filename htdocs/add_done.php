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
			if (isset($_SESSION['shupan'])) {
				$pro_shupan=$_SESSION['shupan'];
			}
			else{
				print'出版社が受信できません。';
				exit();
			}
            if (isset($_SESSION['noukinashi'])) {
				$pro_noukinashi=$_SESSION['noukinashi'];
			}
			else{
				print'納期が受信できません。';
				exit();
			}
			if (isset($_SESSION['dept'])) {
				$pro_gaka=$_SESSION['dept'];
			}
			else{
				print'学科が受信できません。';
				exit();
			}
			if (isset($_SESSION['grade'])) {
				$pro_gakunen=$_SESSION['grade'];
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

				$sql='INSERT INTO mst_product(name,price,shupan,noukinashi,gaka,gakunen) VALUES (:name, :price,:shupan,:noukinashi,:dept,:grade)';
				$prepare=$db->prepare($sql);
				$prepare->bindValue(':name', $pro_name, PDO::PARAM_STR);
				$prepare->bindValue(':price', $pro_price, PDO::PARAM_INT);
				$prepare->bindValue(':shupan', $pro_shupan, PDO::PARAM_INT);
				$prepare->bindValue(':noukinashi', $pro_noukinashi, PDO::PARAM_INT);
				$prepare->bindValue(':dept', $pro_gaka, PDO::PARAM_INT);
				$prepare->bindValue(':grade', $pro_gakunen, PDO::PARAM_INT);
				$prepare->execute();

				$db=null;

				print h($pro_name).'<br /> ';
				print h($pro_price);
				print h($pro_shupan);
				print h($pro_noukinashi);
				print h($pro_gaka);
				print h($pro_gakunen);
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
