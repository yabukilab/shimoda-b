<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>トップページ</title>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';
			require_once '_common.php';
			
			//print '<button href="_index.php">管理者画面へ</button><br />';

			print'学生と学年を入力してください';

			

			print'<form method="post" action="selection.php">';
			
			print'学科';
			pulldown_dept();
			print'<br/>';			
			print'学年';
			pulldown_grade();
			print'<br/>';


			print'<input type="submit" value="決定">';
			print'<br/>';
			print'</form>';

			//print '<button href="circumstances.php">発送状況確認画面へ</button><br />';

		?>
<!--
		<a href="circumstances.php">発送状況確認画面へ</a>
-->
		<a href="_index.php">管理者画面へ</a><br />
	</body>
</html>
