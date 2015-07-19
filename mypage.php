<?php

session_start();
mysql_connect('localhost', 'root', 'root') or die(mysql_error());
mysql_select_db('kokoro_com');
mysql_query('set names utf8');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  // ログインしている

  $session_id = $_SESSION['id'];
  $_SESSION['time'] = time();
  
  $sql1 = "SELECT * FROM user WHERE id='$session_id'";
  $record1 = mysql_query($sql1) or die(mysql_error());
  $user = mysql_fetch_assoc($record1);

  $sql2 = "SELECT * FROM review WHERE user_id='$session_id'";
  $record2 = mysql_query($sql2) or die(mysql_error());
  

} else {
  // ログインしていない
  echo "<a href='login.php'>ログイン</a>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>マイページ</title>
</head>
<body>

<h1>
<?php


echo $user['name'];
echo "さんのページ";

?>
</h1>

<section class="user-info">
      <ul>
        <li class="info--username">
          <span class="title">氏名 (<a href="#apply_name_change" rel="leanModal" class="edit-name">編集</a>)</span> <span class="data">
			<?php echo $user['name'];?>
		  </span>
        </li>
        <li class="info--email">
          <span class="title">メールアドレス
            (<a href="#change_email" rel="leanModal" class="edit-email">編集</a>)
          </span> <span class="data">
          <?php echo $user['email'];?>
          </span>
        </li>
      </ul>
</section>

<?php
while ($review = mysql_fetch_assoc($record2)):{
echo $review['star']."<br>";
echo $review['title']."<br>";
echo $review['text'];
echo "<hr>";
}
endwhile?>
<br>
<a href="top.php">トップページへ戻る</a><br>
</body>
</html>