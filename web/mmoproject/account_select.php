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
				<p>Account Select</p>
			</ul>
		</nav>

		<article>
			<h1>User Accounts</h1>
			<p>Select a username to access the account.</p>

			<!-- This table layout is temporary for debugging -->
			<table>
				<tr>
					<th>ID</th>
					<th>Username</th>
					<th>E-mail Address</th>
				</tr>
			<?php
			
			$statement = $db->prepare("SELECT id, username, user_email FROM user_account");
			$statement->execute();
			// Go through each result

			while ($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>';
				echo '<td><button onClick="setSession(\'account\', ' . $row['id'] . ')">' . $row['username'] . '</button></td>';
				echo '<td>' . $row['user_email'] . '</td>';
				echo '</tr>';
			}
			?>
			</table>

			<div id="sessionStatus">Waiting for session to update...</div>

		</article>
	</body>
</html>