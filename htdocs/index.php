<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>教科書検索</title>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';
			require_once '_common.php';

			print '<form method="post" action="selection.php">';

			print '教科書検索';

			print '<br />';
			print '<br />';
			print '学科と学年を選択してください';

			print '<br />';
			print '<br />';
			print '学科';
			pulldown_dept();

			print '<br />';
			print '<br />';
			print '学年';
			pulldown_grade();

			print '<br />';
			print '<br />';
			print '<input type="submit" value="決定">';
			print '</form>';
		?>
	</body>
</html>
