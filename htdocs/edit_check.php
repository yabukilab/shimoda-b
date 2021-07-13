<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>入力内容チェック</title>
	</head>
	<body>
		<?php
			require_once '_h.php';

			session_start();

			$pro_name=$_POST['name'];
			$pro_price=$_POST['price'];
			$pro_syuppan = $_POST['syuppan'];
			$pro_nouki = $_POST['nouki'];
			$pro_gaku = $_POST['gaku'];
			$pro_gakun = $_POST['gakun'];

			if($pro_name=='')
			{
				print '名前が入力されていません。<br />';
			}
			else
			{
				print '名前:';
				print  h($pro_name);
				print '<br />';
			}

			if($pro_price=='')
			{
				print '価格が入力されていません。<br />';
			}
			else
			{
				print '価格:';
				print h($pro_price);
				print '<br />';
			}
			if($pro_syuppan=='')
			{
				print '出版社が入力されていません。<br />';
			}
			else
			{
				print '出版社:';
				print  h($pro_syuppan);
				print '<br />';
			}
			if($pro_nouki=='')
			{
				print '納期が入力されていません。<br />';
			}
			else
			{
				print '納期:';
				print  h($pro_nouki);
				print '<br />';
			}

			if($pro_gaku=='')
			{
				print '学科が入力されていません。<br />';
			}
			else
			{
				print '学科:';
				print h($pro_gaku);
				print '<br />';
			}
			if($pro_gakun=='')
			{
				print '学年が入力されていません。<br />';
			}
			else
			{
				print '学年:';
				print h($pro_gakun);
				print '<br />';
			}

			if($pro_name=='' || $pro_price==''||$pro_syuppan==''||$pro_nouki==''||$pro_gaku==''||$pro_gakun=='')
			{
				print '<form>';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '</form>';
			}
			else
			{
				print '上記の内容に修正します。<br />';
				print '<br />';

				$_SESSION['name'] = "$pro_name";
				$_SESSION['price'] = "$pro_price";
				$_SESSION['syuppan'] = "$pro_syuppan";
				$_SESSION['nouki'] = "$pro_nouki";
				$_SESSION['gaku'] = "$pro_gaku";
				$_SESSION['grade'] = "$pro_gakun";

				print '<form method="post" action="edit_done.php">';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '<input type="submit" value="登録">';
				print '</form>';

			}
		?>
	</body>
</html>
