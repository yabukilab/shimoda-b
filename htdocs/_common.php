<?php

//学科のプルダウン入力
function pulldown_dept()
{
	print '<select name="dept">';
	print '<option value="プロジェクトマネジメント学科">プロジェクトマネジメント学科</option>';
	print '<option value="経営情報科学科">経営情報科学科</option>';
	print '<option value="金融・経営リスク科学科">金融・経営リスク科学科</option>';
	print '<option value="機械工学科">機械工学科</option>';
	print '<option value="機械電子創成工学科">機械電子創成工学科</option>';
	print '<option value="先端材料工学科">先端材料工学科</option>';
	print '<option value="電気電子工学科">電気電子工学科</option>';
	print '<option value="情報通信システム工学科">情報通信システム工学科</option>';
	print '<option value="応用科学科">応用科学科</option>';
	print '<option value="建築学科">建築学科</option>';
	print '<option value="都市環境工学科">都市環境工学科</option>';
	print '<option value="デザイン科学科">デザイン科学科</option>';
	print '<option value="未来ロボティクス学科">未来ロボティクス学科<?option>';
	print '<option value="生命科学科">生命科学科</option>';
	print '<option value="知能メディア工学科">知能メディア工学科</option>';
	print '<option value="情報工学科">情報工学科</option>';
	print '<option value="情報ネットワーク学科">情報ネットワーク学科</option>';
	
	print '</select>';
}

//学年のプルダウン入力
function pulldown_grade()
{
	print '<select name="grade">';
	print '<option value="1">1</option>';
	print '<option value="2">2</option>';
	print '<option value="3">3</option>';
	print '<option value="4">4</option>';
	print '</select>';
}

//商品表示のプルダウン入力
function pulldown_disp()
{
	print '<select name="procode">';
	print '<option value="1">1</option>';
	print '<option value="2">2</option>';
	print '<option value="3">3</option>';
	print '<option value="4">4</option>';
	print '<option value="5">5</option>';
	print '<option value="6">6</option>';
	print '<option value="7">7</option>';
	print '<option value="8">8</option>';
	print '<option value="9">9</option>';
	print '<option value="10">10</option>';
	print '</select>';
}

