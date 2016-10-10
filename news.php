<?php
require_once 'inc/util.php';
require_once 'inc/db.php';
require_once 'inc/auth.php';

define ( "IMAGE_PATH", "images/news/" );

try {
  $pdo = db_init ();
  $stmt = $pdo->query ( "select * from news join news_category on news.category_id=news_category.id ORDER BY created DESC" );
  $news = $stmt->fetchAll ();
} catch ( PDOException $e ) {
  echo $e->getMessage ();
  exit ();
}

?>
<?php require_once 'header.php';?>
<div class="container" id="news">
<?php foreach ($news as $post):?>
	<table class="table table-bordered">
		<thead>
			<tr>
				<td>
					<h1><?php echo h($post["name"])?></h1>
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<div class="col-xs-4">
						<img src="<?php echo IMAGE_PATH.h($post["src"]);?>"
							alt="<?php echo h($post["title"])?>">
					</div>
					<div class="col-xs-8">
						<h2><?php echo h($post["title"])?></h2>
						<time><?php echo h($post["posted"])?></time>
						<p><?php echo h($post["message"])?></p>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
<?php endforeach;?>
</div>
<?php require_once 'footer.php';?>