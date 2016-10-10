<?php

require_once 'inc/util.php';
require_once 'inc/db.php';
require_once 'inc/auth.php';

define ( "IMAGE_PATH", "images/menu/" );

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  try {
    $pdo = db_init();
    $stmt = $pdo->prepare("SELECT * FROM menu WHERE id=?");
    $stmt->execute(array($id));
    $menu = $stmt->fetch();
  }
  catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }
}
?>
<?php require_once 'header.php';?>
<div class="containter" id="detail">
	<div class="col-xs-12">

		<div>
			<img src="<?php echo IMAGE_PATH.h($menu["src_lg"])?>" alt="<?php echo h($menu["name"]);?>">
		</div>
		<div>
			<h1><?php echo h($menu["name"]);?></h1>
		</div>
		<div>
			<p><?php echo h($menu["description"]);?></p>
			<div><?php echo h($menu["kcal"]);?>kcal ￥<?php echo h($menu["price"]);?></div>
		</div>
		<div>
			<div class="col-xs-3">
				<img src="images/stuff_broccoli_floretes.jpg" alt="">
			</div>
			<div class="col-xs-3">
				<img src="images/stuff_broccoli_floretes.jpg" alt="">
			</div>
			<div class="col-xs-3">
				<img src="images/stuff_broccoli_floretes.jpg" alt="">
			</div>
			<div class="col-xs-3">
				<img src="images/stuff_broccoli_floretes.jpg" alt="">
			</div>
			<div class="col-xs-3">
				<img src="images/stuff_broccoli_floretes.jpg" alt="">
			</div>
			<div class="col-xs-3">
				<img src="images/stuff_broccoli_floretes.jpg" alt="">
			</div>
			<div class="col-xs-3">
				<img src="images/stuff_broccoli_floretes.jpg" alt="">
			</div>
			<div class="col-xs-3">
				<img src="images/stuff_broccoli_floretes.jpg" alt="">
			</div>
		</div>
		<div>
			<div>購入数</div>
			<div>200</div>
		</div>
		<div>
			<a href="#" class="ui-btn">買い物かごに追加 | ￥1200</a>
		</div>
	</div>
</div>
<?php require_once 'footer.php';?>
