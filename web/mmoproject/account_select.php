<?php
	$db = NULL;
	try {
		// default Heroku Postgres configuration URL
		$dbUrl = getenv('DATABASE_URL');
		if (!isset($dbUrl) || empty($dbUrl)) {
			$dbUrl = "postgres://postgres:mniDnb16@localhost:5432/postgres";
		}
		// Get the various parts of the DB Connection from the URL
		$dbopts = parse_url($dbUrl);
		$dbHost = $dbopts["host"];
		$dbPort = $dbopts["port"];
		$dbUser = $dbopts["user"];
		$dbPassword = $dbopts["pass"];
		$dbName = ltrim($dbopts["path"],'/');
		// Create the PDO connection
		$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
		// this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch (PDOException $ex) {
		// If this were in production, you would not want to echo
		// the details of the exception.
		echo "Error connecting to DB. Details: $ex";
		die();
	}
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
			<table>
				<tr>
					<th>ID</th>
					<th>User Name</th>
					<th>User E-mail</th>
				</tr>

			<?php
			
			$statement = $db->prepare("SELECT id, username, user_email FROM user");
			$statement->execute();
			// Go through each result

			while ($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				echo '<tr><td>' . $row['id'] . '</td>';
				echo '<td>' . $row['username'] . '</td>';
				echo '<td>' . $row['user_email'] . '</td></tr>';
			}
			?>

			</table>

		</article>
	</body>
</html>