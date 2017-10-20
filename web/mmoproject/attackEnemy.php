<?php
session_start();
$str = $_REQUEST["str"];
$enemyId = $_REQUEST["enemyId"];

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
	echo "<script> addLine('This enemy appears already dead. Try attacking a different one.'); </script>";
} else {
	echo "<script> addLine('You attack " . $enemyName . " for " . $str . " damage.'); </script>";
	$enemyHP -= $str;
}

// Check if this attack kills it
if ($enemyHP <= 0) {
	echo "<script> addLine('You have successfully murdered this creature.'); </script>";
	//Should we change something since this creature is dead? Do I have time to implement this?
	echo "<script> addLine('If I was feeling diligent, you would get some EXP right now.'); </script>";
	echo "<script> addLine('Sorry breh.'); </script>";
} else {
	echo "<script> addLine('" . $enemyName . " has " . $enemyHP . " HP remaining.'); </script>";
	// Now update DB to keep this new HP value for enemy
	$statement = $db->prepare('UPDATE enemy SET health_points = ' . $enemyHP . ' WHERE id=' . $enemyId);
	$statement->execute();
}

?>