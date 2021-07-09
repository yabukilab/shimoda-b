<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>教科書一覧</title>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';
			//プルダウンメニュー
			require_once '_common.php';

			try
			{
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql='SELECT * FROM mst_product';
//				$sql='SELECT code,name,price FROM mst_product WHERE price > 100';
//				$sql='SELECT code,name,price FROM mst_product ORDER BY price DESC';
				$prepare=$db->prepare($sql);
				$prepare->execute();

				$db=null;

				print '教科書一覧<br /><br />';

//検索処理に入れ替えるためコメントアウト
/*
				while(true)
				{
					$rec=$prepare->fetch(PDO::FETCH_ASSOC);
					if($rec==false)
					{
						break;
					}
					print h($rec['code']).' ';
					print h($rec['name']).' ';
					print h($rec['price']);
					print '<br />';
				}
*/

//検索処理（はじめ）
				//検索キーワード入力
				print '<form method="get" action="">';
				//print '検索キーワード';
				pulldown_dept();
				pulldown_grade();

				//print '<input type="text" name="dept">';
				print '<input type="submit" value="検索">';
				print '</form>';

				//検索キーワード空チェック
				if (isset($_GET['dept'])){
					$dept=$_GET['dept'];
				}
				else{
					$dept='';
				}
				print '<br />';
                if (isset($_GET['grade'])){
					$grade=$_GET['grade'];
				}
				else{
					$grade='';
				}
				print '<br />';

				//検索キーワード表示
				if ($dept!==''){
					print $dept.'が含まれる商品';
					print '<br />';
				}

				while(true)
				{
					$rec=$prepare->fetch(PDO::FETCH_ASSOC);
					if($rec==false)
					{
						break;
					}
					//検索処理
					if ((($dept==='')||(strpos($rec['gaka'],$dept)!==false))&&(($grade==='')||(strpos($rec['gakunen'],$grade)!==false))){
						print $rec['code'].' ';
						print $rec['name'].' ';
						print $rec['price'].' ';
						print '<br />';
					}
				}
//検索処理（おわり）

				print '<br />';
				print '<a href="add.php">入力</a><br />';

				print '<br />';
				print '<form method="get" action="disp.php">';
				print '商品表示：番号';
				//プルダウンメニュー
				pulldown_disp();
				print '<input type="submit" value="決定">';
				print '</form>';

				print '<br />';
				print '<form method="get" action="edit.php">';
				print '商品修正：番号';
				print '<input type="text" name="procode" style="width:20px">';
				print '<input type="submit" value="決定">';
				print '</form>';

				print '<br />';
				print '<form method="get" action="delete.php">';
				print '商品削除：番号';
				print '<input type="text" name="procode" style="width:20px">';
				print '<input type="submit" value="決定">';
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
