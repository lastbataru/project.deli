<?php
function h($string) {
  return htmlspecialchars ( $string, ENT_QUOTES );
}
function getToken() {
  return hash ( 'sha256', session_id () );
}
?>