<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>教科書選択</title>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';

			$user_dept=$_POST['dept'];
			$user_grade=$_POST['grade'];

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

				print '教科書選択';

				print '<br />';
				print '<br />';
				print '注文する教科書にチェックしてください';
				print '<br />';
				print '<br />';

				print '<form method="post" action="order.php">';

				//検索キーワード空チェック
				if (isset($_POST['dept'])){
					$user_dept=$_POST['dept'];
				}
				else{
					$user_dept='';
				}
				if (isset($_POST['grade'])){
					$user_grade=$_POST['grade'];
				}
				else{
					$user_grade='';
				}
				print '<br />';

				//検索キーワード表示
				if ($user_dept!==''&&$user_grade!==''){
					print $user_dept.'で';
					print $user_grade.'年が含まれる商品';
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
					if ((($user_dept==='')||(strpos($rec['gaku'],$user_dept)!==false))&&(($user_grade==='')||(strpos($rec['gakun'],$user_grade)!==false))){
						print '<input type="checkbox" name="check[]" value="'.h($rec['code']). '">';
						print $rec['code'].' ';
						print $rec['name'].'  ';
						print $rec['price'].' 円';
						print $rec['nouki'].' ';
						print '<br />';
					}
				}
//検索処理（おわり）

				/*while(true)
				{
					$rec=$prepare->fetch(PDO::FETCH_ASSOC);
					if($rec==false)
					{
						break;
					}
					print '<input type="checkbox" name="check[]" value="'.h($rec['code']). '">';
					print h($rec['code']).' ';
					print h($rec['name']).' ';
					print h($rec['price']);
					print '<br />';
				}
				*/

				print '<br />';
				print '学生番号';
				print '<input type="text" name="student_id" style="width:100px">';

				print '<br />';
				print '氏　　名';
				print '<input type="text" name="student_name" style="width:100px">';

				print '<br />';
				print '<input type="submit" formaction="order.php" value="決定">';
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
