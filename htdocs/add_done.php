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

			$pro_name=$_POST['name'];
			$pro_comment=$_POST['comment'];

			try
			{
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql='INSERT INTO test(name,comment) VALUES (:name, :comment)';
				$prepare=$db->prepare($sql);
				$prepare->bindValue(':name', $pro_name, PDO::PARAM_STR);
				$prepare->bindValue(':comment', $pro_comment, PDO::PARAM_STR);
				$prepare->execute();

				$db=null;

				print h($pro_name).' ';
				print h($pro_comment);
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
