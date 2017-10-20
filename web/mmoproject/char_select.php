<?php
session_start();
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
				<a href="account_select.php">Account Select</a>
				<p>Character Select</p>
			</ul>
		</nav>

		<article>
			<h1>Player Characters</h1>
			<p>Select a Character to Play</p>

			<?php
			
			echo 'You previously selected ' . $_SESSION["account"] . ' as the account.';
			echo '<br>Due to current issues with sessions, I will proceed as if account ID 1 was selected.<br>';

			echo '<table><tr>';
			echo '<th>Account</th>';
			echo '<th>Player ID</th>';
			echo '<th>Character Name</th>';
			echo '<th>Exp</th>';
			echo '<th>HP</th>';
			echo '<th>STR</th>';
			echo '<th>INT</th>';
			echo '<th>AGI</th></tr>';

			$_SESSION["account"] = 1;

			$statement = $db->prepare("SELECT ua.username, p.id, p.name, p.exp_points, p.health_points, p.strength, p.intellect, p.agility FROM player as p, user_account as ua WHERE ua.id=1 AND ua.id=p.user_id");
			$statement->execute();
			// Go through each result

			while ($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				echo '<tr>';
				echo '<td>' . $row['ua.username'] . '</td>';
				echo '<td>' . $row['p.id'] . '</td>';
				echo '<td>' . $row['p.name'] . '</td>';
				echo '<td>' . $row['p.exp_points'] . '</td>';
				echo '<td>' . $row['p.health_points'] . '</td>';
				echo '<td>' . $row['p.strength'] . '</td>';
				echo '<td>' . $row['p.intellect'] . '</td>';
				echo '<td>' . $row['p.agility'] . '</td>';
				echo '</tr>';
			}

			echo '</table>';

			?>
			
		</article>
	</body>
</html>