<?php
require_once 'inc/util.php';
require_once 'inc/db.php';
session_start ();
$email = "";
$pass = "";
if ($_SERVER ["REQUEST_METHOD"] === "POST") {
  $email = $_POST ["email"];
  $pass = $_POST ["password"];
  $isValidated = true;
  if ($email === "") {
    $errorEmail = "ログインIDを入力してください。";
    $isValidated = false;
  }
  if ($pass === "") {
    $errorPass = "パスワードを入力してください。";
    $isValidated = false;
  }
  if ($isValidated == true) {
    try {
      $pdo = db_init ();
      $stmt = $pdo->prepare ( "select * from user where email=? and password=?" );
      $stmt->execute ( array (
          $email,
          $pass
      ) );
      $info = $stmt->fetch ();
      if ($info != false) {
        session_regenerate_id ();
        $_SESSION ["email"] = $email;
        $_SESSION ["login"] = true;
        header ( "Location: user.php" );
        exit ();
      } else {
        $errorLogin = "ログインIDまたはパスワードに誤りがあります。";
      }
    } catch ( PDOException $e ) {
      echo $e->getMessage ();
      exit ();
    }
  }
}
?>
<?php require_once 'header.php';?>
<div class="contain" id="login">
<?php var_dump($_SESSION);?>
	<form action="#" method="post">
	  <?php if (isset($errorEmail)): ?>
      <p class="error"><?php echo $errorEmail; ?></p>
      <?php endif; ?>
      <?php if (isset($errorPass)): ?>
      <p class="error"><?php echo $errorPass; ?></p>
      <?php endif; ?>
      <?php if (isset($errorLogin)): ?>
      <p class="error"><?php echo $errorLogin; ?></p>
      <?php endif; ?>
		<div data-role="fieldcontain">
			<label for="email">メールアドレス</label> <input type="email" name="email"
				id="email" value="<?php echo h($email); ?>">
		</div>
		<div data-role="fieldcontain">
			<label for="password">パスワード</label> <input type="password"
				name="password" id="password" value="<?php echo h($pass); ?>">
		</div>
		<button type="submit">ログイン</button>
	</form>
</div>
<?php require_once 'footer.php';?>