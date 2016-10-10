<?php
function auth_confirm()
{
  if ($_SESSION["admin_login"] != TRUE) {
    header("Location: login.php");
    exit;
  }
}
