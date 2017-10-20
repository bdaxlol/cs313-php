<?php
session_start();
$q = $_REQUEST["q"];
$r = $_REQUEST["r"];

$_SESSION[$q] = $r;
echo "Session variable $q set to " . $_SESSION[$q];
?>