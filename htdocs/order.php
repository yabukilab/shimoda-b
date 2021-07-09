<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>注文情報</title>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';

			$user_id=$_POST['student_id'];
			$user_name=$_POST['student_name'];

			try
			{
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				print '注文情報<br /><br />';

				foreach ($_POST["check"] as $key => $value) {

					$sql='SELECT * FROM mst_product WHERE code = :code';
					$prepare=$db->prepare($sql);
					$prepare->bindValue(':code', $value, PDO::PARAM_INT);
					$prepare->execute();

					$rec=$prepare->fetch(PDO::FETCH_ASSOC);
					print h($rec['code']).' ';
					print h($rec['name']).' ';
					print h($rec['price']);
					print '<br />';					

				}

				$db=null;

				print '<form method="post" action="complete.php">';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '<input type="submit" value="注文">';
				print '</form>';
			}
			catch (Exception $e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
		?>
	</body>
</html>
