<?php
//
define ( "HOST", "localhost" );
define ( "DBNAME", "DBzd1A10" );
define ( "DBUSER", "zd1A10" );
define ( "DBPASS", "C4T5KS" );
//
// define ( "HOST", "localhost" );
// define ( "DBNAME", "dilldelivery" );
// define ( "DBUSER", "dilluser" );
// define ( "DBPASS", "secret" );
//
function db_init() {
  $pdo = new PDO ( "mysql:host=" . HOST . ";dbname=" . DBNAME, DBUSER, DBPASS );
  $pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $pdo->exec ( "SET NAMES utf8" );
  return $pdo;
}
?>