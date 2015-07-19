<?php
mysql_connect('localhost', 'root', 'root') or die(mysql_error());
mysql_select_db('kokoro_com');
mysql_query('set names utf8');

session_start();

if ($_COOKIE['email'] != '') {
	$_POST['email'] = $_COOKIE['email'];
	$_POST['password'] = $_COOKIE['password'];
	$_POST['save'] = 'on';
}




if (!empty($_POST)) {
	//ログインの処理
  $email = $_POST['email'];
  $password = $_POST['password'];

	if ($_POST['email'] != '' && $_POST['password'] !='') {

		$sql = "SELECT * FROM user where email='$email' AND password='$password'";

		$record = mysql_query($sql) or die(mysql_error());
		if ($table = mysql_fetch_assoc($record)){
			//ログイン成功
			$_SESSION['id'] = $table['id'];
			$_SESSION['time'] = time();

			// ログイン情報を記録する
			if ($_POST['save'] == 'on') {
				setcookie('email', $_POST['email'], time()+60*60*24*14);
				setcookie('password', $_POST['password'], time()+60*60*24*14);
			}

			header('Location: top.php');
			exit();
		} else {
			$error['login'] = 'failed';
		}
	} else {
		$error['login'] = 'blank';
	}

}



//ログインしていたら、開かない
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  header('Location: index.php'); exit();
}

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ログイン</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/tones_fav3.ico">
  </head>



<body style="background:#eee;">


	<div id="wrap">
	
  <div class="heading">
    <h1>ログイン</h1>
  </div>

  	<div class="login">
    <div id="lead">
      <p>メールアドレスとパスワードを記入して下さい</p>
    </div>
    <form action="" method="post">
      <dl>
        <dt>メールアドレス</dt>
        <dd>
          <input type="text" name="email" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['email']); ?>" />
          <?php if ($error['login'] == 'blank'): ?>
          <p class="error">* メールアドレスとパスワードをご記入ください</p>
          <?php endif; ?>
          <?php if ($error['login'] == 'failed'): ?>
          <p class="error">* メールアドレスまたはパスワードが間違っています</p>
          <?php endif; ?>
        </dd>
        <dt>パスワード</dt>
        <dd>
          <input type="password" name="password" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['password']); ?>" />
        </dd>
        <br>
        <dd>
          <input id="save" type="checkbox" name="save" value="on">
          <label for="save">次回からは自動的にログインする</label>
        </dd>
      </dl>
      
        <button type="submit" class="btn btn-block btn-primary">ログイン</button>
        </div>
        </div>


     </form>
     
        <p style="text-align: center;">
        アカウントを登録しませんか？<br>
        <a href="user_new.php" style="font-size:16px;">新規登録する</a>
    	</p>

      <a href="top.php">トップページへ戻る</a><br>

   

</div>

</div>

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
