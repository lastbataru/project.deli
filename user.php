<?php
require_once 'inc/util.php';
require_once 'inc/db.php';
session_start ();
if ($_SESSION ["login"] != true) {
  header ( "Location: login.php" );
  exit ();
}
$email = $_SESSION ["email"];
try {
  $pdo = db_init ();

  $stmt = $pdo->query ( "select * from dill_user where email='" . $email . "'" );
  $user = $stmt->fetch ();

  $id = $user ["id"];
  $stmtAllergy = $pdo->query ( "select * from dill_allergy_category join dill_allergy_user
		on dill_allergy_category.id=dill_allergy_user.allergy_id
		where dill_allergy_user.user_id=" . $id );
  $allergies = $stmtAllergy->fetchAll ();

  $stmtCoupon = $pdo->query ( "select * from dill_coupon_name join dill_coupon_user
		on dill_coupon_name.id=dill_coupon_user.coupon_id
		where dill_coupon_user.user_id=" . $id );
  $coupons = $stmtCoupon->fetchAll ();
} catch ( PDOException $e ) {
  echo $e->getMessage ();
  exit ();
}

if (isset ( $_POST ["useCoupon"] )) {
  $_SESSION ["coupon"] = array (
      "name" => $_POST ["coupon_name"],
      "price" => $_POST ["coupon_price"],
      "percentage" => $_POST ["coupon_percentage"]
  );
}
if (isset ( $_POST ["logout"] )) {
  unset ( $_SESSION ["login"] );
  unset ( $_SESSION ["email"] );
  unset ( $_SESSION ["coupon"] );
  header ( "Location:login.php" );
}
?>
<?php require_once 'header.php';?>
<!--<?php var_dump($_SESSION);?>  -->
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
						<div class="panel-body">
							<p>
								<?php echo h($user["lastname"]);?>　<?php echo h($user["firstname"]);?>
							</p>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">メールアドレス</div>
						<div class="panel-body">
							<p>
								<?php echo h($user["email"]);?>
							</p>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">郵便番号</div>
						<div class="panel-body">
							<p>
								<?php echo h($user["postal1"]);?>-<?php echo h($user["postal2"]);?>
							</p>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">住所</div>
						<div class="panel-body">
							<p>
								<?php echo h($user["prefecture"]);?><?php echo h($user["address1"]);?><?php echo h($user["address2"]);?>　<?php echo h($user["building"]);?>
							</p>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">クーポン</div>
						<div class="panel-body">
							<?php foreach ($coupons as $coupon):?>
							<form action="#" method="post">

								<p>
									<input type="hidden" name="coupon_name"
										value="<?php echo $coupon ["name"];?>">
								</p>
								<p>
									<input type="hidden" name="coupon_price"
										value="<?php echo $coupon ["price"];?>">
								</p>
								<p>
									<input type="hidden" name="coupon_percentage"
										value="<?php echo $coupon ["percentage"];?>">
								</p>
								<p><?php echo $coupon ["name"];?></p>
								<p>
									<button type="submit" name="useCoupon">使う</button>
								</p>
							</form>
							<?php endforeach;?>
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
					<form action="#" method="post">
						<button type="submit" name="logout">ログアウト</button>
					</form>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<?php require_once 'footer.php';?>