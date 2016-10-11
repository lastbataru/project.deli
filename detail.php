<?php
require_once 'inc/util.php';
require_once 'inc/db.php';
require_once 'inc/auth.php';
session_start ();

define ( "IMAGE_PATH_MENU", "images/menu/" );
define ( "IMAGE_PATH_STUFF", "images/stuff/" );
if (isset ( $_GET ["id"] )) {
  $id = $_GET ["id"];
  try {
    $pdo = db_init ();
    $stmt = $pdo->prepare ( "SELECT * FROM menu WHERE id=?" );
    $stmt->execute ( array (
        $id
    ) );
    $menu = $stmt->fetch ();

    $stmtStuffList = $pdo->query ( "select * from stuff_name join stuff_menu on stuff_name.id=stuff_menu.stuff_id
where stuff_menu.menu_id=" . $id );
    $stuffList = $stmtStuffList->fetchAll ();
  } catch ( PDOException $e ) {
    echo $e->getMessage ();
    exit ();
  }
}

if ($_SERVER ["REQUEST_METHOD"] === "POST") {
  $name = $_POST ["name"];
  $price = $_POST ["price"];
  $src_sm = $_POST ["src_sm"];
  $item = array (
      "name"=>$name,
      "price"=>$price,
      "src"=>$src_sm
  );
  $_SESSION ["cart"] [] = $item;
  header ( "Location: menu.php" );
  exit ();
}
?>
<?php require_once 'header.php';?>
<div class="containter" id="detail">

	<img src="<?php echo IMAGE_PATH_MENU.h($menu["src_lg"])?>"
		alt="<?php echo h($menu["name"]);?>">
	<h1><?php echo h($menu["name"]);?></h1>
	<p><?php echo h($menu["description"]);?></p>
	<p><?php echo h($menu["kcal"]);?>kcal ￥<?php echo h($menu["price"]);?></p>
	<div class="col-xs-12">
		<?php foreach($stuffList as $stuff):?>
		<div class="col-xs-4">
			<figure class="fig-dishname">
				<img src="<?php echo IMAGE_PATH_STUFF.h($stuff["src"]);?>" alt="">
				<figcaption class="cap-dishname"><?php echo h($stuff["name"]); ?></figcaption>
			</figure>
		</div>
		<?php endforeach;?>
	</div>
	<form action="#" method="post">
		<p>
			<input type="hidden" name="name"
				value="<?php echo h($menu["name"]); ?>">
		</p>
		<p>
			<input type="hidden" name="price"
				value="<?php echo h($menu["price"]); ?>">
		</p>
		<p>
			<input type="hidden" name="src_sm"
				value="<?php echo h($menu["src_sm"]); ?>">
		</p>
		<button type="submit">買い物かごに追加 | &yen;<?php echo h($menu["price"]);?></button>
	</form>
</div>
<?php require_once 'footer.php';?>
