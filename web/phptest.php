<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>PostgreSQL SELECT Example 1</title>
</head>
<body>
<h1>List of all entries in the table</h1>
<?php
$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=mniDnb16");
$result = pg_query($db,"SELECT * FROM scriptures");
echo "<table>";
while($row=pg_fetch_assoc($result)){echo "<tr>";
echo "<td align='center' width='200'>" . $row['id'] . "</td>";
echo "<td align='center' width='200'>" . $row['book'] . "</td>";
echo "<td align='center' width='200'>" . $row['chapter'] . "</td>";
echo "<td align='center' width='200'>" . $row['verse'] . "</td>";
echo "<td align='center' width='200'>" . $row['content'] . "</td>";
echo "</tr>";}echo "</table>";?>
</div>
</body>
</html>