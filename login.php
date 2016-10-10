<?php require_once 'header.php';?>
<div class="contain" id="login">
	<form action="#" method="post">
		<div data-role="fieldcontain">
			<label for="email">メールアドレス</label>
			<input type="email" name="email" id="email" value="">
		</div>
		<div data-role="fieldcontain">
			<label for="password">パスワード</label>
			<input type="password" name="password" id="password" value="">
		</div>
		<button type="submit">ログイン</button>
	</form>
</div>
<?php require_once 'footer.php';?>