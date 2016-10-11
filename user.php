<?php
require_once 'inc/util.php';
require_once 'inc/db.php';
session_start ();
if ($_POST ["login"] != true) {
  header ( "Location: login.php" );
  exit ();
}
$email = $_SESSION ["email"];
try {
  $pdo = db_init ();
  $stmt = $pdo->query ( "select * from user where email='" . $email . "'" );
  $user = $stmt->fetch ();

  $id = $user ["id"];
  $stmtAllergy = $pdo->query ( "select * from allergy_category join allergy_user
on allergy_category.id=allergy_user.allergy_id
where allergy_user.user_id=" . $id );
  $allergies = $stmtAllergy->fetchAll ();
} catch ( PDOException $e ) {
  echo $e->getMessage ();
  exit ();
}
?>
<?php require_once 'header.php';?>
<div class="container" id="user">
	<table class="table table-bordered">
		<thead>
			<tr>
				<td>
					<h2>Profile</h2>
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<div class="panel panel-default">
						<div class="panel-heading">氏名</div>
						<div class="panel-body"><?php echo h($user["lastname"]);?>　<?php echo h($user["firstname"]);?><button>変更する</button>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">メールアドレス</div>
						<div class="panel-body"><?php echo h($user["email"]);?><button>変更する</button>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">郵便番号</div>
						<div class="panel-body"><?php echo h($user["postal1"]);?>-<?php echo h($user["postal2"]);?><button>変更する</button>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">住所</div>
						<div class="panel-body"><?php echo h($user["prefecture"]);?><?php echo h($user["address1"]);?><?php echo h($user["address2"]);?>　<?php echo h($user["building"]);?><button>変更する</button>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">アレルギー</div>
						<div class="panel-body">
							<?php foreach ($allergies as $allergy):?>
							<p><?php echo $allergy ["name"];?></p>
							<?php endforeach;?>
						</div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<?php require_once 'footer.php';?>