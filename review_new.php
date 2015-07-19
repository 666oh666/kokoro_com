<?php

session_start();
mysql_connect('localhost', 'root', 'root') or die(mysql_error());
mysql_select_db('kokoro_com');
mysql_query('set names utf8');

$spot_id = $_GET['id'];

$sql = "SELECT * FROM spot WHERE id='$spot_id'";
$record = mysql_query($sql) or die(mysql_error());
$spot = mysql_fetch_assoc($record);


if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  // ログインしている

  $session_id = $_SESSION['id'];
  $_SESSION['time'] = time();
  
  $sql = "SELECT * FROM user WHERE id='$session_id'";
  $record = mysql_query($sql) or die(mysql_error());
  $user = mysql_fetch_assoc($record);

  

} else {
  // ログインしていない
  echo "<a href='login.php'>ログイン</a>";
}



if (!empty($_POST)) {
	// 登録処理をする

	//セキュリティを強化した書き方

	// $sql = sprintf('INSERT INTO user SET name="%s", email="%s", password="%s", address="%s"',
	// 	mysql_real_escape_string($_POST['name']),
	// 	mysql_real_escape_string($_POST['email']),
	// 	mysql_real_escape_string($_POST['password']),
	// 	mysql_real_escape_string($_POST['address'])

	// );

	$spot_id = $spot['id'];
	$user_id = $user['id'];
	$star = $_POST['star'];
	$title = $_POST['title'];
	$text = $_POST['text'];

	// foreach ($_REQUEST['holiday'] as $holiday) {
 // print(htmlspecialchars($holiday)); }


// ,'$holiday'
	$sql = "INSERT INTO review SET spot_id='$spot_id', user_id='$user_id', star='$star', title='$title', text='$text'";
	mysql_query($sql) or die(mysql_error());

	header('Location: thanks.php');
	exit();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>新規投稿</title>
</head>
<body>

<h1>
口コミ投稿	
</h1>

<h3>
口コミを投稿しよう
</h3>


<form action="" method="post">

<p>
評価：<select name="star">
<option value="" selected>選んでください</option>
<option value="1">☆</option>
<option value="2">☆☆</option>
<option value="3">☆☆☆</option>
<option value="4">☆☆☆☆</option>
<option value="5">☆☆☆☆☆</option>
</select>
</p>


<p>
タイトル：<input type="text" name="title">
</p>

<!-- <p>
コメント：<input type="textbox" name="text">
</p> -->

<form>
コメント：<textarea name="text" rows="5" cols="50" wrap="">
</textarea>




<!-- <p>
定休日：

<input type="checkbox" name="holiday[]" value="日">日
<input type="checkbox" name="holiday[]" value="月">月
<input type="checkbox" name="holiday[]" value="火">火
<input type="checkbox" name="holiday[]" value="水">水
<input type="checkbox" name="holiday[]" value="木">木
<input type="checkbox" name="holiday[]" value="金">金
<input type="checkbox" name="holiday[]" value="土">土	

</p> -->


<p>
<input type="submit" value="送信"><input type="reset" value="リセット">
</p>
</form>

<a href="top.php">トップページへ戻る</a><br>
</body>
</html>