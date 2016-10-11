<?php
session_start ();
define ( "IMAGE_PATH", "images/menu/" );
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
			<?php if (is_array($_SESSION["cart"])):?>
			<?php foreach ($_SESSION ["cart"] as $item):?>
			<tr>
				<td>
					<div class="col-xs-4">
						<img src="<?php echo IMAGE_PATH.$item["src"]?>"
							alt="<?php echo $item["name"]?>">
					</div>
					<div class="col-xs-8">
						<div>
							<h2><?php echo $item["name"]?></h2>
						</div>
						<div><?php echo $item["price"]?>円（税込）</div>
						<div>
							<a href="#" class="ui-btn btn-change">変更</a> <a href="#"
								class="ui-btn btn-cancel">キャンセル</a>
						</div>
					</div>
				</td>
			</tr>
			<?php endforeach;?>
			<?php else:?>
				<td>買い物かごは空です。</td>
			<?php endif;?>
		</tbody>
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
			<tr>
				<td>
					<div>
						<div>
							<h2>誕生日の方限定！！50%OFFクーポン</h2>
							<span>1枚</span>
						</div>
						<div>－2635円</div>
						<div>
							<button>クーポン変更</button>
							<button>クーポン削除</button>
						</div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-bordered">
		<thead>
			<tr>
				<td>
					<div>
						<h1>ご注文合計金額</h1>
					</div>
					<div>2635円（税込）</div>
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<div>
						<a href="#" class="ui-btn">お会計へ進む</a>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<?php require_once 'footer.php';?>