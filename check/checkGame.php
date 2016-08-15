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
		<title>Game Details</title>
	</head>
	<body>
		<div>
			<table>
				<tr>
					<th>Name</th>
					<th>Min Players</th>
					<th>Max Players</th>
				</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT name, player_min, player_max FROM game_tbl WHERE game_tbl.id = ?" ))) {
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i", $_POST['game']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->bind_result($name, $min_player, $max_player)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo "<tr>\n<td>" . $name . "</td>\n<td>" . $min_player .  "</td>\n<td>" .$max_player . "</td>\n</tr>";
}
$stmt->close();
?>
			</table>
		</div>
		</br>
		</br>
		<div>
			<table>
				<tr>
					<th>Game Type(s)</th>
				</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT type_tbl.name FROM game_tbl INNER JOIN game_types_tbl ON game_tbl.id = game_types_tbl.game_id INNER JOIN type_tbl ON game_types_tbl.type_id = type_tbl.id WHERE game_tbl.id = ?" ))) {
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i", $_POST['game']))){
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
		</br>
		<div>
			<table>
				<caption>Results</caption>
				<tr>
					<th>Date Played</th>
					<th>Winner</th>
				</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT result_tbl.date_played, player_tbl.fname, player_tbl.lname FROM player_tbl INNER JOIN result_tbl ON result_tbl.player_id = player_tbl.id INNER JOIN game_tbl ON game_tbl.id = result_tbl.game_id WHERE result_tbl.game_id = ?"))) {
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i", $_POST['game']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}	
if(!$stmt->bind_result($date, $fname, $lname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo "<tr>\n<td>" . $date . "</td><td>" . $fname . " " . $lname . "</td>\n</tr>";
}
$stmt->close();
?>
			</table>
		</div>
		</br>
		<a href="../home.php">Back to Home</a>
	</body>
</html>