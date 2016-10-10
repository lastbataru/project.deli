<?php
define ( "HOST", "localhost" );
define ( "DBNAME", "dilldelivery" );
define ( "DBUSER", "dilluser" );
define ( "DBPASS", "secret" );
function db_init() {
  $pdo = new PDO ( "mysql:host=" . HOST . ";dbname=" . DBNAME, DBUSER, DBPASS );
  $pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $pdo->exec ( "SET NAMES utf8" );
  return $pdo;
}
?>