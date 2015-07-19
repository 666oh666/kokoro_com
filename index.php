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

} else {
  // ログインしていない
  header('Location: login.php'); exit();
}

  $sql2 = "SELECT * FROM spot";
  $spot = mysql_query($sql2) or die(mysql_error());

  $sql3 = "SELECT * FROM review";
  $review = mysql_query($sql3) or die(mysql_error());

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>お店一覧</title>
</head>
<body>

<h1>ようこそ！</h1>
<p><?php echo $user['name']; ?>さん</p>
<br>


<h3>
お店一覧
</h3>
<hr></hr>

<!-- spotテーブルから全件データを取得 -->
<?php
while ($spots = mysql_fetch_assoc($spot)):
?>

<h4>店名</h4>
<a href="spot_page.php?id=<?php echo $spots['id']; ?>">
<p><?php echo $spots['name']; ?>さん</p></a>
<h4>料金</h4>
<p><?php echo $spots['price']; ?>円</p>

<hr></hr>

<!-- reviewテーブルから全件データを取得 -->
<?php
while ($reviews = mysql_fetch_assoc($review)):
?>
<h3>レビュー</h3>
<h4>評価</h4>
<p><?php echo $reviews['star']; ?></p>
<h4>タイトル</h4>
<p><?php echo $reviews['title']; ?></p>
<h4>本文</h4>
<p><?php echo $reviews['text']; ?></p>

<hr>

<?php endwhile?><!-- review -->

<?php endwhile?><!-- spot -->

<hr><hr>

<a href="top.php">トップページへ戻る</a><br>

</body>
</html>
