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

		//エラー処理追加
		if($user_id=='' || $user_name=='' || isset($_POST["check"]) != true){
			print '必要な情報が入力されていません。';
			print '<br />';
			print '教科書のチェック、学生番号、氏名を入力してください。';
			print '<br />';
			print '<input type="button" onclick="history.back()" value="戻る">';				
		}
		else{
			try
			{
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				print '注文情報';
				print '<br />';
				print '<br />';
				print '学生番号 '.$user_id.' ';
				print '<br />';
				print '氏　　名 '.$user_name;
				print '<br />';
				print '<br />';
				print '商品番号 書名 出版社 価格 在庫 納期';
				print '<br />';

				foreach ($_POST["check"] as $key => $value) {

					$sql='SELECT * FROM mst_product WHERE code = :code';
					$prepare=$db->prepare($sql);
					$prepare->bindValue(':code', $value, PDO::PARAM_INT);
					$prepare->execute();
				
					$rec=$prepare->fetch(PDO::FETCH_ASSOC);
					print $rec['code'].' ';
					print $rec['name'].' ';
					print $rec['syuppan'].' ';
					print $rec['price'].'円'.' ';
					print $rec['zaiko'].' ';
					print $rec['nouki'].' ';
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
		}
		?>
	</body>
</html>
