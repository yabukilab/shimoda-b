<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>メニュー管理</title>
	</head>
    <body>

        <h2>メニュー削除完了</h2><br><br>
        
        <form method="POST">
            <button type="submit" name="back">戻る</button>
            
            
        <?php
        
        if (isset($_POST['back'])) {
            header("Location:edit_menu.php");
        }

        ?>
    
    </body>
</html>