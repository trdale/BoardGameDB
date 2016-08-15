<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "dalet-db", "N9lGRQfgZkTeF9SM", "dalet-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>View By Type</title>
	</head>
	<body>
		<div>
			<table>
				<tr>
					<th>Name</th>
				</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT game_tbl.name FROM game_tbl INNER JOIN game_types_tbl ON game_tbl.id = game_types_tbl.game_id INNER JOIN type_tbl ON game_types_tbl.type_id = type_tbl.id WHERE type_tbl.id = ?" ))) {
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i", $_POST['type']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->bind_result($name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo "<tr>\n<td>" . $name . "</td>\n</tr>";
}
$stmt->close();
?>
			</table>
		</div>
		</br>
		<a href="../home.php">Back to Home</a>
	</body>
</html>