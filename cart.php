<?php
session_start ();
define ( "IMAGE_PATH", "images/menu/" );
sort ( $_SESSION ["cart"] );
if (isset ( $_POST ["menu_cancel"] )) {
  $cartId = $_POST ["id"];
  unset ( $_SESSION ["cart"] [$cartId - 1] );
}
if (isset ( $_POST ["coupon_cancel"] )) {
  unset ( $_SESSION ["coupon"] );
}
?>

<?php require_once 'header.php';?>
<div class="containter" id="cart">
	<table class="table table-bordered">
		<thead>
			<tr>
				<td>
					<h1>ご注文内容</h1>
				</td>
			</tr>
		</thead>
		<tbody>
		<?php if (isset($_SESSION["cart"])):?>
			<?php foreach ($_SESSION ["cart"] as $item):?>
	<?php
    $totalPrice += $item ["price"];
    $id ++;
    ?>
			<tr>
				<td>
					<div class="col-xs-4">
						<img src="<?php echo IMAGE_PATH.$item["src"]?>"
							alt="<?php echo $item["name"]?>">
					</div>
					<div class="col-xs-8">
						<h2><?php echo $item["name"]?></h2>
						<p><?php echo $item["price"]?>円（税込）</p>
						<form action="#" method="post">
							<p>
								<input type="hidden" name="id" value="<?php echo $id;?>">
							</p>
							<p>
								<button type="submit" name="menu_cancel">取り消し</button>
							</p>
						</form>
					</div>
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	<?php endif;?>
	</table>
	<table class="table table-bordered">
		<thead>
			<tr>
				<td>
					<h1>クーポン</h1>
				</td>
			</tr>
		</thead>
		<tbody>
		<?php if(isset($_SESSION["coupon"])):?>
	<?php
    if ($_SESSION ["coupon"] ["price"] != 0) {
      $couponPrice = $_SESSION ["coupon"] ["price"];
    } else {
      $couponPrice = $totalPrice * ($_SESSION ["coupon"] ["percentage"] / 100);
    }
    ?>
			<tr>
				<td>
					<h2><?php echo $_SESSION["coupon"]["name"];?></h2>
					<p>-<?php echo $couponPrice;?>円</p>
					<form action="#" method="post">
						<button type="submit" name="coupon_cancel">取り消し</button>
					</form>
				</td>
			</tr>
		<?php endif;?>
		</tbody>
	</table>
	<table class="table table-bordered">
		<thead>
			<tr>
				<td>
					<h1>ご注文合計金額</h1>
					<p><?php echo $totalPrice;?>円（税込）</p>
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<!-- 				<td><a href="#" class="ui-btn">お会計へ進む</a></td> -->
			</tr>
		</tbody>
	</table>
</div>

<?php require_once 'footer.php';?>