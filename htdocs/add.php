<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>教科書入力</title>
	</head>
	<body>
		教科書入力<br /><br />
		


		<form method="post" action="add_check.php">
		名前を入力してください。
		<br />
		<input type="text" name="name" style="width:100px">
		<br />
		価格を入力してください。
		<br />
		<input type="text" name="price" style="width:50px">
		<br />
		出版社を入力してください。
		<br />
		<input type="text" name="syuppan" style="width:100px">
		<br />
		納期を入力してください。
		<br />
		<input type="text" name="nouki" style="width:100px">
		<br />
		在庫を入力してください。
		<br />
		<input type="text" name="zaiko" style="width:100px">
		<br />
		学部を入力してください。
		<br />
		<?php
		require_once '_common.php';
		pulldown_dept();
		print'<br/>';
		?>
		学年を入力してください。
		<?php
		//require_once '_common.php';
		print'<br/>';
		pulldown_grade();
		print'<br/>';
		?>
		<!--<input type="text" name="gaku" style="width:400px"><br />-->
		<br />
		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="確認">
		</form>
		
	</body>
</html>
