<?php
$var = $_REQUEST["q"];
$val = $_REQUEST["r"];

$_SESSION[$var] = $val;
echo "Session variable $var set to $val .";
?>