<?php
require "dbConnect.php";
$db = get_db();
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
				<p>Account Select</p>
			</ul>
		</nav>

		<article>
			<h1>User Accounts</h1>
			<p>Select an account to access.</p>

			<!-- This table layout is temporary for debugging -->

			<?php
			
			$statement = $db->prepare("SELECT id, username, user_email FROM user_account");
			$statement->execute();
			// Go through each result

			while ($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				echo '<p>';
				echo '<strong>' . $row['id'] . ' ' . $row['username'] . ':';
				echo $row['user_email'];
				echo '</p>';
			}
			?>

		</article>
	</body>
</html>