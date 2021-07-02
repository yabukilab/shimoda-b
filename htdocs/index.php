<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <link rel='stylesheet' href='home.css' />
    <title>ホーム画面</title>
  </head>

  <body>
  <div id="header">
		  <h1 style="text-align:center;">お財布管理ツール</h1>
		  <h2>※千葉工業大学PM学科3年の実験サイトです</h2>
	  </div>
      <div id="daily">
        
        <?php
            echo date('Y年m月d日');
        ?>
        <br>
    </div>
      <?php
      require'db.php';
      $sql = 'SELECT*FROM testtable';
      $prepare =$db->prepare($sql);
      $prepare->execute();
      $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
      
    foreach($result as $row){
        $hwork = h($row['hwork']);
        $worktime = h($row['worktime']);
        $target = h($row['target']);
        $remonth =h($row['remonth']);
        $inget = h($row['inget']);
        $fixcost = h($row['fixcost']);
        $varcost = h($row['varcost']);
        
        $salaary = (int)$hwork * (int)$worktime;
        $spen = (int)$fixcost + (int)$varcost;
        $remai = (int)$inget - (int)$spen;
        $balance = (int)$salaary - (int)$spen;
        $goal = (int)$target - (int)$balance;
        echo 
        "<table>
    <tbody>
        <tr>
            <th>給料</th>
            <td>{$salaary}</td>
        </tr>
         <tr>
            <th>出費</th>
            <td>{$spen}</td>
        </tr>
         <tr>
            <th>残り予算</th>
            <td>{$remai}</td>
        </tr>
        <tr>
            <th>残金</th>
            <td>{$balance}</td>
        </tr>
        <tr>
            <th>目標まで</th>
            <td>{$goal}</td>
        </tr>
    </tbody>    
　　　　　</table>";
    }
    ?>
    <br>
    <table>
        <th><?
        if($spen<30000)
        echo"節約できてますね"
        ?></th>
    </table>
<p style="text-align: center;">
    <a href="input.php" class="btn btn-flat"><span>入力画面</span></a>
</p>

</body>
</html>