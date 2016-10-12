<?php
require_once 'inc/db.php';

try {
  $pdo = db_init ();
  $stmt = $pdo->query ( "select * from dill_user" );
  $userList = $stmt->fetchAll ();
} catch ( PDOException $e ) {
  echo $e->getMessage ();
  exit ();
}

?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>user list</title>
</head>
<body>
	<table border="1">
		<thead>
			<tr>
				<th>ID</th>
				<th>氏名</th>
				<th>メールアドレス</th>
				<th>パスワード</th>
			</tr>
		</thead>
		<?php foreach ($userList as $user):?>
		<tbody>
			<tr>
				<td><?php echo $user["id"]?></td>
				<td><?php echo $user["lastname"]?>　<?php echo $user["firstname"]?></td>
				<td><?php echo $user["email"]?></td>
				<td><?php echo $user["password"]?></td>
			</tr>
		</tbody>
		<?php endforeach;?>
	</table>
</body>
</html>