<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "dalet-db", "N9lGRQfgZkTeF9SM", "dalet-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!($stmt = $mysqli->prepare("INSERT INTO result_tbl(game_id, player_id, date_played) VALUES (?,?,?)"))) {
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("iis",$_POST['game'],$_POST['player'],$_POST['datePlayed']))) {
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to result_tbl.";
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Add Result</title>
	</head>
	<body>
		</br>
		<a href="../home.php">Back to Home</a>
	</body>
</html>