<?php
session_start();
require "dbConnect.php";
$db = get_db();

echo session_id();
echo ini_get('session.cookie_domain');
?>

<!DOCTYPE html>

<html>

	<head>
		<title>CS313 Project 1 - MMORPG Mockup</title>
		<link rel="stylesheet" type="text/css" href="index.css">
		<script src="index.js"></script>
	</head>

	<body>
		<header>
			<img id="leftFloat" src="images/black-cat-icon-11.png" alt="Home Page Icon" height="105" width="105">
			<h1 id="rightFloat">MMORPG Mockup<h1>
		</header>

		<nav>
			<ul>
				<a href="account_select.php">Account Select</a>
				<p>Character Select</p>
			</ul>
		</nav>

		<article>
			<h1>Player Characters</h1>
			<p>Select a Character to Play</p>

			<?php
			print_r($_SESSION);
			echo "You previously selected " . $_SESSION["account"] . " as the account.";

			?>
			
		</article>
	</body>
</html>