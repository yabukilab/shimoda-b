<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>発送状況確認画面</title>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';
			require_once '_common.php';	
		

			$db = new PDO($dsn, $dbUser, $dbPass);
			$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql='SELECT * FROM mst_product';
			$prepare=$db->prepare($sql);
			$prepare->execute();

			$db=null;

			print '<h1>発送状況確認画面</h1>';

			print '<form method="post" action="">';
			print '<input type="text" name="user_id" style="width:60px">';
			print '<input type="submit" value="検索">';
			print '</form>';

			if (isset($_POST['user_id'])){
				$user_id=$_POST['user_id'];
			}
			else{
				$user_id='';
			}

			if ($user_id!==''){
				print '学籍番号';
				print $user_id.'の発送状況';
				print '<br />';
			}

			/*while(true)
				{
					$rec=$prepare->fetch(PDO::FETCH_ASSOC);
					if($rec==false)
					{
						break;
					}
					//検索処理
					if (strpos($rec['userid'],$user_id)!==false){
						 $hassou=$rec['hassou'];
						 $haitatsu=$rec['haitatsu'];
					}
				}

				*/

			?>
		

			

			<form method="post" action="selection.php">
			<span style="border: 1px solid;">
			発送済み
			</span>
			<span>

			<?php
			$hassou = 1;


			if($hassou =='0'){
			print'<font color="red">--------------→</font>';
			}
			if($hassou =='1'){
			print'<font color="blue">--------------→</font>';
			}
			?>
			</span>
			<span style="border: 1px solid;">
			配達中
			</span>
			<span>
			<?php
			//	ここでデータベースの配達状況を呼び出し

			//例
			$haitatsu = 0;


			if($haitatsu =='0'){
			print'<font color="red">--------------→</font>';
			}
			if($haitatsu =='1'){
			print'<font color="blue">--------------→</font>';
			}
			?>
			</span>
			<span style="border: 1px solid;">
			配達済み
			</span>	
			<br><br>

			<input type="submit" value="決定">
			</form>

			
	</body>
</html>
