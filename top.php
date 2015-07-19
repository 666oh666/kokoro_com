<?php
session_start();
mysql_connect('localhost', 'root', 'root') or die(mysql_error());
mysql_select_db('kokoro_com');
mysql_query('set names utf8');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  // ログインしている

  $session_id = $_SESSION['id'];
  $_SESSION['time'] = time();
  
  $sql = "SELECT * FROM user WHERE id='$session_id'";
  $record = mysql_query($sql) or die(mysql_error());
  $user = mysql_fetch_assoc($record);

  echo "ようこそ".$user['name']."さん";

} else {
  // ログインしていない
  echo "<a href='login.php'>ログイン</a>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ココロドットコム</title>
</head>
<body>


<h1>ココロドットコム</h1>

<h3 style="color:pink">おすすめの癒やしスポットの検索、レビューが出来るサイトです！</h3>

<a href="index.php">一覧ページ</a><br>
<a href="user_new.php">ユーザー登録</a><br>
<a href="spot_new.php">スポット登録</a><br>
<a href="review_new.php">レビュー投稿</a><br>
<a href="login.php">ログイン</a><br>
<a href="logout.php">ログアウト</a><br>
<a href="spot_page.php">お店ページ</a><br>
<a href="review_new.php">レビューページ</a><br>
<a href="mypage.php">マイページ</a><br>
</body>
</html