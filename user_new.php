<?php


mysql_connect('localhost', 'root', 'root') or die(mysql_error());
mysql_select_db('kokoro_com');
mysql_query('set names utf8');



if (!empty($_POST)) {
	// 登録処理をする

	//セキュリティを強化した書き方

	// $sql = sprintf('INSERT INTO user SET name="%s", email="%s", password="%s", address="%s"',
	// 	mysql_real_escape_string($_POST['name']),
	// 	mysql_real_escape_string($_POST['email']),
	// 	mysql_real_escape_string($_POST['password']),
	// 	mysql_real_escape_string($_POST['address'])
	// );

	


	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$address = $_POST['address'];

	$sql = "INSERT INTO user SET name='$name', email='$email', password='$password', address='$address'";

	mysql_query($sql) or die(mysql_error());

	header('Location: thanks.php');
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ユーザー登録</title>
</head>
<body>

<h1>
ココロドットコムへようこそ	
</h1>

<h3>
新規ユーザー登録
</h3>

<form action="" method="post">
<p>
名前：<input type="text" name="name" size="40" value="<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');?>">
</p>
<p>
メールアドレス：<input type="text" name="email" size="40">
</p>
<p>
パスワード：<input type="password" name="password" size="40">
</p>
<p>
お住まい：
<select name="address">
<option value="" selected>都道府県</option>
<option value="北海道">北海道</option>
<option value="青森県">青森県</option>
<option value="岩手県">岩手県</option>
<option value="宮城県">宮城県</option>
<option value="秋田県">秋田県</option>
<option value="山形県">山形県</option>
<option value="福島県">福島県</option>
<option value="茨城県">茨城県</option>
<option value="栃木県">栃木県</option>
<option value="群馬県">群馬県</option>
<option value="埼玉県">埼玉県</option>
<option value="千葉県">千葉県</option>
<option value="東京都">東京都</option>
<option value="神奈川県">神奈川県</option>
<option value="新潟県">新潟県</option>
<option value="富山県">富山県</option>
<option value="石川県">石川県</option>
<option value="福井県">福井県</option>
<option value="山梨県">山梨県</option>
<option value="長野県">長野県</option>
<option value="岐阜県">岐阜県</option>
<option value="静岡県">静岡県</option>
<option value="愛知県">愛知県</option>
<option value="三重県">三重県</option>
<option value="滋賀県">滋賀県</option>
<option value="京都府">京都府</option>
<option value="大阪府">大阪府</option>
<option value="兵庫県">兵庫県</option>
<option value="奈良県">奈良県</option>
<option value="和歌山県">和歌山県</option>
<option value="鳥取県">鳥取県</option>
<option value="島根県">島根県</option>
<option value="岡山県">岡山県</option>
<option value="広島県">広島県</option>
<option value="山口県">山口県</option>
<option value="徳島県">徳島県</option>
<option value="香川県">香川県</option>
<option value="愛媛県">愛媛県</option>
<option value="高知県">高知県</option>
<option value="福岡県">福岡県</option>
<option value="佐賀県">佐賀県</option>
<option value="長崎県">長崎県</option>
<option value="熊本県">熊本県</option>
<option value="大分県">大分県</option>
<option value="宮崎県">宮崎県</option>
<option value="鹿児島県">鹿児島県</option>
<option value="沖縄県">沖縄県</option>
</select>
</p>


<input type="submit" value="送信"><input type="reset" value="リセット">
</p>
</form>

<a href="top.php">トップページへ戻る</a><br>
</body>
</html