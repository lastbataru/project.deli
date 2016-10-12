<?php
require_once 'inc/util.php';
require_once 'inc/db.php';

define ( "IMAGE_PATH", "images/menu/" );

try {
  $pdo = db_init ();
  $stmtlg = $pdo->query ( "SELECT * FROM dill_menu ORDER BY created DESC limit 0,1" );
  $menulg = $stmtlg->fetchAll ();
  $stmtsm = $pdo->query ( "SELECT * FROM dill_menu ORDER BY created DESC limit 1,100" );
  $menusm = $stmtsm->fetchAll ();
} catch ( PDOException $e ) {
  echo $e->getMessage ();
  exit ();
}
?>
<?php require_once 'header.php';?>
<div class="containter" id="menu">
	<?php foreach ($menulg as $itemlg): ?>
	<div class="col-xs-12">
		<a href="detail.php?id=<?php echo h($itemlg["id"]);?>">
			<figure class="fig-dishname">
				<img src="<?php echo IMAGE_PATH . h($itemlg["src_lg"]); ?>" alt="">
				<figcaption class="cap-dishname"><?php echo h($itemlg["name"]); ?></figcaption>
			</figure>
		</a>
	</div>
	<?php endforeach; ?>
	<?php foreach ($menusm as $itemsm): ?>
	<div class="col-xs-6">
		<a href="detail.php?id=<?php echo h($itemsm["id"]);?>">
			<figure class="fig-dishname">
				<img src="<?php echo IMAGE_PATH . h($itemsm["src_sm"]); ?>" alt="">
				<figcaption class="cap-dishname"><?php echo h($itemsm["name"]); ?></figcaption>
			</figure>
		</a>
	</div>
	<?php endforeach; ?>
</div>
<?php require_once 'footer.php';?>