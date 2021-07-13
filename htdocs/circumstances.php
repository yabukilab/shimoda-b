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

			//ここでデータベースの呼び出し
			
			?>
			<h1>発送状況確認画面</h1>

			

			<form method="post" action="selection.php">
			<span style="border: 1px solid;">
			発送済み
			</span>
			<span>
			<?php
			//	ここでデータベースの発送状況を呼び出し

			//例
			$hassou = 1;


			if($hassou ==''){
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


			if($haitatsu ==''){
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
