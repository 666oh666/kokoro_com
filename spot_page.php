<?php
session_start();
mysql_connect('localhost', 'root', 'root') or die(mysql_error());
mysql_select_db('kokoro_com');
mysql_query('set names utf8');
 
$spot_id = $_GET['id'];

$sql = "SELECT * FROM spot WHERE id='$spot_id'";
$record = mysql_query($sql) or die(mysql_error());
$spot = mysql_fetch_assoc($record);





?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>お店ページ</title>
</head>
<body>
<?php

echo "<h1>".$spot['name']."</h1>";
echo "<p>".$spot['place']."<p>";
echo "<p>".$spot['price']."<p>";
echo "<a href=".$spot['url'].">サイトURL</a><br>";
echo "<a href=review_page.php?id=".$spot_id.">レビューを見る</a><br>";
echo "<a href=review_new.php?id=".$spot_id.">レビューを書く</a>";

?>
<br>
<a href="top.php">トップページへ戻る</a><br>
</body>
</html>
