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
		<title>View Player</title>
	</head>
	<body>
		<div>
			<table>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
				</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT fname, lname FROM player_tbl WHERE player_tbl.id = ?" ))) {
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i", $_POST['player']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->bind_result($fname, $lname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo "<tr>\n<td>" . $fname . "</td><td>" . $lname . "</td>\n</tr>";
}
$stmt->close();
?>
			</table>
		</div>
		</br>
		</br>
		<div>
			<table>
				<caption>Results</caption>
				<tr>
					<th>Game</th>
					<th>Date Played</th>
				</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT result_tbl.date_played, game_tbl.name FROM player_tbl INNER JOIN result_tbl ON result_tbl.player_id = player_tbl.id INNER JOIN game_tbl ON game_tbl.id = result_tbl.game_id WHERE player_tbl.id = ?"))) {
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i", $_POST['player']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}	
if(!$stmt->bind_result($date, $gname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo "<tr>\n<td>" . $gname . "</td><td>" . $date . "</td>\n</tr>";
}
$stmt->close();
?>
			</table>
		</div>
		</br>
		<a href="../home.php">Back to Home</a>
	</body>
</html>