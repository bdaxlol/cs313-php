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
				<a href="char_select.php">Character Select</a>
			</ul>
		</nav>

		<article>
			<?php

			echo '<table><tr>';
			echo '<th>Name</th>';
			echo '<th>HP</th>';
			echo '<th>STR</th>';
			echo '<th>INT</th>';
			echo '<th>AGI</th>';
			echo '<th>EXP</th>';
			echo '<th>GOLD</th>';
			echo '<th>Map</th></tr>';

			$statement = $db->prepare('SELECT name, health_points, strength, intellect, agility, exp_points, gold, map_id, map_x, map_y FROM player WHERE id=' . $_SESSION["character"]);
			$statement->execute();
			// Go through each result

			while ($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
			$name = $row['name'];
			$hp = $row['health_points'];
			$str = $row['strength'];
			$inte = $row['intellect'];
			$agi = $row['agility'];
			$exp = $row['exp_points'];
			$gold = $row['gold'];
			$mapid = $row['map_id'];
			$mapx = $row['map_x'];
			$mapy = $row['map_y'];
			}
			
			$statement = $db->prepare('SELECT name FROM map WHERE id=' . $mapid);
			$statement->execute();
			// Go through each result

			while ($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
			$mapName = $row['name'];
			}

			echo '<tr>';
			echo '<td>' . $name . '</td>';
			echo '<td>' . $hp . '</td>';
			echo '<td>' . $str . '</td>';
			echo '<td>' . $inte . '</td>';
			echo '<td>' . $agi . '</td>';
			echo '<td>' . $exp . '</td>';
			echo '<td>' . $gold . '</td>';
			echo '<td>' . $mapName . ': ' . $mapx . ', ' . $mapy . '</td>';
			echo '</tr>';
			echo '</table>';

			echo '<br><div id="scrollDiv">';
			echo '<table id="scrollTable"><tr><td>Welcome!</td></tr></table></div><br>'
			
			echo "<script> addLine('You are standing in " . $mapName . "'); </script>";

			// add a table to display nearby monsters
			echo '<table><tr>';
			echo '<th>Name</th>';
			echo '<th>Max HP</th>';
			echo '<th>X</th>';
			echo '<th>Y</th>';
			echo '<th>Action</th></tr>'

			$statement = $db->prepare('SELECT e.id, el.name, el.base_health_points, e.map_x, e.map_y FROM enemy as e, enemy_lookup as el WHERE e.map_id=' . $mapid . ' AND el.id=e.type');
			$statement->execute();
			// Go through each result

			while ($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				echo '<tr>';
				echo '<td>' . $row['name'] . '</td>';
				echo '<td>' . $row['base_health_points'] . '</td>';
				echo '<td>' . $row['map_x'] . '</td>';
				echo '<td>' . $row['map_y'] . '</td>';
				echo '<td><button onClick="attackEnemy(' . $str . ', ' . $row['id'] . ')">Attack</button></td>';
				echo '</tr>';
			}

			echo '</table>';
			?>
			
		</article>
	</body>
</html>