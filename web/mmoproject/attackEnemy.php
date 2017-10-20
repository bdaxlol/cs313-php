<script src="index.js"></script>
<?php
require "dbConnect.php";
$db = get_db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$str = $_POST["str"];
$enemyId = $_POST["enemyId"];

//got parameters for str of attacking player and id of target enemy

$statement = $db->prepare('SELECT e.health_points, el.name FROM enemy as e, enemy_lookup as el WHERE e.id=' . $enemyId . ' AND el.id=e.type');
$statement->execute();
// Go through each result

while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
	$enemyHP = $row['health_points'];
	$enemyName = $row['name'];
}

// We have enemy's current HP, check if enemy is still alive
if ($enemyHP <= 0) {
	echo "0";
} else {
	$enemyHP -= $str;
}

// Check if this attack kills it
if ($enemyHP <= 0) {
	echo "0";
	//Should we change something since this creature is dead? Do I have time to implement this?
} else {
	echo $enemyHP;
	// Now update DB to keep this new HP value for enemy
	$statement = $db->prepare('UPDATE enemy SET health_points = ' . $enemyHP . ' WHERE id=' . $enemyId);
	$statement->execute();
}
}

?>