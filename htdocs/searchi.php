<?php
//検索処理（はじめ）
				//検索キーワード入力
				print '<form method="post" action="">';
				print '検索キーワード';
				print '<input type="text" name="keyword">';
				print '<input type="submit" value="検索">';
				print '</form>';

				//検索キーワード空チェック
				if (isset($_POST['keyword'])){
					$keyword=$_POST['keyword'];
				}
				else{
					$keyword='';
				}
				print '<br />';

				//検索キーワード表示
				if ($keyword!==''){
					print $keyword.'が含まれる商品';
					print '<br />';
				}

				while(true)
				{
					$rec=$prepare->fetch(PDO::FETCH_ASSOC);
					if($rec==false)
					{
						break;
					}
					//検索処理
					if (($keyword==='')||(strpos($rec['name'],$keyword)!==false)){
						print $rec['code'].' ';
						print $rec['name'].' ';
						print $rec['price'].' ';
						print '<br />';
					}
				}
//検索処理（おわり）