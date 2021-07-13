<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>教科書削除</title>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';

			session_cache_expire(30);// 有効期間30分
			session_start();

			try
			{
				$pro_code=$_GET['procode'];

				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql='SELECT * FROM mst_product WHERE code = :code';
				$stmt=$db->prepare($sql);
				$stmt->bindValue(':code', $pro_code, PDO::PARAM_INT);
				$stmt->execute();

				$rec=$stmt->fetch(PDO::FETCH_ASSOC);

				$dbh=null;

				if($rec==false)
				{
					print'教科書がコードが正しくありません。';
					print'<a href="index.php">戻る</a>';
					print '<br />';
					exit();
				}

				$_SESSION['code'] = "$pro_code";

			}
			catch(Exception $e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
		?>

		教科書削除<br />
		<br />
		商品コード<br />
		<?php print h($rec['code']); ?><br />
		商品名<br />
		<?php print h($rec['name']); ?><br />
		価格<br />
		<?php print h($rec['price']); ?><br />
		出版社<br />
		<?php print h($rec['syuppan']); ?><br />
		納期<br />
		<?php print h($rec['nouki']); ?><br />
		在庫<br />
		<?php print h($rec['zaiko']); ?><br />
		学科:<br />
		<?php print h($rec['gaku']); ?><br />
		学年:<br />
		<?php print h($rec['gakun']); ?><br />
		<br />
		この商品を削除してよろしいですか？<br />
		<br />

		<form method="post" action="delete_done.php">
		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="ＯＫ">
		</form>

	</body>
</html>