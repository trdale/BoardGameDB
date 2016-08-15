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
		<title>All Results</title>
	</head>
	<body>
		<div>
			<table>
				<caption>Results</caption>
				<tr>
					<th>Game</th>
					<th>Date Played</th>
					<th>Winner</th>
				</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT game_tbl.name, result_tbl.date_played, player_tbl.fname, player_tbl.lname FROM player_tbl INNER JOIN result_tbl ON result_tbl.player_id = player_tbl.id INNER JOIN game_tbl ON game_tbl.id = result_tbl.game_id"))) {
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}	
if(!$stmt->bind_result($gname, $date, $fname, $lname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo "<tr>\n<td>" . $gname . "</td><td>" . $date . "</td><td>" . $fname . " " . $lname . "</td>\n</tr>";
}
$stmt->close();
?>
			</table>
		</div>
		</br>
		<a href="../home.php">Back to Home</a>
	</body>
</html>