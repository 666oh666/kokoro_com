<?php

session_start();
mysql_connect('localhost', 'root', 'root') or die(mysql_error());
mysql_select_db('kokoro_com');
mysql_query('set names utf8');

$spot_id = $_GET['id'];




$sql = "SELECT * FROM review WHERE spot_id='$spot_id'";
$record = mysql_query($sql) or die(mysql_error());
$review = mysql_fetch_assoc($record);

$review_star = $review['star'];
$review_title = $review['title'];
$review_text = $review['text'];
$review_user_id = $review['user_id'];

$sql1 = "SELECT * FROM user WHERE id='$review_user_id'";
$record1 = mysql_query($sql1) or die(mysql_error());
$user1 = mysql_fetch_assoc($record1);

$review_name = $user1['name'];

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



// if (!empty($_POST)) {
	// 登録処理をする

	//セキュリティを強化した書き方

	// $sql = sprintf('INSERT INTO user SET name="%s", email="%s", password="%s", address="%s"',
	// 	mysql_real_escape_string($_POST['name']),
	// 	mysql_real_escape_string($_POST['email']),
	// 	mysql_real_escape_string($_POST['password']),
	// 	mysql_real_escape_string($_POST['address'])

	// );
	
	// $user_id = $user['id'];
	// $star = $_POST['star'];
	// $title = $_POST['title'];
	// $text = $_POST['text'];

	// foreach ($_REQUEST['holiday'] as $holiday) {
 // print(htmlspecialchars($holiday)); }


// ,'$holiday'
	// $sql = "INSERT INTO review SET spot_id='$spot_id', user_id='$user_id', star='$star', title='$title', text='$text'";
	// mysql_query($sql) or die(mysql_error());

	// header('Location: thanks.php');
	// exit();

// }

?>

<h1>お店の評価</h1>

<?php
	
	echo "名前<br>";
	
	echo $review_name."<br>";

	echo "評価<br>";
	
	echo $review_star."<br>";

	echo "タイトル<br>";
	
	echo $review_title."<br>";

	echo "本文<br>";
	
	echo $review_text;
	echo "<hr>"

?>

<a href="index.php">一覧へ戻る</a>