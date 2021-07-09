<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>入力内容チェック</title>
	</head>
	<body>
		<?php
			require_once '_h.php';

			session_cache_expire(30);// 有効期間30分
			session_start();

			$pro_name=$_POST['name'];
			$pro_price=$_POST['price'];
			$pro_shupan=$_POST['shupan'];
			$pro_noukinashi=$_POST['noukinashi'];
			$pro_dept=$_POST['dept'];
			$pro_grade=$_POST['grade'];

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
			if($pro_shupan=='')
			{
				print '出版社が入力されていません。<br />';
			}
			else
			{
				print '出版社:';
				print  h($pro_shupan);
				print '<br />';
			}			
			if($pro_noukinashi=='')
			{
				print '納期が入力されていません。<br />';
			}
			else
			{
				print '納期:';
				print  h($pro_noukinashi);
				print '<br />';
			}
			if($pro_dept=='')
			{
				print '学科が入力されていません。<br />';
			}
			else
			{
				print '学科:';
				print  h($pro_dept);
				print '<br />';
			}
			if($pro_grade=='')
			{
				print '学年が入力されていません。<br />';
			}
			else
			{
				print '学年:';
				print  h($pro_grade);
				print '<br />';
			}
			if($pro_name=='' || $pro_price=='' || $pro_shupan=='' || $pro_noukinashi=='' || $pro_dept=='' || $pro_grade=='')
			{
				print '<form>';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '</form>';
			}
			else
			{
				print '上記の内容を追加します。<br />';
				print '<br />';

				$_SESSION['name'] = "$pro_name";
				$_SESSION['price'] = "$pro_price";
				$_SESSION['shupan'] = "$pro_shupan";
				$_SESSION['noukinashi'] = "$pro_noukinashi";
				$_SESSION['dept'] = "$pro_dept";
				$_SESSION['grade'] = "$pro_grade";

				print '<form method="post" action="add_done.php">';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '<input type="submit" value="登録">';
				print '</form>';

			}
		?>
	</body>
</html>
