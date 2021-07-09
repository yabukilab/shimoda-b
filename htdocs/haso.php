<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';
			require_once '_common.php';

			print '<form method="post" action="selection.php">';

			print '発送状況確認画面';

			print '<br />';
			print '<br />';
			print '発送済み&rarr;';

			print '<br />';
			print '<br />';
			print '配達中';
			pulldown_dept();

			print '<br />';
			print '<br />';
			print '配達済み';
			pulldown_grade();

			print '<br />';
			print '<br />';
			print '<input type="submit" value="決定">';
			print '</form>';
		?>
	</body>
</html>