<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>PM演習1</title>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';
			try
			{
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql='SELECT * FROM test';
				$prepare=$db->prepare($sql);
				$prepare->execute();

				$db=null;

				print 'つぶやき<br />';

				while(true)
				{
					$rec=$prepare->fetch(PDO::FETCH_ASSOC);
					if($rec==false)
					{
						break;
					}
					print h($rec['code']).' ';
					print h($rec['name']).' ';
					print h($rec['comment']);
					print '<br />';
				}

				print '<br />';
				print 'つぶやき入力<br />';
				print '<form method="post" action="add_done.php">';
				print '名前を入力してください。';
				print '<input type="text" name="name" style="width:100px"><br />';
				print 'つぶやきを入力してください。';
				print '<input type="text" name="comment" style="width:200px"><br />';
				print '<input type="submit" value="つぶやく">';
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
